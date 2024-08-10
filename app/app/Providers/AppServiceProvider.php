<?php

namespace App\Providers;

use App\Repositories\SubjectEloquent;
use App\Repositories\SubjectRepositoryInterface;
use App\Repositories\AuthorEloquent;
use App\Repositories\AuthorRepositoryInterface;
use App\Repositories\BookEloquent;
use App\Repositories\BookRepositoryInterface;
use App\Repositories\RelatorioVwEloquent;
use App\Repositories\RelatorioVwRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
                AuthorRepositoryInterface::class,
                AuthorEloquent::class);

        $this->app->bind(
            SubjectRepositoryInterface::class,
            SubjectEloquent::class);

        $this->app->bind(
            BookRepositoryInterface::class,
            BookEloquent::class);

        $this->app->bind(
            RelatorioVwRepositoryInterface::class,
            RelatorioVwEloquent::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
