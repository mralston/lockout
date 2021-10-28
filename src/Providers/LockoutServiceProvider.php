<?php

namespace Mralston\Lockout\Providers;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use Mralston\Lockout\Console\Prune;
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

        if ($this->app->runningInConsole()) {
            $this->commands([
                Unlock::class,
                Prune::class,
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