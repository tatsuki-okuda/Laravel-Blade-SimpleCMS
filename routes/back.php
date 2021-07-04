<?php
use Illuminate\Support\Facades\Route;
 
// Route::get('/', function () {
//     echo 'back';
// });

Route::group(['middleware' => 'can:admin'], function () {
  Route::resource('users', 'UserController')->except('show');
});

Route::get('/', 'DashboardController')->name('dashboard');
Route::resource('posts', 'PostController')->except('show');
Route::resource('tags', 'TagController')->except('show');

