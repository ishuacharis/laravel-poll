<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Password\PasswordContract;
use App\Repositories\Password\Password;

class PasswordServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(PasswordContract::class, Password::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
