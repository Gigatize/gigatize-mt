<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSkillsTable extends Migration {

	public function up()
	{
		Schema::create('skills', function(Blueprint $table) {
			$table->increments('id');
            $table->string('name', 100)->unique();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('skills');
	}
}