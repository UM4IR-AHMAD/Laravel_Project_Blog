<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /* *
     * Bootstrap any application services.
     *
     * @return void
     * 
     * @commented because it use for custom pagination
     */
    public function boot()
    {
        //
    }
}
