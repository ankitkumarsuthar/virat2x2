<?php 
Route::group(['prefix' => '/user', 'middleware' => 'usercheck'], function () {

	   Route::get('/wallet/all_transactions', [
            'as'    => 'user.wallet.all_transactions.index',
            'uses'  => 'User\WalletController@all_transactions'
        ]);

        Route::get('/wallet/all_transactions/get-list', [
            'as'    => 'user.wallet.all_transactions.getlist',
            'uses'  => 'User\WalletController@all_transactions_get_list'
        ]); 

        Route::get('/wallet/create', [
            'as'    => 'user.wallet.create',
            'uses'  => 'User\WalletController@create'
        ]);

        Route::post('/wallet/store', [
            'as'    => 'user.wallet.store',
            'uses'  => 'User\WalletController@store'
        ]);

        Route::get('/wallet/edit/{id}', [
            'as'    => 'user.wallet.edit',
            'uses'  => 'User\WalletController@edit'
        ]);

        Route::post('/wallet/update', [
            'as'    => 'user.wallet.update',
            'uses'  => 'User\WalletController@update'
        ]);

        Route::get('/wallet/delete/{id}', [
            'as'    => 'user.wallet.delete',
            'uses'  => 'User\WalletController@delete'
        ]);

        Route::get('/wallet/get-list', [
            'as'    => 'user.wallet.getlist',
            'uses'  => 'User\WalletController@getList'
        ]);      
        
    

});


?>