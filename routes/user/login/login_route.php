<?php 

Route::get('user', [
    'as'    => 'user.login',
    'uses'  => 'User\LoginController@index'
]);


Route::post('/user/login/check', [
    'as'    => 'user.login.check',
    'uses'  => 'User\LoginController@checkLogin'
]);

Route::get('/user/forgot/password', [
    'as'    => 'user.forgot.password',
    'uses'  => 'User\LoginController@forogtPassword'
]);


Route::post('/user/send/reset/password/link', [
    'as'    => 'user.send.reset.password.link',
    'uses'  => 'User\LoginController@sendResetPasswordLink'
]);


Route::get('/user/logout', [
    'as'    => 'user.logout',
    'uses'  => 'User\LoginController@logout'
]);

Route::get('/user/{user_id}/reset-password/{code}', [
    'as'    => 'front.reset.password',
    'uses'  => 'User\LoginController@getResetPassword'
]);


?>