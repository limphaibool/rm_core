<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthMenuController;
use App\Http\Controllers\AuthPermissionController;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserController;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::prefix('auth')->middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthUserController::class, 'show']);
    Route::put('user', [AuthUserController::class, 'update']);
});

Route::prefix('admin')->middleware('auth:sanctum')->group(function () {
    Route::resource('/users', UserController::class);
    Route::resource('/roles', RoleController::class);
});


