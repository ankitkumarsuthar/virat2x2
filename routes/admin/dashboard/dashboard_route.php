<?php 

Route::group(['prefix' => '/admin', 'middleware' => 'admincheck'], function () {

	Route::get('/dashboard', [
		'as'    => 'admin.dashboard',
	    'uses'  => 'Admin\DashboardController@index'
	]);

});


?>