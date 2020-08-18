<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'address'       => $faker->streetAddress,
        'address_ext'   => $faker->secondaryAddress,
        'country_id'    => $faker->numberBetween($min = 1, $max = 156),
        'state'         => $faker->state,
        'city'          => $faker->city,
        'cod'           => $faker->postcode,
        'verified_at'   => null,
        'image_url'     => $faker->imageUrl($width = 640, $height = 480),
        'user_id'       => 1,
    ];
});
