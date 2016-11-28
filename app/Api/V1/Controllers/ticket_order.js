/**
 * Created by mostafa on 22/11/16.
 */

// to send ajax request from postman, add header X-Requested-With: XMLHttpRequest


// this is the $request passed to postValidateTickets method
var request_postValidateTickets = {
    "_token": "1n5Ou6zLTJVghSOgfexRFSwmvvctbXPffuTfNzyH",
    "tickets": ["4", "5"],
    "ticket_4": "1",
    "ticket_5": "1",  // for multiple tickets, if single : "0"
    "is_embedded": "0"
};


var request_postCreateOrder = {
    "_token": "RL8NqMTfSie00NgluhOkfi8DDdZb6hlkitME99AY",
    "event_id": "6",
    "order_first_name": "Yasser",
    "order_last_name": "ELBRAWY",
    "order_email": "freedom4soul@gmail.com",
    "ticket_holder_first_name": [{"4": "Yasser"}],
    "ticket_holder_last_name": [{"4": "ELBRAWY"}],
    "ticket_holder_email": [{"4": "freedom4soul@gmail.com"}],
    "is_embedded": ""
};

var session_completeOrder = {

    "validation_rules": {
        "ticket_holder_first_name.0.4": ["required"],
        "ticket_holder_last_name.0.4": ["required"],
        "ticket_holder_email.0.4": ["required", "email"]
    },
    "validation_messages": {
        "ticket_holder_first_name.0.4.required": "Ticket holder 1's first name is required",
        "ticket_holder_last_name.0.4.required": "Ticket holder 1's last name is required",
        "ticket_holder_email.0.4.required": "Ticket holder 1's email is required",
        "ticket_holder_email.0.4.email": "Ticket holder 1's email appears to be invalid"
    },
    "event_id": 6,
    "tickets": [{
        "ticket": {
            "id": 4,
            "created_at": "2016-11-15 12:52:37",
            "updated_at": "2016-11-27 09:30:01",
            "deleted_at": null,
            "edited_by_user_id": null,
            "account_id": 11,
            "order_id": null,
            "event_id": 6,
            "title": "General Admission",
            "description": "",
            "price": "0.00",
            "max_per_person": 30,
            "min_per_person": 1,
            "quantity_available": null,
            "quantity_sold": 14,
            "start_sale_date": "2016-11-17 15:52:00",
            "end_sale_date": "2016-12-20 15:52:00",
            "sales_volume": "0.00",
            "organiser_fees_volume": "0.00",
            "is_paused": 0,
            "public_id": null,
            "user_id": 12,
            "sort_order": 1,
            "is_hidden": 0,
            "questions": []
        }, "qty": 1, "price": 0, "booking_fee": 0, "organiser_booking_fee": 0, "full_price": 0
    }],
    "total_ticket_quantity": 1,
    "order_started": 1480244526,
    "expires": {"date": "2016-11-27 11:12:05.000000", "timezone_type": 3, "timezone": "UTC"},
    "reserved_tickets_id": 66,
    "order_total": 0,
    "booking_fee": 0,
    "organiser_booking_fee": 0,
    "total_booking_fee": 0,
    "order_requires_payment": false,
    "account_id": 11,
    "affiliate_referral": null,
    "account_payment_gateway": {
        "id": 2,
        "account_id": 11,
        "payment_gateway_id": 2,
        "config": {"username": "orgnaiser1_paypal", "password": "123456", "signature": "qwerty", "brandName": "vitee"},
        "deleted_at": null,
        "created_at": "2016-11-24 13:08:36",
        "updated_at": "2016-11-24 13:08:36",
        "payment_gateway": {
            "id": 2,
            "provider_name": "PayPal Express",
            "provider_url": "https:\/\/www.paypal.com",
            "is_on_site": 0,
            "can_refund": 0,
            "name": "PayPal_Express"
        }
    },
    "payment_gateway": {
        "id": 2,
        "provider_name": "PayPal Express",
        "provider_url": "https:\/\/www.paypal.com",
        "is_on_site": 0,
        "can_refund": 0,
        "name": "PayPal_Express"
    },
    "request_data": [{
        "_token": "RL8NqMTfSie00NgluhOkfi8DDdZb6hlkitME99AY",
        "event_id": "6",
        "order_first_name": "Yasser",
        "order_last_name": "ELBRAWY",
        "order_email": "freedom4soul@gmail.com",
        "ticket_holder_first_name": [{"4": "Yasser"}],
        "ticket_holder_last_name": [{"4": "ELBRAWY"}],
        "ticket_holder_email": [{"4": "freedom4soul@gmail.com"}],
        "is_embedded": ""
    }]
};


