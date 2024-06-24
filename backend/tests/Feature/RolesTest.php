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
            'roleName' => 'test',
            'parentId' => 1,
        ]);

        // Assert
        $this->assertDatabaseHas('roles', ['role_name' => 'test', 'parent_id' => 1, 'enabled' => true]);

        $response->assertOk();
        $response->assertJsonPath('status', ResponseStatus::SUCCESS);
        $response->assertJsonPath('data.name', 'test');
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
        $response->assertJsonFragment(['id' => 1]);
        $response->assertJsonFragment(['id' => 2]);
        $response->assertJsonMissing([
            'id' => 3
        ]);
        $response->assertJsonMissing([
            'id' => 4
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
        $response = $this->actingAs($user)->put('/api/admin/roles/2', [
            'roleName' => 'test edit',
            'parentId' => 3
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
        $response = $this->actingAs($user)->put('/api/admin/roles/1', [
            'roleName' => 'test edit',
        ]);
        // Assert
        $response->assertBadRequest();
        $response->assertJsonPath('status', ResponseStatus::ERROR);
        $this->assertDatabaseMissing('roles', ['role_name' => 'test edit']);
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

