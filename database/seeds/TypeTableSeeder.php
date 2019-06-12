<?php

use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            'uuid' => Str::uuid(4),
        ]);

        DB::table('submission_type')->insert([
            'type_id' => 1,
            'submission_id' => 1,
        ]);
    }
}
