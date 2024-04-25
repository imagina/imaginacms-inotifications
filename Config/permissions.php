<?php

return [
    'notification.notifications' => [
        'manage'=>'notification::messages.manage',
        'index' => 'notification::messages.list resource',
        'destroy' => 'notification::messages.destroy resource',
        'destroyAll' => 'notification::messages.destroy all resource',
        'markAllAsRead' => 'notification::messages.markAllAsRead resource',
        'create' => 'notification::notifications.create resource',
        'edit' => 'notification::notifications.edit resource',
    ],
    'notification.rules' => [
        'manage'=>'notification::messages.manage',
        'index' => 'notification::messages.list resource',
        'destroy' => 'notification::messages.destroy resource',
        'destroyAll' => 'notification::messages.destroy all resource',
        'markAllAsRead' => 'notification::messages.markAllAsRead resource',
    ],
    'notification.templates' => [
        'manage'=>'notification::messages.manage',
        'index' => 'notification::messages.list resource',
        'destroy' => 'notification::messages.destroy resource',
        'destroyAll' => 'notification::messages.destroy all resource',
        'markAllAsRead' => 'notification::messages.markAllAsRead resource',
    ],
    'notification.providers' => [
        'manage'=>'notification::messages.manage',
        'index' => 'notification::messages.list resource',
        'destroy' => 'notification::messages.destroy resource',
        'destroyAll' => 'notification::messages.destroy all resource',
        'markAllAsRead' => 'notification::messages.markAllAsRead resource',
    ],
];
