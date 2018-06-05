<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsTable extends Migration {

	public function up()
	{
		Schema::create('projects', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 200);
			$table->string('slug', 200);
			$table->integer('user_id')->unsigned();
			$table->integer('category_id')->unsigned();
			$table->text('description');
			$table->date('start_date');
			$table->date('deadline');
			$table->integer('location_id')->unsigned();
			$table->string('timezone', 200)->nullable();
			$table->string('impact', 550);
			$table->integer('max_users');
			$table->integer('estimated_hours');
			$table->string('resources_link', 200)->nullable();
			$table->string('additional_info', 550)->nullable();
			$table->boolean('on_site')->default(0);
			$table->boolean('renew')->default(0);
			$table->boolean('flexible_start')->default(0);
			$table->string('status',50)->default('Not Started');
			$table->boolean('started')->default(0);
			$table->boolean('complete')->default(0);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('projects');
	}
}