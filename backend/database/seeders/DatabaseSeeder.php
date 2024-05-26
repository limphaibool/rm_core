<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Resource;
use App\Models\ResourceAction;
use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Thiti Lim',
            'username' => 'thiti',
            'password' => '1234',

        ]);

        Role::create([
            'name' => 'MD',
        ]);

        Resource::create(['name' => 'roles']);
        ResourceAction::insert([
            [
                'code' => 'READ',
                'name' => 'Read'
            ],
            [
                'code' => 'CREATE',
                'name' => 'Create'
            ],
            [
                'code' => 'UPDATE',
                'name' => 'Update'
            ],
            [
                'code' => 'DELETE',
                'name' => 'Delete'
            ],
        ]);
        Permission::insert([
            [
                'resource_id' => 1,
                'resource_action_id' => 1,
            ],
            [
                'resource_id' => 1,
                'resource_action_id' => 2,
            ],
            [
                'resource_id' => 1,
                'resource_action_id' => 3,
            ],
        ]);
    }
}
