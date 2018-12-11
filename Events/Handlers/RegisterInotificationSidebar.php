<?php

namespace Modules\Inotification\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterInotificationSidebar implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function handle(BuildingSidebar $sidebar)
    {
        $sidebar->add($this->extendWith($sidebar->getMenu()));
    }

    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('inotification::inotifications.title.inotifications'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('inotification::notifications.title.notifications'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.inotification.notification.create');
                    $item->route('admin.inotification.notification.index');
                    $item->authorize(
                        $this->auth->hasAccess('inotification.notifications.index')
                    );
                });
                $item->item(trans('inotification::platforms.title.platforms'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.inotification.platform.create');
                    $item->route('admin.inotification.platform.index');
                    $item->authorize(
                        $this->auth->hasAccess('inotification.platforms.index')
                    );
                });
                $item->item(trans('inotification::notificationhistories.title.notificationhistories'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.inotification.notificationhistory.create');
                    $item->route('admin.inotification.notificationhistory.index');
                    $item->authorize(
                        $this->auth->hasAccess('inotification.notificationhistories.index')
                    );
                });
// append



            });
        });

        return $menu;
    }
}
