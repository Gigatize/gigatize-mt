<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectUserTable extends Migration {

	public function up()
	{
		Schema::create('project_user', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('project_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('project_user');
	}
}