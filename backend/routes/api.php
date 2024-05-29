<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthMenuController;
use App\Http\Controllers\AuthPermissionController;
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
    Route::get('menus', [AuthMenuController::class, 'index']);
    Route::get('permissions', [AuthPermissionController::class, 'index']);
});
Route::prefix('auth')->middleware('auth:sanctum')->group(function () {
    Route::get('menus', [AuthMenuController::class, 'index']);
    Route::get('permissions', [AuthPermissionController::class, 'index']);
});

Route::prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{user_id}', [UserController::class, 'show']);
    Route::delete('/users/{user_id}', [UserController::class, 'destroy']);

    Route::get('/roles', [RoleController::class, 'index']);
    Route::post('/roles', [RoleController::class, 'store']);
    Route::delete('/roles', [RoleController::class, 'destroy']);

    Route::get('roles/{role_id}/permissions', [RolePermissionController::class, 'index']);
    Route::post('roles/{role_id}/permissions', [RolePermissionController::class, 'store']);
    Route::delete('roles/{role_id}/permissions', [RolePermissionController::class, 'destroy']);

    Route::get('roles/{role_id}/users', [RolePermissionController::class, 'index']);
    Route::post('roles/{role_id}/users', [RolePermissionController::class, 'store']);



});


