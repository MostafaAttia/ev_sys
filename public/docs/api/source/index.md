---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/api/collection.json)
<!-- END_INFO -->

#general
<!-- START_8e73e131257b043c6c352d7c21d0309b -->
## Sign Up

<strong>Parameters:</strong>
<br>
first_name           : required <br>
last_name            : required <br>
email                : required|email|unique <br>
password             : required|min:6 <br>
password_confirmation: required <br>
<br>
gender               : optional|in:male,female <br>
dob                  : optional|date <br>
phone                : optional|max:15|min:4 <br>
address              : optional|string|min:10|max:255 <br>
image                : optional|image|mimes:jpeg,png,jpg|max:2048 bytes <br>

<strong>Response:</strong>

array containing a message of success and a token

> Example request:

```bash
curl "http://localhost//api/signup" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/signup",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST /api/signup`


<!-- END_8e73e131257b043c6c352d7c21d0309b -->
<!-- START_7571ba0bcf678b5474025c2b69ea88a9 -->
## Confirm email

> Example request:

```bash
curl "http://localhost//api/signup/confirm_email/{confirmation_code}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/signup/confirm_email/{confirmation_code}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "headers": {}
}
```

### HTTP Request
`GET /api/signup/confirm_email/{confirmation_code}`

`HEAD /api/signup/confirm_email/{confirmation_code}`


<!-- END_7571ba0bcf678b5474025c2b69ea88a9 -->
<!-- START_b982a9c2785c94e078bbe534a1f12d68 -->
## Login

<strong>Parameters:</strong>
<br>
email                : required|email|unique <br>
password             : required|min:6 <br>

<strong>Response:</strong>
<br>
{"token": "jwt_token"}

> Example request:

```bash
curl "http://localhost//api/login" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/login",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST /api/login`


<!-- END_b982a9c2785c94e078bbe534a1f12d68 -->
<!-- START_135a29bc1e5ba0dc0dbeb458895243c0 -->
## Log Out

> Example request:

```bash
curl "http://localhost//api/logout" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/logout",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET /api/logout`

`HEAD /api/logout`

`POST /api/logout`

`PUT /api/logout`

`PATCH /api/logout`

`DELETE /api/logout`


<!-- END_135a29bc1e5ba0dc0dbeb458895243c0 -->
<!-- START_ff3f8c566c9ef2b4156ea5ebcf6bcf69 -->
## Generates reset token for a given user

* <strong>Parameters:</strong>
<br>
email                : required|email <br>

NOTE: in headers please send  Accept  application/json , or your request will fail :)

<strong>Response:</strong> <br>

success: data array with password-reset token, <br>
error: otherwise <br>

> Example request:

```bash
curl "http://localhost//api/password/email" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/password/email",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST /api/password/email`


<!-- END_ff3f8c566c9ef2b4156ea5ebcf6bcf69 -->
<!-- START_5e9e4ac523cd01bd511cd54c969e8d9c -->
## Reset the given user&#039;s password.

<strong>Parameters:</strong>
<br>
email                : required|email <br>
password             : required|min:6 <br>
password_confirmation: required <br>
token                : required <br>

NOTE: in headers please send  Accept  application/json , or your request will fail :)

<strong>Response:</strong> <br>

array containing a message with a login token, <br>
if success -> token:{your_login_token}, <br>
if failed ->  token:null <br>

> Example request:

```bash
curl "http://localhost//api/password/reset" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/password/reset",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST /api/password/reset`


<!-- END_5e9e4ac523cd01bd511cd54c969e8d9c -->
<!-- START_d433d0ecb2571e4312c50b13716d74bb -->
## Get User Details by ID OR Email

<strong>Parameters:</strong>
<br>
ID             : optional_if|min:6 <br>
email          : optional_if|email|unique <br>

if you want to get details by email, first param will be null.

> Example request:

```bash
curl "http://localhost//api/client/{client_id?}/{client_email?}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/client/{client_id?}/{client_email?}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "exception": null,
    "original": {
        "status": "success",
        "data": {
            "id": 1,
            "first_name": "Mostafa",
            "last_name": "Attiaaa",
            "email": "mostafa.elperrawy@gmail.com",
            "gender": "male",
            "dob": "1990-04-01",
            "phone": "38102062",
            "address": "road 843, block 208, building 1591, flat 9",
            "image_path": {
                "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/user_content\/original\/img_22ec45d82445cbafe82056e9bc4dd052.jpg",
                "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/user_content\/60*60\/img_22ec45d82445cbafe82056e9bc4dd052.jpg",
                "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/user_content\/120*120\/img_22ec45d82445cbafe82056e9bc4dd052.jpg",
                "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/user_content\/240*240\/img_22ec45d82445cbafe82056e9bc4dd052.jpg"
            },
            "is_email_confirmed": 1
        },
        "message": null
    },
    "headers": {}
}
```

### HTTP Request
`GET /api/client/{client_id?}/{client_email?}`

`HEAD /api/client/{client_id?}/{client_email?}`


<!-- END_d433d0ecb2571e4312c50b13716d74bb -->
<!-- START_21c3b1d3f53a04b23635d2d10717f9fb -->
## Update/Edit User

<strong>Required:</strong><br>

header: Authorization "token" for this user

<strong>Parameters:</strong>
<br>
first_name   : optional|max:56 <br>
last_name    : optional|max:56 <br>
password     : optional|min:6 <br>
password_confirmation: required_with:password|min:6 <br>
gender       : optional|in:male,female <br>
dob          : optional|date "YYYY-MM-DD" <br>
phone        : optional|string|max:15|min:4 <br>
address      : optional|string|min:10|max:255 <br>

> Example request:

```bash
curl "http://localhost//api/client/update" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/client/update",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST /api/client/update`


<!-- END_21c3b1d3f53a04b23635d2d10717f9fb -->
<!-- START_c027020f44b52e61d6a1354fbff6b949 -->
## Store a newly created comment in storage.

Parameters: <br>
content: text|required

Headers : auth token

> Example request:

```bash
curl "http://localhost//api/event/{event_id}/comment" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/event/{event_id}/comment",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST /api/event/{event_id}/comment`


<!-- END_c027020f44b52e61d6a1354fbff6b949 -->
<!-- START_ba86a55170c4d00c6ec71041668421e1 -->
## return the specified comment

> Example request:

```bash
curl "http://localhost//api/comment/{comment_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/comment/{comment_id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET /api/comment/{comment_id}`

`HEAD /api/comment/{comment_id}`


<!-- END_ba86a55170c4d00c6ec71041668421e1 -->
<!-- START_ffb840a9db2696163385fcfe0d95d443 -->
## Update the specified comment in storage.

Parameters: <br>
content: text|required

> Example request:

```bash
curl "http://localhost//api/comment/{comment_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/comment/{comment_id}",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST /api/comment/{comment_id}`


<!-- END_ffb840a9db2696163385fcfe0d95d443 -->
<!-- START_eacaf299c930d7aa962fd07369475145 -->
## Remove the specified comment from storage.

> Example request:

```bash
curl "http://localhost//api/comment/{comment_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/comment/{comment_id}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE /api/comment/{comment_id}`


<!-- END_eacaf299c930d7aa962fd07369475145 -->
<!-- START_32803795778a67192a0f27db26a09a4d -->
## Get all comments for an event.

> Example request:

```bash
curl "http://localhost//api/event/{event_id}/comments" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/event/{event_id}/comments",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET /api/event/{event_id}/comments`

`HEAD /api/event/{event_id}/comments`


<!-- END_32803795778a67192a0f27db26a09a4d -->
<!-- START_21515a56eedfa639ab6c6184b17aa70d -->
## Post/Update rating for event

<strong>Required:</strong><br>

header: Authorization "token" for current user

<strong>Parameters:</strong>
<br>
rating   : required|in:1,2,3,4,5 <br>

> Example request:

```bash
curl "http://localhost//api/event/{event_id}/rating" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/event/{event_id}/rating",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST /api/event/{event_id}/rating`


<!-- END_21515a56eedfa639ab6c6184b17aa70d -->
<!-- START_e9d6fc18a46965a48ae4ea817ecdd897 -->
## delete user&#039;s rating

<strong>Required:</strong><br>

header: Authorization "token" for current user

> Example request:

```bash
curl "http://localhost//api/event/{event_id}/rating" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/event/{event_id}/rating",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE /api/event/{event_id}/rating`


<!-- END_e9d6fc18a46965a48ae4ea817ecdd897 -->
<!-- START_24150484e1a5ffc20d8914b803a39b56 -->
## Get all Events [including unpublished events]

> Example request:

```bash
curl "http://localhost//api/events/all" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/events/all",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET /api/events/all`

`HEAD /api/events/all`


<!-- END_24150484e1a5ffc20d8914b803a39b56 -->
<!-- START_a271b2813bbc84345e0f55e28c1f6b5a -->
## Get all live events

> Example request:

