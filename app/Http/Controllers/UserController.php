<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('mobile-app')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        // $user->sendEmailVerificationNotification();

        return response($response, 201);
        // return response()->json(['message' => 'Registration successful. Please verify your email.'], 201);
    }


    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Incorrect email of password'
            ], 401);
        }

        $token = $user->createToken('mobile-app')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

         return response($response, 201);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();
        return response(['message' => 'Log out successful'], 200);
    }
}
