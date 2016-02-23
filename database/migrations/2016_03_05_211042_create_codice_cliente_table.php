<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCodiceClienteTable extends Migration {

	public function up()
	{
		Schema::create('codice_cliente', function(Blueprint $table) {
			$table->increments('id_codice_cliente');
			$table->timestamps();
			$table->softDeletes();
			$table->string('codice', 30);
			$table->string('tipo_codice', 40);
		});
	}

	public function down()
	{
		Schema::drop('codice_cliente');
	}
}