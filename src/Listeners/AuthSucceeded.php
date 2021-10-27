<?php

namespace Mralston\Lockout\Listeners;

use Illuminate\Auth\Events\Login;
use Mralston\Lockout\Models\AuthFailure;

class AuthSucceeded
{
    public function handle(Login $event)
    {
        if (empty($event->user)) {
            return;
        }

        $failure = AuthFailure::firstWhere('user_id', $event->user->id);

        if (!empty($failure) && $failure->attempts < intval(config('lockout.max_attempts'))) {
            $failure->delete();
        }
    }
}