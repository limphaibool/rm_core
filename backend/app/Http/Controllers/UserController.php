<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;

class UserController extends Controller
{
    use HttpResponses;
    /**
     * See all users in all subset roles (including no roles)
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Create new user (no role)
     */
    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {

    }
    public function test(Request $request, User $User)
    {
        echo "test";
    }
    public function update(Request $request, User $User)
    {
        if (!$User) {
            return response()->json([
                'status' => 2,
                'message' => 'User not found'
            ], 404);
        } else {
            $username = $request->username;
            $name_thai = $request->name_thai;
            $User->update([
                'username' => $username,
                'name_thai' => $name_thai
            ]);
            return response()->json([
                'status' => 1,
                'message' => 'Update Success'
            ], 200);
        }
    }
    public function destroy($id)
    {

    }

}
