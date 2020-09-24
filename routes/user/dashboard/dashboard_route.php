<?php 

Route::group(['prefix' => '/user', 'middleware' => 'usercheck'], function () {

	Route::get('/dashboard', [
		'as'    => 'user.dashboard',
	    'uses'  => 'User\DashboardController@index'
	]);

});


?>