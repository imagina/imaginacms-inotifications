<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/inotification'], function (Router $router) {
    $router->bind('notification', function ($id) {
        return app('Modules\Inotification\Repositories\NotificationRepository')->find($id);
    });
    $router->get('notifications', [
        'as' => 'admin.inotification.notification.index',
        'uses' => 'NotificationController@index',
        'middleware' => 'can:inotification.notifications.index'
    ]);
    $router->get('notifications/create', [
        'as' => 'admin.inotification.notification.create',
        'uses' => 'NotificationController@create',
        'middleware' => 'can:inotification.notifications.create'
    ]);
    $router->post('notifications', [
        'as' => 'admin.inotification.notification.store',
        'uses' => 'NotificationController@store',
        'middleware' => 'can:inotification.notifications.create'
    ]);
    $router->get('notifications/{notification}/edit', [
        'as' => 'admin.inotification.notification.edit',
        'uses' => 'NotificationController@edit',
        'middleware' => 'can:inotification.notifications.edit'
    ]);
    $router->put('notifications/{notification}', [
        'as' => 'admin.inotification.notification.update',
        'uses' => 'NotificationController@update',
        'middleware' => 'can:inotification.notifications.edit'
    ]);
    $router->delete('notifications/{notification}', [
        'as' => 'admin.inotification.notification.destroy',
        'uses' => 'NotificationController@destroy',
        'middleware' => 'can:inotification.notifications.destroy'
    ]);
    $router->bind('platform', function ($id) {
        return app('Modules\Inotification\Repositories\PlatformRepository')->find($id);
    });
    $router->get('platforms', [
        'as' => 'admin.inotification.platform.index',
        'uses' => 'PlatformController@index',
        'middleware' => 'can:inotification.platforms.index'
    ]);
    $router->get('platforms/create', [
        'as' => 'admin.inotification.platform.create',
        'uses' => 'PlatformController@create',
        'middleware' => 'can:inotification.platforms.create'
    ]);
    $router->post('platforms', [
        'as' => 'admin.inotification.platform.store',
        'uses' => 'PlatformController@store',
        'middleware' => 'can:inotification.platforms.create'
    ]);
    $router->get('platforms/{platform}/edit', [
        'as' => 'admin.inotification.platform.edit',
        'uses' => 'PlatformController@edit',
        'middleware' => 'can:inotification.platforms.edit'
    ]);
    $router->put('platforms/{platform}', [
        'as' => 'admin.inotification.platform.update',
        'uses' => 'PlatformController@update',
        'middleware' => 'can:inotification.platforms.edit'
    ]);
    $router->delete('platforms/{platform}', [
        'as' => 'admin.inotification.platform.destroy',
        'uses' => 'PlatformController@destroy',
        'middleware' => 'can:inotification.platforms.destroy'
    ]);
    $router->bind('notificationhistory', function ($id) {
        return app('Modules\Inotification\Repositories\NotificationHistoryRepository')->find($id);
    });
    $router->get('notificationhistories', [
        'as' => 'admin.inotification.notificationhistory.index',
        'uses' => 'NotificationHistoryController@index',
        'middleware' => 'can:inotification.notificationhistories.index'
    ]);
    $router->get('notificationhistories/create', [
        'as' => 'admin.inotification.notificationhistory.create',
        'uses' => 'NotificationHistoryController@create',
        'middleware' => 'can:inotification.notificationhistories.create'
    ]);
    $router->post('notificationhistories', [
        'as' => 'admin.inotification.notificationhistory.store',
        'uses' => 'NotificationHistoryController@store',
        'middleware' => 'can:inotification.notificationhistories.create'
    ]);
    $router->get('notificationhistories/{notificationhistory}/edit', [
        'as' => 'admin.inotification.notificationhistory.edit',
        'uses' => 'NotificationHistoryController@edit',
        'middleware' => 'can:inotification.notificationhistories.edit'
    ]);
    $router->put('notificationhistories/{notificationhistory}', [
        'as' => 'admin.inotification.notificationhistory.update',
        'uses' => 'NotificationHistoryController@update',
        'middleware' => 'can:inotification.notificationhistories.edit'
    ]);
    $router->delete('notificationhistories/{notificationhistory}', [
        'as' => 'admin.inotification.notificationhistory.destroy',
        'uses' => 'NotificationHistoryController@destroy',
        'middleware' => 'can:inotification.notificationhistories.destroy'
    ]);
// append



});
