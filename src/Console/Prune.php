<?php

namespace Mralston\Lockout\Console;

use Illuminate\Console\Command;
use Mralston\Lockout\Models\AuthFailure;

class Prune extends Command
{
    protected $signature = 'lockout:prune';

    protected $description = 'Prunes stale authentication failure records.';

    public function handle()
    {
        AuthFailure::prune();

        return 0;
    }
}