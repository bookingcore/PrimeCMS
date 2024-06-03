<?php

namespace PrimeCMS\Form\Providers;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'primecms/form');

        $this->mergeConfigFrom(__DIR__ . '/../Configs/config.php', 'primecms/form');

        $this->publishes([
            __DIR__ . '/../../resources/views' => base_path('resources/views/vendor/primecms/form'),
            __DIR__ . '/../Configs/config.php' => config_path('primecms-form.php'),
        ]);
    }
}
