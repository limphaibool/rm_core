<?php

namespace App\Http\Controllers;

use App\Data\RoleData;
use App\Enums\ResponseStatus;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class RoleController extends Controller
{
    use HttpResponses;
    /**
     * Returns all roles that have <= permissions
     */
    public function index()
    {
        $roles = Role::find(Auth::user()->role_id)->descendantsAndSelf()->get();
        return $this->success(data: RoleData::collect($roles));
    }

    /**
     * Create a new role
     */
    public function store(Request $request)
    {
        $role_name = $request->role_name;
        $parent_id = Auth::user()->role_id;
        try {
            $role = Role::create([
                'role_name' => $role_name,
                'parent_id' => $parent_id,
            ]);
            return $this->success(message: 'Create Role Success', data: $role);
        } catch (Exception $e) {
            return $this->error(message: $e);
        }
    }

    public function show($id)
    {
        $roles = Role::find(Auth::user()->role_id)->descendantsAndSelf()->where('role_id', $id)->get();
        return $this->success(data: $roles);
    }
    public function update(Request $request, $id)
    {
        $is_child_role = Role::find(Auth::user()->role_id)->descendants()->where('role_id', $id)->exists();
        if ($is_child_role) {
            $role_name = $request->role_name;
            try {
                $update = Role::where('role_id', $id)->update([
                    'role_name' => $role_name
                ]);
            } catch (Exception $e) {
                return $this->error(data: "ไม่สามารถ update ได้");
            }
            if (!$update) {
                return $this->error(data: "ไม่สามารถ update ได้");
            }
            $role_update = Role::find($id);
            return $this->success(data: $role_update);
        } else {
            return $this->error(data: "ไม่สามารถ update ได้");
        }
    }

    /**
     * Remove role
     */
    public function destroy(Request $request, $id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json([
                'status' => ResponseStatus::NOT_FOUND,
                'message' => 'Role not found'
            ], 404);
        } else {
            $is_descendant = Role::find(Auth::user()->role_id)->descendants()->where('role_id', $id)->exists();
            // return $this->success(data: $check_descendants);
            if ($is_descendant) {
                $is_mother = Role::find($id)->descendants()->exists();
                // return $this->success(data: $check_mother);
                if (!$is_mother) {
                    $role->delete();
                    // $User_update = User::where("role_id",$id)->get();
                    User::where("role_id", $id)->update([
                        'role_id' => null
                    ]);
                    return $this->success(message: "Delete success");
                } else {
                    return $this->error(data: "ไม่สามารถลบได้");
                }
            } else {
                return $this->error(data: "ไม่สามารถลบได้");
            }
        }
    }

}
