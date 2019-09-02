<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->post('notification/mark-read',
    ['as' => 'api.notification.read',
        'uses' => 'NotificationsController@markAsRead'
    ]);

$router->group(['prefix' => '/notification/v1'], function (Router $router) {

    $router->group(['prefix' => '/notifications'], function (Router $router) {

        //Route create
        $router->post('/', [
            'as' => 'api.notification.create',
            'uses' => 'NotificationsController@create',
            'middleware' => ['auth:api']
        ]);

        //Route index
        $router->get('/', [
            'as' => 'api.notification.get.items.by',
            'uses' => 'NotificationsController@index',
            'middleware' => ['auth:api']
        ]);

        //Route show
        $router->get('/{criteria}', [
            'as' => 'api.notification.get.item',
            'uses' => 'NotificationsController@show',
            'middleware' => ['auth:api']
        ]);

        //Route update
        $router->put('/{criteria}', [
            'as' => 'api.notification.update',
            'uses' => 'NotificationsController@update',
            'middleware' => ['auth:api']
        ]);

        //Route delete
        $router->delete('/{criteria}', [
            'as' => 'api.notification.delete',
            'uses' => 'NotificationsController@delete',
            'middleware' => ['auth:api']
        ]);
    });
});