<?php

namespace App\Providers;

use App\Repositories\AuthRepository;
use App\Repositories\AuthRepositoryInterface;
use App\Repositories\CommentRepository;
use App\Repositories\CommentRepositoryInterface;
use App\Repositories\NewsRepository;
use App\Repositories\NewsRepositoryInterface;
use Illuminate\Support\ServiceProvider;

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
        $this->app->bind(
            NewsRepositoryInterface::class,
            NewsRepository::class,
        );

        $this->app->bind(
            CommentRepositoryInterface::class,
            CommentRepository::class
        );

        $this->app->bind(
            AuthRepositoryInterface::class,
            AuthRepository::class
        );
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
