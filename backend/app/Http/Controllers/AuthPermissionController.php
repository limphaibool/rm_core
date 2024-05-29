<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthPermissionController extends Controller
{
    public function index()
    {
        $role = Role::find(Auth::user()->role_id);
        return response()->json([
            'data' => PermissionResource::collection($role->permissions)
        ]);
    }
}
