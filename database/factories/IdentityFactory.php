<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Identity;
use Faker\Generator as Faker;

$factory->define(Identity::class, function (Faker $faker) {
    $verified = $faker->numberBetween($min=0, $max=1);
    return [
        'country_id'        => $faker->numberBetween($min = 1, $max = 156),
        'nationality'       => $faker->word,
        'first_name'        => $faker->firstName,
        'middle_name'       => null,
        'last_name'         => $faker->lastname,
        'second_surname'    => null,
        'dni_number'        => $faker->ean8,
        'validation_number' => $faker->ean8,
        'expiration_date'   => $faker->date($format = 'Y-m-d', $min = 'tomorrow'),
        'issue_date'        => $faker->date($format = 'Y-m-d', $max = 'now'),
        'dob'               => $faker->date($format = 'Y-m-d', $max = '-18 years'),
        'document_type'     => $faker->randomElement($array = array ('dni','passport','drive_license')),
        'gender'            => $faker->randomElement($array = array ('F','M','Unknown')),
        'verified_at'       => $verified ? $faker->dateTime($max = now()) : null,
        'front_image_url'   => $faker->imageUrl($width = 640, $height = 480),
        'reverse_image_url' => $faker->imageUrl($width = 640, $height = 480),
        'user_id'           => 1,
    ];
});
