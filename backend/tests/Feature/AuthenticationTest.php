<?php

namespace Tests\Feature;

use App\Data\UserData;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;
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
        ], ['referer' => 'localhost:5173']);

        // Assert
        $response->assertOk();
        $response->assertJsonPath('status', 0);
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
        ], ['referer' => 'localhost:5173']);

        // Assert
        $response->assertUnauthorized();
        $response->assertJsonPath('status', 1);
    }
}
