<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use DPSEI\LicensePlate;
use DPSEI\Submission;
use Faker\Generator as Faker;

$factory->define(Submission::class, function (Faker $faker) {
    return [
        'uuid' => $faker->uuid,
        'longitude' => $faker->longitude,
        'latitude' => $faker->latitude,
        'parked_at' => $faker->dateTimeThisYear($max = 'now', $timezone = null),
        'created_at' => now(),
        'licenseplate_id' => function () {
            return factory(LicensePlate::class)->create();
        },
    ];
});
