<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthController extends Controller
{
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
    // public function Login(Request $request)
    // {
    //    if(!Auth::attempt($request->only('email', 'password'))){
    //         return response([
    //             'error' => 'invalid credentials',
    //         ], Response::HTTP_UNAUTHORIZED);
    //     }

    //     $user = Auth::user();
    //     $adminLogin = $request->path() === 'api/v1/admin/login';
    //     if($adminLogin && !$user->is_admin) {
    //         return response([
    //             'error' => 'Access Denied!'
    //         ], Response::HTTP_UNAUTHORIZED);
    //     }


    // }
}
