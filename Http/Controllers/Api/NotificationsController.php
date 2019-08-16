<?php

namespace Modules\Inotification\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;
use Modules\Inotification\Repositories\NotificationRepository;
use Modules\Inotification\Transformers\NotificationTransformer;

class NotificationsController extends BaseApiController
{
    /**
     * @var NotificationRepository
     */
    private $notification;

    public function __construct(NotificationRepository $notification)
    {
        $this->notification = $notification;
    }

    public function markAsRead(Request $request)
    {
        $updated = $this->notification->markNotificationAsRead($request->get('id'));

        return response()->json(compact('updated'));
    }
    /**
       * GET ITEMS
       *
       * @return mixed
       */
      public function index(Request $request)
      {
        try {
          //Get Parameters from URL.
          $params = $this->getParamsRequest($request);

          //Request to Repository
          $dataEntity = $this->notification->getItemsBy($params);

          //Response
          $response = ["data" => NotificationTransformer::collection($dataEntity)];

          //If request pagination add meta-page
          $params->page ? $response["meta"] = ["page" => $this->pageTransformer($dataEntity)] : false;
        } catch (\Exception $e) {
          $status = $this->getStatusError($e->getCode());
          $response = ["errors" => $e->getMessage()];
        }

        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
      }
      /**
         * GET A ITEM
         *
         * @param $criteria
         * @return mixed
         */
        public function show($criteria,Request $request)
        {
          try {
            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);

            //Request to Repository
            $dataEntity = $this->notification->getItem($criteria, $params);

            //Break if no found item
            if(!$dataEntity) throw new Exception('Item not found',204);

            //Response
            $response = ["data" => new NotificationTransformer($dataEntity)];

            //If request pagination add meta-page
            $params->page ? $response["meta"] = ["page" => $this->pageTransformer($dataEntity)] : false;
          } catch (\Exception $e) {
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
          }

          //Return response
          return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
        }
}
