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

        AuthFailure::where('user_id', $event->user->id)
            ->delete();
    }
}