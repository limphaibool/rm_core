<?php

namespace Database\Seeders;

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
            'level' => 0
        ]);
    }
}
