<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Banner;

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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('layouts.customers.default', function ($view) {
            $view->with('banners', Banner::where('status', 1)->get());
        });
    }
}