```bash
curl "http://localhost//api/events/live" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/events/live",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "exception": null,
    "original": {
        "status": "success",
        "data": [
            {
                "id": 1,
                "title": "first event",
                "desc": "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_0f94924227fdae9f2c47d05e27077369.jpg"
                },
                "start_date": {
                    "date": "2018-05-22 00:02:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-06-22 00:02:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 1,
                    "name": "Culture-Authority@Bahrain",
                    "events": 12,
                    "followers_ids": [],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg"
                    }
                },
                "venue_name": "Egyptian Museum Cairo",
                "venue_name_full": "Egyptian Museum, Meret Basha, Ismailia, Qasr an Nile, Egypt",
                "location_address": "15 Meret Basha, Ismailia, Qasr an Nile, Cairo Governorate, Egypt",
                "location_address_line_1": "Meret Basha",
                "location_address_line_2": "",
                "location_country": "Egypt",
                "location_country_code": "EG",
                "location_state": "Cairo Governorate",
                "location_lat": "30.0478468",
                "location_long": "31.233649300000025",
                "is_activity": false,
                "event_url": "http:\/\/localhost\/e\/1\/first-event",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 1,
                    "name": "Art & Theatre",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/art.jpg",
                    "events": 1,
                    "fans_ids": []
                },
                "likers_ids": [
                    2
                ]
            },
            {
                "id": 2,
                "title": "second event",
                "desc": "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_9db7d7a1d65de18478cc760bf95c1c52.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_9db7d7a1d65de18478cc760bf95c1c52.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_9db7d7a1d65de18478cc760bf95c1c52.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_9db7d7a1d65de18478cc760bf95c1c52.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_9db7d7a1d65de18478cc760bf95c1c52.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_9db7d7a1d65de18478cc760bf95c1c52.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_9db7d7a1d65de18478cc760bf95c1c52.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_9db7d7a1d65de18478cc760bf95c1c52.jpg"
                },
                "start_date": {
                    "date": "2018-07-25 00:21:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-08-25 00:21:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 1,
                    "name": "Culture-Authority@Bahrain",
                    "events": 12,
                    "followers_ids": [],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg"
                    }
                },
                "venue_name": "Egyptian Media Production City - EMPC",
                "venue_name_full": "Egyptian Media Production City - EMPC, Egypt",
                "location_address": "Giza Governorate, Egypt",
                "location_address_line_1": "",
                "location_address_line_2": "",
                "location_country": "Egypt",
                "location_country_code": "EG",
                "location_state": "Giza Governorate",
                "location_lat": "29.96574120000001",
                "location_long": "31.016253900000038",
                "is_activity": false,
                "event_url": "http:\/\/localhost\/e\/2\/second-event",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 3,
                    "name": "Music & Entertainment",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/music.jpg",
                    "events": 3,
                    "fans_ids": []
                },
                "likers_ids": [
                    2
                ]
            },
            {
                "id": 3,
                "title": "Third Event",
                "desc": "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_dc764cf0bd172f77ad2abb7ec8f49f22.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_dc764cf0bd172f77ad2abb7ec8f49f22.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_dc764cf0bd172f77ad2abb7ec8f49f22.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_dc764cf0bd172f77ad2abb7ec8f49f22.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_dc764cf0bd172f77ad2abb7ec8f49f22.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_dc764cf0bd172f77ad2abb7ec8f49f22.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_dc764cf0bd172f77ad2abb7ec8f49f22.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_dc764cf0bd172f77ad2abb7ec8f49f22.jpg"
                },
                "start_date": {
                    "date": "2018-04-22 00:33:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-06-22 00:33:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 1,
                    "name": "Culture-Authority@Bahrain",
                    "events": 12,
                    "followers_ids": [],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg"
                    }
                },
                "venue_name": "Egypt Pyramids Tours",
                "venue_name_full": "Egypt Pyramids Tours, Oula, Giza, Egypt",
                "location_address": "Ad Doqi, Giza, Oula, Giza, Giza Governorate 12411, Egypt",
                "location_address_line_1": "",
                "location_address_line_2": "",
                "location_country": "Egypt",
                "location_country_code": "EG",
                "location_state": "Giza Governorate",
                "location_lat": "30.01382300000001",
                "location_long": "31.20957199999998",
                "is_activity": false,
                "event_url": "http:\/\/localhost\/e\/3\/third-event",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 2,
                    "name": "Exhibitions",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/exhibition.jpg",
                    "events": 2,
                    "fans_ids": [
                        2
                    ]
                },
                "likers_ids": [
                    1,
                    2,
                    3
                ]
            },
            {
                "id": 4,
                "title": "Fourth Event",
                "desc": "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_6877b3afd22b28817c6d2283c84edbdb.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_6877b3afd22b28817c6d2283c84edbdb.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_6877b3afd22b28817c6d2283c84edbdb.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_6877b3afd22b28817c6d2283c84edbdb.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_6877b3afd22b28817c6d2283c84edbdb.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_6877b3afd22b28817c6d2283c84edbdb.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_6877b3afd22b28817c6d2283c84edbdb.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_6877b3afd22b28817c6d2283c84edbdb.jpg"
                },
                "start_date": {
                    "date": "2018-04-22 00:34:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-07-22 00:34:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 1,
                    "name": "Culture-Authority@Bahrain",
                    "events": 12,
                    "followers_ids": [],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg"
                    }
                },
                "venue_name": "Abo Ali Restaurant",
                "venue_name_full": "Abo Ali Restaurant, مجمع عبد المقصود - الاردنية، العاشر من رمضان، الشرقية، Egypt",
                "location_address": "مجمع عبد المقصود - الاردنية، العاشر من رمضان، الشرقية، محافظة القاهرة‬، Egypt",
                "location_address_line_1": "مجمع عبد المقصود - الاردنية",
                "location_address_line_2": "",
                "location_country": "Egypt",
                "location_country_code": "EG",
                "location_state": "محافظة القاهرة‬",
                "location_lat": "30.29376500000001",
                "location_long": "31.745685999999978",
                "is_activity": false,
                "event_url": "http:\/\/localhost\/e\/4\/fourth-event",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 3,
                    "name": "Music & Entertainment",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/music.jpg",
                    "events": 3,
                    "fans_ids": []
                },
                "likers_ids": [
                    1,
                    2,
                    3
                ]
            },
            {
                "id": 5,
                "title": "Fifth Event",
                "desc": "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_716d9dcf34302161a891d4e983f076ba.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_716d9dcf34302161a891d4e983f076ba.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_716d9dcf34302161a891d4e983f076ba.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_716d9dcf34302161a891d4e983f076ba.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_716d9dcf34302161a891d4e983f076ba.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_716d9dcf34302161a891d4e983f076ba.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_716d9dcf34302161a891d4e983f076ba.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_716d9dcf34302161a891d4e983f076ba.jpg"
                },
                "start_date": {
                    "date": "2018-04-22 00:38:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-06-22 00:38:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 1,
                    "name": "Culture-Authority@Bahrain",
                    "events": 12,
                    "followers_ids": [],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg"
                    }
                },
                "venue_name": "Alexandria Faculty of Medicine",
                "venue_name_full": "Alexandria University, Al Mesallah Sharq, Qesm Al Attarin, Egypt",
                "location_address": "Chamblion street, el azareeta, Al Mesallah Sharq, Qesm Al Attarin, Alexandria Governorate, Egypt",
                "location_address_line_1": "",
                "location_address_line_2": "",
                "location_country": "Egypt",
                "location_country_code": "EG",
                "location_state": "Alexandria Governorate",
                "location_lat": "31.2023016",
                "location_long": "29.90580669999997",
                "is_activity": false,
                "event_url": "http:\/\/localhost\/e\/5\/fifth-event",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 5,
                    "name": "Nightlife",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/nightlife.jpg",
                    "events": 3,
                    "fans_ids": [
                        2,
                        3
                    ]
                },
                "likers_ids": [
                    2
                ]
            },
            {
                "id": 6,
                "title": "Sixth Event",
                "desc": "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_dc335e1e6654016463b20afdab94ce25.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_dc335e1e6654016463b20afdab94ce25.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_dc335e1e6654016463b20afdab94ce25.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_dc335e1e6654016463b20afdab94ce25.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_dc335e1e6654016463b20afdab94ce25.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_dc335e1e6654016463b20afdab94ce25.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_dc335e1e6654016463b20afdab94ce25.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_dc335e1e6654016463b20afdab94ce25.jpg"
                },
                "start_date": {
                    "date": "2018-04-22 00:39:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-05-22 00:39:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 1,
                    "name": "Culture-Authority@Bahrain",
                    "events": 12,
                    "followers_ids": [],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg"
                    }
                },
                "venue_name": "Bahrain International Exhibition & Convention Centre",
                "venue_name_full": "Bahrain International Exhibition & Convention Centre, Avenue 28, Sanabis, Bahrain",
                "location_address": "158 Avenue 28, Sanabis 11644, Bahrain",
                "location_address_line_1": "Avenue 28",
                "location_address_line_2": "Sanabis",
                "location_country": "Bahrain",
                "location_country_code": "BH",
                "location_state": "Capital Governorate",
                "location_lat": "26.229856",
                "location_long": "50.54240400000003",
                "is_activity": false,
                "event_url": "http:\/\/localhost\/e\/6\/sixth-event",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 4,
                    "name": "Networking & Social",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/social.jpg",
                    "events": 2,
                    "fans_ids": [
                        1
                    ]
                },
                "likers_ids": [
                    1,
                    2,
                    3
                ]
            },
            {
                "id": 7,
                "title": "Seventh Event",
                "desc": "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_4c03292ddc701554c04ee01267a58523.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_4c03292ddc701554c04ee01267a58523.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_4c03292ddc701554c04ee01267a58523.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_4c03292ddc701554c04ee01267a58523.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_4c03292ddc701554c04ee01267a58523.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_4c03292ddc701554c04ee01267a58523.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_4c03292ddc701554c04ee01267a58523.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_4c03292ddc701554c04ee01267a58523.jpg"
                },
                "start_date": {
                    "date": "2018-04-22 00:41:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-05-22 00:41:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 1,
                    "name": "Culture-Authority@Bahrain",
                    "events": 12,
                    "followers_ids": [],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg"
                    }
                },
                "venue_name": "Bahrain National Stadium",
                "venue_name_full": "Bahrain National Stadium, شارع المحرق، Riffa, Bahrain",
                "location_address": "East Riffa, Bahrain، شارع المحرق، Riffa, Bahrain",
                "location_address_line_1": "شارع المحرق",
                "location_address_line_2": "Riffa",
                "location_country": "Bahrain",
                "location_country_code": "BH",
                "location_state": "Central Governorate",
                "location_lat": "26.153794",
                "location_long": "50.54364529999998",
                "is_activity": false,
                "event_url": "http:\/\/localhost\/e\/7\/seventh-event",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 5,
                    "name": "Nightlife",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/nightlife.jpg",
                    "events": 3,
                    "fans_ids": [
                        2,
                        3
                    ]
                },
                "likers_ids": [
                    2
                ]
            },
            {
                "id": 8,
                "title": "Eighth Event",
                "desc": "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_49e5f70e37185fe15ec663f6abae6b32.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_49e5f70e37185fe15ec663f6abae6b32.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_49e5f70e37185fe15ec663f6abae6b32.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_49e5f70e37185fe15ec663f6abae6b32.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_49e5f70e37185fe15ec663f6abae6b32.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_49e5f70e37185fe15ec663f6abae6b32.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_49e5f70e37185fe15ec663f6abae6b32.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_49e5f70e37185fe15ec663f6abae6b32.jpg"
                },
                "start_date": {
                    "date": "2018-04-22 00:54:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-05-22 00:54:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 1,
                    "name": "Culture-Authority@Bahrain",
                    "events": 12,
                    "followers_ids": [],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg"
                    }
                },
                "venue_name": "Stavolta",
                "venue_name_full": "Stavolta, Maadi as Sarayat Al Gharbeyah, Al Maadi, Cairo, Egypt",
                "location_address": "39 Road 231, Degla - Maadi, Maadi as Sarayat Al Gharbeyah, Al Maadi, Cairo Governorate, Egypt",
                "location_address_line_1": "",
                "location_address_line_2": "",
                "location_country": "Egypt",
                "location_country_code": "EG",
                "location_state": "Cairo Governorate",
                "location_lat": "29.962045",
                "location_long": "31.276809999999955",
                "is_activity": false,
                "event_url": "http:\/\/localhost\/e\/8\/eighth-event",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 7,
                    "name": "Sports",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/sports.jpg",
                    "events": 4,
                    "fans_ids": [
                        1
                    ]
                },
                "likers_ids": []
            },
            {
                "id": 9,
                "title": "Ninth Event",
                "desc": "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_5a79b3fdfc1c99abcd55dd2eda70f876.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_5a79b3fdfc1c99abcd55dd2eda70f876.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_5a79b3fdfc1c99abcd55dd2eda70f876.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_5a79b3fdfc1c99abcd55dd2eda70f876.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_5a79b3fdfc1c99abcd55dd2eda70f876.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_5a79b3fdfc1c99abcd55dd2eda70f876.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_5a79b3fdfc1c99abcd55dd2eda70f876.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_5a79b3fdfc1c99abcd55dd2eda70f876.jpg"
                },
                "start_date": {
                    "date": "2018-06-22 00:55:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-06-23 00:55:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 1,
                    "name": "Culture-Authority@Bahrain",
                    "events": 12,
                    "followers_ids": [],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg"
                    }
                },
                "venue_name": "Cairo International Airport",
                "venue_name_full": "Cairo International Airport, Sheraton Al Matar, Qism El-Nozha, Egypt",
                "location_address": "Sheraton Al Matar, Qism El-Nozha, Cairo Governorate, Egypt",
                "location_address_line_1": "",
                "location_address_line_2": "",
                "location_country": "Egypt",
                "location_country_code": "EG",
                "location_state": "Cairo Governorate",
                "location_lat": "30.118977",
                "location_long": "31.40692809999996",
                "is_activity": false,
                "event_url": "http:\/\/localhost\/e\/9\/ninth-event",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 6,
                    "name": "Food & Dining",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/food.jpg",
                    "events": 1,
                    "fans_ids": []
                },
                "likers_ids": []
            },
            {
                "id": 10,
                "title": "Tenth Event",
                "desc": "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_26b1a0ab970a1f2803dc040e96d5dddc.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_26b1a0ab970a1f2803dc040e96d5dddc.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_26b1a0ab970a1f2803dc040e96d5dddc.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_26b1a0ab970a1f2803dc040e96d5dddc.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_26b1a0ab970a1f2803dc040e96d5dddc.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_26b1a0ab970a1f2803dc040e96d5dddc.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_26b1a0ab970a1f2803dc040e96d5dddc.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_26b1a0ab970a1f2803dc040e96d5dddc.jpg"
                },
                "start_date": {
                    "date": "2018-05-22 00:56:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-05-23 00:56:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 1,
                    "name": "Culture-Authority@Bahrain",
                    "events": 12,
                    "followers_ids": [],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg"
                    }
                },
                "venue_name": "National Museum of Egyptian Civilization",
                "venue_name_full": "National Museum of Egyptian Civilization, طريق مصر القديمه، Ad Deyorah, Misr Al Qadimah, Cairo, Egypt",
                "location_address": "طريق مصر القديمه، Ad Deyorah, Misr Al Qadimah, Cairo Governorate, Egypt",
                "location_address_line_1": "طريق مصر القديمه",
                "location_address_line_2": "",
                "location_country": "Egypt",
                "location_country_code": "EG",
                "location_state": "Cairo Governorate",
                "location_lat": "30.00748590000001",
                "location_long": "31.24846189999994",
                "is_activity": false,
                "event_url": "http:\/\/localhost\/e\/10\/tenth-event",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 4,
                    "name": "Networking & Social",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/social.jpg",
                    "events": 2,
                    "fans_ids": [
                        1
                    ]
                },
                "likers_ids": []
            },
            {
                "id": 11,
                "title": "Eleventh Event",
                "desc": "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_130a56899a6c6be0fe47daa1f6153377.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_130a56899a6c6be0fe47daa1f6153377.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_130a56899a6c6be0fe47daa1f6153377.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_130a56899a6c6be0fe47daa1f6153377.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_130a56899a6c6be0fe47daa1f6153377.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_130a56899a6c6be0fe47daa1f6153377.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_130a56899a6c6be0fe47daa1f6153377.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_130a56899a6c6be0fe47daa1f6153377.jpg"
                },
                "start_date": {
                    "date": "2018-04-22 00:58:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-05-22 00:58:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 1,
                    "name": "Culture-Authority@Bahrain",
                    "events": 12,
                    "followers_ids": [],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg"
                    }
                },
                "venue_name": "Stadium Metro station",
                "venue_name_full": "Stadium Metro station, Khedr El-Touny, Ash Sharekat, Nasr City, Cairo, Egypt",
                "location_address": "Khedr El-Touny, Ash Sharekat, Nasr City, Cairo Governorate, Egypt",
                "location_address_line_1": "Khedr El-Touny",
                "location_address_line_2": "",
                "location_country": "Egypt",
                "location_country_code": "EG",
                "location_state": "Cairo Governorate",
                "location_lat": "30.07339079999999",
                "location_long": "31.317991500000062",
                "is_activity": false,
                "event_url": "http:\/\/localhost\/e\/11\/eleventh-event",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 2,
                    "name": "Exhibitions",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/exhibition.jpg",
                    "events": 2,
                    "fans_ids": [
                        2
                    ]
                },
                "likers_ids": []
            },
            {
                "id": 13,
                "title": "Twelve Event ",
                "desc": "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_c82865ac7d3a65876508712ab3760867.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_c82865ac7d3a65876508712ab3760867.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_c82865ac7d3a65876508712ab3760867.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_c82865ac7d3a65876508712ab3760867.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_c82865ac7d3a65876508712ab3760867.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_c82865ac7d3a65876508712ab3760867.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_c82865ac7d3a65876508712ab3760867.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_c82865ac7d3a65876508712ab3760867.jpg"
                },
                "start_date": {
                    "date": "2018-03-23 00:00:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-07-22 23:59:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 1,
                    "name": "Culture-Authority@Bahrain",
                    "events": 12,
                    "followers_ids": [],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg"
                    }
                },
                "venue_name": "Alexandria National Museum",
                "venue_name_full": "Alexandria National Museum, El-Shaheed Galal El-Desouky, Bab Sharqi WA Wabour Al Meyah, Qesm Bab Sharqi, Egypt",
                "location_address": "131 El-Shaheed Galal El-Desouky, Bab Sharqi WA Wabour Al Meyah, Qesm Bab Sharqi, Alexandria Governorate, Egypt",
                "location_address_line_1": "El-Shaheed Galal El-Desouky",
                "location_address_line_2": "",
                "location_country": "Egypt",
                "location_country_code": "EG",
                "location_state": "Alexandria Governorate",
                "location_lat": "31.2009548",
                "location_long": "29.91325759999995",
                "is_activity": true,
                "event_url": "http:\/\/localhost\/e\/13\/twelve-event",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 3,
                    "name": "Music & Entertainment",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/music.jpg",
                    "events": 3,
                    "fans_ids": []
                },
                "likers_ids": []
            },
            {
                "id": 14,
                "title": "Karaoke Night",
                "desc": "At vero eos et **accusamus** et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. *Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.* Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_25654870d258d269c8fb7bd97595f10e.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_25654870d258d269c8fb7bd97595f10e.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_25654870d258d269c8fb7bd97595f10e.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_25654870d258d269c8fb7bd97595f10e.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_25654870d258d269c8fb7bd97595f10e.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_25654870d258d269c8fb7bd97595f10e.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_25654870d258d269c8fb7bd97595f10e.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_25654870d258d269c8fb7bd97595f10e.jpg"
                },
                "start_date": {
                    "date": "2018-06-26 03:44:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-06-26 04:44:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 2,
                    "name": "Zomba",
                    "events": 2,
                    "followers_ids": [
                        2
                    ],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_82135f7e5a42ad07d8ce266179ad9861.jpg",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_82135f7e5a42ad07d8ce266179ad9861.jpg",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_82135f7e5a42ad07d8ce266179ad9861.jpg",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_82135f7e5a42ad07d8ce266179ad9861.jpg"
                    }
                },
                "venue_name": "Cairo Opera House",
                "venue_name_full": "Cairo Opera House, Opera Land، EL GEZIRAH، Zamalek, Egypt",
                "location_address": "Opera Land، EL GEZIRAH، الزمالك، محافظة القاهرة‬، Egypt",
                "location_address_line_1": "Opera Land",
                "location_address_line_2": "",
                "location_country": "Egypt",
                "location_country_code": "EG",
                "location_state": "محافظة القاهرة‬",
                "location_lat": "30.0424866",
                "location_long": "31.224456799999984",
                "is_activity": false,
                "event_url": "http:\/\/localhost\/e\/14\/karaoke-night",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 7,
                    "name": "Sports",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/sports.jpg",
                    "events": 4,
                    "fans_ids": [
                        1
                    ]
                },
                "likers_ids": []
            },
            {
                "id": 15,
                "title": "Zomba event",
                "desc": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\r\n\r\n",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_fd7413cfc06baeae83362e499330a381.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_fd7413cfc06baeae83362e499330a381.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_fd7413cfc06baeae83362e499330a381.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_fd7413cfc06baeae83362e499330a381.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_fd7413cfc06baeae83362e499330a381.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_fd7413cfc06baeae83362e499330a381.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_fd7413cfc06baeae83362e499330a381.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_fd7413cfc06baeae83362e499330a381.jpg"
                },
                "start_date": {
                    "date": "2018-03-20 03:53:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-03-20 05:53:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 2,
                    "name": "Zomba",
                    "events": 2,
                    "followers_ids": [
                        2
                    ],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_82135f7e5a42ad07d8ce266179ad9861.jpg",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_82135f7e5a42ad07d8ce266179ad9861.jpg",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_82135f7e5a42ad07d8ce266179ad9861.jpg",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_82135f7e5a42ad07d8ce266179ad9861.jpg"
                    }
                },
                "venue_name": "Cairo International Stadium",
                "venue_name_full": "Cairo Stadium, Al Estad, Nasr City, Egypt",
                "location_address": "Al Estad, Nasr City, Cairo Governorate, Egypt",
                "location_address_line_1": "",
                "location_address_line_2": "",
                "location_country": "Egypt",
                "location_country_code": "EG",
                "location_state": "Cairo Governorate",
                "location_lat": "30.0691131",
                "location_long": "31.312257899999963",
                "is_activity": false,
                "event_url": "http:\/\/localhost\/e\/15\/zomba-event",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 5,
                    "name": "Nightlife",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/nightlife.jpg",
                    "events": 3,
                    "fans_ids": [
                        2,
                        3
                    ]
                },
                "likers_ids": []
            },
            {
                "id": 16,
                "title": "Romba ",
                "desc": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\r\n\r\n",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_aebf3a850b36d9fa275579f374f1227f.jpeg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_aebf3a850b36d9fa275579f374f1227f.jpeg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_aebf3a850b36d9fa275579f374f1227f.jpeg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_aebf3a850b36d9fa275579f374f1227f.jpeg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_aebf3a850b36d9fa275579f374f1227f.jpeg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_aebf3a850b36d9fa275579f374f1227f.jpeg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_aebf3a850b36d9fa275579f374f1227f.jpeg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_aebf3a850b36d9fa275579f374f1227f.jpeg"
                },
                "start_date": {
                    "date": "2018-06-26 06:54:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-06-26 08:54:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 3,
                    "name": "Liverpool",
                    "events": 2,
                    "followers_ids": [
                        2,
                        1,
                        3
                    ],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_4d7b03e615f126a9366bf0d01e01adaa.png",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_4d7b03e615f126a9366bf0d01e01adaa.png",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_4d7b03e615f126a9366bf0d01e01adaa.png",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_4d7b03e615f126a9366bf0d01e01adaa.png"
                    }
                },
                "venue_name": "Anfield",
                "venue_name_full": "Anfield Stadium, Anfield Road, Liverpool, UK",
                "location_address": "Anfield Rd, Liverpool L4 0TH, UK",
                "location_address_line_1": "Anfield Road",
                "location_address_line_2": "",
                "location_country": "UnitedKingdom",
                "location_country_code": "GB",
                "location_state": "England",
                "location_lat": "53.43082939999999",
                "location_long": "-2.960829999999987",
                "is_activity": false,
                "event_url": "http:\/\/localhost\/e\/16\/romba",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 7,
                    "name": "Sports",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/sports.jpg",
                    "events": 4,
                    "fans_ids": [
                        1
                    ]
                },
                "likers_ids": []
            },
            {
                "id": 17,
                "title": "Mo Salah",
                "desc": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\r\n\r\n",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_8ee2f30120e9e77d54375702a49404e3.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_8ee2f30120e9e77d54375702a49404e3.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_8ee2f30120e9e77d54375702a49404e3.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_8ee2f30120e9e77d54375702a49404e3.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_8ee2f30120e9e77d54375702a49404e3.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_8ee2f30120e9e77d54375702a49404e3.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_8ee2f30120e9e77d54375702a49404e3.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_8ee2f30120e9e77d54375702a49404e3.jpg"
                },
                "start_date": {
                    "date": "2018-06-26 06:57:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-06-26 07:57:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 3,
                    "name": "Liverpool",
                    "events": 2,
                    "followers_ids": [
                        2,
                        1,
                        3
                    ],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_4d7b03e615f126a9366bf0d01e01adaa.png",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_4d7b03e615f126a9366bf0d01e01adaa.png",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_4d7b03e615f126a9366bf0d01e01adaa.png",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_4d7b03e615f126a9366bf0d01e01adaa.png"
                    }
                },
                "venue_name": "Anfield",
                "venue_name_full": "Anfield Stadium, Anfield Road, Liverpool, UK",
                "location_address": "Anfield Rd, Liverpool L4 0TH, UK",
                "location_address_line_1": "Anfield Road",
                "location_address_line_2": "",
                "location_country": "UnitedKingdom",
                "location_country_code": "GB",
                "location_state": "England",
                "location_lat": "53.43082939999999",
                "location_long": "-2.960829999999987",
                "is_activity": false,
                "event_url": "http:\/\/localhost\/e\/17\/mo-salah",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 7,
                    "name": "Sports",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/sports.jpg",
                    "events": 4,
                    "fans_ids": [
                        1
                    ]
                },
                "likers_ids": []
            }
        ],
        "message": null
    },
    "headers": {}
}
```

