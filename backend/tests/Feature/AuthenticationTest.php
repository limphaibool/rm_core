<?php

namespace Tests\Feature;

use App\Data\UserData;
use App\Enums\ResponseStatus;
use App\Models\Role;
use App\Traits\HttpResponses;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();
    }


    public function test_login_success()
    {
        // Arrange
        $user = User::create([
            'user_id' => 1,
            'name' => 'Thiti Lim',
            'username' => 'thiti',
            'password' => '1234',
            'name_thai' => 'ธิติ',
            'name_eng' => 'Thiti',
            'email' => 'thiti@thiti.com',
            'enabled' => true,
        ]);

        // Act
        $response = $this->post('/api/auth/login', [
            'username' => 'thiti',
            'password' => '1234'
        ]);

        // Assert
        $response->assertOk();
        $response->assertJsonPath('status', ResponseStatus::SUCCESS);
        $response->assertJsonPath('data.id', $user->user_id);
        $this->assertAuthenticatedAs($user);
        $response->assertCookie('laravel_session');
        $response->assertCookie('XSRF-TOKEN');
    }
    public function test_login_incorrect_password_returns_error()
    {
        // Arrange
        $user = User::create([
            'user_id' => 1,
            'name' => 'Thiti Lim',
            'username' => 'thiti',
            'password' => '1234',
            'name_thai' => 'ธิติ',
            'name_eng' => 'Thiti',
            'email' => 'thiti@thiti.com',
            'enabled' => true,
        ]);

        // Act
        $response = $this->post('/api/auth/login', [
            'username' => 'thiti',
            'password' => 'wrongpassword'
        ]);

        // Assert
        $response->assertUnauthorized();
        $response->assertJsonPath('status', ResponseStatus::UNAUTHENTICATED);
    }

    public function test_logout_success()
    {
        // Arrange
        $user = User::create([
            'user_id' => 1,
            'name' => 'Thiti Lim',
            'username' => 'thiti',
            'password' => '1234',
            'name_thai' => 'ธิติ',
            'name_eng' => 'Thiti',
            'email' => 'thiti@thiti.com',
            'enabled' => true,
        ]);
        $this->actingAs($user);
        $this->assertAuthenticatedAs($user);

        // Act
        $response = $this->post('/api/auth/logout');

        // Assert
        $response->assertJsonPath('status', ResponseStatus::SUCCESS);
        $response->assertOk();
    }

    public function test_logout_user_call_authenticated_api_returns_unauthenticated()
    {
        // Arrange
        $user = User::create([
            'user_id' => 1,
            'name' => 'Thiti Lim',
            'username' => 'thiti',
            'password' => '1234',
            'name_thai' => 'ธิติ',
            'name_eng' => 'Thiti',
            'email' => 'thiti@thiti.com',
            'enabled' => true,
        ]);

        $role = Role::create([
            'role_id' => 1,
            'role_name' => 'test role'
        ]);
        $this->actingAs($user);
        $this->assertAuthenticatedAs($user);

        // Act
        $response = $this->post('/api/auth/logout');
        $response = $this->get('/api/auth/user');

        // Assert
        $response->assertUnauthorized();
        $response->assertJsonPath('status', ResponseStatus::UNAUTHENTICATED);
    }

    public function test_auth_user_show_user_success()
    {
        $role = Role::create([
            'role_id' => 1,
            'role_name' => 'test role'
        ]);
        $user = User::create([
            'user_id' => 1,
            'name' => 'Thiti Lim',
            'username' => 'thiti',
            'password' => '1234',
            'name_thai' => 'ธิติ',
            'name_eng' => 'Thiti',
            'email' => 'thiti@thiti.com',
            'enabled' => true,
            'role_id' => $role->role_id
        ]);

        $response = $this->actingAs($user)->get('/api/auth/user');
        $response->assertOk();
        $response->assertJsonPath('data.id', $user->user_id);
        $response->assertJsonPath('data.username', $user->username);
        $response->assertJsonPath('data.role.id', $role->role_id);
    }

    public function test_auth_user_update_user_success()
    {
        $role = Role::create([
            'role_id' => 1,
            'role_name' => 'test role'
        ]);
        $user = User::create([
            'user_id' => 1,
            'name' => 'Thiti Lim',
            'username' => 'thiti',
            'password' => '1234',
            'name_thai' => 'ธิติ',
            'name_eng' => 'Thiti',
            'email' => 'thiti@thiti.com',
            'enabled' => true,
            'role_id' => $role->role_id
        ]);

        $response = $this->actingAs($user)->patch('/api/auth/user', [
            'nameThai' => 'เทส',
            'nameEng' => 'test',
        ]);
        $response->assertOk();
        $this->assertDatabaseHas('users', [
            'user_id' => 1,
            'name_thai' => 'เทส',
            'name_eng' => 'test',
        ]);

        $response->assertJsonPath('data.id', $user->user_id);
        $response->assertJsonPath('data.nameThai', 'เทส');
        $response->assertJsonPath('data.nameEng', 'test');
        $response->assertJsonPath('data.role.id', $role->role_id);
    }

    public function test_auth_user_update_user_validate()
    {
        $role = Role::create([
            'role_id' => 1,
            'role_name' => 'test role'
        ]);
        $user = User::create([
            'user_id' => 1,
            'name' => 'Thiti Lim',
            'username' => 'thiti',
            'password' => '1234',
            'name_thai' => 'ธิติ',
            'name_eng' => 'Thiti',
            'email' => 'thiti@thiti.com',
            'enabled' => true,
            'role_id' => $role->role_id
        ]);

        $response = $this->actingAs($user)->patch('/api/auth/user', [
            'nameThai' => '',
            'nameEng' => 'test',
        ]);
        $response->assertBadRequest();
        $response->assertJsonPath('status', ResponseStatus::FORM_INVALID);
        $response->assertJsonIsArray('data');
    }




}
