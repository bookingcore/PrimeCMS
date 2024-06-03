<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

abstract class Controller
{

    public function sendError($message, $data = [])
    {

        $data['status'] = 0;

        return $this->sendSuccess($data, $message);

    }

    public function sendSuccess($data = [], $message = '')
    {
        if (is_string($data)) {
            $message = $data;
            $data = [];
        }
        if (!isset($data['status'])) $data['status'] = 1;

        if ($message)
            $data['message'] = $message;

        return response()->json($data);
    }

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
