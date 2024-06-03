<?php
/**
 * Created by PhpStorm.
 * User: h2 gaming
 * Date: 7/3/2019
 * Time: 9:27 PM
 */

namespace Modules\Page;

use Modules\BaseModuleProvider;
use Modules\Core\Helpers\SitemapHelper;
use Modules\Page\Models\Page;
use Modules\Page\Providers\RouterServiceProvider;

class ModuleProvider extends BaseModuleProvider
{

    public static function getAdminMenu()
    {
        return [
            'page' => [
                "position"   => 20,
                'url'        => route('page.admin.index'),
                'title'      => __("Page"),
                'icon'       => 'icon ion-ios-bookmarks',
                'permission' => 'page_view',
                'group'      => 'content'
            ],
        ];
    }

    public static function getAdminMenuGroups()
    {
        return [
            'content' => [
                'name'     => __("Content"),
                'position' => 150
            ]
        ];
    }

    public function boot(SitemapHelper $sitemapHelper)
    {

        $this->publishes([
            __DIR__ . '/Config/config.php' => config_path('page.php'),
        ]);

        $sitemapHelper->add("page", [app()->make(Page::class), 'getForSitemap']);

    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/config.php', 'page'
        );

        $this->app->register(RouterServiceProvider::class);
    }
}
