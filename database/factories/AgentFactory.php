<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Agent;
use Faker\Generator as Faker;

$factory->define(Agent::class, function (Faker $faker) {
    return [
        'r_legal_name'      => $faker->name,
        'r_legal_last_name' => $faker->lastname,
        'r_nationality'     => $faker->country,
        'r_birthday'        => $faker->date($format = 'Y-m-d', $max = '-18Years'),
        'r_pais_residencia' => $faker->country,
        'r_rut'             => $faker->ean8,
        'r_serie'           => $faker->ean8,
        'r_telefono'        => $faker->phoneNumber,

        'e_name'            => $faker->company,
        'e_fantasy'         => $faker->company,
        'e_rut'             => $faker->ean8,
        'e_address'         => $faker->address,
        'e_country'         => $faker->country,
        'e_zip'             => $faker->postcode,
    ];
});
