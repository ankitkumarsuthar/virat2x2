<?php 
Route::group(['prefix' => '/admin', 'middleware' => 'admincheck'], function () {	
 
    Route::get('/withdrawal', [
        'as'    => 'admin.withdrawal.index',
        'uses'  => 'Admin\WithdrawalController@index'
    ]);

    Route::get('/withdrawal/approve/{id}', [
        'as'    => 'admin.withdrawal.approve',
        'uses'  => 'Admin\WithdrawalController@approve'
    ]);

    Route::get('/withdrawal/reject/{id}', [
        'as'    => 'admin.withdrawal.reject',
        'uses'  => 'Admin\WithdrawalController@reject'
    ]);

    Route::get('/withdrawal/get-list', [
            'as'    => 'admin.withdrawal.getlist',
            'uses'  => 'Admin\WithdrawalController@getList'
        ]);  
});
?>