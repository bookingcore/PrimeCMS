<?php

namespace Core\Settings\Models;

use App\Models\BaseModel;
use Illuminate\Support\Facades\Cache;

class Setting extends BaseModel
{
    protected static $_cached = [];
    protected $table = 'core_settings';

    public static function item($item, $default = false)
    {
        if (isset(static::$_cached[$item])) {
            return static::$_cached[$item];
        }

        $value = Cache::rememberForever('setting_' . $item, function () use ($item, $default) {
            $val = static::where('name', $item)->first();
            return ($val and $val['val'] != null) ? $val['val'] : $default;
        });

        static::$_cached[$item] = $value;

        return $value;
    }
}
