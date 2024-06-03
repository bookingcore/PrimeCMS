<?php

namespace App\Providers;

use App\Managers\ModuleManager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->loadCoreModules();
    }

    public function loadCoreModules()
    {
        foreach (ModuleManager::getModules() as $module) {
            $this->app->register($module);
        }
    }
}
