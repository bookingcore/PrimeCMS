<?php
namespace Modules\Core\Models;

use App\Models\BaseModel;

class AttributesTranslation extends BaseModel
{
    protected $table = 'bravo_attrs_translations';
    protected $fillable = [
        'name',
    ];
}