### HTTP Request
`GET /api/events/live`

`HEAD /api/events/live`


<!-- END_a271b2813bbc84345e0f55e28c1f6b5a -->
<!-- START_b4a1cefd9ab5f4ce350a0e48db43120a -->
## Get Event by id

<strong>Parameters:</strong>
<br>
event_id  : required|integer <br>

> Example request:

```bash
curl "http://localhost//api/event/{event_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/event/{event_id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "exception": null,
    "original": {
        "status": "success",
        "data": {
            "id": 1,
            "title": "first event",
            "desc": "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?",
            "image_path": {
                "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_0f94924227fdae9f2c47d05e27077369.jpg"
            },
            "start_date": {
                "date": "2018-05-22 00:02:00",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "end_date": {
                "date": "2018-06-22 00:02:00",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "organiser": {
                "id": 1,
                "name": "Culture-Authority@Bahrain",
                "events": 12,
                "followers_ids": [],
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                    "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                    "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                    "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg"
                }
            },
            "venue_name": "Egyptian Museum Cairo",
            "venue_name_full": "Egyptian Museum, Meret Basha, Ismailia, Qasr an Nile, Egypt",
            "location_address": "15 Meret Basha, Ismailia, Qasr an Nile, Cairo Governorate, Egypt",
            "location_address_line_1": "Meret Basha",
            "location_address_line_2": "",
            "location_country": "Egypt",
            "location_country_code": "EG",
            "location_state": "Cairo Governorate",
            "location_lat": "30.0478468",
            "location_long": "31.233649300000025",
            "is_activity": false,
            "event_url": "http:\/\/localhost\/e\/1\/first-event",
            "social_show_facebook": 1,
            "social_show_twitter": 1,
            "social_show_googleplus": 1,
            "social_show_linkedin": 1,
            "category": {
                "id": 1,
                "name": "Art & Theatre",
                "image": "http:\/\/localhost:8000\/front\/img\/categories\/art.jpg",
                "events": 1,
                "fans_ids": []
            },
            "likers_ids": [
                2
            ]
        },
        "message": null
    },
    "headers": {}
}
```

