<?php

namespace Mralston\Lockout\Listeners;

use Illuminate\Auth\Events\Failed;
use Mralston\Lockout\Models\AuthFailure;

class AuthFailed
{
    public function handle(Failed $event)
    {
        if (empty($event->user)) {
            return;
        }

        $failure = AuthFailure::firstOrCreate([
            'user_id' => $event->user->id,
        ]);

        $failure->update([
            'attempts' => ($failure->attempts ?? 0) + 1,
        ]);
    }
}