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

Route::get('/get-suppliers', 'Admin\SupplierController@index');
Route::post('/add-suppliers', 'Admin\SupplierController@store')->name('add-suppliers');
Route::post('/update-supplier', 'Admin\SupplierController@update')->name('update-supplier');
Route::get('/show-suppliers/{slug}', 'Admin\SupplierController@show')->name('show-suppliers');
Route::get('/remove-supplier/{slug}', 'Admin\SupplierController@destroy');

Route::get('/get-customers', 'Admin\CustomerController@index');
Route::post('/add-customers', 'Admin\CustomerController@store')->name('add-customers');
Route::get('/show-customers/{slug}', 'Admin\CustomerController@show')->name('show-customers');

// Route::get('/get-products', 'Admin\ProductController@index');