### HTTP Request
`GET /api/event/{event_id}`

`HEAD /api/event/{event_id}`


<!-- END_b4a1cefd9ab5f4ce350a0e48db43120a -->
<!-- START_21563b8989534d55b8bc8df32e393ff8 -->
## List Attendees

<strong>Parameters:</strong>
<br>
event_id  : required|integer <br>

> Example request:

```bash
curl "http://localhost//api/event/{event_id}/attendees" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/event/{event_id}/attendees",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "exception": null,
    "original": {
        "status": "success",
        "data": [],
        "message": null
    },
    "headers": {}
}
```

### HTTP Request
`GET /api/event/{event_id}/attendees`

`HEAD /api/event/{event_id}/attendees`


<!-- END_21563b8989534d55b8bc8df32e393ff8 -->
<!-- START_9595ab5304948ee38b3672fc5018e16f -->
## List all Categories

> Example request:

```bash
curl "http://localhost//api/categories" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/categories",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "exception": null,
    "original": {
        "status": "success",
        "data": [
            {
                "id": 1,
                "name": "Art & Theatre",
                "description": "",
                "img_path": "http:\/\/localhost:8000\/front\/img\/categories\/art.jpg"
            },
            {
                "id": 2,
                "name": "Exhibitions",
                "description": "",
                "img_path": "http:\/\/localhost:8000\/front\/img\/categories\/exhibition.jpg"
            },
            {
                "id": 3,
                "name": "Music & Entertainment",
                "description": "",
                "img_path": "http:\/\/localhost:8000\/front\/img\/categories\/music.jpg"
            },
            {
                "id": 4,
                "name": "Networking & Social",
                "description": "",
                "img_path": "http:\/\/localhost:8000\/front\/img\/categories\/social.jpg"
            },
            {
                "id": 5,
                "name": "Nightlife",
                "description": "",
                "img_path": "http:\/\/localhost:8000\/front\/img\/categories\/nightlife.jpg"
            },
            {
                "id": 6,
                "name": "Food & Dining",
                "description": "",
                "img_path": "http:\/\/localhost:8000\/front\/img\/categories\/food.jpg"
            },
            {
                "id": 7,
                "name": "Sports",
                "description": "",
                "img_path": "http:\/\/localhost:8000\/front\/img\/categories\/sports.jpg"
            }
        ],
        "message": null
    },
    "headers": {}
}
```

