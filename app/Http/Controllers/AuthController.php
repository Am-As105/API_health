<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password)
    ]);

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'success' => true,
        'token' => $token,
        'user' => $user
    ]);

     }
     public function login(Request $request)
{
    if (!\Auth::attempt($request->only('email', 'password'))) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials'
        ], 401);
    }

    $user = \Auth::user();
    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'success' => true,
        'token' => $token,
        'user' => $user
    ]);
  }
}
