# asgardcms-inotifications

##### Whatsapp Notifications 

###### Install Twilio SDK from Composer

```
composer require twilio/sdk
```

###### Source SDK
[The Twilio PHP Helper Library](https://www.twilio.com/docs/libraries/php)


###### Add Twilio keys
```ssh
# Twilio
TWILIO_AUTH_TOKEN=xxxx
TWILIO_ACCOUNT_SID=xxx
TWILIO_SENDER=whatsapp:+xxxx 
```

###### End Point
```
POST: api/notification/whatsapp
```

###### Body Request

```ssh
{
	"attributes":{
		"user": "Imagina Colombia",
		"phone": "whatsapp:+573222222222",
		"message": "Hi World 😁"
	}
}
```

###### Type Data in Body Request

```
user: String
```

```
phone String, whatsapp:+573222222222 (+57 is code country) (the rest is phone) 
```

```
message String (Possibility of adding emojis 😁)
```

###### Body Response

```
status: 200
```

```ssh
{
  "data":[
    "code id message"
  ]
}
```
