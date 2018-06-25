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

Route::get('/admin/orders', 'Admin\OrdersController@index')->name('admin-view-orders');
Route::any('/admin/orders/create',  'Admin\OrdersController@create')->name('admin-order-create');
Route::get('/admin/orders/{id}',  'Admin\OrdersController@show')->name('admin-show-order');
Route::get('/admin/orders/{id}/edit',  'Admin\OrdersController@edit')->name('admin-edit-order');
Route::post('/admin/order/{id}/save',  'Admin\OrdersController@save')->name('admin-save-order');

Route::get('/admin/users', 'Admin\UsersController@index')->name('admin-view-users');
Route::any('/admin/users/create',  'Admin\UsersController@create')->name('admin-user-create');
Route::get('/admin/users/{id}',  'Admin\UsersController@show')->name('admin-show-user');
Route::get('/admin/users/{id}/edit',  'Admin\UsersController@edit')->name('admin-edit-user');
Route::post('/admin/user/{id}/save',  'Admin\UsersController@save')->name('admin-save-user');

Route::get('/admin/addresses', 'Admin\AddressesController@index')->name('admin-view-addresses');
Route::any('/admin/addresses/create',  'Admin\AddressesController@create')->name('admin-address-create');
Route::get('/admin/addresses/{id}',  'Admin\AddressesController@show')->name('admin-show-address');
Route::get('/admin/addresses/{id}/edit',  'Admin\AddressesController@edit')->name('admin-edit-address');
Route::post('/admin/address/{id}/save',  'Admin\AddressesController@save')->name('admin-save-address');