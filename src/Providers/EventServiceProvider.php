<?php

namespace Mralston\Lockout\Providers;

use Illuminate\Auth\Events\Attempting;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Mralston\Lockout\Listeners\AuthAttempted;
use Mralston\Lockout\Listeners\AuthFailed;
use Mralston\Lockout\Listeners\AuthSucceeded;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Attempting::class => [
            AuthAttempted::class,
        ],
        Login::class => [
            AuthSucceeded::class,
        ],
        Failed::class => [
            AuthFailed::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}