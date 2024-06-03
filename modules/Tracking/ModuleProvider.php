<?php

namespace Modules\Tracking;

use Modules\BaseModuleProvider;

class ModuleProvider extends BaseModuleProvider
{

    public static function getAdminMenu()
    {
        return [
            'tracking' => [
                "position"   => 100,
                'url'        => route('tracking.admin.index'),
                'title'      => __("Tracking"),
                'icon'       => 'fa fa-signal',
                'permission' => 'user_view',
                'group'      => 'system'
            ]
        ];
    }

    public function boot()
    {

        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');

    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
        $this->app->singleton('tracker', function () {
            return app()->make(Tracker::class);
        });
    }
}
