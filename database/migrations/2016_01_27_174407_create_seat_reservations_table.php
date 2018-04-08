<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeatReservationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seat_reservations', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('seat_id')->default(0);
			$table->integer('reservedby_id')->default(0);
			$table->integer('reservedfor_id')->default(0);
			$table->integer('payment_id')->default(0);
			$table->integer('ticket_id')->default(0);
			$table->integer('status_id')->default(0);

			$table->integer('year')->default(1970);

			$table->integer('reminder_email_sent')->default(0);

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
		Schema::drop('seat_reservations');
	}

}
