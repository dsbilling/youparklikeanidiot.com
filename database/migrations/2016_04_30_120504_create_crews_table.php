<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crew', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('user_id')->default(0);
			$table->integer('category_id')->default(0);
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
		Schema::drop('crew');
	}

}
