<?php

namespace Modules\Inotification\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Inotification\Entities\NotificationHistory;
use Modules\Inotification\Repositories\NotificationHistoryRepository;
use Modules\Inotification\Transformers\NotificationHistoryTransformer;
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;
use Illuminate\Support\Facades\Auth;

class NotificationHistoryController extends BaseApiController
{
  /**
   * @var NotificationHistoryRepository
   */
  private $notificationhistory;

  public function __construct(
    NotificationHistoryRepository $notificationhistory
  )
  {
    parent::__construct();
    $this->notificationhistory = $notificationhistory;
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {
    try {
      //Get Parameters from URL.
      $p = $this->parametersUrl(false, false, [], []);

      //If no exist userId, take user loged
      $p->filter->userId = $p->filter->userId ?? Auth::user()->id;

      //Request to Repository
      $history = $this->notificationhistory->index($p->page, $p->take, $p->filter, $p->include);

      //Tranformer notifications
      $history->notifications = NotificationHistoryTransformer::collection($history->notifications);

      //Response
      $response = ["data" => $history];
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
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('inotification::admin.notificationhistories.create');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  NotificationHistory $notificationhistory
   * @param  UpdateNotificationHistoryRequest $request
   * @return Response
   */
  public function update($id)
  {
    try {
      //Get current notification
      $notification = $this->notificationhistory->find($id);
      $update = $notification;
      $update->viewed_at = date('Y/m/d h:i:s a', time());

      $this->notificationhistory->update($notification, (array)$update);

      //Response
      $response = ["data" => new NotificationHistoryTransformer($update)];
    } catch (\Exception $e) {
      //Message Error
      $status = 500;
      $response = [
        "errors" => $e->getMessage()
      ];
    }

    return response()->json($response, $status ?? 200);
  }
}
