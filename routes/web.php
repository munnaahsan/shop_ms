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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/get-categories', 'Admin\CategoryController@index');
Route::get('/show-category/{slug}', 'Admin\CategoryController@show')->name('show-category');
Route::post('/update-category', 'Admin\CategoryController@update')->name('update-category');
Route::post('/add-category', 'Admin\CategoryController@store')->name('add-category');
Route::get('/remove-category/{slug}', 'Admin\CategoryController@destroy');
Route::post('/categories/remove-items', 'Admin\CategoryController@removeItems');
