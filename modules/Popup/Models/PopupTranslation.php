<?php

namespace Modules\Popup\Models;


use App\Models\BaseModel;

class PopupTranslation extends BaseModel
{
    protected $table = 'bravo_popup_translations';

    protected $fillable = [
        'content',
        'title'
    ];



}
