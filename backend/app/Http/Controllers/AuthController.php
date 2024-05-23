<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('username', 'password'))) {
            $request->session()->regenerate();
            return response()->json([
                'message' => 'Login Success',
                'data' => Auth::user()
            ], 200);
        }
        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}
