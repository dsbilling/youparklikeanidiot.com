<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeatReservationStatusesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seat_reservation_statuses', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('name');
			$table->string('slug');

			$table->integer('reservation_id')->default(0);

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
		Schema::drop('seat_reservation_statuses');
	}

}
