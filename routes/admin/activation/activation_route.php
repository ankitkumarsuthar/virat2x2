<?php 

Route::group(['prefix' => '/admin', 'middleware' => 'admincheck'], function () {

	 Route::get('/activation/', [
            'as'    => 'admin.activation.index',
            'uses'  => 'Admin\ActivationController@index'
        ]);        

        Route::get('/activation/activate/{id}', [
            'as'    => 'admin.activation.activate',
            'uses'  => 'Admin\ActivationController@activate'
        ]);

        Route::get('/activation/remove/{id}', [
            'as'    => 'admin.activation.remove',
            'uses'  => 'Admin\ActivationController@remove'
        ]);

         Route::get('/activation/delete/{id}', [
            'as'    => 'admin.activation.delete',
            'uses'  => 'Admin\ActivationController@delete'
        ]);

        Route::post('/activation/update', [
            'as'    => 'admin.activation.update',
            'uses'  => 'Admin\ActivationController@update'
        ]);


        Route::get('/activation/get-list', [
            'as'    => 'admin.activation.getlist',
            'uses'  => 'Admin\ActivationController@getList'
        ]);      
        
        Route::post('/users/check-email', [
            'as'    => 'admin.user.check.email',
            'uses'  => 'Admin\ActivationController@checkEmail'
        ]);

});


?>