<?php
namespace Modules\User\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscriber extends BaseModel
{
    use SoftDeletes;
    protected $table = 'core_subscribers';
    protected $fillable = [
        'email',
        'first_name',
        'last_name'
    ];
}
