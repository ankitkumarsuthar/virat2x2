<?php 

Route::group(['prefix' => '/admin', 'middleware' => 'admincheck'], function () {

	 Route::get('/user/', [
            'as'    => 'admin.user.index',
            'uses'  => 'Admin\UsersController@index'
        ]);

        Route::get('/user/create', [
            'as'    => 'admin.user.create',
            'uses'  => 'Admin\UsersController@create'
        ]);

        Route::post('/user/store', [
            'as'    => 'admin.user.store',
            'uses'  => 'Admin\UsersController@store'
        ]);

        Route::get('/user/edit/{id}', [
            'as'    => 'admin.user.edit',
            'uses'  => 'Admin\UsersController@edit'
        ]);

        Route::post('/user/update', [
            'as'    => 'admin.user.update',
            'uses'  => 'Admin\UsersController@update'
        ]);

        Route::get('/user/delete/{id}', [
            'as'    => 'admin.user.delete',
            'uses'  => 'Admin\UsersController@delete'
        ]);

        Route::get('/user/get-list', [
            'as'    => 'admin.user.getlist',
            'uses'  => 'Admin\UsersController@getList'
        ]);      
        
        Route::post('/panel/users/check-email', [
            'as'    => 'admin.panel.user.check.email',
            'uses'  => 'Admin\UsersController@checkEmail2'
        ]);

});


?>