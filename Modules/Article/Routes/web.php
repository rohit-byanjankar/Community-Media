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



Route::prefix('article')->group(function() {
<<<<<<< HEAD
   
=======
>>>>>>> 58fd8aaccb101886ef3bfd02b2e33407e0e2b7ad
    Route::resource('posts', 'PostsController')->middleware('admin');
    Route::resource('tags', 'TagsController')->middleware('admin');
    Route::resource('categories', 'CategoriesController')->middleware('admin');
    Route::get('trashed-posts', 'PostsController@trashed')->name('trashed-posts.index')->middleware('admin');
    Route::put('restore-post/{post}', 'PostsController@restore')->name('restore-posts')->middleware('admin');


});

