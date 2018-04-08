<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSeatRows extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seat_rows', function(Blueprint $table)
        {

            $table->integer('author_id')->default(1)->after('slug'); //who created it?
            $table->integer('editor_id')->default(1)->after('author_id'); //who updated it?

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
