# asgardcms-inotifications

##### Whatsapp Notifications


###### End Point
```
POST: /api/notification/whatsapp/{botId}
```

###### Body Request

```ssh
{
	"attributes":{
		"user": "Imagina Colombia",
		"phone": "whatsapp:+573222222222"
	}
}
```


###### Body Response

```ssh
{
    "data": [
        "SM6917bec4e9fb46e680568aaa57d99c99"
    ]
}
```
