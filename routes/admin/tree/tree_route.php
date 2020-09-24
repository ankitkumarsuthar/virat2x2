<?php 

Route::group(['prefix' => '/admin', 'middleware' => 'admincheck'], function () {

	Route::get('/downline', [
		'as'    => 'admin.mlm_tree_view',
	    'uses'  => 'Admin\TreeViewController@index'
	]);

	Route::get('/downline/get-list', [
        'as'    => 'admin.mlm_tree_view.getlist',
        'uses'  => 'Admin\TreeViewController@getList'
    ]); 

    Route::get('/downline/view/{id}', [
        'as'    => 'admin.mlm_tree_view.view',
        'uses'  => 'Admin\TreeViewController@view'
    ]); 

});


?>