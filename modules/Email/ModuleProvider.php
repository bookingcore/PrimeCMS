<?php

namespace Modules\Email;

use Modules\BaseModuleProvider;

class ModuleProvider extends BaseModuleProvider
{

    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }

}
