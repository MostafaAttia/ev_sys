<?php

use App\Models\Event;
use App\Models\EventImage;
use Faker\Generator as Faker;

$factory->define(EventImage::class, function (Faker $faker) {

    return [
        'image_path'                        => 'event_image_0f94924227fdae9f2c47d05e27077369.jpg',
        'account_id'                        => 1,
        'user_id'                           => 1,
        'created_at'                        => $faker->dateTime(),
        'updated_at'                        => $faker->dateTime(),
    ];
});
