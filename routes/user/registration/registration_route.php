<?php 

Route::get('/user/registration', [
    'as'    => 'user.registration',
    'uses'  => 'User\UserRegistrationController@index'
]);

Route::post('/user-users/check-email', [
    'as'    => 'user.users.check.email',
    'uses'  => 'User\UserRegistrationController@checkEmail'
]);

Route::post('/user/register/user', [
    'as'    => 'user.register.user',
    'uses'  => 'User\UserRegistrationController@store'
]);

?>