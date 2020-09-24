<?php 

Route::group(['prefix' => '/user', 'middleware' => 'usercheck'], function () {

	Route::get('mlm', [
		'as'    => 'user.mlm',
	    'uses'  => 'User\MlmController@index'
	]);

	Route::post('/mlm/create', [
		'as'    => 'user.mlm.create',
	    'uses'  => 'User\MlmController@create'
	]);

	Route::post('/mlm/store', [
		'as'    => 'user.mlm.store',
	    'uses'  => 'User\MlmController@store'
	]);

	Route::post('/mlm/edit', [
		'as'    => 'user.mlm.edit',
	    'uses'  => 'User\MlmController@edit'
	]);

	Route::post('/mlm/update', [
		'as'    => 'user.mlm.update',
	    'uses'  => 'User\MlmController@update'
	]);

});


?>