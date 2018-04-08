<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckinsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('checkins', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('ticket_id')->default(0);
			$table->integer('bandnumber')->default(0);
			$table->integer('year')->default(1970);

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
		Schema::drop('checkins');
	}

}
