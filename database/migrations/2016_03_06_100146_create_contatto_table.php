<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContattoTable extends Migration {

	public function up()
	{
		Schema::create('contatto', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('id_cliente')->unsigned();
			$table->string('descrizione', 80);
			$table->string('telefono', 30);
			$table->string('telefono2', 40);
			$table->string('mobile', 40);
			$table->string('mobile2', 40);
			$table->string('email', 120);
			$table->string('email2', 120);
			$table->string('indirizzo', 150);
			$table->string('citta', 50);
			$table->string('cap', 5);
			$table->string('provincia', 2);
		});
	}

	public function down()
	{
		Schema::drop('contatto');
	}
}