<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrewSkillsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crew_skills', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('title');
			$table->string('slug');
			$table->string('icon');
			$table->string('label');

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
		Schema::drop('crew_skills');
	}

}
