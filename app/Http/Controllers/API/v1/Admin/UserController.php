<?php

namespace App\Http\Controllers\API\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Return all users that are not admins
     *
     * @return array
     */
    public function index() {
        $users = User::all()->reject(function($user){
            return $user->is_admin == '1';
        });

        return response()->json([
            'data' => $users
        ]);
    }
}
