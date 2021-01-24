<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'path' => '/image/submissions/parkering.jpg',
        ]);
        DB::table('images')->insert([
            'uuid' => Str::uuid(4),
            'path' => '/image/submissions/parkering2.jpg',
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
