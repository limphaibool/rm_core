<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Returns all roles that have <= permissions
     */
    public function index()
    {
        // return response()->json([
        //     'status' => 1,
        //     'message' => 'Success',
        //     'data' => 'ok'
        // ], 200);
        // return Role::find(Auth::user()->user_id);
        $query = Role::leftJoin('users', 'roles.role_id', '=', 'users.role_id')
            ->select(
                'roles.*',
            )
            ->where('users.enabled', 1)
            ->orWhere('roles.parent_id', 8)
            ->get();
            // if (!empty($selectedCategory)) {
            //     $query->where('products.category_id', '=', $selectedCategory);
            // }
        return $query;
    }

    /**
     * Create a new role
     */
    public function store(Request $request)
    {
        $role_name = $request->role_name;
        $parent_id = $request->parent_id;
        try {
            Role::create([
                'role_name' => $role_name,
                'parent_id' => $parent_id,
            ]);
            return response()->json([
                'status' => 1,
                'message' => 'Create Role Success',
                'data' => $role_name
            ], 200);
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
        }else{
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
        }else{
            $Role->delete();
            return response()->json([
                'status' => 1,
                'message' => 'Delete Success'
            ], 200);
        }
    }

}
