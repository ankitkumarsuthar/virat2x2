<?php 

Route::get('admin', [
    'as'    => 'admin.login',
    'uses'  => 'Admin\LoginController@index'
]);


Route::post('/admin/login/check', [
    'as'    => 'admin.login.check',
    'uses'  => 'Admin\LoginController@checkLogin'
]);

Route::get('/admin/forgot/password', [
    'as'    => 'admin.forgot.password',
    'uses'  => 'Admin\LoginController@forogtPassword'
]);


Route::post('/admin/send/reset/password/link', [
    'as'    => 'admin.send.reset.password.link',
    'uses'  => 'Admin\LoginController@sendResetPasswordLink'
]);


Route::get('/admin/logout', [
    'as'    => 'admin.logout',
    'uses'  => 'Admin\LoginController@logout'
]);


?>