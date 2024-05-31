<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Returns all roles that have <= permissions
     */
    public function index()
    {
        return Role::find(Auth::user()->role_id)->descendants()->get();

    }

    /**
     * Create a new role
     */
    public function store(Request $request)
    {
        //
        Role::create([
            'role_name' => $request->role_name,
            'parent_id' => $request->parent_id,
        ]);
    }

    public function show($id)
    {

    }
    public function update($id)
    {

    }

    /**
     * Remove role
     */
    public function destroy(Request $request)
    {
        //
    }

}
