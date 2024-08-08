<?php

namespace App\Providers;

use App\Repositories\AssuntoEloquent;
use App\Repositories\AssuntoRepositoryInterface;
use App\Repositories\AutorEloquent;
use App\Repositories\AutorRepositoryInterface;
use App\Repositories\LivroEloquent;
use App\Repositories\LivroRepositoryInterface;
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

        $this->app->bind(
            LivroRepositoryInterface::class,
            LivroEloquent::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
