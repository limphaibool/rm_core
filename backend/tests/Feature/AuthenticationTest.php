<?php

namespace Tests\Feature;

use App\Data\UserData;
use App\Enums\ResponseStatus;
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
        $response->assertJsonPath('status', ResponseStatus::SUCCESS->value);
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
        $response->assertJsonPath('status', ResponseStatus::UNAUTHENTICATED->value);
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
        $response->assertJsonPath('status', ResponseStatus::SUCCESS->value);
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
        $this->actingAs($user);
        $this->assertAuthenticatedAs($user);

        // Act
        $response = $this->post('/api/auth/logout');
        $response = $this->get('/api/auth/user');

        // Assert
        $this->withExceptionHandling();
        $response->assertUnauthorized();
        $response->assertJsonPath('status', ResponseStatus::UNAUTHENTICATED->value);
    }
}
