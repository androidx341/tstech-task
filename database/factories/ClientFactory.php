<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    $gender = $faker->randomElement([Client::GENDER_MALE, Client::GENDER_FEMALE]);

    return [
        'firstName' => $faker->firstName($gender),
        'lastName' => $faker->lastName,
        'gender' => $gender,
        'birthDate' => $faker->dateTimeBetween('-60 years', '-18 years')
    ];
});
