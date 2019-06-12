<?php

use Illuminate\Database\Seeder;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
            'uuid' => Str::uuid(4),
            'path' => '/image/parking/parkering.jpg',
        ]);
        DB::table('images')->insert([
            'uuid' => Str::uuid(4),
            'path' => '/image/parking/parkering2.jpg',
        ]);
        DB::table('image_submission')->insert([
            'image_id' => 1,
            'submission_id' => 1,
        ]);
        DB::table('image_submission')->insert([
            'image_id' => 2,
            'submission_id' => 1,
        ]);
    }
}
