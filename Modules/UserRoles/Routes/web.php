<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('userroles')->group(function() {
    Route::get('/', 'UserRolesController@index');
    Route::resource('roles', 'RolesController');
    Route::get('rolePermission','PermissionController@selectRole');
    Route::get('rolePermission/{role}','PermissionController@getPermission');
    Route::post('role-permission-save', 'PermissionController@checkPermissionPost')->name('permission-post');
});