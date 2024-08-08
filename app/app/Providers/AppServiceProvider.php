<?php

namespace App\Providers;

use App\Repositories\AssuntoEloquent;
use App\Repositories\AssuntoRepositoryInterface;
use App\Repositories\AutorEloquent;
use App\Repositories\AutorRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
                AutorRepositoryInterface::class,
                AutorEloquent::class);

        $this->app->bind(
            AssuntoRepositoryInterface::class,
            AssuntoEloquent::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
