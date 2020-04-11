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
            'title' => 'To plasser, en bil',
        ]);

        DB::table('types')->insert([
            'uuid' => Str::uuid(4),
            'title' => 'Parkering/all stans forbudt',
        ]);

        DB::table('types')->insert([
            'uuid' => Str::uuid(4),
            'title' => 'For langt unna innkjørselen',
        ]);

        DB::table('types')->insert([
            'uuid' => Str::uuid(4),
            'title' => 'For nær/i innkjørsel',
        ]);

        DB::table('types')->insert([
            'uuid' => Str::uuid(4),
            'title' => 'Over de malte linjene',
        ]);

        DB::table('types')->insert([
            'uuid' => Str::uuid(4),
            'title' => 'Dobbeltparkering',
        ]);

        DB::table('types')->insert([
            'uuid' => Str::uuid(4),
            'title' => 'Parkert på handicap plass uten merke',
        ]);

        DB::table('types')->insert([
            'uuid' => Str::uuid(4),
            'title' => 'I sykkelfelt',
        ]);

        DB::table('types')->insert([
            'uuid' => Str::uuid(4),
            'title' => 'På fortauet',
        ]);

        DB::table('types')->insert([
            'uuid' => Str::uuid(4),
            'title' => 'Reservert ladestasjon for EL-kjøretøy',
        ]);

        DB::table('types')->insert([
            'uuid' => Str::uuid(4),
            'title' => 'Parkert på ladestasjon uten å lade',
        ]);

        DB::table('types')->insert([
            'uuid' => Str::uuid(4),
            'title' => 'Annet, se kommentar',
        ]);
    }
}
