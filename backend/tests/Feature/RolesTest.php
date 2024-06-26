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
            'role_id' => 1,
            'enabled' => true,
        ]);

        // Act
        $response = $this->actingAs($user)->post('/api/admin/roles', [
            'role_name' => 'test'
        ]);

        // Assert
        $response->assertOk();
        $response->assertJsonPath('data.role_name', 'test');
        $response->assertJsonPath('status', ResponseStatus::SUCCESS);
        $response->assertJsonFragment(['role_name' => 'test']);
        $response->assertJsonFragment(['role_id' => 1]);
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
        $response_2 = $this->actingAs($user)->get('/api/admin/roles/1');
        // Assert
        $response->assertOk();
        $response->assertJsonPath('status', ResponseStatus::SUCCESS);
        $response->assertJsonFragment(['role_id' => 1]);
        $response->assertJsonFragment(['role_id' => 2]);
        $response->assertJsonMissing([
            'role_id' => 3
        ]);
        $response->assertJsonMissing([
            'role_id' => 4
        ]);
        $response_2->assertOk();
        $response_2->assertJsonPath('status', ResponseStatus::SUCCESS);
        $response_2->assertJsonFragment(['role_id' => 1]);
        $response_2->assertJsonMissing([
            'role_id' => 2
        ]);
    }
    public function test_roles_update_success(): void
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
        $response = $this->actingAs($user)->patch('/api/admin/roles/2', [
            'role_name' => 'test edit'
        ]);
        // Assert
        $response->assertOk();
        $this->assertDatabaseHas('roles', ['role_name' => 'test edit']);
        $response->assertJsonPath('status', ResponseStatus::SUCCESS);
        $response->assertJsonPath('data.role_id', 2);
        $response->assertJsonPath('data.role_name', 'test edit');
    }

    public function test_roles_update_can_not_update_self(): void
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
        $response = $this->actingAs($user)->patch('/api/admin/roles/1', [
            'role_name' => 'test edit'
        ]);
        // Assert
        $response->assertBadRequest();
        $response->assertJsonPath('status', ResponseStatus::ERROR);
    }
    public function test_roles_delete_only_child_roles(): void
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
        $response = $this->actingAs($user)->delete('/api/admin/roles/2');
        // Assert
        $response->assertOk();
        $response->assertJsonPath('status', ResponseStatus::SUCCESS);
    }

}

