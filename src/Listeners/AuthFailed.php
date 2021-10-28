<?php

namespace Mralston\Lockout\Listeners;

use Illuminate\Auth\Events\Failed;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Mralston\Lockout\Models\AuthFailure;

class AuthFailed
{
    use AuthenticatesUsers;

    public function handle(Failed $event)
    {
        $request = app('request');

        $username_field = $this->username();

        AuthFailure::create([
            'user_id' => $event->user->id ?? null,
            'email' => $event->credentials[$username_field],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }
}