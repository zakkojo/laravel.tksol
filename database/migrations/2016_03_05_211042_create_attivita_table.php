<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttivitaTable extends Migration {

	public function up()
	{
		Schema::create('attivita', function(Blueprint $table) {
			$table->increments('id_attivita');
			$table->integer('id_progetto')->unsigned();
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