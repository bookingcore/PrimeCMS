<?php

namespace Core;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function register()
    {
        $modules = [
            \Core\Settings\ServiceProvider::class,
            \Core\Admin\ServiceProvider::class,
            \Core\User\ServiceProvider::class,
        ];
        foreach ($modules as $class) {
            $this->app->register($class);
        }
    }
}
