<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeatTicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seat_tickets', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('barcode');

			$table->integer('reservation_id')->default(0);
			$table->integer('user_id')->default(0);
			$table->integer('checkin_id')->default(0);
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
		Schema::drop('seat_tickets');
	}

}
