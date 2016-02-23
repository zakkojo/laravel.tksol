<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClienteTable extends Migration {

	public function up()
	{
		Schema::create('cliente', function(Blueprint $table) {
			$table->increments('id_cliente');
			$table->string('codice_fiscale', 16)->unique();
			$table->string('partita_iva', 11)->unique();
			$table->timestamps();
			$table->softDeletes();
			$table->string('ragione_sociale', 100);
			$table->integer('rating');
			$table->boolean('cliente');
			$table->string('settore', 20);
			$table->boolean('softwarehouse');
		});
	}

	public function down()
	{
		Schema::drop('cliente');
	}
}