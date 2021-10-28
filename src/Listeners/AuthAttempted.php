<?php

namespace Mralston\Lockout\Listeners;

use Illuminate\Auth\Events\Attempting;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Mralston\Lockout\Models\AuthFailure;

class AuthAttempted
{
    use AuthenticatesUsers;

    public function handle(Attempting $event)
    {
        // Determine the username property on the user model
        $username_field = $this->username();

        // Fetch the maximum number of login attempts per user and per IP address
        $max_attempts_user = config('lockout.max_attempts_user');
        $max_attempts_ip = config('lockout.max_attempts_ip');

        // Determine the timescale within which max login attempts shouldn't be exceeded
        $lockout_duration_user = config('lockout.lockout_duration_user');
        $lockout_duration_ip = config('lockout.lockout_duration_ip');

        if (!empty($lockout_duration_user)) {
            $user_since = Carbon::now()->subSeconds($lockout_duration_user);
        }

        if (!empty($lockout_duration_ip)) {
            $ip_since = Carbon::now()->subSeconds($lockout_duration_ip);
        }

        // Lockout if client IP has made too many attempts
        if (AuthFailure::countIpFailures(request()->ip(), $ip_since ?? null) >= $max_attempts_ip) {
            abort(403, 'Contact IT Support');
        }

        // Lockout if username has had too many failures
        if (AuthFailure::countEmailFailures($event->credentials[$username_field], $user_since ?? null) >= $max_attempts_user) {
            abort(403, 'Contact IT Support');
        }
    }
}