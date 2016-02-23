<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInterventoTable extends Migration {

	public function up()
	{
		Schema::create('intervento', function(Blueprint $table) {
			$table->increments('id_intervento');
			$table->softDeletes();
			$table->enum('stato', array('TEMPLATE', 'PIANIFICATO', 'CONSUNTIVO'));
			$table->date('data_intervento');
			$table->boolean('fatturabile');
			$table->text('relazione');
			$table->text('note');
			$table->integer('id_cliente')->unsigned();
			$table->integer('id_progetto')->unsigned();
			$table->integer('id_attivita')->unsigned();
			$table->integer('id_tipo_intervento');
			$table->enum('tipo_consulente', array('SENIOR', 'JUNIOR'));
		});
	}

	public function down()
	{
		Schema::drop('intervento');
	}
}