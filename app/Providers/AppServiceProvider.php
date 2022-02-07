<?php

namespace App\Providers;

use App\Exceptions\InvalidConfigurationException;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     * @throws InvalidConfigurationException
     */
    public function register()
    {
        if (!in_array(config('app.env'), ['local', 'testing', 'production'])) {
            throw new InvalidConfigurationException(
                sprintf("Environment must be one of [%s].", join('|', ['local', 'testing', 'production']))
            );
        }

        if (!$this->app->environment('production')) {
            $this->app->register(DuskServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
