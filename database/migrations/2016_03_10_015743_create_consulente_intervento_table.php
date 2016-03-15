<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConsulenteInterventoTable extends Migration {

	public function up()
	{
		Schema::create('consulente_intervento', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('intervento_id')->unsigned();
			$table->integer('consulente_id')->unsigned();
			$table->boolean('fatturabile');
			$table->decimal('importo', 8,2);
		});
	}

	public function down()
	{
		Schema::drop('consulente_intervento');
	}
}