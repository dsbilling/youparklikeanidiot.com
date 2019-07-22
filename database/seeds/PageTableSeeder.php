<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            'uuid' => Str::uuid(4),
            'title' => 'Test Page',
            'slug' => 'test-page',
            'content' => '<p>oihohyahyeee</p><p><br></p><p><br></p><h1>LOOOOL</h1><p><br></p>',
            'author_id' => 1,
            'editor_id' => 1,
        ]);
    }
}
