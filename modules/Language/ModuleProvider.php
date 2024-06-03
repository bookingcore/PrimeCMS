<?php
/**
 * Created by PhpStorm.
 * User: h2 gaming
 * Date: 7/3/2019
 * Time: 9:27 PM
 */

namespace Modules\Language;

use Modules\BaseModuleProvider;
use Modules\Language\Providers\RouteServiceProvider;

class ModuleProvider extends BaseModuleProvider
{

    public function boot()
    {

        $this->publishes([
            __DIR__ . '/Config/config.php' => config_path('news.php'),
        ]);

    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/config.php', 'news'
        );

        $this->app->register(RouteServiceProvider::class);
    }
}