### HTTP Request
`GET /api/categories`

`HEAD /api/categories`


<!-- END_9595ab5304948ee38b3672fc5018e16f -->
<!-- START_5d38a97a16c14f50e92fe67fedb6392f -->
## Get Events in a category

<strong>Parameters:</strong>
<br>
category_id  : required|integer <br>

> Example request:

```bash
curl "http://localhost//api/category/{category_id}/events" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/category/{category_id}/events",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "exception": null,
    "original": {
        "status": "success",
        "data": [
            {
                "id": 1,
                "title": "first event",
                "desc": "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_0f94924227fdae9f2c47d05e27077369.jpg"
                },
                "start_date": {
                    "date": "2018-05-22 00:02:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-06-22 00:02:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 1,
                    "name": "Culture-Authority@Bahrain",
                    "events": 12,
                    "followers_ids": [],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg"
                    }
                },
                "venue_name": "Egyptian Museum Cairo",
                "venue_name_full": "Egyptian Museum, Meret Basha, Ismailia, Qasr an Nile, Egypt",
                "location_address": "15 Meret Basha, Ismailia, Qasr an Nile, Cairo Governorate, Egypt",
                "location_address_line_1": "Meret Basha",
                "location_address_line_2": "",
                "location_country": "Egypt",
                "location_country_code": "EG",
                "location_state": "Cairo Governorate",
                "location_lat": "30.0478468",
                "location_long": "31.233649300000025",
                "is_activity": false,
                "event_url": "http:\/\/localhost\/e\/1\/first-event",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 1,
                    "name": "Art & Theatre",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/art.jpg",
                    "events": 1,
                    "fans_ids": []
                },
                "likers_ids": [
                    2
                ]
            }
        ],
        "message": null
    },
    "headers": {}
}
```

### HTTP Request
`GET /api/category/{category_id}/events`

`HEAD /api/category/{category_id}/events`


<!-- END_5d38a97a16c14f50e92fe67fedb6392f -->
<!-- START_ff11ed1613c3216917e968b8fc30ae36 -->
## Get Events by organiser id

<strong>Parameters:</strong>
<br>
organiser_id  : required|integer <br>

> Example request:

