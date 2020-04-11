<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use DPSEI\LicensePlate;
use Faker\Generator as Faker;

$factory->define(LicensePlate::class, function (Faker $faker) {
    return [
        'uuid' => $faker->uuid,
        'country_code' => $faker->countryCode,
        'registration' => chr(rand(65, 90)).chr(rand(65, 90)).rand(10000, 99999),
    ];
});
