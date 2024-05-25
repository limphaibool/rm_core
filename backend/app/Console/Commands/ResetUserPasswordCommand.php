<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ResetUserPasswordCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset-password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset user password';

    /**user
     * Execute the console command.
     */
    public function handle()
    {
        $username = $this->ask('Username for password reset');
        $user = User::firstWhere('username', '=', $username);
        if ($user == null) {
            $this->error('Could not find user');
            return -1;
        }
        $password = $this->ask('New password');
        if ($this->confirm('Confirm password update for user ' . $username)) {
            $user->password = $password;
            $user->save();
            $this->info('Password reset success');
        }

    }
}
