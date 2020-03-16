<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');

            $table->decimal('latitude', 9, 6);
            $table->decimal('longitude', 9, 6);
            $table->longText('description')->nullable();

            $table->integer('license_plate_id')->nullable();
            $table->integer('user_id')->nullable();

            $table->dateTime('parked_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submissions');
    }
}
