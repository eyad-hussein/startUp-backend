<?php

namespace App\Services;

use App\Http\Requests\User\RegisterUserRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthService
{

    public function attempt(array $credentials): bool
    {
        return Auth::attempt($credentials);
    }


    public function register(array $userData)
    {
        $user = User::create($userData);
        $token = $user->createToken('mobile-app')->plainTextToken;

        // $user->sendEmailVerificationNotification();

        return response([
            'user' => new UserResource($user),
            'token' => $token,
        ], 201);
        // return response()->json(['message' => 'Registration successful. Please verify your email.'], 201);
    }


    public function login(array $userData)
    {
        if (!$this->attempt($userData))
            return back()->withErrors(['message' => 'Invalid credentials']);

        $user = Auth::user();

        $token = $user->createToken('mobile-app')->plainTextToken;

        return response([
            'user' => new UserResource($user),
            'token' => $token,
        ]);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response(['message' => 'Log out successful']);
    }

    public function changePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        $user = Auth::user();
        $user->update([
            'password' => bcrypt($data['new_password']),
        ]);

        return response(['message' => 'Password changed successfully']);
    }

    public function validateToken(string $token)
    {
        if (Auth::user() && Auth::user()->tokens()->find($token))
            return response(['valid' => true]);
        else
            return response(['valid' => false]);
    }
}