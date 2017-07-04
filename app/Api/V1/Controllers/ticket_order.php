<?php

$ticket_order = array(

    'validation_rules' =>
        array(
            'ticket_holder_first_name.0.4' =>
                array(
                    0 => 'required',
                ),
            'ticket_holder_last_name.0.4' =>
                array(
                    0 => 'required',
                ),
            'ticket_holder_email.0.4' =>
                array(
                    0 => 'required',
                    1 => 'email',
                ),
        ),
    'validation_messages' =>
        array(
            'ticket_holder_first_name.0.4.required' => 'Ticket holder 1\'s first name is required',
            'ticket_holder_last_name.0.4.required' => 'Ticket holder 1\'s last name is required',
            'ticket_holder_email.0.4.required' => 'Ticket holder 1\'s email is required',
            'ticket_holder_email.0.4.email' => 'Ticket holder 1\'s email appears to be invalid',
        ),
    'event_id' => 6,
    'tickets' =>
        array(
            0 =>
                array(
                    'ticket' =>
                        App\Models\Ticket::__set_state(array(
                            'rules' =>
                                array(
                                    'title' =>
                                        array(
                                            0 => 'required',
                                        ),
                                    'price' =>
                                        array(
                                            0 => 'required',
                                            1 => 'numeric',
                                            2 => 'min:0',
                                        ),
                                    'start_sale_date' =>
                                        array(
                                            0 => 'date',
                                        ),
                                    'end_sale_date' =>
                                        array(
                                            0 => 'date',
                                            1 => 'after:start_sale_date',
                                        ),
                                    'quantity_available' =>
                                        array(
                                            0 => 'integer',
                                            1 => 'min:0',
                                        ),
                                ),
                            'messages' =>
                                array(
                                    'price.numeric' => 'The price must be a valid number (e.g 12.50)',
                                    'title.required' => 'You must at least give a title for your ticket. (e.g Early Bird)',
                                    'quantity_available.integer' => 'Please ensure the quantity available is a number.',
                                ),
                            'perPage' => 10,
                            'timestamps' => true,
                            'softDelete' => true,
                            'errors' => NULL,
                            'connection' => NULL,
                            'table' => NULL,
                            'primaryKey' => 'id',
                            'keyType' => 'int',
                            'incrementing' => true,
                            'attributes' =>
                                array(
                                    'id' => 4,
                                    'created_at' => '2016-11-15 12:52:37',
                                    'updated_at' => '2016-11-21 20:32:32',
                                    'deleted_at' => NULL,
                                    'edited_by_user_id' => NULL,
                                    'account_id' => 11,
                                    'order_id' => NULL,
                                    'event_id' => 6,
                                    'title' => 'General Admission',
                                    'description' => '',
                                    'price' => '0.00',
                                    'max_per_person' => 30,
                                    'min_per_person' => 1,
                                    'quantity_available' => NULL,
                                    'quantity_sold' => 9,
                                    'start_sale_date' => '2016-11-17 15:52:00',
                                    'end_sale_date' => '2016-12-20 15:52:00',
                                    'sales_volume' => '0.00',
                                    'organiser_fees_volume' => '0.00',
                                    'is_paused' => 0,
                                    'public_id' => NULL,
                                    'user_id' => 12,
                                    'sort_order' => 0,
                                    'is_hidden' => 0,
                                ),
                            'original' =>
                                array(
                                    'id' => 4,
                                    'created_at' => '2016-11-15 12:52:37',
                                    'updated_at' => '2016-11-21 20:32:32',
                                    'deleted_at' => NULL,
                                    'edited_by_user_id' => NULL,
                                    'account_id' => 11,
                                    'order_id' => NULL,
                                    'event_id' => 6,
                                    'title' => 'General Admission',
                                    'description' => '',
                                    'price' => '0.00',
                                    'max_per_person' => 30,
                                    'min_per_person' => 1,
                                    'quantity_available' => NULL,
                                    'quantity_sold' => 9,
                                    'start_sale_date' => '2016-11-17 15:52:00',
                                    'end_sale_date' => '2016-12-20 15:52:00',
                                    'sales_volume' => '0.00',
                                    'organiser_fees_volume' => '0.00',
                                    'is_paused' => 0,
                                    'public_id' => NULL,
                                    'user_id' => 12,
                                    'sort_order' => 0,
                                    'is_hidden' => 0,
                                ),
                            'relations' =>
                                array(
                                    'questions' =>
                                        Illuminate\Database\Eloquent\Collection::__set_state(array(
                                            'items' =>
                                                array(),
                                        )),
                                ),
                            'hidden' =>
                                array(),
                            'visible' =>
                                array(),
                            'appends' =>
                                array(),
                            'fillable' =>
                                array(),
                            'guarded' =>
                                array(
                                    0 => '*',
                                ),
                            'dates' =>
                                array(),
                            'dateFormat' => NULL,
                            'casts' =>
                                array(),
                            'touches' =>
                                array(),
                            'observables' =>
                                array(),
                            'with' =>
                                array(),
                            'morphClass' => NULL,
                            'exists' => true,
                            'wasRecentlyCreated' => false,
                            'forceDeleting' => false,
                        )),
                    'qty' => 1,
                    'price' => 0.0,
                    'booking_fee' => 0,
                    'organiser_booking_fee' => 0,
                    'full_price' => 0.0,
                ),
        ),
    'total_ticket_quantity' => 1,
    'order_started' => 1479760916,
    'expires' =>
        Carbon\Carbon::__set_state(array(
            'date' => '2016-11-21 20:51:55.000000',
            'timezone_type' => 3,
            'timezone' => 'UTC',
        )),
    'reserved_tickets_id' => 18,
    'order_total' => 0.0,
    'booking_fee' => 0,
    'organiser_booking_fee' => 0,
    'total_booking_fee' => 0,
    'order_requires_payment' => false,
    'account_id' => 11,
    'affiliate_referral' => NULL,
    'account_payment_gateway' => false,
    'payment_gateway' => false,
    'request_data' =>
        array(
            0 =>
                array(
                    '_token' => '1QCadrIWXkuoO1TPJjaIZnXGzfDQoMqUJZ43htag',
                    'event_id' => '6',
                    'order_first_name' => 'MOSTAFA',
                    'order_last_name' => 'ELBRAWY',
                    'order_email' => 'freedom4soul@gmail.com',
                    'ticket_holder_first_name' =>
                        array(
                            0 =>
                                array(
                                    4 => 'MOSTAFA',
                                ),
                        ),
                    'ticket_holder_last_name' =>
                        array(
                            0 =>
                                array(
                                    4 => 'ELBRAWY',
                                ),
                        ),
                    'ticket_holder_email' =>
                        array(
                            0 =>
                                array(
                                    4 => 'freedom4soul@gmail.com',
                                ),
                        ),
                    'is_embedded' => '',
                ),
        ),
);


$request_data = array (

      0 => array (
              '_token' => 'RL8NqMTfSie00NgluhOkfi8DDdZb6hlkitME99AY',
              'event_id' => '6',
              'order_first_name' => 'Nayef',
              'order_last_name' => 'ELBRAWY',
              'order_email' => 'freedom4soul@gmail.com',
              'ticket_holder_first_name' =>
                  array (
                      0 =>
                          array (
                              4 => 'Nayef',
                          ),
                  ),
              'ticket_holder_last_name' =>
                  array (
                      0 =>
                          array (
                              4 => 'ELBRAWY',
                          ),
                  ),
              'ticket_holder_email' =>
                  array (
                      0 =>
                          array (
                              4 => 'freedom4soul@gmail.com',
                          ),
                  ),
              'is_embedded' => '',
          ),
  );