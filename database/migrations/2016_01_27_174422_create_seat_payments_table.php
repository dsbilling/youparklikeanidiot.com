<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeatPaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seat_payments', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('stripecharge')->nullable();

			$table->integer('user_id')->default(0);
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
		Schema::drop('seat_payments');
	}

}
