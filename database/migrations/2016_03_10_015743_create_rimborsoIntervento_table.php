<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRimborsoInterventoTable extends Migration {

	public function up()
	{
		Schema::create('rimborsoIntervento', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('intervento_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();
			$table->string('tipo_spesa', 50);
			$table->string('um', 10);
			$table->decimal('quantita');
			$table->decimal('importo');
			$table->string('note', 100);
		});
	}

	public function down()
	{
		Schema::drop('rimborsoIntervento');
	}
}