```bash
curl "http://localhost//api/organiser/{organiser_id}/events" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/organiser/{organiser_id}/events",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "exception": null,
    "original": {
        "status": "success",
        "data": [
            {
                "id": 1,
                "title": "first event",
                "desc": "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_0f94924227fdae9f2c47d05e27077369.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_0f94924227fdae9f2c47d05e27077369.jpg"
                },
                "start_date": {
                    "date": "2018-05-22 00:02:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-06-22 00:02:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 1,
                    "name": "Culture-Authority@Bahrain",
                    "events": 12,
                    "followers_ids": [],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg"
                    }
                },
                "venue_name": "Egyptian Museum Cairo",
                "venue_name_full": "Egyptian Museum, Meret Basha, Ismailia, Qasr an Nile, Egypt",
                "location_address": "15 Meret Basha, Ismailia, Qasr an Nile, Cairo Governorate, Egypt",
                "location_address_line_1": "Meret Basha",
                "location_address_line_2": "",
                "location_country": "Egypt",
                "location_country_code": "EG",
                "location_state": "Cairo Governorate",
                "location_lat": "30.0478468",
                "location_long": "31.233649300000025",
                "is_activity": false,
                "event_url": "http:\/\/localhost\/e\/1\/first-event",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 1,
                    "name": "Art & Theatre",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/art.jpg",
                    "events": 1,
                    "fans_ids": []
                },
                "likers_ids": [
                    2
                ]
            },
            {
                "id": 2,
                "title": "second event",
                "desc": "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_9db7d7a1d65de18478cc760bf95c1c52.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_9db7d7a1d65de18478cc760bf95c1c52.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_9db7d7a1d65de18478cc760bf95c1c52.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_9db7d7a1d65de18478cc760bf95c1c52.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_9db7d7a1d65de18478cc760bf95c1c52.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_9db7d7a1d65de18478cc760bf95c1c52.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_9db7d7a1d65de18478cc760bf95c1c52.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_9db7d7a1d65de18478cc760bf95c1c52.jpg"
                },
                "start_date": {
                    "date": "2018-07-25 00:21:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-08-25 00:21:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 1,
                    "name": "Culture-Authority@Bahrain",
                    "events": 12,
                    "followers_ids": [],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg"
                    }
                },
                "venue_name": "Egyptian Media Production City - EMPC",
                "venue_name_full": "Egyptian Media Production City - EMPC, Egypt",
                "location_address": "Giza Governorate, Egypt",
                "location_address_line_1": "",
                "location_address_line_2": "",
                "location_country": "Egypt",
                "location_country_code": "EG",
                "location_state": "Giza Governorate",
                "location_lat": "29.96574120000001",
                "location_long": "31.016253900000038",
                "is_activity": false,
                "event_url": "http:\/\/localhost\/e\/2\/second-event",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 3,
                    "name": "Music & Entertainment",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/music.jpg",
                    "events": 3,
                    "fans_ids": []
                },
                "likers_ids": [
                    2
                ]
            },
            {
                "id": 3,
                "title": "Third Event",
                "desc": "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_dc764cf0bd172f77ad2abb7ec8f49f22.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_dc764cf0bd172f77ad2abb7ec8f49f22.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_dc764cf0bd172f77ad2abb7ec8f49f22.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_dc764cf0bd172f77ad2abb7ec8f49f22.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_dc764cf0bd172f77ad2abb7ec8f49f22.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_dc764cf0bd172f77ad2abb7ec8f49f22.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_dc764cf0bd172f77ad2abb7ec8f49f22.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_dc764cf0bd172f77ad2abb7ec8f49f22.jpg"
                },
                "start_date": {
                    "date": "2018-04-22 00:33:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-06-22 00:33:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 1,
                    "name": "Culture-Authority@Bahrain",
                    "events": 12,
                    "followers_ids": [],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg"
                    }
                },
                "venue_name": "Egypt Pyramids Tours",
                "venue_name_full": "Egypt Pyramids Tours, Oula, Giza, Egypt",
                "location_address": "Ad Doqi, Giza, Oula, Giza, Giza Governorate 12411, Egypt",
                "location_address_line_1": "",
                "location_address_line_2": "",
                "location_country": "Egypt",
                "location_country_code": "EG",
                "location_state": "Giza Governorate",
                "location_lat": "30.01382300000001",
                "location_long": "31.20957199999998",
                "is_activity": false,
                "event_url": "http:\/\/localhost\/e\/3\/third-event",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 2,
                    "name": "Exhibitions",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/exhibition.jpg",
                    "events": 2,
                    "fans_ids": [
                        2
                    ]
                },
                "likers_ids": [
                    1,
                    2,
                    3
                ]
            },
            {
                "id": 4,
                "title": "Fourth Event",
                "desc": "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_6877b3afd22b28817c6d2283c84edbdb.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_6877b3afd22b28817c6d2283c84edbdb.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_6877b3afd22b28817c6d2283c84edbdb.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_6877b3afd22b28817c6d2283c84edbdb.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_6877b3afd22b28817c6d2283c84edbdb.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_6877b3afd22b28817c6d2283c84edbdb.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_6877b3afd22b28817c6d2283c84edbdb.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_6877b3afd22b28817c6d2283c84edbdb.jpg"
                },
                "start_date": {
                    "date": "2018-04-22 00:34:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-07-22 00:34:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 1,
                    "name": "Culture-Authority@Bahrain",
                    "events": 12,
                    "followers_ids": [],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg"
                    }
                },
                "venue_name": "Abo Ali Restaurant",
                "venue_name_full": "Abo Ali Restaurant, مجمع عبد المقصود - الاردنية، العاشر من رمضان، الشرقية، Egypt",
                "location_address": "مجمع عبد المقصود - الاردنية، العاشر من رمضان، الشرقية، محافظة القاهرة‬، Egypt",
                "location_address_line_1": "مجمع عبد المقصود - الاردنية",
                "location_address_line_2": "",
                "location_country": "Egypt",
                "location_country_code": "EG",
                "location_state": "محافظة القاهرة‬",
                "location_lat": "30.29376500000001",
                "location_long": "31.745685999999978",
                "is_activity": false,
                "event_url": "http:\/\/localhost\/e\/4\/fourth-event",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 3,
                    "name": "Music & Entertainment",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/music.jpg",
                    "events": 3,
                    "fans_ids": []
                },
                "likers_ids": [
                    1,
                    2,
                    3
                ]
            },
            {
                "id": 5,
                "title": "Fifth Event",
                "desc": "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_716d9dcf34302161a891d4e983f076ba.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_716d9dcf34302161a891d4e983f076ba.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_716d9dcf34302161a891d4e983f076ba.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_716d9dcf34302161a891d4e983f076ba.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_716d9dcf34302161a891d4e983f076ba.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_716d9dcf34302161a891d4e983f076ba.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_716d9dcf34302161a891d4e983f076ba.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_716d9dcf34302161a891d4e983f076ba.jpg"
                },
                "start_date": {
                    "date": "2018-04-22 00:38:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-06-22 00:38:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 1,
                    "name": "Culture-Authority@Bahrain",
                    "events": 12,
                    "followers_ids": [],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg"
                    }
                },
                "venue_name": "Alexandria Faculty of Medicine",
                "venue_name_full": "Alexandria University, Al Mesallah Sharq, Qesm Al Attarin, Egypt",
                "location_address": "Chamblion street, el azareeta, Al Mesallah Sharq, Qesm Al Attarin, Alexandria Governorate, Egypt",
                "location_address_line_1": "",
                "location_address_line_2": "",
                "location_country": "Egypt",
                "location_country_code": "EG",
                "location_state": "Alexandria Governorate",
                "location_lat": "31.2023016",
                "location_long": "29.90580669999997",
                "is_activity": false,
                "event_url": "http:\/\/localhost\/e\/5\/fifth-event",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 5,
                    "name": "Nightlife",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/nightlife.jpg",
                    "events": 3,
                    "fans_ids": [
                        2,
                        3
                    ]
                },
                "likers_ids": [
                    2
                ]
            },
            {
                "id": 6,
                "title": "Sixth Event",
                "desc": "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_dc335e1e6654016463b20afdab94ce25.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_dc335e1e6654016463b20afdab94ce25.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_dc335e1e6654016463b20afdab94ce25.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_dc335e1e6654016463b20afdab94ce25.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_dc335e1e6654016463b20afdab94ce25.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_dc335e1e6654016463b20afdab94ce25.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_dc335e1e6654016463b20afdab94ce25.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_dc335e1e6654016463b20afdab94ce25.jpg"
                },
                "start_date": {
                    "date": "2018-04-22 00:39:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-05-22 00:39:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 1,
                    "name": "Culture-Authority@Bahrain",
                    "events": 12,
                    "followers_ids": [],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg"
                    }
                },
                "venue_name": "Bahrain International Exhibition & Convention Centre",
                "venue_name_full": "Bahrain International Exhibition & Convention Centre, Avenue 28, Sanabis, Bahrain",
                "location_address": "158 Avenue 28, Sanabis 11644, Bahrain",
                "location_address_line_1": "Avenue 28",
                "location_address_line_2": "Sanabis",
                "location_country": "Bahrain",
                "location_country_code": "BH",
                "location_state": "Capital Governorate",
                "location_lat": "26.229856",
                "location_long": "50.54240400000003",
                "is_activity": false,
                "event_url": "http:\/\/localhost\/e\/6\/sixth-event",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 4,
                    "name": "Networking & Social",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/social.jpg",
                    "events": 2,
                    "fans_ids": [
                        1
                    ]
                },
                "likers_ids": [
                    1,
                    2,
                    3
                ]
            },
            {
                "id": 7,
                "title": "Seventh Event",
                "desc": "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_4c03292ddc701554c04ee01267a58523.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_4c03292ddc701554c04ee01267a58523.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_4c03292ddc701554c04ee01267a58523.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_4c03292ddc701554c04ee01267a58523.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_4c03292ddc701554c04ee01267a58523.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_4c03292ddc701554c04ee01267a58523.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_4c03292ddc701554c04ee01267a58523.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_4c03292ddc701554c04ee01267a58523.jpg"
                },
                "start_date": {
                    "date": "2018-04-22 00:41:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-05-22 00:41:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 1,
                    "name": "Culture-Authority@Bahrain",
                    "events": 12,
                    "followers_ids": [],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg"
                    }
                },
                "venue_name": "Bahrain National Stadium",
                "venue_name_full": "Bahrain National Stadium, شارع المحرق، Riffa, Bahrain",
                "location_address": "East Riffa, Bahrain، شارع المحرق، Riffa, Bahrain",
                "location_address_line_1": "شارع المحرق",
                "location_address_line_2": "Riffa",
                "location_country": "Bahrain",
                "location_country_code": "BH",
                "location_state": "Central Governorate",
                "location_lat": "26.153794",
                "location_long": "50.54364529999998",
                "is_activity": false,
                "event_url": "http:\/\/localhost\/e\/7\/seventh-event",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 5,
                    "name": "Nightlife",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/nightlife.jpg",
                    "events": 3,
                    "fans_ids": [
                        2,
                        3
                    ]
                },
                "likers_ids": [
                    2
                ]
            },
            {
                "id": 8,
                "title": "Eighth Event",
                "desc": "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_49e5f70e37185fe15ec663f6abae6b32.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_49e5f70e37185fe15ec663f6abae6b32.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_49e5f70e37185fe15ec663f6abae6b32.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_49e5f70e37185fe15ec663f6abae6b32.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_49e5f70e37185fe15ec663f6abae6b32.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_49e5f70e37185fe15ec663f6abae6b32.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_49e5f70e37185fe15ec663f6abae6b32.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_49e5f70e37185fe15ec663f6abae6b32.jpg"
                },
                "start_date": {
                    "date": "2018-04-22 00:54:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-05-22 00:54:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 1,
                    "name": "Culture-Authority@Bahrain",
                    "events": 12,
                    "followers_ids": [],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg"
                    }
                },
                "venue_name": "Stavolta",
                "venue_name_full": "Stavolta, Maadi as Sarayat Al Gharbeyah, Al Maadi, Cairo, Egypt",
                "location_address": "39 Road 231, Degla - Maadi, Maadi as Sarayat Al Gharbeyah, Al Maadi, Cairo Governorate, Egypt",
                "location_address_line_1": "",
                "location_address_line_2": "",
                "location_country": "Egypt",
                "location_country_code": "EG",
                "location_state": "Cairo Governorate",
                "location_lat": "29.962045",
                "location_long": "31.276809999999955",
                "is_activity": false,
                "event_url": "http:\/\/localhost\/e\/8\/eighth-event",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 7,
                    "name": "Sports",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/sports.jpg",
                    "events": 4,
                    "fans_ids": [
                        1
                    ]
                },
                "likers_ids": []
            },
            {
                "id": 9,
                "title": "Ninth Event",
                "desc": "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_5a79b3fdfc1c99abcd55dd2eda70f876.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_5a79b3fdfc1c99abcd55dd2eda70f876.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_5a79b3fdfc1c99abcd55dd2eda70f876.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_5a79b3fdfc1c99abcd55dd2eda70f876.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_5a79b3fdfc1c99abcd55dd2eda70f876.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_5a79b3fdfc1c99abcd55dd2eda70f876.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_5a79b3fdfc1c99abcd55dd2eda70f876.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_5a79b3fdfc1c99abcd55dd2eda70f876.jpg"
                },
                "start_date": {
                    "date": "2018-06-22 00:55:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-06-23 00:55:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 1,
                    "name": "Culture-Authority@Bahrain",
                    "events": 12,
                    "followers_ids": [],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg"
                    }
                },
                "venue_name": "Cairo International Airport",
                "venue_name_full": "Cairo International Airport, Sheraton Al Matar, Qism El-Nozha, Egypt",
                "location_address": "Sheraton Al Matar, Qism El-Nozha, Cairo Governorate, Egypt",
                "location_address_line_1": "",
                "location_address_line_2": "",
                "location_country": "Egypt",
                "location_country_code": "EG",
                "location_state": "Cairo Governorate",
                "location_lat": "30.118977",
                "location_long": "31.40692809999996",
                "is_activity": false,
                "event_url": "http:\/\/localhost\/e\/9\/ninth-event",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 6,
                    "name": "Food & Dining",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/food.jpg",
                    "events": 1,
                    "fans_ids": []
                },
                "likers_ids": []
            },
            {
                "id": 10,
                "title": "Tenth Event",
                "desc": "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_26b1a0ab970a1f2803dc040e96d5dddc.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_26b1a0ab970a1f2803dc040e96d5dddc.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_26b1a0ab970a1f2803dc040e96d5dddc.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_26b1a0ab970a1f2803dc040e96d5dddc.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_26b1a0ab970a1f2803dc040e96d5dddc.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_26b1a0ab970a1f2803dc040e96d5dddc.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_26b1a0ab970a1f2803dc040e96d5dddc.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_26b1a0ab970a1f2803dc040e96d5dddc.jpg"
                },
                "start_date": {
                    "date": "2018-05-22 00:56:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-05-23 00:56:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 1,
                    "name": "Culture-Authority@Bahrain",
                    "events": 12,
                    "followers_ids": [],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg"
                    }
                },
                "venue_name": "National Museum of Egyptian Civilization",
                "venue_name_full": "National Museum of Egyptian Civilization, طريق مصر القديمه، Ad Deyorah, Misr Al Qadimah, Cairo, Egypt",
                "location_address": "طريق مصر القديمه، Ad Deyorah, Misr Al Qadimah, Cairo Governorate, Egypt",
                "location_address_line_1": "طريق مصر القديمه",
                "location_address_line_2": "",
                "location_country": "Egypt",
                "location_country_code": "EG",
                "location_state": "Cairo Governorate",
                "location_lat": "30.00748590000001",
                "location_long": "31.24846189999994",
                "is_activity": false,
                "event_url": "http:\/\/localhost\/e\/10\/tenth-event",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 4,
                    "name": "Networking & Social",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/social.jpg",
                    "events": 2,
                    "fans_ids": [
                        1
                    ]
                },
                "likers_ids": []
            },
            {
                "id": 11,
                "title": "Eleventh Event",
                "desc": "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_130a56899a6c6be0fe47daa1f6153377.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_130a56899a6c6be0fe47daa1f6153377.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_130a56899a6c6be0fe47daa1f6153377.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_130a56899a6c6be0fe47daa1f6153377.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_130a56899a6c6be0fe47daa1f6153377.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_130a56899a6c6be0fe47daa1f6153377.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_130a56899a6c6be0fe47daa1f6153377.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_130a56899a6c6be0fe47daa1f6153377.jpg"
                },
                "start_date": {
                    "date": "2018-04-22 00:58:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-05-22 00:58:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 1,
                    "name": "Culture-Authority@Bahrain",
                    "events": 12,
                    "followers_ids": [],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg"
                    }
                },
                "venue_name": "Stadium Metro station",
                "venue_name_full": "Stadium Metro station, Khedr El-Touny, Ash Sharekat, Nasr City, Cairo, Egypt",
                "location_address": "Khedr El-Touny, Ash Sharekat, Nasr City, Cairo Governorate, Egypt",
                "location_address_line_1": "Khedr El-Touny",
                "location_address_line_2": "",
                "location_country": "Egypt",
                "location_country_code": "EG",
                "location_state": "Cairo Governorate",
                "location_lat": "30.07339079999999",
                "location_long": "31.317991500000062",
                "is_activity": false,
                "event_url": "http:\/\/localhost\/e\/11\/eleventh-event",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 2,
                    "name": "Exhibitions",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/exhibition.jpg",
                    "events": 2,
                    "fans_ids": [
                        2
                    ]
                },
                "likers_ids": []
            },
            {
                "id": 13,
                "title": "Twelve Event ",
                "desc": "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?",
                "image_path": {
                    "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/original\/event_image_c82865ac7d3a65876508712ab3760867.jpg",
                    "200*200": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/200*200\/event_image_c82865ac7d3a65876508712ab3760867.jpg",
                    "300*300": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*300\/event_image_c82865ac7d3a65876508712ab3760867.jpg",
                    "335*250": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/335*250\/event_image_c82865ac7d3a65876508712ab3760867.jpg",
                    "300*400": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/300*400\/event_image_c82865ac7d3a65876508712ab3760867.jpg",
                    "450*600": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/450*600\/event_image_c82865ac7d3a65876508712ab3760867.jpg",
                    "400*720": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/400*720\/event_image_c82865ac7d3a65876508712ab3760867.jpg",
                    "600*1080": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/event_images\/600*1080\/event_image_c82865ac7d3a65876508712ab3760867.jpg"
                },
                "start_date": {
                    "date": "2018-03-23 00:00:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "end_date": {
                    "date": "2018-07-22 23:59:00",
                    "timezone_type": 3,
                    "timezone": "UTC"
                },
                "organiser": {
                    "id": 1,
                    "name": "Culture-Authority@Bahrain",
                    "events": 12,
                    "followers_ids": [],
                    "image_path": {
                        "original": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/original\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "60*60": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/60*60\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "120*120": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/120*120\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg",
                        "240*240": "https:\/\/s3.amazonaws.com\/cdn.vt17.dev\/organizer\/240*240\/img_6235a9739aaf74ae2f0c6dbcf1f53ed7.jpg"
                    }
                },
                "venue_name": "Alexandria National Museum",
                "venue_name_full": "Alexandria National Museum, El-Shaheed Galal El-Desouky, Bab Sharqi WA Wabour Al Meyah, Qesm Bab Sharqi, Egypt",
                "location_address": "131 El-Shaheed Galal El-Desouky, Bab Sharqi WA Wabour Al Meyah, Qesm Bab Sharqi, Alexandria Governorate, Egypt",
                "location_address_line_1": "El-Shaheed Galal El-Desouky",
                "location_address_line_2": "",
                "location_country": "Egypt",
                "location_country_code": "EG",
                "location_state": "Alexandria Governorate",
                "location_lat": "31.2009548",
                "location_long": "29.91325759999995",
                "is_activity": true,
                "event_url": "http:\/\/localhost\/e\/13\/twelve-event",
                "social_show_facebook": 1,
                "social_show_twitter": 1,
                "social_show_googleplus": 1,
                "social_show_linkedin": 1,
                "category": {
                    "id": 3,
                    "name": "Music & Entertainment",
                    "image": "http:\/\/localhost:8000\/front\/img\/categories\/music.jpg",
                    "events": 3,
                    "fans_ids": []
                },
                "likers_ids": []
            }
        ],
        "message": null
    },
    "headers": {}
}
```

