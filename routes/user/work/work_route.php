<?php 

Route::group(['prefix' => '/user', 'middleware' => 'usercheck'], function () {

	Route::get('work', [
		'as'    => 'user.work.index',
	    'uses'  => 'User\WorkController@index'
	]);

	Route::get('work/start', [
		'as'    => 'user.work.start',
	    'uses'  => 'User\WorkController@start'
	]);

	Route::get('work/next/{video}', [
		'as'    => 'user.work.next',
	    'uses'  => 'User\WorkController@next'
	]);

	Route::get('work/finish/{video}', [
		'as'    => 'user.work.finish',
	    'uses'  => 'User\WorkController@finish'
	]);

	Route::get('work/done', [
		'as'    => 'user.work.done',
	    'uses'  => 'User\WorkController@workFinish'
	]);

	

});


?>