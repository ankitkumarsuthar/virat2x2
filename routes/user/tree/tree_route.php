<?php 

Route::group(['prefix' => '/user', 'middleware' => 'usercheck'], function () {

	Route::get('/downline', [
		'as'    => 'user.mlm_tree_view',
	    'uses'  => 'User\TreeViewController@index'
	]);


});


?>