// this will be session() $ticket_order_4
var ticket_order_eventId = {

    "validation_rules": {
        "ticket_holder_first_name.0.4": ["required"],
        "ticket_holder_last_name.0.4": ["required"],
        "ticket_holder_email.0.4": ["required", "email"]
    },
    "validation_messages": {
        "ticket_holder_first_name.0.4.required": "Ticket holder 1's first name is required",
        "ticket_holder_last_name.0.4.required": "Ticket holder 1's last name is required",
        "ticket_holder_email.0.4.required": "Ticket holder 1's email is required",
        "ticket_holder_email.0.4.email": "Ticket holder 1's email appears to be invalid"
    },
    "event_id": 6,
    "tickets": [{
        "ticket": {
            "id": 4,
            "created_at": "2016-11-15 12:52:37",
            "updated_at": "2016-11-21 20:42:30",
            "deleted_at": null,
            "edited_by_user_id": null,
            "account_id": 11,
            "order_id": null,
            "event_id": 6,
            "title": "General Admission",
            "description": "",
            "price": "0.00",
            "max_per_person": 30,
            "min_per_person": 1,
            "quantity_available": null,
            "quantity_sold": 10,
            "start_sale_date": "2016-11-17 15:52:00",
            "end_sale_date": "2016-12-20 15:52:00",
            "sales_volume": "0.00",
            "organiser_fees_volume": "0.00",
            "is_paused": 0,
            "public_id": null,
            "user_id": 12,
            "sort_order": 0,
            "is_hidden": 0,
            "questions": []
        },
        "qty": 1,
        "price": 0,
        "booking_fee": 0,
        "organiser_booking_fee": 0,
        "full_price": 0
    }],
    "total_ticket_quantity": 1,
    "order_started": 1479763962,
    "expires": {
        "date": "2016-11-21 21:42:41.000000", "timezone_type": 3, "timezone": "UTC"
    },
    "reserved_tickets_id": 19,
    "order_total": 0,
    "booking_fee": 0,
    "organiser_booking_fee": 0,
    "total_booking_fee": 0,
    "order_requires_payment": false,
    "account_id": 11,
    "affiliate_referral": null,
    "account_payment_gateway": false,
    "payment_gateway": false,
    "request_data": [{
        "_token": "1QCadrIWXkuoO1TPJjaIZnXGzfDQoMqUJZ43htag",
        "event_id": "6",
        "order_first_name": "MOSTAFA",
        "order_last_name": "Attia",
        "order_email": "mostafa.elperrawy@gmail.com",
        "ticket_holder_first_name": [{
            "4": "MOSTAFA"
        }],
        "ticket_holder_last_name": [{
            "4": "Attia"
        }],
        "ticket_holder_email": [{
            "4": "mostafa.elperrawy@gmail.com"
        }],
        "is_embedded": ""
    }]
};


// this array is appended to the resulted response array from postValidateTickets
// It containing the ticket holder info, and passed to postCreateOrder method
var request_data = [{
    "_token": "RL8NqMTfSie00NgluhOkfi8DDdZb6hlkitME99AY",
    "event_id": "6",
    "order_first_name": "Nayef",
    "order_last_name": "ELBRAWY",
    "order_email": "freedom4soul@gmail.com",
    "ticket_holder_first_name": [{"4": "Nayef"}],
    "ticket_holder_last_name": [{"4": "ELBRAWY"}],
    "ticket_holder_email": [{"4": "freedom4soul@gmail.com"}],
    "is_embedded": ""
}];