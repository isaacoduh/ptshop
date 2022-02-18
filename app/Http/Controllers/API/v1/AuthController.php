<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */


    public function Register(RegisterRequest $request)
    {

        $user = User::create($request->only('first_name', 'last_name', 'email') + [
            'password' => Hash::make($request->input('password')),
            'is_admin' => $request->path() === 'api/admin/register' ? 1 : 0,
            'uuid' => (string)Str::uuid()
        ]);

        return response()->json([
            "success" => true,
            "message" => "User created successfully",
            "data" => $user
        ],201);

    }

    public function Login(Request $request)
    {
        // validate
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string:min:6'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if(!$token = auth()->attempt($validator->validated())){
            return response()->json([
                'error' => 'Unauthorized'
            ],401);
        }

        return $this->createNewToken($token);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

}
