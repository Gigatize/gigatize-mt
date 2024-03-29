<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 200);
			$table->string('icon_path', 200);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('categories');
	}
}