<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\EloquentRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\VoteRepositoryInterface;
use App\Repositories\HousemateRepositoryInterface;
use App\Repositories\NotificationRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\VoteRepository;
use App\Repositories\Eloquent\HousemateRepository;
use App\Repositories\Eloquent\NotificationRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(VoteRepositoryInterface::class, VoteRepository::class);
        $this->app->bind(HousemateRepositoryInterface::class, HousemateRepository::class);
        $this->app->bind(NotificationRepositoryInterface::class, NotificationRepository::class);
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
