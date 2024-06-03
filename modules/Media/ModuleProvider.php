<?php

namespace Modules\Media;

use Modules\BaseModuleProvider;

class ModuleProvider extends BaseModuleProvider
{
    public static function getAdminMenu()
    {
        return [
            'media' => [
                'position'   => 56,
                'title'      => __("Media"),
                'icon'       => "fa fa-picture-o",
                "url"        => route('media.admin.index'),
                'permission' => 'media_upload',
                "group"      => "content"
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
    }
}