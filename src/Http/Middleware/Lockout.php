<?php

namespace Mralston\Lockout\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Mralston\Lockout\Models\AuthFailure;

class Lockout
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (Auth::check()) {
            $failure = AuthFailure::firstWhere('user_id', Auth::id());
            if ($failure->attempts ?? 0 > intval(config('lockout.max_attempts'))) {

                Auth::logout();

                abort(403, 'Your account has been locked.');
            }
        }

        return $response;
    }
}