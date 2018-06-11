<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            base_path('node_modules/admin-lte') => public_path('node_modules/admin-lte'),
        ], 'public');

        $this->publishes([
            base_path('node_modules/jquery') => public_path('node_modules/jquery'),
        ], 'public');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
