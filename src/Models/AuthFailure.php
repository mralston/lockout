<?php

namespace Mralston\Lockout\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class AuthFailure extends Model
{
    public $fillable = [
        'user_id',
        'email',
        'ip_address',
        'user_agent',
    ];

    public static function countUserFailures(Authenticatable $user, ?Carbon $since = null): int
    {
        $query = static::where('user_id', $user->id);

        if (!empty($since)) {
            $query->where('created_at', '>', $since);
        }

        return $query->count();
    }

    public static function countEmailFailures(string $email, ?Carbon $since = null): int
    {
        $query = static::where('email', $email);

        if (!empty($since)) {
            $query->where('created_at', '>', $since);
        }

        return $query->count();
    }

    public static function countIpFailures(string $ip_address, ?Carbon $since = null): int
    {
        $query = static::where('ip_address', $ip_address);

        if (!empty($since)) {
            $query->where('created_at', '>', $since);
        }

        return $query->count();
    }

    public static function prune()
    {
        $duration = max(
            config('lockout.lockout_duration_user'),
            config('lockout.lockout_duration_ip'),
            0
        );

        $since = Carbon::now()->subSeconds($duration);

        static::where('created_at', '<', $since)
            ->delete();
    }
}
