<?php

namespace Mralston\Lockout\Providers;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use Mralston\Lockout\Http\Middleware\Lockout as LockoutMiddleware;
use Mralston\Lockout\Console\Unlock;

class LockoutServiceProvider extends ServiceProvider
{
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot(Kernel $kernel)
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $kernel->pushMiddleware(LockoutMiddleware::class);

        if ($this->app->runningInConsole()) {
            $this->commands([
                Unlock::class,
            ]);

            $this->publishes([
                __DIR__.'/../../config/lockout.php' => config_path('lockout.php'),
            ], 'config');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/lockout.php', 'lockout');
    }
}