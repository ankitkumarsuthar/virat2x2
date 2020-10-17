<?php 

Route::group(['prefix' => '/admin', 'middleware' => 'admincheck'], function () {

	 Route::get('/setting/', [
            'as'    => 'admin.setting.index',
            'uses'  => 'Admin\SettingsController@index'
        ]);     

        Route::post('/setting/store', [
            'as'    => 'admin.setting.store',
            'uses'  => 'Admin\SettingsController@store'
        ]);
           
});


?>