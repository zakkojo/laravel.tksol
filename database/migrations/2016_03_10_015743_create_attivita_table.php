<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttivitaTable extends Migration {

	public function up()
	{
		Schema::create('attivita', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('progetto_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('sequenza');
			$table->string('descrizione', 100);
		});
	}

	public function down()
	{
		Schema::drop('attivita');
	}
}