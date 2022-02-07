<?php

namespace App\Providers;

use App\Contracts\GameInterface;
use App\Contracts\GenreInterface;
use App\Services\GameService;
use App\Services\GenreService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GameInterface::class, GameService::class);
        $this->app->bind(GenreInterface::class, GenreService::class);
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
