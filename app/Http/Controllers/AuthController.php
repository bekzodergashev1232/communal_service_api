<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ApiResponse;

class AuthController extends Controller
{
    // Register
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name'                => 'required|string|max:255',
            'email'               => 'required|email|max:255|unique:users',
            'password'            => 'required|string',
            'count_family_member' => 'required|integer|min:2',
        ]);

        try {
            $user = User::create([
                'name'                => $validatedData['name'],
                'email'               => $validatedData['email'],
                'password'            => bcrypt($validatedData['password']),
                'count_family_member' => $validatedData['count_family_member'],
            ]);

            return ApiResponse::success($user, 'User created successfully.', 201);
        } catch (\Exception $e) {
            return ApiResponse::error('User create failed: ' . $e->getMessage(), 500);
        }
    }

    // Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            return ApiResponse::error('Invalid login details', 401);
        }

        $user  = Auth::user();
        $token = $user->createToken('API Token')->accessToken;

        return ApiResponse::success([
            'user'  => $user,
            'token' => $token,
        ], 'Login successful');
    }
}
