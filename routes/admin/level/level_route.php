<?php 

Route::group(['prefix' => '/admin', 'middleware' => 'admincheck'], function () {

	 
        Route::post('/level/update', [
            'as'    => 'admin.level.update',
            'uses'  => 'Admin\LevelController@update'
        ]);


});


?>