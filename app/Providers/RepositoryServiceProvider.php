<?php

namespace App\Providers;

use App\interfaces\BoardingHouseRepositoryInterface;
use App\interfaces\CategoryRepositoryInterface;
use App\interfaces\CityRepositoryInterface;
use App\Repositories\BoardingHouseRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CityRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(BoardingHouseRepositoryInterface::class, BoardingHouseRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
