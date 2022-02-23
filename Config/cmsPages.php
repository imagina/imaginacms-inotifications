<?php

return [
  'admin' => [
    "setting" => [
      "permission" => "notification.notifications.manage",
      "activated" => true,
      "path" => [
        "en-us" => "/notifications/setting",
        "es" => "/notificaciones/configuracion"
      ],
      "name" => "notification.admin.providers",
      "layout" => "qsite/_layouts/master",
      "page" => "qnotification/_pages/admin/setting/index",
      "title" => "notification.cms.sidebar.adminConfig.title",
      "headerTitle" => "notification.cms.sidebar.adminConfig.headerTitle",
      "icon" => "fab fa-stack-exchange",
      "authenticated" => true,
      "subHeader" => [
        "refresh" => true
      ]
    ]
  ],
  'panel' => [],
  'main' => []
];
