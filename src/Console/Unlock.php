<?php

namespace Mralston\Lockout\Console;

use Illuminate\Console\Command;
use Mralston\Lockout\Models\AuthFailure;

class Unlock extends Command
{
    protected $signature = 'lockout:unlock {user}';

    protected $description = 'Unlock a user account.';

    public function handle()
    {
        $failure = AuthFailure::firstWhere('user_id', $this->argument('user'));

        if (empty($failure)) {
            $this->error('User wasn\'t locked.');
            return 1;
        }

        $failure->delete();

        $this->info('User unlocked.');

        return 0;
    }
}