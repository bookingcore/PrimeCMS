<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

abstract class Controller
{

    public function checkPermission($permission = false)
    {
        if ($permission) {
            if (!Auth::user()->hasPermission($permission)) {
                abort(403);
            }
        }
    }

    public function hasPermission($permission)
    {
        return Auth::user()->hasPermission($permission);
    }
}
