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
    "exception": null,
    "original": {},
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
{
    "exception": null,
    "original": {
        "message": "You Are Now Logged out!"
    },
    "headers": {}
}
```

### HTTP Request
`GET /api/logout`

`HEAD /api/logout`

`POST /api/logout`

`PUT /api/logout`

`PATCH /api/logout`

`DELETE /api/logout`


<!-- END_135a29bc1e5ba0dc0dbeb458895243c0 -->
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
null
```

### HTTP Request
`GET /api/client/{client_id?}/{client_email?}`

`HEAD /api/client/{client_id?}/{client_email?}`


<!-- END_d433d0ecb2571e4312c50b13716d74bb -->
<!-- START_4db0fcc03b9e0826560cc79fd0580e63 -->
## Update/Edit User

<strong>Parameters:</strong>
<br>
first_name   : optional|max:56|min:4 <br>
last_name    : optional|max:56|min:4 <br>
email        : optional|email|unique <br>
gender       : optional|in:male,female <br>
dob          : optional|date <br>
phone        : optional|max:15|min:4 <br>
address      : optional|string|min:10|max:255 <br>

> Example request:

```bash
curl "http://localhost//api/client/{client_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost//api/client/{client_id}",
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
`POST /api/client/{client_id}`


<!-- END_4db0fcc03b9e0826560cc79fd0580e63 -->
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
    "original": [
        {
            "id": 3,
            "title": "Batelco Event",
            "location": null,
            "bg_type": "image",
            "bg_color": "#B23333",
            "bg_image_path": "assets\/images\/public\/EventPage\/backgrounds\/5.jpg",
            "description": "batelco desc",
            "start_date": "2016-11-09 15:51:00",
            "end_date": "2016-11-11 15:51:00",
            "on_sale_date": null,
            "account_id": 11,
            "user_id": 12,
            "currency_id": 2,
            "sales_volume": "0.00",
            "organiser_fees_volume": "0.00",
            "organiser_fee_fixed": "0.00",
            "organiser_fee_percentage": "0.000",
            "organiser_id": 4,
            "venue_name": "Batelco Building",
            "venue_name_full": "Batelco Building, Manama, Bahrain",
            "location_address": "Batelco Building, Manama 304, Bahrain",
            "location_address_line_1": "",
            "location_address_line_2": "Manama",
            "location_country": "Bahrain",
            "location_country_code": "BH",
            "location_state": "Capital Governorate",
            "location_post_code": "304",
            "location_street_number": "",
            "location_lat": "26.2347067",
            "location_long": "50.576700399999936",
            "location_google_place_id": "ChIJXwHr8V-vST4RmrNgXBdv-XY",
            "pre_order_display_message": null,
            "post_order_display_message": null,
            "social_share_text": null,
            "social_show_facebook": 1,
            "social_show_linkedin": 1,
            "social_show_twitter": 1,
            "social_show_email": 1,
            "social_show_googleplus": 1,
            "location_is_manual": 0,
            "is_live": 1,
            "created_at": "2016-11-06 12:52:00",
            "updated_at": "2016-11-07 11:40:48",
            "deleted_at": null,
            "barcode_type": "QRCODE",
            "ticket_border_color": "#000000",
            "ticket_bg_color": "#FFFFFF",
            "ticket_text_color": "#000000",
            "ticket_sub_text_color": "#999999",
            "social_show_whatsapp": 1,
            "questions_collection_type": "buyer",
            "checkout_timeout_after": 8,
            "is_1d_barcode_enabled": 0,
            "enable_offline_payments": 0,
            "offline_payment_instructions": null,
            "category_id": null,
            "is_activity": false,
            "activity_start_date": null,
            "activity_end_date": null,
            "activity_start_time": null,
            "activity_end_time": null
        },
        {
            "id": 4,
            "title": "Batelco first event",
            "location": null,
            "bg_type": "image",
            "bg_color": "#B23333",
            "bg_image_path": "assets\/images\/public\/EventPage\/backgrounds\/5.jpg",
            "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
            "start_date": "2016-11-09 11:44:00",
            "end_date": "2016-11-13 11:44:00",
            "on_sale_date": null,
            "account_id": 11,
            "user_id": 13,
            "currency_id": 2,
            "sales_volume": "0.00",
            "organiser_fees_volume": "0.00",
            "organiser_fee_fixed": "0.00",
            "organiser_fee_percentage": "0.000",
            "organiser_id": 5,
            "venue_name": "F1 Night Club",
            "venue_name_full": "F1 Night Club, Manama, Bahrain",
            "location_address": "Manama, Bahrain",
            "location_address_line_1": "",
            "location_address_line_2": "Manama",
            "location_country": "Bahrain",
            "location_country_code": "BH",
            "location_state": "Capital Governorate",
            "location_post_code": "",
            "location_street_number": "",
            "location_lat": "26.2344744",
            "location_long": "50.59595030000003",
            "location_google_place_id": "ChIJ3TAkKVOvST4RpwN-DtOt0no",
            "pre_order_display_message": null,
            "post_order_display_message": null,
            "social_share_text": null,
            "social_show_facebook": 1,
            "social_show_linkedin": 1,
            "social_show_twitter": 1,
            "social_show_email": 1,
            "social_show_googleplus": 1,
            "location_is_manual": 0,
            "is_live": 1,
            "created_at": "2016-11-08 08:46:21",
            "updated_at": "2016-11-08 11:03:33",
            "deleted_at": null,
            "barcode_type": "QRCODE",
            "ticket_border_color": "#000000",
            "ticket_bg_color": "#FFFFFF",
            "ticket_text_color": "#000000",
            "ticket_sub_text_color": "#999999",
            "social_show_whatsapp": 1,
            "questions_collection_type": "buyer",
            "checkout_timeout_after": 8,
            "is_1d_barcode_enabled": 0,
            "enable_offline_payments": 0,
            "offline_payment_instructions": null,
            "category_id": null,
            "is_activity": false,
            "activity_start_date": null,
            "activity_end_date": null,
            "activity_start_time": null,
            "activity_end_time": null
        },
        {
            "id": 5,
            "title": "Craig David Concert",
            "location": null,
            "bg_type": "image",
            "bg_color": "#B23333",
            "bg_image_path": "assets\/images\/public\/EventPage\/backgrounds\/5.jpg",
            "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
            "start_date": "2016-11-10 14:56:00",
            "end_date": "2016-11-11 14:56:00",
            "on_sale_date": null,
            "account_id": 11,
            "user_id": 12,
            "currency_id": 1,
            "sales_volume": "0.00",
            "organiser_fees_volume": "0.00",
            "organiser_fee_fixed": "0.00",
            "organiser_fee_percentage": "0.000",
            "organiser_id": 4,
            "venue_name": "Bahrain City Centre Mall",
            "venue_name_full": "Bahrain City Centre Mall, Isa Town, Bahrain",
            "location_address": "Building 2758، Road 4650, Sh. Khalifa Highway، Manama، Bahrain",
            "location_address_line_1": "Road 4650, Sh. Khalifa Highway",
            "location_address_line_2": "Manama",
            "location_country": "Bahrain",
            "location_country_code": "BH",
            "location_state": "محافظة العاصمة",
            "location_post_code": "",
            "location_street_number": "",
            "location_lat": "26.2328708",
            "location_long": "50.5535989",
            "location_google_place_id": "ChIJ6VRVVTGvST4R39uYys8Pn_U",
            "pre_order_display_message": null,
            "post_order_display_message": null,
            "social_share_text": null,
            "social_show_facebook": 1,
            "social_show_linkedin": 1,
            "social_show_twitter": 1,
            "social_show_email": 1,
            "social_show_googleplus": 1,
            "location_is_manual": 0,
            "is_live": 1,
            "created_at": "2016-11-09 11:57:24",
            "updated_at": "2016-11-15 12:38:06",
            "deleted_at": null,
            "barcode_type": "QRCODE",
            "ticket_border_color": "#000000",
            "ticket_bg_color": "#FFFFFF",
            "ticket_text_color": "#000000",
            "ticket_sub_text_color": "#999999",
            "social_show_whatsapp": 1,
            "questions_collection_type": "buyer",
            "checkout_timeout_after": 8,
            "is_1d_barcode_enabled": 0,
            "enable_offline_payments": 0,
            "offline_payment_instructions": null,
            "category_id": 3,
            "is_activity": false,
            "activity_start_date": null,
            "activity_end_date": null,
            "activity_start_time": null,
            "activity_end_time": null
        },
        {
            "id": 6,
            "title": "Sting Live Concert ",
            "location": null,
            "bg_type": "image",
            "bg_color": "#B23333",
            "bg_image_path": "assets\/images\/public\/EventPage\/backgrounds\/11.jpg",
            "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
            "start_date": "2017-05-26 07:01:00",
            "end_date": "2017-05-26 08:01:00",
            "on_sale_date": null,
            "account_id": 11,
            "user_id": 12,
            "currency_id": 1,
            "sales_volume": "0.00",
            "organiser_fees_volume": "0.00",
            "organiser_fee_fixed": "0.00",
            "organiser_fee_percentage": "0.000",
            "organiser_id": 4,
            "venue_name": "Dubai Marina",
            "venue_name_full": "Dubai Marina - Dubai - United Arab Emirates",
            "location_address": "Dubai Marina - Dubai - United Arab Emirates",
            "location_address_line_1": "",
            "location_address_line_2": "Dubai",
            "location_country": "United Arab Emirates",
            "location_country_code": "AE",
            "location_state": "Dubai",
            "location_post_code": "",
            "location_street_number": "",
            "location_lat": "25.0805422",
            "location_long": "55.14034259999994",
            "location_google_place_id": "ChIJ4ybBAlRrXz4RfG3EVWYeUbk",
            "pre_order_display_message": "We can't wait to see you!",
            "post_order_display_message": "Welcome to the party!",
            "social_share_text": null,
            "social_show_facebook": 1,
            "social_show_linkedin": 1,
            "social_show_twitter": 1,
            "social_show_email": 1,
            "social_show_googleplus": 1,
            "location_is_manual": 0,
            "is_live": 1,
            "created_at": "2016-11-15 12:44:05",
            "updated_at": "2017-02-13 15:03:09",
            "deleted_at": null,
            "barcode_type": "QRCODE",
            "ticket_border_color": "#bd2020",
            "ticket_bg_color": "#256b33",
            "ticket_text_color": "#000000",
            "ticket_sub_text_color": "#999999",
            "social_show_whatsapp": 1,
            "questions_collection_type": "buyer",
            "checkout_timeout_after": 8,
            "is_1d_barcode_enabled": 0,
            "enable_offline_payments": 1,
            "offline_payment_instructions": "1- Call me { 1239875 }\n2- Meet me at { Location }",
            "category_id": 3,
            "is_activity": false,
            "activity_start_date": null,
            "activity_end_date": null,
            "activity_start_time": null,
            "activity_end_time": null
        },
        {
            "id": 14,
            "title": "Debenhams Festival",
            "location": null,
            "bg_type": "image",
            "bg_color": "#B23333",
            "bg_image_path": "assets\/images\/public\/EventPage\/backgrounds\/5.jpg",
            "description": "> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.\n\nDebenhams I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure .\n\n1. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. \n2. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. \n3. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. \n4. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. \n\n* Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.\n* Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.\n* Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.\n* Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.\n\n",
            "start_date": "2016-12-10 00:00:00",
            "end_date": "2017-01-10 23:59:00",
            "on_sale_date": null,
            "account_id": 11,
            "user_id": 12,
            "currency_id": 1,
            "sales_volume": "0.00",
            "organiser_fees_volume": "0.00",
            "organiser_fee_fixed": "0.00",
            "organiser_fee_percentage": "0.000",
            "organiser_id": 4,
            "venue_name": "Bahrain City Centre Mall",
            "venue_name_full": "Bahrain City Centre Mall, Manama, Bahrain",
            "location_address": "Building 2758، Road 4650, Sh. Khalifa Highway، المنامة، Bahrain",
            "location_address_line_1": "Road 4650, Sh. Khalifa Highway",
            "location_address_line_2": "المنامة",
            "location_country": "Bahrain",
            "location_country_code": "BH",
            "location_state": "محافظة العاصمة",
            "location_post_code": "",
            "location_street_number": "",
            "location_lat": "26.2328708",
            "location_long": "50.5535989",
            "location_google_place_id": "ChIJ6VRVVTGvST4R39uYys8Pn_U",
            "pre_order_display_message": null,
            "post_order_display_message": null,
            "social_share_text": null,
            "social_show_facebook": 1,
            "social_show_linkedin": 1,
            "social_show_twitter": 1,
            "social_show_email": 1,
            "social_show_googleplus": 1,
            "location_is_manual": 0,
            "is_live": 1,
            "created_at": "2016-12-04 12:26:50",
            "updated_at": "2016-12-26 03:54:05",
            "deleted_at": null,
            "barcode_type": "QRCODE",
            "ticket_border_color": "#000000",
            "ticket_bg_color": "#FFFFFF",
            "ticket_text_color": "#000000",
            "ticket_sub_text_color": "#999999",
            "social_show_whatsapp": 1,
            "questions_collection_type": "buyer",
            "checkout_timeout_after": 8,
            "is_1d_barcode_enabled": 0,
            "enable_offline_payments": 0,
            "offline_payment_instructions": null,
            "category_id": 2,
            "is_activity": true,
            "activity_start_date": null,
            "activity_end_date": null,
            "activity_start_time": "03:00:00",
            "activity_end_time": "09:00:00"
        },
        {
            "id": 19,
            "title": "Activty 7",
            "location": null,
            "bg_type": "image",
            "bg_color": "#B23333",
            "bg_image_path": "assets\/images\/public\/EventPage\/backgrounds\/5.jpg",
            "description": "desc",
            "start_date": "2016-12-11 00:00:00",
            "end_date": "2017-01-01 23:59:00",
            "on_sale_date": null,
            "account_id": 11,
            "user_id": 12,
            "currency_id": 1,
            "sales_volume": "0.00",
            "organiser_fees_volume": "0.00",
            "organiser_fee_fixed": "0.00",
            "organiser_fee_percentage": "0.000",
            "organiser_id": 4,
            "venue_name": "Batelco Building",
            "venue_name_full": "Batelco Building, Manama, Bahrain",
            "location_address": "Batelco Building, Manama 304, Bahrain",
            "location_address_line_1": "",
            "location_address_line_2": "Manama",
            "location_country": "Bahrain",
            "location_country_code": "BH",
            "location_state": "Capital Governorate",
            "location_post_code": "304",
            "location_street_number": "",
            "location_lat": "26.2347067",
            "location_long": "50.576700399999936",
            "location_google_place_id": "ChIJXwHr8V-vST4RmrNgXBdv-XY",
            "pre_order_display_message": null,
            "post_order_display_message": null,
            "social_share_text": null,
            "social_show_facebook": 1,
            "social_show_linkedin": 1,
            "social_show_twitter": 1,
            "social_show_email": 1,
            "social_show_googleplus": 1,
            "location_is_manual": 0,
            "is_live": 1,
            "created_at": "2016-12-12 09:25:20",
            "updated_at": "2016-12-12 10:15:18",
            "deleted_at": null,
            "barcode_type": "QRCODE",
            "ticket_border_color": "#000000",
            "ticket_bg_color": "#FFFFFF",
            "ticket_text_color": "#000000",
            "ticket_sub_text_color": "#999999",
            "social_show_whatsapp": 1,
            "questions_collection_type": "buyer",
            "checkout_timeout_after": 8,
            "is_1d_barcode_enabled": 0,
            "enable_offline_payments": 0,
            "offline_payment_instructions": null,
            "category_id": 3,
            "is_activity": true,
            "activity_start_date": null,
            "activity_end_date": null,
            "activity_start_time": "12:38:00",
            "activity_end_time": "13:38:00"
        },
        {
            "id": 20,
            "title": "Activity 8",
            "location": null,
            "bg_type": "image",
            "bg_color": "#B23333",
            "bg_image_path": "assets\/images\/public\/EventPage\/backgrounds\/5.jpg",
            "description": "desc",
            "start_date": "2016-12-12 00:00:00",
            "end_date": "2017-02-12 23:59:00",
            "on_sale_date": null,
            "account_id": 11,
            "user_id": 12,
            "currency_id": 1,
            "sales_volume": "0.00",
            "organiser_fees_volume": "0.00",
            "organiser_fee_fixed": "0.00",
            "organiser_fee_percentage": "0.000",
            "organiser_id": 4,
            "venue_name": "Bahrain City Centre Mall",
            "venue_name_full": "Bahrain City Centre Mall, Manama, Bahrain",
            "location_address": "Building 2758، Road 4650, Sh. Khalifa Highway، المنامة، Bahrain",
            "location_address_line_1": "Road 4650, Sh. Khalifa Highway",
            "location_address_line_2": "المنامة",
            "location_country": "Bahrain",
            "location_country_code": "BH",
            "location_state": "محافظة العاصمة",
            "location_post_code": "",
            "location_street_number": "",
            "location_lat": "26.2328708",
            "location_long": "50.5535989",
            "location_google_place_id": "ChIJ6VRVVTGvST4R39uYys8Pn_U",
            "pre_order_display_message": null,
            "post_order_display_message": null,
            "social_share_text": null,
            "social_show_facebook": 1,
            "social_show_linkedin": 1,
            "social_show_twitter": 1,
            "social_show_email": 1,
            "social_show_googleplus": 1,
            "location_is_manual": 0,
            "is_live": 1,
            "created_at": "2016-12-12 10:03:52",
            "updated_at": "2016-12-12 10:11:54",
            "deleted_at": null,
            "barcode_type": "QRCODE",
            "ticket_border_color": "#000000",
            "ticket_bg_color": "#FFFFFF",
            "ticket_text_color": "#000000",
            "ticket_sub_text_color": "#999999",
            "social_show_whatsapp": 1,
            "questions_collection_type": "buyer",
            "checkout_timeout_after": 8,
            "is_1d_barcode_enabled": 0,
            "enable_offline_payments": 0,
            "offline_payment_instructions": null,
            "category_id": 4,
            "is_activity": true,
            "activity_start_date": null,
            "activity_end_date": null,
            "activity_start_time": "13:03:00",
            "activity_end_time": "14:03:00"
        },
        {
            "id": 22,
            "title": "Bryan Adams Concert",
            "location": null,
            "bg_type": "image",
            "bg_color": "#B23333",
            "bg_image_path": "assets\/images\/public\/EventPage\/backgrounds\/5.jpg",
            "description": "> Bryan Adams\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
            "start_date": "2017-04-01 13:42:00",
            "end_date": "2017-04-01 14:42:00",
            "on_sale_date": null,
            "account_id": 11,
            "user_id": 12,
            "currency_id": 1,
            "sales_volume": "0.00",
            "organiser_fees_volume": "0.00",
            "organiser_fee_fixed": "0.00",
            "organiser_fee_percentage": "0.000",
            "organiser_id": 4,
            "venue_name": "Coral Bay",
            "venue_name_full": "Coral Bay, شارع الفاتح, Manama, Capital Governorate, Bahrain",
            "location_address": "Block 322, Road 2407, Building 491, Road 2407 شارع الفاتح، Manama 317, Bahrain",
            "location_address_line_1": "شارع الفاتح",
            "location_address_line_2": "Manama",
            "location_country": "Bahrain",
            "location_country_code": "BH",
            "location_state": "Capital Governorate",
            "location_post_code": "317",
            "location_street_number": "Road 2407",
            "location_lat": "26.229316",
            "location_long": "50.59996899999999",
            "location_google_place_id": "ChIJwT4HlrOoST4RzAPlh1UcMY8",
            "pre_order_display_message": null,
            "post_order_display_message": null,
            "social_share_text": null,
            "social_show_facebook": 1,
            "social_show_linkedin": 1,
            "social_show_twitter": 1,
            "social_show_email": 1,
            "social_show_googleplus": 1,
            "location_is_manual": 0,
            "is_live": 1,
            "created_at": "2016-12-25 10:47:07",
            "updated_at": "2016-12-26 03:56:49",
            "deleted_at": null,
            "barcode_type": "QRCODE",
            "ticket_border_color": "#000000",
            "ticket_bg_color": "#FFFFFF",
            "ticket_text_color": "#000000",
            "ticket_sub_text_color": "#999999",
            "social_show_whatsapp": 1,
            "questions_collection_type": "buyer",
            "checkout_timeout_after": 8,
            "is_1d_barcode_enabled": 0,
            "enable_offline_payments": 0,
            "offline_payment_instructions": null,
            "category_id": 3,
            "is_activity": false,
            "activity_start_date": null,
            "activity_end_date": null,
            "activity_start_time": null,
            "activity_end_time": null
        }
    ],
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
        "id": 1,
        "title": "Solar Expo",
        "location": null,
        "bg_type": "image",
        "bg_color": "#B23333",
        "bg_image_path": "assets\/images\/public\/EventPage\/backgrounds\/5.jpg",
        "description": "just for testing",
        "start_date": "2016-11-04 10:00:00",
        "end_date": "2016-11-05 10:00:00",
        "on_sale_date": null,
        "account_id": 11,
        "user_id": 12,
        "currency_id": 2,
        "sales_volume": "0.00",
        "organiser_fees_volume": "0.00",
        "organiser_fee_fixed": "0.00",
        "organiser_fee_percentage": "0.000",
        "organiser_id": 4,
        "venue_name": "Rotana Hotel",
        "venue_name_full": null,
        "location_address": null,
        "location_address_line_1": "404",
        "location_address_line_2": "",
        "location_country": null,
        "location_country_code": null,
        "location_state": "MANAMA",
        "location_post_code": "361",
        "location_street_number": null,
        "location_lat": null,
        "location_long": null,
        "location_google_place_id": null,
        "pre_order_display_message": null,
        "post_order_display_message": null,
        "social_share_text": null,
        "social_show_facebook": 1,
        "social_show_linkedin": 1,
        "social_show_twitter": 1,
        "social_show_email": 1,
        "social_show_googleplus": 1,
        "location_is_manual": 1,
        "is_live": 0,
        "created_at": "2016-11-03 11:53:09",
        "updated_at": "2016-11-03 11:53:09",
        "deleted_at": null,
        "barcode_type": "QRCODE",
        "ticket_border_color": "#000000",
        "ticket_bg_color": "#FFFFFF",
        "ticket_text_color": "#000000",
        "ticket_sub_text_color": "#999999",
        "social_show_whatsapp": 1,
        "questions_collection_type": "buyer",
        "checkout_timeout_after": 8,
        "is_1d_barcode_enabled": 0,
        "enable_offline_payments": 0,
        "offline_payment_instructions": null,
        "category_id": null,
        "is_activity": false,
        "activity_start_date": null,
        "activity_end_date": null,
        "activity_start_time": null,
        "activity_end_time": null
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
    "original": [],
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
    "original": [
        {
            "id": 1,
            "name": "Art & Theatre",
            "description": ""
        },
        {
            "id": 2,
            "name": "Exhibitions",
            "description": ""
        },
        {
            "id": 3,
            "name": "Music & Entertainment",
            "description": ""
        },
        {
            "id": 4,
            "name": "Networking & Social",
            "description": ""
        },
        {
            "id": 5,
            "name": "Nightlife",
            "description": ""
        },
        {
            "id": 6,
            "name": "Food & Dining",
            "description": ""
        },
        {
            "id": 7,
            "name": "Sport",
            "description": ""
        }
    ],
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
    "original": [],
    "headers": {}
}
```

