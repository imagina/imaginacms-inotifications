<?php

namespace Modules\Inotification\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Setting\Contracts\Setting;

use Modules\Inotification\Events\SendWhatsAppNotification;

class SendWhatsAppController extends Controller
{

  private $setting;

  public function __construct(Setting $setting)
  {
    $this->setting = $setting;
  }

  /**
   * Show the form for creating a new resource.
   * @return Response
   */
  public function create(Request $request)
  {

    try {
      // Get data
      $data = $request->input('attributes') ?? [];

      // Set Params
      $user = $data['user'];
      $phone = $data['phone'];
      $message = $this->setting->get('inotification::whatsapp-message-default');

      // Send Notification
      $event = event(new SendWhatsAppNotification($user, $phone, $message));
      $response = ["data" => $event];

    } catch (\Exception $e) {
      $status = 500;
      $response = ["errors" => $e->getMessage()];
    }
    return response()->json($response ?? ["data" => "WhatsApp successful"], $status ?? 200);
  }

}
