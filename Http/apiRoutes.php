<?php

use Illuminate\Routing\Router;

/** @var Router $router */

$router->group(['prefix' => '/notification'], function (Router $router) {
    $router->post('notification/mark-read', [
        'as' => 'api.notification.read',
        'uses' => 'NotificationsController@markAsRead'
    ]);

    $router->get('notifications', [
        'as' => 'admin.notification.notification.index',
        'uses' => 'NotificationsController@index',
        'middleware' => 'can:notification.notifications.index',
    ]);
    $router->get('notifications/markAllAsRead', [
        'as' => 'admin.notification.notification.markAllAsRead',
        'uses' => 'NotificationsController@markAllAsRead',
        'middleware' => 'can:notification.notifications.markAllAsRead',
    ]);
    $router->delete('notifications/destroyAll', [
        'as' => 'admin.notification.notification.destroyAll',
        'uses' => 'NotificationsController@destroyAll',
        'middleware' => 'can:inotification.notifications.destroyAll',
    ]);
    $router->delete('notifications/{notification}', [
        'as' => 'admin.inotification.notification.destroy',
        'uses' => 'NotificationsController@destroy',
        'middleware' => 'can:inotification.notifications.destroy',
    ]);
});