### HTTP Request
`GET /api/category/{category_id}/events`

`HEAD /api/category/{category_id}/events`


<!-- END_5d38a97a16c14f50e92fe67fedb6392f -->
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
    "original": [
        {
            "id": 4,
            "title": "Batelco first event",
            "location": null,
            "bg_type": "image",
            "bg_color": "#B23333",
            "bg_image_path": "assets\/images\/public\/EventPage\/backgrounds\/5.jpg",
            "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
            "start_date": "2016-11-09 11:44:00",
            "end_date": "2016-11-13 11:44:00",
            "on_sale_date": null,
            "account_id": 11,
            "user_id": 13,
            "currency_id": 2,
            "sales_volume": "0.00",
            "organiser_fees_volume": "0.00",
            "organiser_fee_fixed": "0.00",
            "organiser_fee_percentage": "0.000",
            "organiser_id": 5,
            "venue_name": "F1 Night Club",
            "venue_name_full": "F1 Night Club, Manama, Bahrain",
            "location_address": "Manama, Bahrain",
            "location_address_line_1": "",
            "location_address_line_2": "Manama",
            "location_country": "Bahrain",
            "location_country_code": "BH",
            "location_state": "Capital Governorate",
            "location_post_code": "",
            "location_street_number": "",
            "location_lat": "26.2344744",
            "location_long": "50.59595030000003",
            "location_google_place_id": "ChIJ3TAkKVOvST4RpwN-DtOt0no",
            "pre_order_display_message": null,
            "post_order_display_message": null,
            "social_share_text": null,
            "social_show_facebook": 1,
            "social_show_linkedin": 1,
            "social_show_twitter": 1,
            "social_show_email": 1,
            "social_show_googleplus": 1,
            "location_is_manual": 0,
            "is_live": 1,
            "created_at": "2016-11-08 08:46:21",
            "updated_at": "2016-11-08 11:03:33",
            "deleted_at": null,
            "barcode_type": "QRCODE",
            "ticket_border_color": "#000000",
            "ticket_bg_color": "#FFFFFF",
            "ticket_text_color": "#000000",
            "ticket_sub_text_color": "#999999",
            "social_show_whatsapp": 1,
            "questions_collection_type": "buyer",
            "checkout_timeout_after": 8,
            "is_1d_barcode_enabled": 0,
            "enable_offline_payments": 0,
            "offline_payment_instructions": null,
            "category_id": null,
            "is_activity": false,
            "activity_start_date": null,
            "activity_end_date": null,
            "activity_start_time": null,
            "activity_end_time": null,
            "relevance": 8
        }
    ],
    "headers": {}
}
```

### HTTP Request
`GET /api/events/search/{query}`

`HEAD /api/events/search/{query}`


<!-- END_fce8ab495aa93d48e21f89aa353a456b -->
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
