<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectSponsorTable extends Migration {

	public function up()
	{
		Schema::create('project_sponsor', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('project_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->integer('points');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('project_sponsor');
	}
}