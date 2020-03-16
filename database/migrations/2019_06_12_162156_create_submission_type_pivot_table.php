<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionTypePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submission_type', function (Blueprint $table) {
            $table->unsignedBigInteger('submission_id')->index();
            $table->foreign('submission_id')->references('id')->on('submissions')->onDelete('cascade');
            $table->unsignedBigInteger('type_id')->index();
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
            $table->primary(['submission_id', 'type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('submission_type');
    }
}
