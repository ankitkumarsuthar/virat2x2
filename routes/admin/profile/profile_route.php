<?php 

Route::group(['prefix' => '/admin', 'middleware' => 'admincheck'], function () {

	 Route::get('/profile/', [
            'as'    => 'admin.profile.index',
            'uses'  => 'Admin\ProfileController@index'
        ]);

        Route::get('/profile/create', [
            'as'    => 'admin.profile.create',
            'uses'  => 'Admin\ProfileController@create'
        ]);

        Route::post('/profile/store', [
            'as'    => 'admin.profile.store',
            'uses'  => 'Admin\ProfileController@store'
        ]);

        Route::get('/profile/edit/{id}', [
            'as'    => 'admin.profile.edit',
            'uses'  => 'Admin\ProfileController@edit'
        ]);

        Route::post('/profile/update', [
            'as'    => 'admin.profile.update',
            'uses'  => 'Admin\ProfileController@update'
        ]);

        Route::get('/profile/delete/{id}', [
            'as'    => 'admin.profile.delete',
            'uses'  => 'Admin\ProfileController@delete'
        ]);

        Route::get('/profile/get-list', [
            'as'    => 'admin.profile.getlist',
            'uses'  => 'Admin\ProfileController@getList'
        ]);      
        
        Route::post('/profile/check-email', [
            'as'    => 'admin.profile.check.email',
            'uses'  => 'Admin\ProfileController@checkEmail'
        ]);

});


?>