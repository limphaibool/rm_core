<?php

namespace App\Http\Controllers;

use App\Data\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('username', 'password'))) {
            $user = UserData::from(Auth::user());

            $request->session()->regenerate();
            return response()->json([
                'message' => 'Login Success',
                'data' => $user
            ], 200);
        }
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json([
            'message' => 'Logout Success',
        ], 200);



    }
}
