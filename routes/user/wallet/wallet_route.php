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

        Route::get('/wallet/transfer_to_another', [
            'as'    => 'user.wallet.transfer.to.another',
            'uses'  => 'User\WalletController@transferToAnother'
        ]); 
        Route::post('/wallet/transfer_to_another/send', [
            'as'    => 'user.wallet.transfer.to.another.send',
            'uses'  => 'User\WalletController@transferToAnotherSend'
        ]); 

        Route::get('/wallet/withdraw', [
            'as'    => 'user.wallet.withdraw.index',
            'uses'  => 'User\WalletController@withdrawForm'
        ]); 

        Route::post('/wallet/withdraw/request', [
            'as'    => 'user.wallet.withdraw.request',
            'uses'  => 'User\WalletController@withdrawRequest'
        ]); 

        Route::get('/wallet/withdraw/request', [
            'as'    => 'user.wallet.request.getlist',
            'uses'  => 'User\WalletController@withdrawRequestGetList'
        ]); 

        

});


?>