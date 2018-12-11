<?php

namespace Modules\Inotification\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Inotification\Events\Handlers\RegisterInotificationSidebar;

class InotificationServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterInotificationSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('notifications', array_dot(trans('inotification::notifications')));
            $event->load('platforms', array_dot(trans('inotification::platforms')));
            $event->load('notificationhistories', array_dot(trans('inotification::notificationhistories')));
            // append translations



        });
    }

    public function boot()
    {
        $this->publishConfig('inotification', 'permissions');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Inotification\Repositories\NotificationRepository',
            function () {
                $repository = new \Modules\Inotification\Repositories\Eloquent\EloquentNotificationRepository(new \Modules\Inotification\Entities\Notification());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Inotification\Repositories\Cache\CacheNotificationDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Inotification\Repositories\PlatformRepository',
            function () {
                $repository = new \Modules\Inotification\Repositories\Eloquent\EloquentPlatformRepository(new \Modules\Inotification\Entities\Platform());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Inotification\Repositories\Cache\CachePlatformDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Inotification\Repositories\NotificationHistoryRepository',
            function () {
                $repository = new \Modules\Inotification\Repositories\Eloquent\EloquentNotificationHistoryRepository(new \Modules\Inotification\Entities\NotificationHistory());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Inotification\Repositories\Cache\CacheNotificationHistoryDecorator($repository);
            }
        );
// add bindings



    }
}
