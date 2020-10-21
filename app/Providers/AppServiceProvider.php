<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $modules = [];
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        foreach(glob(__DIR__ .'/../Mod/*') as $path) {
            $path = realpath($path);
            $module = (object) pathinfo($path);
            $module->path = $path;
            $module->namespace = $module->filename;
            $module->service_provider = realpath("{$module->path}\Providers\{$module->namespace}ServiceProvider.php");
            $module->routes_api = realpath("{$module->path}\\routes\api.php");
            $this->modules[] = $module;

            if ($module->service_provider) {
                $this->app->register($module->service_provider);
            }

        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        foreach($this->modules as $module) {
            if ($module->routes_api) {
                \Route::group(['prefix'=>'api'], function() use($module) {
                    include $module->routes_api;
                });
            }
        }
    }
}
