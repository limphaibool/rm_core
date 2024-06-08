<?php

namespace App\Http\Controllers;

use App\Data\UserData;
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

}
