<?php 

Route::group(['prefix' => '/admin', 'middleware' => 'admincheck'], function () {

	 	Route::get('/videos/', [
            'as'    => 'admin.videos.index',
            'uses'  => 'Admin\VideoLinksController@index'
        ]);

        Route::post('/videos/update', [
            'as'    => 'admin.videos.update',
            'uses'  => 'Admin\VideoLinksController@update'
        ]);


});


?>