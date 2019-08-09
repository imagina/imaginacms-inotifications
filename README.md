# ASGARDCMS-INOTIFICATIONS

##### WHATSAPP NOTIFICATIONS
###### PARAMS

String $sid - Twilio SID
 
String $token - Twilio TOKEN

String $sender - Twilio SENDER PHONE (whatsapp:+57311111111)
 
String $template - Hi {$user} (user string is replace for $user variable)
 
String $user - Imagina Colombia

String $phone - (whatsapp:+57311111111)


```
use Modules\Inotification\Events\SendWhatsAppNotification;

event( new SendWhatsAppNotification( $sid, $token, $sender, $template, $user, $phone ) );
```

##### PUSHER NOTIFICATIONS
###### PARAMS

String $userid - Id user who will receive the notification

String $data - Data to send in the event of the notification

```
use Modules\Inotification\Events\NotificationEvent;

event( new NotificationEvent($userId, $data) );
```
