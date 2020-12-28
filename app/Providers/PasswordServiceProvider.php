<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\IPassword;
use App\Contracts\Password\PasswordContract;

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
        $this->app->bind(IPassword::class, PasswordContract::class);
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
