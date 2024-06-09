<?php

namespace App\Http\Controllers;

use App\Data\UserData;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthUserController extends Controller
{
    use HttpResponses;

    public function show()
    {
        return $this->success(data: UserData::from(Auth::user()));
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return $this->success(message: 'User update success', data: UserData::from($user));

    }

}
