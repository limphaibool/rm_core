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
        Role::create(['role_name' => 'admin', 'parent_id' => null]);
        Role::create(['role_name' => 'child 1', 'parent_id' => 1]);
        Role::create(['role_name' => 'admin 2', 'parent_id' => null]);
        Role::create(['role_name' => 'child 1.2', 'parent_id' => 1]);
        Role::create(['role_name' => 'child 1.3', 'parent_id' => 1]);
        Role::create(['role_name' => 'child 2', 'parent_id' => 5]);
        Role::create(['role_name' => 'child 4.1', 'parent_id' => 4]);
        Role::factory(50)->create();
        User::updateOrCreate(['user_id' => 1], [
            'user_id' => 1,
            'name' => 'Thiti Lim',
            'username' => 'thiti',
            'password' => '1234',
            'name_thai' => 'ธิติ',
            'name_eng' => 'Thiti',
            'role_id' => 1,
            'email' => 'thiti@thiti.com',
        ]);

        Resource::updateOrCreate(['name' => 'roles']);

        $resources = [
            ['resource_id' => 1, 'name' => 'roles'],
            ['resource_id' => 2, 'name' => 'inventory'],
            ['resource_id' => 3, 'name' => 'inventory_move'],
            ['resource_id' => 4, 'name' => 'inventory_start'],
            ['resource_id' => 5, 'name' => 'inventory_finish'],

        ];

        $actions = [
            [
                'action_id' => 1,
                'code' => 'READ',
                'name' => 'Read'
            ],
            [
                'action_id' => 2,
                'code' => 'CREATE',
                'name' => 'Create'
            ],
            [
                'action_id' => 3,
                'code' => 'UPDATE',
                'name' => 'Update'
            ],
            [
                'action_id' => 4,
                'code' => 'DELETE',
                'name' => 'Delete'
            ],
        ];
        foreach ($resources as $resource) {
            Resource::updateOrCreate(['resource_id' => $resource['resource_id']], $resource);
        }
        foreach ($actions as $action) {
            ResourceAction::updateOrCreate(['action_id' => $action['action_id']], $action);
        }

        foreach (Resource::all() as $resource) {

            foreach (ResourceAction::all() as $action) {
                Permission::create([
                    'resource_id' => $resource->resource_id,
                    'action_id' => $action->action_id
                ]);
            }
        }
    }
}
