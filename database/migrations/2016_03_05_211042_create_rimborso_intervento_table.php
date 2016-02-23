<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRimborsoInterventoTable extends Migration {

	public function up()
	{
		Schema::create('rimborso_intervento', function(Blueprint $table) {
			$table->increments('id_rimborso_intervento');
			$table->timestamps();
			$table->softDeletes();
			$table->string('tipo_spesa', 50);
			$table->string('um', 10);
			$table->decimal('quantita');
			$table->decimal('importo');
			$table->string('note', 100);
			$table->integer('id_intervento');
			$table->integer('id_consulente');
		});
	}

	public function down()
	{
		Schema::drop('rimborso_intervento');
	}
}