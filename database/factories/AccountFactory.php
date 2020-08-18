<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Account;
use Faker\Generator as Faker;

$factory->define(Account::class, function (Faker $faker) {
    return [
        'country_id'        => 1,
        'currency_id'       => 1,
        'bank_name'         => $faker->company,
        'bank_account'      => $faker->uuid,
        'account_name'      => $faker->name,
        'code'              => $faker->swiftBicNumber,
        'description'       => $faker->sentence($nbWords = 6, $variableNbWords = true) 
    ];
});
