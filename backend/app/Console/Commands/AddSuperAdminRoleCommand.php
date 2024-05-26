<?php

namespace App\Console\Commands;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Console\Command;

class AddSuperAdminRoleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add-super-role';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add role with all permissions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Name of role');
        if ($this->confirm('Confirm role name [' . $name . ']')) {
            $role = Role::create([
                'name' => $name,
            ]);
            $permissions = Permission::all()->pluck('permission_id');
            $role->permissions()->attach($permissions);
            $this->info('Super role ' . $name . ' succesfully created');
        }
    }
}
