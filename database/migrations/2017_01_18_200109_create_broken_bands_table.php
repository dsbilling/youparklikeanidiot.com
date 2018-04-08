<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrokenBandsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('broken_bands', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('checkin_id')->default(0);
			$table->integer('previous_bandnumber')->default(0);
			$table->integer('new_bandnumber')->default(0);
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
		Schema::drop('broken_bands');
	}

}
