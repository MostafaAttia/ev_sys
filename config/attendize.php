<?php

return [

    'version' => file_get_contents(base_path('VERSION')),

    'ticket_status_sold_out'        => 1,
    'ticket_status_after_sale_date' => 2,//
    'enable_test_payments'          => env('ENABLE_TEST_PAYMENTS', false),

    'payment_gateway_stripe'   => 1,
    'payment_gateway_paypal'   => 2,
    'payment_gateway_coinbase' => 3,
	'payment_gateway_migs'     => 4,

    'outgoing_email_noreply' => env('MAIL_FROM_ADDRESS'),
    'outgoing_email'         => env('MAIL_FROM_ADDRESS'),
    'outgoing_email_name'    => env('MAIL_FROM_NAME'),
    'incoming_email'         => env('MAIL_FROM_ADDRESS'),

    'app_name'               => 'Vitee',
    'event_default_bg_color' => '#B23333',
    'event_default_bg_image' => 'assets/images/public/EventPage/backgrounds/5.jpg',
    'event_default_image'    => 'user_content/defaults/default-event.jpg',

    's3_base_url'               => 'https://s3.amazonaws.com/cdn.vt17.dev',
    's3_event_defaults'         => '/defaults/events/',
    's3_event_images_original'  => '/event_images/original/',
    's3_event_images_200_200'   => '/event_images/200*200/',
    's3_event_images_300_300'   => '/event_images/300*300/',
    's3_event_images_300_400'   => '/event_images/300*400/',
    's3_event_images_450_600'   => '/event_images/450*600/',
    's3_event_images_400_720'   => '/event_images/400*720/',
    's3_event_images_600_1080'  => '/event_images/600*1080/',


    's3_client_defaults'        => '/defaults/users/',
    's3_client_original'        => '/user_content/original/',
    's3_client_60_60'           => '/user_content/60*60/',
    's3_client_120_120'         => '/user_content/120*120/',
    's3_client_240_240'         => '/user_content/240*240/',

    's3_organiser_defaults'        => '/defaults/organizer/',
    's3_organiser_original'        => '/organizer/original/',
    's3_organiser_60_60'           => '/organizer/60*60/',
    's3_organiser_120_120'         => '/organizer/120*120/',
    's3_organiser_240_240'         => '/organizer/240*240/',

    'event_images_path'      => 'user_content/event_images',
    'organiser_images_path'  => 'user_content/organiser_images',
    'event_pdf_tickets_path' => 'user_content/pdf_tickets',
    'event_bg_images'        => 'assets/images/public/EventPage/backgrounds',

    'fallback_organiser_logo_url' => '/assets/images/logo-dark.png',
    'cdn_url'                     => '',

    'checkout_timeout_after' => env('CHECKOUT_TIMEOUT_AFTER', 10), #minutes

    'ticket_status_before_sale_date' => 3,
    'ticket_status_on_sale'          => 4,
    'ticket_status_off_sale'         => 5,

    'ticket_booking_fee_fixed'      => 0,
    'ticket_booking_fee_percentage' => 0,

    /* Order statuses */
    'order_complete'                => 1,
    'order_refunded'                => 2,
    'order_partially_refunded'      => 3,
    'order_cancelled'               => 4,
    'order_awaiting_payment'        => 5,

    /* Attendee question types */
    'question_textbox_single'       => 1,
    'question_textbox_multi'        => 2,
    'question_dropdown_single'      => 3,
    'question_dropdown_multi'       => 4,
    'question_checkbox_multi'       => 5,
    'question_radio_single'         => 6,


    'default_timezone'           => 30, #Europe/Dublin
    'default_currency'           => 2, #Euro
    'default_date_format'        => 'j M, Y',
    'default_date_picker_format' => 'd M, yyyy',
    'default_datetime_format'    => 'F j, Y, g:i a',
    'default_query_cache'        => 120, #Minutes
    'default_locale'             => 'en',
    'default_payment_gateway'    => 1, #Stripe=1 Paypal=2 BitPay=3 MIGS=4

    'cdn_url_user_assets'   => '',
    'cdn_url_static_assets' => ''
];
