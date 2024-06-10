<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use App\Enums\ResponseStatus;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RolesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_roles_create_parent_success(): void
    {
        // Arrange
        $user = User::create([
            'name' => 'Thiti Lim',
            'username' => 'thiti',
            'password' => '1234',
            'name_thai' => 'ธิติ',
            'name_eng' => 'Thiti',
            'email' => 'thiti@thiti.com',
            'enabled' => true,
        ]);

        // Act
        $response = $this->actingAs($user)->post('/api/admin/roles', [
            'role_name' => 'test',
            'parent_id' => null
        ]);

        // Assert
        $response->assertOk();
        $response->assertJsonPath('data.role_name', 'test');
        $response->assertJsonPath('status', ResponseStatus::SUCCESS);
        $this->assertDatabaseHas('roles', [
            'role_name' => 'test'
        ]);
    }
    public function test_roles_index_show_only_child_roles(): void
    {
        // Arrange
        Role::create([
            'role_id' => 1,
            'role_name' => 'user role',
            'parent_id' => null,
        ]);
        Role::create([
            'role_id' => 2,
            'role_name' => 'child role',
            'parent_id' => 1,
        ]);
        Role::create([
            'role_id' => 3,
            'role_name' => 'role 2',
            'parent_id' => null,
        ]);
        Role::create([
            'role_id' => 4,
            'role_name' => 'child role 2',
            'parent_id' => 3,
        ]);
        $user = User::create([
            'name' => 'Thiti Lim',
            'username' => 'thiti',
            'password' => '1234',
            'name_thai' => 'ธิติ',
            'name_eng' => 'Thiti',
            'email' => 'thiti@thiti.com',
            'role_id' => 1,
            'enabled' => true,
        ]);


        // Act
        $response = $this->actingAs($user)->get('/api/admin/roles');

        // Assert
        $response->assertOk();
        $response->assertJsonPath('status', ResponseStatus::SUCCESS);
        $response->assertJsonPath('data.0.role_id', 1);
        $response->assertJsonPath('data.1.role_id', 2);
        $response->assertJsonMissing([
            'role_id' => 3
        ]);
        $response->assertJsonMissing([
            'role_id' => 4
        ]);
    }


}

