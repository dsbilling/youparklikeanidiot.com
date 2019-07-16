<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        DB::table('users')->insert([
        	'uuid' => Str::uuid(4),
            'name' => $faker->name,
            'username' => $faker->userName,
            'email' => $faker->unique()->safeEmail,
            'password' => bcrypt('12345678'),
        ]);
    }
}
