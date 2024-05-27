<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class AuthPermissionController extends Controller
{
    public function index()
    {
        return Permission::all();

    }
}
