<?php

namespace Modules\Inotification\Composers;

use Illuminate\Contracts\View\View;
use Modules\Inotification\Repositories\NotificationRepository;
use Modules\User\Contracts\Authentication;

class NotificationViewComposer
{
    /**
     * @var NotificationRepository
     */
    private $notification;
    /**
     * @var Authentication
     */
    private $auth;

    public function __construct(NotificationRepository $notification, Authentication $auth)
    {
        $this->notification = $notification;
        $this->auth = $auth;
    }

    public function compose(View $view)
    {
        $notifications = $this->notification->latestForUser($this->auth->id());
        $view->with('notifications', $notifications);
    }
}
