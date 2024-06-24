<?php

namespace App\Http\Controllers;

use App\Data\UserData;
use App\Http\Resources\UserResource;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HttpResponses;
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('username', 'password'))) {
            $user = UserData::from(Auth::user());
            $request->session()->regenerate();
            return $this->success(message: 'Login Success', data: $user);
        }
        return $this->unauthenticated();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return $this->success(message: 'Logout success');
    }
}
