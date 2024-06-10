<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    use HttpResponses;
    /**
     * Returns all roles that have <= permissions
     */
    public function index()
    {
        $roles = Role::find(Auth::user()->role_id)->childrenAndSelf()->get();
        return $this->success(data: $roles);
    }

    /**
     * Create a new role
     */
    public function store(Request $request)
    {
        $role_name = $request->role_name;
        $parent_id = $request->parent_id;
        try {
            $role = Role::create([
                'role_name' => $role_name,
                'parent_id' => $parent_id,
            ]);
            return $this->success(message: 'Create Role Success', data: $role);
        } catch (Exception $e) {
            return response()->json(['status' => 2, 'message' => $e], 401);
        }
    }

    public function show($id)
    {

    }
    public function update(Request $request, Role $Role)
    {
        if (!$Role) {
            return response()->json([
                'status' => 2,
                'message' => 'Role not found'
            ], 404);
        } else {
            $role_name = $request->role_name;
            $parent_id = $request->parent_id;
            $Role->update([
                'role_name' => $role_name,
                'parent_id' => $parent_id
            ]);
            return response()->json([
                'status' => 1,
                'message' => 'Update Success'
            ], 200);
        }
    }

    /**
     * Remove role
     */
    public function destroy(Request $request, $id)
    {
        $Role = Role::find($id);
        if (!$Role) {
            return response()->json([
                'status' => 2,
                'message' => 'Role not found'
            ], 404);
        } else {
            $Role->delete();
            return response()->json([
                'status' => 1,
                'message' => 'Delete Success'
            ], 200);
        }
    }

}
