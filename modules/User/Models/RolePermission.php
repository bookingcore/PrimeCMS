<?php


namespace Modules\User\Models;


use App\Models\BaseModel;

class RolePermission extends BaseModel
{
    protected $table = 'core_role_permissions';

    protected $fillable = [
        'role_id',
        'permission'
    ];
}
