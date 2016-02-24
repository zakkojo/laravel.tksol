<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClienteProgettoTable extends Migration {

	public function up()
	{
		Schema::create('cliente_progetto', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id_cliente')->unsigned();
			$table->integer('id_progetto')->unsigned();
			$table->enum('stato', array('CONTACT', 'PROSPECT', 'FALL', 'ACTIVE', 'CLOSED'));
			$table->string('note', 500);
			$table->date('data_primo_contatto');
			$table->date('data_avvio_progetto');
			$table->date('data_chiusura_progetto');
			$table->enum('modalita_fattura', array('CHIAVI_IN_MANO;TIME_CONSUMING'));
			$table->float('importo');
			$table->date('data_validita_contratto');
			$table->integer('periodicita_pagamenti');
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('cliente_progetto');
	}
}