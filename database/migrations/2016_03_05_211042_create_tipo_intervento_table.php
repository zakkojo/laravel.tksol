<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipoInterventoTable extends Migration {

	public function up()
	{
		Schema::create('tipo_intervento', function(Blueprint $table) {
			$table->increments('id_tipo_intervento');
			$table->timestamps();
			$table->softDeletes();
			$table->string('descrizione', 40);
		});
	}

	public function down()
	{
		Schema::drop('tipo_intervento');
	}
}