Route::get('/admin/addresses', 'Admin\AddressesController@index')->name('admin-view-addresses');
Route::any('/admin/addresses/create',  'Admin\AddressesController@create')->name('admin-address-create');
Route::get('/admin/addresses/{id}',  'Admin\AddressesController@show')->name('admin-show-address');
Route::get('/admin/addresses/{id}/edit',  'Admin\AddressesController@edit')->name('admin-edit-address');
Route::post('/admin/address/{id}/save',  'Admin\AddressesController@save')->name('admin-save-address');