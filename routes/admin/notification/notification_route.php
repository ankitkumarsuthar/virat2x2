<?php 

Route::group(['prefix' => '/admin', 'middleware' => 'admincheck'], function () {

	 Route::get('/notification/', [
            'as'    => 'admin.notification.index',
            'uses'  => 'Admin\NotificationController@index'
        ]);

        Route::get('/notification/create', [
            'as'    => 'admin.notification.create',
            'uses'  => 'Admin\NotificationController@create'
        ]);

        Route::post('/notification/store', [
            'as'    => 'admin.notification.store',
            'uses'  => 'Admin\NotificationController@store'
        ]);

        Route::get('/notification/edit/{id}', [
            'as'    => 'admin.notification.edit',
            'uses'  => 'Admin\NotificationController@edit'
        ]);

        Route::post('/notification/update', [
            'as'    => 'admin.notification.update',
            'uses'  => 'Admin\NotificationController@update'
        ]);

        Route::get('/notification/delete/{id}', [
            'as'    => 'admin.notification.delete',
            'uses'  => 'Admin\NotificationController@delete'
        ]);

        Route::get('/notification/get-list', [
            'as'    => 'admin.notification.getlist',
            'uses'  => 'Admin\NotificationController@getList'
        ]);              
});


?>