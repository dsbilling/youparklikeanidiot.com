<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsors', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('name');
            $table->string('url')->nullable();
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('year')->default(1970);

            $table->integer('author_id')->default(0); //who created it?
            $table->integer('editor_id')->default(0); //who updated it?

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sponsors');
    }
}
