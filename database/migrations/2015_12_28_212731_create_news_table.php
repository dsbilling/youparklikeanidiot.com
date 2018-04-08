<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('news', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('title');
			$table->string('slug');
			$table->longText('content');

			$table->integer('category_id')->default(0);

			$table->integer('author_id')->default(0); //who created it?
			$table->integer('editor_id')->default(0); //who updated it?
			$table->boolean('active')->default(1); //is it visible on the website?
			
			$table->dateTime('published_at')->nullable();
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
		Schema::drop('news');
	}

}
