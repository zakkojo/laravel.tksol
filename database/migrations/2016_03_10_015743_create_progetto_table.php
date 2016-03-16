<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProgettoTable extends Migration {

	public function up()
	{
		Schema::create('progetto', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('progetto_padre');
			$table->timestamps();
			$table->softDeletes();
			$table->string('area', 40);
			$table->string('nome', 50);
		});
	}

	public function down()
	{
		Schema::drop('progetto');
	}
}