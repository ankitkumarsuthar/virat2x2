<?php 

Route::group(['prefix' => '/user', 'middleware' => 'usercheck'], function () {

	Route::get('/my-account', [
		'as'    => 'user.myaccount',
	    'uses'  => 'User\MyAccountController@index'
	]);

	Route::post('/my-account/change-password', [
		'as'    => 'user.myaccount.change.password',
	    'uses'  => 'User\MyAccountController@changePassword'
	]);

	Route::post('/my-account/save-bank-detail', [
		'as'    => 'user.myaccount.save.bankdetail',
	    'uses'  => 'User\MyAccountController@saveBankDetail'
	]);

	Route::post('/my-account/save-upi-detail', [
		'as'    => 'user.myaccount.save.upi',
	    'uses'  => 'User\MyAccountController@saveUpiDetail'
	]);

	Route::post('/my-account/save-paytm-detail', [
		'as'    => 'user.myaccount.save.paytm',
	    'uses'  => 'User\MyAccountController@savePaytmDetail'
	]);

});


?>