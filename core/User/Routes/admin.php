<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/admin/user')->name('core.user.admin.')->group(function () {
    Route::get('/', \Core\User\Admin\Components\User\UserIndex::class)->name('index');
});
