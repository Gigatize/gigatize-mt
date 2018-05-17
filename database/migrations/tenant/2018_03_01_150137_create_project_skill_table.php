<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectSkillTable extends Migration {

	public function up()
	{
		Schema::create('project_skill', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('project_id')->unsigned();
			$table->integer('skill_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('project_skill');
	}
}