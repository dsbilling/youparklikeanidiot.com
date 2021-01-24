<?php

namespace Database\Seeders;

use DPSEI\Image;
use DPSEI\Submission;
use DPSEI\Type;
use DPSEI\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)->create()->each(function ($user) {
            $submissions = factory(Submission::class, 10)->create()->each(function ($submission) {
                $types = Type::all()->random(3);
                $submission->types()->attach($types);
                $images = factory(Image::class, 3)->create();
                $submission->images()->attach($images);
            });
            $user->submissions()->saveMany($submissions);
        });
    }
}
