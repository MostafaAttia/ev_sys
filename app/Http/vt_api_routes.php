<?php

use App\Http\Controllers;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

    // Auth routes for CLIENTS
    $api->post('signup', 'App\Api\V1\Controllers\ClientAuthController@signup');
    $api->get('signup/confirm_email/{confirmation_code}', [
        'as'   => 'ClientConfirmEmail',
        'uses' => 'App\Api\V1\Controllers\ClientAuthController@confirmEmail',
    ]);
    $api->post('login', 'App\Api\V1\Controllers\ClientAuthController@login');

    $api->any('/logout', [
        'uses' => 'App\Api\V1\Controllers\UserLogoutController@doLogout',
        'as'   => 'logout',
    ]);

    $api->post('login/forgot-password', [
        'as'   => 'postForgotPassword',
        'uses' => 'App\Api\V1\Controllers\RemindersController@postRemind',
    ]);

    $api->get('client/{client_id?}/{client_email?}', 'App\Api\V1\Controllers\ClientController@getClientDetails');
    $api->post('client/{client_id}', 'App\Api\V1\Controllers\ClientController@updateClient');




    // events routes
    $api->get('/events/all', [ 'middleware' => 'jwt.auth', // protected route !
        'as'   => 'getAllEvents',
        'uses' => 'App\Api\V1\Controllers\EventController@getAllEvents',
    ]);

    $api->get('/events/live', [
        'as'   => 'getLiveEvents',
        'uses' => 'App\Api\V1\Controllers\EventController@getLiveEvents',
    ]);

    $api->get('/event/{event_id}', [
        'as'   => 'getEvent',
        'uses' => 'App\Api\V1\Controllers\EventController@getEvent',
    ]);

//    $api->post('{event_id}/checkout/create', [
//        'as'   => 'postCreateOrder',
//        'uses' => 'App\Api\V1\Controllers\EventCheckoutController@postCreateOrder',
//    ]);


    $api->post('{event_id}/checkout/', [
        'as'   => 'postValidateTickets',
        'uses' => 'App\Api\V1\Controllers\EventCheckoutController@postValidateTickets',
    ]);

    $api->post('{event_id}/checkout/create', [
        'as'   => 'postCreateOrder',
        'uses' => 'App\Api\V1\Controllers\EventCheckoutController@postCreateOrder',
    ]);



















    // Role routes
//    $api->post('role/', 'App\Http\Controllers\RolesController@store');
//    $api->post('attach/{user_id}/role/{role_name}/', 'App\Http\Controllers\UsersController@assignUserRole');
//    $api->post('detach/{user_id}/role/{role_name}/', 'App\Http\Controllers\UsersController@detachUserRole');
//    $api->post('attach/{role_name}/perm/{perm_name}', 'App\Http\Controllers\RolesController@attachRolePermission');
//    $api->post('detach/{role_name}/perm/{perm_name}', 'App\Http\Controllers\RolesController@detachRolePermission');
//    $api->put('role/{name}', 'App\Http\Controllers\RolesController@updateRole');
//    $api->delete('role/{name}', 'App\Http\Controllers\RolesController@deleteRole');
//
//
//    // Permission routes
//    $api->post('perm/', 'App\Http\Controllers\PermissionsController@store');
//    $api->put('perm/{name}', 'App\Http\Controllers\PermissionsController@updatePermission');
//    $api->delete('perm/{name}', 'App\Http\Controllers\PermissionsController@deletePermission');
//
//
//    // transformers test
//    $api->get('users', 'App\Http\Controllers\UsersController@getUsers');
//    $api->get('perm', 'App\Http\Controllers\PermissionsController@getPermissions');


});
