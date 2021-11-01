<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\{
    User,
};
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Hash;

class UserAuthManager extends Controller
{
    //



    public function Register(TRequest $request)
    {
        # code...
        $fields = $request->validate([
            'password'  => 'required|string|min:5',
            'email' => 'required|email|unique:users,email',
        ]);

        $fields['role'] = 'user';

        $user = User::create($fields);

        if(!$user){
            return response()->json([
                "message" => "User Not Registered"
            ],400);
        }

        return response()->json([
            "message" => "User Created Succesfully",
            "user" => $user,
            "token" => $user->createToken('auth_token', ['server:user'])->plainTextToken,
        ],400);
    }

    public function login(Request $request)
    {
 
        $fields = $request->validate([
            'password'  => 'required|string|min:5',
            'email' => 'required|email|max:255|exists:users,email',
        ]);
        
        $user = User::where('email', $fields['email'])->first();

        if(!$user ||!Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad credentials '
            ], 401);
        };


        $token = $user->createToken('auth_token', ['server:user'])->plainTextToken;
        $response['message'] = 'Login Sucessful';
        $response['token'] = $token;
        $response['user'] = $user;

        return response($response, 200);
    }


    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();

        return response([
            'message' => 'Successfully logged out'
        ], 200);

    }


}
