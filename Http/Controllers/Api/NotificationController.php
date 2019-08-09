<?php

namespace Modules\Inotification\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;
use Modules\Inotification\Repositories\NotificationRepository;
use Modules\Inotification\Repositories\NotificationHistoryRepository;
use Modules\Inotification\Transformers\NotificationTransformer;
use Modules\Inotification\Events\NotificationEvent;
use Modules\Iprofile\Repositories\UserApiRepository;
use App\Jobs\sendNotifications;
use Illuminate\Support\Facades\Auth;

class NotificationController extends BaseApiController
{
    /**
     * @var NotificationRepository
     */
    private $notification;
    private $notificationHistory;
    private $user;

    public function __construct(
      /*NotificationRepository $notification,
      NotificationHistoryRepository $notificationHistory,
      UserApiRepository $user*/
    )
    {
        $this->notification = app('Modules\Inotification\Repositories\NotificationRepository');
        $this->notificationHistory = app('Modules\Inotification\Repositories\NotificationHistoryRepository');
        $this->user = app('Modules\Iprofile\Repositories\UserApiRepository');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request, $data = false)
    {
      try {
        $user = Auth::user();//Get user

        //Get Params
        if($data){//From parameters
          $message = $data->message ?? false;
          $options = $data->options ?? false;
          $platforms = $data->platforms ?? false;
          $users = $data->users ?? false;
        }else{//From request
          $message = $request->message ?? false;
          $options = $request->options ?? false;
          $platforms = $request->platforms ?? false;
          $users = $request->users ?? false;
        }

        //Create notificatión if exist message
        if($message){
          //Create Notification
          $notification = $this->notification->create([
            'user_id' => $user->id,
            'message' => $message,
            'options' => json_encode($options)
          ]);
        }

        //If not define users to notify, request all users
        if(!$users || !is_array($users) || !count($users)) {
          $users = $this->user->index(false, false, (object)[], [], [])->pluck('id');
        }else{
          $users = collect($users);
        }

        //Divide users for create job
        $usersJobs = $users->chunk(50);

        /*Create Jobs*/
        if (count($usersJobs)) {
          $count = 0;
          foreach ($usersJobs as $job) {
            $count += count($job);
            sendNotifications::dispatch($job, $notification, count($users), $count);//Create Job
          }
        }

        //Response
        $response = ["data" => "Notification generated with ID ". $notification->id];
      } catch (\Exception $e) {
        //Message Error
        $status = 500;
        $response = [
          "errors" => $e->getMessage()
        ];
      }

      return response()->json($response, $status ?? 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
      try {
        //Get Parameters from URL.
        $p = $this->parametersUrl(false, false, [], ['user','profile']);

        //Request to Repository
        $notifications = $this->notification->index($p->page, $p->take, $p->filter, $p->include);

        //Response
        $response = ["data" => NotificationTransformer::collection($notifications)];
      } catch (\Exception $e) {
        //Message Error
        $status = 500;
        $response = [
          "errors" => $e->getMessage()
        ];
      }

      return response()->json($response, $status ?? 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateNotificationRequest $request
     * @return Response
     */
    public function store(CreateNotificationRequest $request)
    {
        $this->notification->create($request->all());

        return redirect()->route('admin.inotification.notification.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('inotification::notifications.title.notifications')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Notification $notification
     * @return Response
     */
    public function edit(Notification $notification)
    {
        return view('inotification::admin.notifications.edit', compact('notification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Notification $notification
     * @param  UpdateNotificationRequest $request
     * @return Response
     */
    public function update(Notification $notification, UpdateNotificationRequest $request)
    {
        $this->notification->update($notification, $request->all());

        return redirect()->route('admin.inotification.notification.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('inotification::notifications.title.notifications')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Notification $notification
     * @return Response
     */
    public function destroy(Notification $notification)
    {
        $this->notification->destroy($notification);

        return redirect()->route('admin.inotification.notification.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('inotification::notifications.title.notifications')]));
    }
}
