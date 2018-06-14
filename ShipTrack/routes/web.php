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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/orders', 'Admin\OrdersController@index')->name('admin-view-orders');
Route::get('/admin/orders/create', 'Admin\OrdersController@create')->name('admin-order-create');

Route::get('/admin/trucks', 'Admin\TrucksController@index')->name('admin-view-trucks');
Route::any('/admin/trucks/create',  'Admin\TrucksController@create')->name('admin-truck-create');
Route::get('/admin/trucks/{id}',  'Admin\TrucksController@show')->name('admin-show-truck');
Route::get('/admin/trucks/{id}/edit',  'Admin\TrucksController@edit')->name('admin-edit-truck');
Route::post('/admin/trucks/{id}/save',  'Admin\TrucksController@save')->name('admin-save-truck');

Route::get('/admin/clients', 'Admin\ClientsController@index')->name('admin-view-clients');
Route::any('/admin/clients/create',  'Admin\ClientsController@create')->name('admin-client-create');
Route::get('/admin/clients/{id}',  'Admin\ClientsController@show')->name('admin-show-client');
Route::get('/admin/clients/{id}/edit',  'Admin\ClientsController@edit')->name('admin-edit-client');
Route::post('/admin/clients/{id}/save',  'Admin\ClientsController@save')->name('admin-save-client');