<?php 

Route::group(['prefix' => '/admin', 'middleware' => 'admincheck'], function () {

	Route::get('/dashboard', [
		'as'    => 'admin.dashboard',
	    'uses'  => 'Admin\DashboardController@index'
	]);

	Route::get('/refferal', [
		'as'    => 'admin.refferal.index',
	    'uses'  => 'Admin\DashboardController@RefferalBonusSave'
	]);

	Route::post('/refferal/update', [
		'as'    => 'admin.refferal.update',
	    'uses'  => 'Admin\DashboardController@RefferalBonusUpdate'
	]);

});


?>