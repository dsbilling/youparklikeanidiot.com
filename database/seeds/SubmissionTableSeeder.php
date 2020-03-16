<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubmissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('submissions')->insert([
        	'uuid' => Str::uuid(4),
            'longitude' => 10.2989,
            'latitude' => 59.4863,
            'license_plate_id' => 1,
            'user_id' => 1,
            'parked_at' => \Carbon\Carbon::now()->addDays(-5),
            'created_at' => \Carbon\Carbon::now(),
        ]);
    }
}
