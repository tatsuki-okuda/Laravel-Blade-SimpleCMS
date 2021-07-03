<?php
use Illuminate\Support\Facades\Route;
 
// Route::get('/', function () {
//     echo 'back';
// });


Route::get('/', 'DashboardController')->name('dashboard');
Route::resource('posts', 'PostController')->except('show');