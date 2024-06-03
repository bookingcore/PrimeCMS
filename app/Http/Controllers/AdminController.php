<?php

namespace App\Http\Controllers;

use Modules\Core\Helpers\AdminMenuManager;

class AdminController extends Controller
{

    public function setActiveMenu($item)
    {
        AdminMenuManager::setActive($item);
    }

}
