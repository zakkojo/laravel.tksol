<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConsulenteInterventoTable extends Migration {

	public function up()
	{
		Schema::create('consulenteIntervento', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('id_intervento')->unsigned();
			$table->integer('id_consulente')->unsigned();
			$table->boolean('fatturabile');
			$table->decimal('importo', 8,2);
		});
	}

	public function down()
	{
		Schema::drop('consulenteIntervento');
	}
}