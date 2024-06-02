<?php

namespace Core\User;

use Illuminate\Support\Facades\Route;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function boot()
    {
        Route::middleware(['web'])->group(function () {
            $this->loadRoutesFrom(__DIR__ . '/Routes/admin.php');
        });

        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/Views', 'CoreUser');
    }
}
