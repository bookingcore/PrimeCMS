<?php

namespace Core\Admin;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/Views', 'CoreAdmin');

        $this->app->singleton(AdminMenuManager::class);
    }
}
