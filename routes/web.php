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

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::middleware('auth')->group(function(){
    Route::get('/adminpanel', 'HomeController@index')->middleware('admin');
});

Route::resource('adminpanel/settings','SettingsController')->middleware('admin');
Route::get('deactivated','\App\Http\Controllers\Auth\LoginController@userDeactivated')->middleware('auth');
Route::post('deactivated','\App\Http\Controllers\Auth\LoginController@reActivatedEmail');

//REGISTER
Auth::routes();
Route::post('register','RegisterController@register');
Route::get('logout','\App\Http\Controllers\Auth\LoginController@logout');
