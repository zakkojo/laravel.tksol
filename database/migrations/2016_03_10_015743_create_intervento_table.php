<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInterventoTable extends Migration {

	public function up()
	{
		Schema::create('intervento', function(Blueprint $table) {
			$table->increments('id');
			$table->softDeletes();
			$table->enum('stato', array('TEMPLATE', 'PIANIFICATO', 'CONSUNTIVO'));
			$table->date('data_intervento');
			$table->boolean('fatturabile');
			$table->text('relazione');
			$table->text('note');
			$table->integer('cliente_id')->unsigned();
			$table->integer('progetto_id')->unsigned();
			$table->integer('attivita_id')->unsigned();
			$table->integer('tipoIntervento_id');
			$table->enum('tipo_consulente', array('SENIOR', 'JUNIOR'));
		});
	}

	public function down()
	{
		Schema::drop('intervento');
	}
}