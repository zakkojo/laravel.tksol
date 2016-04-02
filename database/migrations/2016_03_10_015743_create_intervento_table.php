<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInterventoTable extends Migration {

	public function up()
	{
		Schema::create('intervento', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('listino_id')->unsigned();
			$table->integer('attivita_id')->unsigned();
			$table->integer('consulente_id')->unsigned();
			$table->softDeletes();
			$table->enum('stato', array('TEMPLATE', 'PIANIFICATO', 'CONSUNTIVO'));
			$table->timestamp('data_intervento');
			$table->boolean('fatturabile');
			$table->text('attivitaSvolte');
			$table->text('note');

			$table->text('attivitaPianificate');
			$table->text('attivitaCaricoCliente');
			$table->text('problemiAperti');
		});
	}

	public function down()
	{
		Schema::drop('intervento');
	}
}