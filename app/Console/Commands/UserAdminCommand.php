<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UserAdminCommand extends Command
{
    protected $signature = 'user:admin {user : ID of the user to make an admin}';

    protected $description = 'Makes the specified user a system administrator';

    public function handle(): int
    {
        $user = User::findOrFail($this->argument('user'));
        $user->admin = true;
        $user->save();

        $this->info("$user->name is now an administrator.");

        return static::SUCCESS;
    }
}
