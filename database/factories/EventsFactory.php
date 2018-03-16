<?php

use App\Models\Event;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {

    return [

        'title'                             => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'description'                       => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'start_date'                        => '2018-09-22 00:02:00',
        'end_date'                          => '2018-09-22 00:05:00',
        'account_id'                        => 1,
        'user_id'                           => 1,
        'currency_id'                       => 2,
        'organiser_id'                      => 1,
        'venue_name'                        => 'Bahrain International Exhibition & Convention Centre',
        'venue_name_full'                   => 'Bahrain International Exhibition & Convention Centre, Avenue 28, Sanabis, Bahrain',
        'location_address'                  => '158 Avenue 28, Sanabis 11644, Bahrain',
        'location_address_line_1'           => 'Avenue 28',
        'location_address_line_2'           => 'Sanabis',
        'location_country'                  => 'Bahrain',
        'location_country_code'             => 'BH',
        'location_state'                    => 'Capital Governorate',
        'location_post_code'                => '11644',
        'location_street_number'            => '158',
        'location_lat'                      => '26.229856',
        'location_long'                     => '50.54240400000003',
        'location_google_place_id'          => 'ChIJXYcKiGSlST4R197qYU8OzT4',
        'is_live'                           => 1,
        'created_at'                        => $faker->dateTime(),
        'updated_at'                        => $faker->dateTime(),
        'category_id'                       => 3,
        'is_activity'                       => 0,

    ];

});
