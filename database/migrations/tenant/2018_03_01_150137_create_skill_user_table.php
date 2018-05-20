<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSkillUserTable extends Migration {

	public function up()
	{
		Schema::create('skill_user', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('skill_id')->unsigned();
			$table->integer('user_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('skill_user');
	}
}