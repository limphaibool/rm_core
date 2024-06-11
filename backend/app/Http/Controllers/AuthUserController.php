<?php

namespace App\Http\Controllers;

use App\Data\UserData;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\HttpResponses;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\LaravelData\Support\Transformation\TransformationContextFactory;

class AuthUserController extends Controller
{
    use HttpResponses;

    public function show()
    {
        $user = UserData::from(Auth::user());
        return $this->success(data: new UserResource($user));
    }

    public function update(UserData $userData)
    {
        Auth::user()->update($userData->only('name_thai')->toArray());
        $user = UserData::from(Auth::user());
        return $this->success('User update success', new UserResource($user));
    }

}