### HTTP Request
`GET /api/organiser/{organiser_id}/events`

`HEAD /api/organiser/{organiser_id}/events`


<!-- END_ff11ed1613c3216917e968b8fc30ae36 -->
<!-- START_fce8ab495aa93d48e21f89aa353a456b -->
## Search Events by title, venue name, location

> Example request:

```bash
curl "http://localhost//api/events/search/{query}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/events/search/{query}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "exception": null,
    "original": {
        "status": "success",
        "data": [],
        "message": null
    },
    "headers": {}
}
```

### HTTP Request
`GET /api/events/search/{query}`

`HEAD /api/events/search/{query}`


<!-- END_fce8ab495aa93d48e21f89aa353a456b -->
<!-- START_90ff9ef6349162494090babf6b55299e -->
## Search Organisers by name

> Example request:

```bash
curl "http://localhost//api/organisers/search/{query}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/organisers/search/{query}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET /api/organisers/search/{query}`

`HEAD /api/organisers/search/{query}`


<!-- END_90ff9ef6349162494090babf6b55299e -->
<!-- START_4a96d8391893117ce248bf6eb44b2b37 -->
## Validate a ticket request. If successful reserve the tickets

> Example request:

```bash
curl "http://localhost//api/event/{event_id}/checkout" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/event/{event_id}/checkout",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST /api/event/{event_id}/checkout`


