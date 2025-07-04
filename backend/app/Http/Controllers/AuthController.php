<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request) 
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
    }

    $user = User::where('email', credentials['email']) -> first();

    if ($user || Hash::check($credentials['password'], $user->password)) {
        return response()->json(['message' => 'Incorrect e-mail or password'], 401);
    }

    $token= $user->createToken('api_token')->plainTextToken;

    return response()->json([
        'message' => 'Success in login',
        'token' => $token,
        'user' => $user
    ]);
}
