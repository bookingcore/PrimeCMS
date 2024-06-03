<?php

namespace App\Models;

use App\Traits\HasSEO;
use App\Traits\HasSlug;
use App\Traits\HasStatus;
use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasStatus;
    use HasTranslations;
    use HasSEO;
    use HasSlug;

    public function fillByAttr($attributes, $input)
    {
        if (!empty($attributes)) {
            foreach ($attributes as $item) {
                $this->setAttribute($item, isset($input[$item]) ? ($input[$item]) : null);
            }
        }
    }

}
