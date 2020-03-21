<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use DPSEI\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    return [
        'uuid' => $faker->uuid,
        'path' => '/image/submissions/parkering' . $faker->randomDigitNot(0) . '.jpg',
    ];
});
