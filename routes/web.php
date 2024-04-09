<?php

use Illuminate\Support\Facades\Route;

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
    return view('admin.dashboard');
})->middleware('checkLogin');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('checkLogin')->name('admin.dashboard');

Route::get('admin/login', function () {
    return view('admin.login');
})->name('admin.login');

Route::get('/notify', function () {
    return view('notify');
})->name('notify');

Route::post('/admin/store', 'AuthController@loginAdmin')->name('admin.store');
Route::post('/logout', 'AuthController@logout')->name('admin.logout');