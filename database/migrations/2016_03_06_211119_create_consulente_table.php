<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConsulenteTable extends Migration {

	public function up()
	{
		Schema::create('consulenti', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('codice_fiscale', 16)->unique();
			$table->string('cognome', 50);
			$table->string('nome', 4);
			$table->string('indirizzo', 120);
			$table->string('citta', 50);
			$table->string('cap', 4);
			$table->string('telefono', 30);
			$table->string('telefono2', 30);
			$table->string('mobile', 30);
			$table->string('mobile2', 30);
			$table->string('partita_iva');
			$table->enum('tipo', array('PARTNER', 'SENIOR', 'JUNIOR'));
		});
	}

	public function down()
	{
		Schema::drop('consulenti');
	}
}