<!-- END_4a96d8391893117ce248bf6eb44b2b37 -->
<!-- START_44b07b75fda9d03fb837a154b98649a7 -->
## Create the order, handle payment, update stats, fire off email jobs

> Example request:

```bash
curl "http://localhost//api/event/{event_id}/checkout/create" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/event/{event_id}/checkout/create",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST /api/event/{event_id}/checkout/create`


<!-- END_44b07b75fda9d03fb837a154b98649a7 -->
<!-- START_15a147728dee9811856fbceea4db3d3b -->
## Follow Organiser

* <strong>Required:</strong><br>

header: Authorization "token" for this user

<strong>Parameters:</strong>
<br>
organiser_id

> Example request:

```bash
curl "http://localhost//api/follow/{organiser_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/follow/{organiser_id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET /api/follow/{organiser_id}`

`HEAD /api/follow/{organiser_id}`


<!-- END_15a147728dee9811856fbceea4db3d3b -->
<!-- START_ddd419ded5e734d748f94080817a3a91 -->
## Unfollow Organiser

* <strong>Required:</strong><br>

header: Authorization "token" for this user

<strong>Parameters:</strong>
<br>
organiser_id

> Example request:

```bash
curl "http://localhost//api/unfollow/{organiser_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/unfollow/{organiser_id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET /api/unfollow/{organiser_id}`

`HEAD /api/unfollow/{organiser_id}`


<!-- END_ddd419ded5e734d748f94080817a3a91 -->
<!-- START_a0d0501a38ed8ac081cae918cbb2f3d3 -->
## Favorite a Category

* <strong>Required:</strong><br>

header: Authorization "token" for this user

<strong>Parameters:</strong>
<br>
category_id

> Example request:

```bash
curl "http://localhost//api/favorite/{category_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/favorite/{category_id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET /api/favorite/{category_id}`

`HEAD /api/favorite/{category_id}`


<!-- END_a0d0501a38ed8ac081cae918cbb2f3d3 -->
<!-- START_9d192c1f0c94ae92172cf88ec05f63f2 -->
## UnFavorite a Category

* <strong>Required:</strong><br>

header: Authorization "token" for this user

<strong>Parameters:</strong>
<br>
category_id

> Example request:

```bash
curl "http://localhost//api/unfavorite/{category_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/unfavorite/{category_id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET /api/unfavorite/{category_id}`

`HEAD /api/unfavorite/{category_id}`


<!-- END_9d192c1f0c94ae92172cf88ec05f63f2 -->
<!-- START_fc55239adc7e2a0f81c474ac98b458a8 -->
## Like an Event

* <strong>Required:</strong><br>

header: Authorization "token" for this user

<strong>Parameters:</strong>
<br>
event_id

> Example request:

```bash
curl "http://localhost//api/like/{event_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/like/{event_id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET /api/like/{event_id}`

`HEAD /api/like/{event_id}`


<!-- END_fc55239adc7e2a0f81c474ac98b458a8 -->
<!-- START_d2bf13b469eba1e5400ead84c72d0a47 -->
## Unlike an Event

* <strong>Required:</strong><br>

header: Authorization "token" for this user

<strong>Parameters:</strong>
<br>
event_id

> Example request:

```bash
curl "http://localhost//api/unlike/{event_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/unlike/{event_id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET /api/unlike/{event_id}`

`HEAD /api/unlike/{event_id}`


<!-- END_d2bf13b469eba1e5400ead84c72d0a47 -->
<!-- START_217cab57cc58e277d3c403efccc6a76f -->
## Get Events posted by organizers who are being followed by this client

* <strong>Required:</strong><br>

header: Authorization "token" for this user

> Example request:

```bash
curl "http://localhost//api/followings/events" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/followings/events",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET /api/followings/events`

`HEAD /api/followings/events`


<!-- END_217cab57cc58e277d3c403efccc6a76f -->
<!-- START_59702db55cb76c7a3c261eb1279c750c -->
## Get Events from client&#039;s favorites categories

* <strong>Required:</strong><br>

header: Authorization "token" for this user

> Example request:

```bash
curl "http://localhost//api/favorites/events" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/favorites/events",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET /api/favorites/events`

`HEAD /api/favorites/events`


<!-- END_59702db55cb76c7a3c261eb1279c750c -->
<!-- START_fe3933bdb0b91b5d1cfcddd7b8b2ea3d -->
## Get organizers who are being followed by this client

* * <strong>Required:</strong><br>

header: Authorization "token" for this user

> Example request:

```bash
curl "http://localhost//api/followings" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/followings",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET /api/followings`

`HEAD /api/followings`


<!-- END_fe3933bdb0b91b5d1cfcddd7b8b2ea3d -->
<!-- START_2fe5f7ac7af3305e4fce6d54cc6ee2e6 -->
## Get categories that are being favorite by this client

* <strong>Required:</strong><br>

header: Authorization "token" for this user

> Example request:

```bash
curl "http://localhost//api/favorites" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/favorites",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET /api/favorites`

`HEAD /api/favorites`


<!-- END_2fe5f7ac7af3305e4fce6d54cc6ee2e6 -->
<!-- START_945ade917bd05a4bc1152d670a8982a4 -->
## Get events that are being liked by this client

* <strong>Required:</strong><br>

header: Authorization "token" for this user

> Example request:

```bash
curl "http://localhost//api/likes" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/likes",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET /api/likes`

`HEAD /api/likes`


<!-- END_945ade917bd05a4bc1152d670a8982a4 -->
<!-- START_d6da835a8bc1ecd847652a4b22f720b2 -->
## count event likers

<strong>Parameters:</strong>
<br>
event_id

> Example request:

```bash
curl "http://localhost//api/likes/{event_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/likes/{event_id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "exception": null,
    "original": {
        "status": "success",
        "data": {
            "likes": 1
        },
        "message": null
    },
    "headers": {}
}
```

### HTTP Request
`GET /api/likes/{event_id}`

`HEAD /api/likes/{event_id}`


<!-- END_d6da835a8bc1ecd847652a4b22f720b2 -->
<!-- START_ecd0e114c1f0b5c95c5499b0cccfd1a7 -->
## count category fans

<strong>Parameters:</strong>
<br>
category_id

> Example request:

```bash
curl "http://localhost//api/fans/{category_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/fans/{category_id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "exception": null,
    "original": {
        "status": "success",
        "data": {
            "fans": 0
        },
        "message": null
    },
    "headers": {}
}
```

### HTTP Request
`GET /api/fans/{category_id}`

`HEAD /api/fans/{category_id}`


<!-- END_ecd0e114c1f0b5c95c5499b0cccfd1a7 -->
<!-- START_a594b6e2c7b6cc0fca3d560d162f6cf6 -->
## count organiser&#039;s followers

<strong>Parameters:</strong>
<br>
organiser_id

> Example request:

```bash
curl "http://localhost//api/followers/{organiser_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/followers/{organiser_id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "exception": null,
    "original": {
        "status": "success",
        "data": {
            "fans": 0
        },
        "message": null
    },
    "headers": {}
}
```

### HTTP Request
`GET /api/followers/{organiser_id}`

`HEAD /api/followers/{organiser_id}`


<!-- END_a594b6e2c7b6cc0fca3d560d162f6cf6 -->
