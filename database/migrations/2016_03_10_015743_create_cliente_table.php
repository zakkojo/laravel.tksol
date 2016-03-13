<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClienteTable extends Migration {

	public function up()
	{
		Schema::create('cliente', function(Blueprint $table) {
			$table->increments('id');
			$table->string('codice_fiscale', 16)->unique();
			$table->string('partita_iva', 11)->unique();
			$table->timestamps();
			$table->softDeletes();
			$table->string('ragione_sociale', 100);
			$table->integer('rating');
			$table->boolean('cliente');
			$table->string('settore', 50);
			$table->boolean('softwarehouse');
			$table->string('indirizzo', 150);
			$table->string('citta', 50);
			$table->string('cap', 10);
			$table->string('provincia', 10);
			$table->string('telefono', 50);

		});
	}

	public function down()
	{
		Schema::drop('cliente');
	}
}