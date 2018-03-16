<?php

use App\Http\Controllers;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1',

    /**
     * @param $api
     */
    function ($api) {

    /*
     * ----------
     * Auth routes for CLIENTS
     * ----------
     */
    $api->post('signup', 'App\Api\V1\Controllers\ClientAuthController@signup');
    $api->get('signup/confirm_email/{confirmation_code}', [ 'middleware' => 'web',
        'as'   => 'ClientConfirmEmailApi',
        'uses' => 'App\Api\V1\Controllers\ClientAuthController@confirmEmail',
    ]);
    $api->post('login', 'App\Api\V1\Controllers\ClientAuthController@login');
    $api->any('/logout', [
        'uses' => 'App\Api\V1\Controllers\UserLogoutController@doLogout',
        'as'   => 'logout',
    ]);

    $api->post('password/email', 'App\Api\V1\Controllers\ForgotPasswordController@getResetToken');
    $api->post('password/reset', 'App\Api\V1\Controllers\ResetPasswordController@reset');

    $api->get('client/{client_id?}/{client_email?}', 'App\Api\V1\Controllers\ClientController@getClientDetails');
    $api->post('client/update', ['middleware' => 'jwt.refresh',
        'as'    => 'updateClient',
        'uses'  => 'App\Api\V1\Controllers\ClientController@updateClient',
    ]);


//    $api->get('login/{provider}', ['uses' => 'App\Api\V1\Controllers\SocialLoginController@redirectToProvider', 'as' => 'social.login']);
//    $api->get('social/login/{provider}', 'App\Api\V1\Controllers\SocialLoginController@handleProviderCallback');


    /*
     * ----------
     * Comments
     * ----------
     */
    $api->post('event/{event_id}/comment', ['middleware' => 'jwt.refresh',
        'as'   => 'postComment',
        'uses' => 'App\Api\V1\Controllers\CommentsController@postComment',
    ]);
    $api->get('comment/{comment_id}', [
        'as'   => 'getComment',
        'uses' => 'App\Api\V1\Controllers\CommentsController@getComment',
    ]);
    $api->post('comment/{comment_id}', ['middleware' => 'jwt.refresh',
        'as'   => 'updateComment',
        'uses' => 'App\Api\V1\Controllers\CommentsController@updateComment',
    ]);
    $api->delete('comment/{comment_id}', ['middleware' => 'jwt.refresh',
        'as'   => 'deleteComment',
        'uses' => 'App\Api\V1\Controllers\CommentsController@deleteComment',
    ]);
    $api->get('event/{event_id}/comments', [
        'as'   => 'getEventComments',
        'uses' => 'App\Api\V1\Controllers\CommentsController@getEventComments',
    ]);


    /*
     * ----------
     * Ratings
     * ----------
     */
    $api->post('event/{event_id}/rating', ['middleware' => 'jwt.refresh',
        'as'   => 'postRating',
        'uses' => 'App\Api\V1\Controllers\RatingController@postRating',
    ]);
    $api->delete('event/{event_id}/rating', ['middleware' => 'jwt.refresh',
        'as'   => 'deleteRating',
        'uses' => 'App\Api\V1\Controllers\RatingController@deleteRating',
    ]);

     /*
     * ----------
     * Events
     * ----------
     */
    $api->get('/events/all', [ 'middleware' => 'jwt.refresh',
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

    // get list of attendees
    $api->get('event/{event_id}/attendees', [
        'as'   => 'getEventAttendees',
        'uses' => 'App\Api\V1\Controllers\EventController@getEventAttendees',
    ]);

    // get list of categories
    $api->get('categories', [
        'as'   => 'getCategories',
        'uses' => 'App\Api\V1\Controllers\EventController@getCategories',
    ]);

    // get all events inside a category
    $api->get('/category/{category_id}/events', [
        'as'   => 'getCategoryEvents',
        'uses' => 'App\Api\V1\Controllers\EventController@getCategoryEvents',
    ]);

    // get all events by organiser
    $api->get('/organiser/{organiser_id}/events', [
        'as'   => 'getOrganiserEvents',
        'uses' => 'App\Api\V1\Controllers\EventController@getOrganiserEvents',
    ]);

    // search events by title, venue name, location
    $api->get('/events/search/{query}', [
        'as'   => 'searchEvents',
        'uses' => 'App\Api\V1\Controllers\EventController@searchEvents',
    ]);

    // search organisers by name
    $api->get('/organisers/search/{query}', [
        'as'   => 'searchOrganisers',
        'uses' => 'App\Api\V1\Controllers\EventController@searchOrganisers',
    ]);

    // get event tickets
    $api->post('event/{event_id}/checkout/', [
        'as'   => 'postValidateTickets',
        'uses' => 'App\Api\V1\Controllers\EventCheckoutController@postValidateTickets',
    ]);

    $api->post('event/{event_id}/checkout/create', [
        'as'   => 'postCreateOrder',
        'uses' => 'App\Api\V1\Controllers\EventCheckoutController@postCreateOrder',
    ]);



    /*
    * ----------
    * Like / Follow / Favorite
    * ----------
    */

    $api->group(['middleware' => 'jwt.refresh'], function($api){

        $api->get('follow/{organiser_id}', [
            'as'    => 'api-follow',
            'uses'  => 'App\Api\V1\Controllers\ClientController@followOrganiser'
        ]);

        $api->get('unfollow/{organiser_id}', [
            'as'    => 'api-unfollow',
            'uses'  => 'App\Api\V1\Controllers\ClientController@unfollowOrganiser'
        ]);

        $api->get('favorite/{category_id}', [
            'as'    => 'api-favorite',
            'uses'  => 'App\Api\V1\Controllers\ClientController@favoriteCategory'
        ]);

        $api->get('unfavorite/{category_id}', [
            'as'    => 'api-unfavorite',
            'uses'  => 'App\Api\V1\Controllers\ClientController@unfavoriteCategory'
        ]);

        $api->get('like/{event_id}', [
            'as'    => 'api-like',
            'uses'  => 'App\Api\V1\Controllers\ClientController@likeEvent'
        ]);

        $api->get('unlike/{event_id}', [
            'as'    => 'api-unlike',
            'uses'  => 'App\Api\V1\Controllers\ClientController@unlikeEvent'
        ]);

        $api->get('followings/events', [
            'as'    => 'api-followingsEvents',
            'uses'  => 'App\Api\V1\Controllers\ClientController@getFollowingsEvents'
        ]);

        $api->get('favorites/events', [
            'as'    => 'api-favoritesEvents',
            'uses'  => 'App\Api\V1\Controllers\ClientController@getFavoritesCategoriesEvents'
        ]);

        $api->get('followings', [
            'as'    => 'api-followings',
            'uses'  => 'App\Api\V1\Controllers\ClientController@followings'
        ]);

        $api->get('favorites', [
            'as'    => 'api-favorites',
            'uses'  => 'App\Api\V1\Controllers\ClientController@favorites'
        ]);

        $api->get('likes', [
            'as'    => 'api-client-likes',
            'uses'  => 'App\Api\V1\Controllers\ClientController@likes'
        ]);

    });

    $api->get('likes/{event_id}', [
        'as'    => 'api-likes',
        'uses'  => 'App\Api\V1\Controllers\ClientController@eventLikes',
    ]);

    $api->get('fans/{category_id}', [
        'as'    => 'api-fans',
        'uses'  => 'App\Api\V1\Controllers\ClientController@categoryFans'
    ]);

    $api->get('/followers/{organiser_id}', [
        'as'    => 'api-followers',
        'uses'  => 'App\Api\V1\Controllers\ClientController@organiserFollowers'
    ]);

});








