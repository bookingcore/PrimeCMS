<?php

namespace Core\User\Admin\Components\User;

use Core\Admin\Components\BaseAdminComponent;


class UserIndex extends BaseAdminComponent
{

    public function render()
    {
        return view('CoreUser::admin.index');
    }
}
