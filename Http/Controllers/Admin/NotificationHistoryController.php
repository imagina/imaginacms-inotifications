<?php

namespace Modules\Inotification\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Inotification\Entities\NotificationHistory;
use Modules\Inotification\Http\Requests\CreateNotificationHistoryRequest;
use Modules\Inotification\Http\Requests\UpdateNotificationHistoryRequest;
use Modules\Inotification\Repositories\NotificationHistoryRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class NotificationHistoryController extends AdminBaseController
{
    /**
     * @var NotificationHistoryRepository
     */
    private $notificationhistory;

    public function __construct(NotificationHistoryRepository $notificationhistory)
    {
        parent::__construct();

        $this->notificationhistory = $notificationhistory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$notificationhistories = $this->notificationhistory->all();

        return view('inotification::admin.notificationhistories.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('inotification::admin.notificationhistories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateNotificationHistoryRequest $request
     * @return Response
     */
    public function store(CreateNotificationHistoryRequest $request)
    {
        $this->notificationhistory->create($request->all());

        return redirect()->route('admin.inotification.notificationhistory.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('inotification::notificationhistories.title.notificationhistories')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  NotificationHistory $notificationhistory
     * @return Response
     */
    public function edit(NotificationHistory $notificationhistory)
    {
        return view('inotification::admin.notificationhistories.edit', compact('notificationhistory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  NotificationHistory $notificationhistory
     * @param  UpdateNotificationHistoryRequest $request
     * @return Response
     */
    public function update(NotificationHistory $notificationhistory, UpdateNotificationHistoryRequest $request)
    {
        $this->notificationhistory->update($notificationhistory, $request->all());

        return redirect()->route('admin.inotification.notificationhistory.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('inotification::notificationhistories.title.notificationhistories')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  NotificationHistory $notificationhistory
     * @return Response
     */
    public function destroy(NotificationHistory $notificationhistory)
    {
        $this->notificationhistory->destroy($notificationhistory);

        return redirect()->route('admin.inotification.notificationhistory.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('inotification::notificationhistories.title.notificationhistories')]));
    }
}
