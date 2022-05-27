<?php

namespace App\Providers;

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
        // 
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
        if (\Schema::hasTable('settings')) {
            config(\App\Models\Settings::getAll());
            \App::setLocale(config('app.locale'));
        }
    }
}
