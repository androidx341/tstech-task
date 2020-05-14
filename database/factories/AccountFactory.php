<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Account;
use Faker\Generator as Faker;

$factory->define(Account::class, function (Faker $faker) {
    return [
        'depositRate' => $faker->randomFloat(2, 1, 12),
        'value' => $faker->randomFloat(2, 0, 15000),
        'createDate' => $faker->dateTimeBetween('-1 month')
    ];
});
