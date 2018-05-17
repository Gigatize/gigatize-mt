<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcceptanceCriteriaTable extends Migration {

	public function up()
	{
		Schema::create('acceptance_criteria', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('project_id')->unsigned();
			$table->string('criteria', 500);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('acceptance_criteria');
	}
}