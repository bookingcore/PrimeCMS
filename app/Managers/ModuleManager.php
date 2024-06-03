<?php

namespace App\Managers;


class ModuleManager
{
    public static function getModules()
    {
        return static::getCoreModules();
    }

    public static function getCoreModules()
    {
        return [
            'core'     => \Modules\Core\ModuleProvider::class,
            'email'    => \Modules\Email\ModuleProvider::class,
            'language' => \Modules\Language\ModuleProvider::class,
            'media'    => \Modules\Media\ModuleProvider::class,
            'news'     => \Modules\News\ModuleProvider::class,
            'page'     => \Modules\Page\ModuleProvider::class,
            'template' => \Modules\Template\ModuleProvider::class,
            'user'     => \Modules\User\ModuleProvider::class,
        ];
    }
}
