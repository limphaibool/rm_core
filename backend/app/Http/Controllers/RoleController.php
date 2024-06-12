<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class RoleController extends Controller
{
    use HttpResponses;
    /**
     * Returns all roles that have <= permissions
     */
    public function index()
    {
        $roles = Role::find(Auth::user()->role_id)->descendantsAndSelf()->get();
        return $this->success(data: $roles);
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
            return response()->json(['status' => 2, 'message' => $e], 401);
        }
    }

    public function show($id)
    {
        $roles = Role::find(Auth::user()->role_id)->descendantsAndSelf()->where('role_id', $id)->get();
        return $this->success(data: $roles);
    }
    public function update(Request $request, $id)
    {
        $Role = Role::find(Auth::user()->role_id);
        if (!$Role) {
            return $this->error(data: "ไม่สามารถ update ได้");
        } else {
            $roles = Role::find(Auth::user()->role_id)->descendantsAndSelf()->where('role_id', $id)->get()->count();
            if($roles > 0){
                $Role_update = $role_name = $request->role_name;
                Role::where('role_id', $id)->update([
                    'role_name' => $role_name
                ]);
                return $this->success(data: $Role_update);
            }else{
                return $this->error(data: "ไม่สามารถ update ได้");
            }
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
            $check_descendants = Role::find(Auth::user()->role_id)->descendants()->where('role_id',$id)->get()->count();
            // return $this->success(data: $check_descendants);
            if($check_descendants > 0){
                $check_mother = Role::find($id)->descendants()->get()->count();
                // return $this->success(data: $check_mother);
                if($check_mother == 0){
                    $Role->delete();
                    // $User_update = User::where("role_id",$id)->get();
                    $User_update = User::where("role_id",$id)->update([
                        'role_id' => null
                    ]);
                    return $this->success(data: $Role);
                }else{
                    return $this->error(data: "ไม่สามารถลบได้");
                }
            }else{
                return $this->error(data: "ไม่สามารถลบได้");
            }
        }
    }

}
