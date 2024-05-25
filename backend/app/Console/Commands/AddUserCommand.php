<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AddUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Name of user');
        $username = $this->ask('Username');
        $password = $this->ask('Password');
        if ($this->confirm('Confirm create user: ' . $username . ' (' . $name . ')')) {
            User::create([
                'name' => $name,
                'username' => $username,
                'password' => $password
            ]);
        }
    }
}
