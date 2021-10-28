<?php

namespace Mralston\Lockout\Console;

use Illuminate\Console\Command;
use Mralston\Lockout\Models\AuthFailure;

class Unlock extends Command
{
    protected $signature = 'lockout:unlock {--user=} {--email=} {--ip=}';

    protected $description = 'Unlock a user account by ID or email address, or unlock an IP address.';

    public function handle()
    {
        if (!empty($this->option('ip'))) {
            $records_affected = AuthFailure::where('ip_address', $this->option('ip'))
                ->delete();

            if ($records_affected > 0) {
                $this->info('IP address unlocked.');
            } else {
                $this->warn('IP address wasn\'t locked.');
            }
        }

        if (!empty($this->option('email'))) {
            $records_affected = AuthFailure::where('email', $this->option('email'))
                ->delete();

            if ($records_affected > 0) {
                $this->info('E-mail address unlocked.');
            } else {
                $this->warn('E-mail address wasn\'t locked.');
            }
        }

        if (!empty($this->option('user'))) {
            $records_affected = AuthFailure::where('user_id', $this->option('user'))
                ->delete();

            if ($records_affected > 0) {
                $this->info('User unlocked.');
            } else {
                $this->warn('User wasn\'t locked.');
            }
        }

        return 0;
    }
}