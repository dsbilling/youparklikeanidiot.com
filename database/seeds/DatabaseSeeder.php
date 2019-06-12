<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(LicensePlateTableSeeder::class);
        $this->call(SubmissionTableSeeder::class);
        $this->call(ImageTableSeeder::class);
        $this->call(TypeTableSeeder::class);
    }
}
