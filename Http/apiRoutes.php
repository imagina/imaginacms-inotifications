<?php

use Illuminate\Routing\Router;

/** @var Router $router */

$router->group(['prefix' => 'notification'], function (Router $router) {
  $router->get('/', [
    'as' => 'api.notification.index',
    'uses' => 'NotificationController@index',
    'middleware' => ['auth:api']
  ]);

  $router->post('/create', [
    'as' => 'api.notification.create',
    'uses' => 'NotificationController@create',
    'middleware' => ['auth:api']
  ]);

  $router->get('/platforms', [
    'as' => 'api.notification.platforms',
    'uses' => 'PlatformController@index',
    'middleware' => ['auth:api']
  ]);

  $router->put('/update/{id}', [
    'as' => 'api.notification.create',
    'uses' => 'NotificationHistoryController@update',
    'middleware' => ['auth:api']
  ]);

  $router->get('/user', [
    'as' => 'api.notification.user',
    'uses' => 'NotificationHistoryController@index',
    'middleware' => ['auth:api']
  ]);

  $router->post('/whatsapp/{bot}', [
    'as' => 'api.inotification.whatsapp.create',
    'uses' => 'SendWhatsAppController@create',
    //'middleware' => ['auth:api']
  ]);




});
