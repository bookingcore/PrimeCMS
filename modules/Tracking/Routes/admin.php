<?php
use \Illuminate\Support\Facades\Route;

Route::get('/','TrackingController@index')->name('tracking.admin.index');
Route::post('/bulkEdit','TrackingController@bulkEdit')->name('tracking.admin.bulkEdit');
