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
			$table->string('stato',50)->default('Pianificato');
			$table->timestamp('data_start');
			$table->timestamp('data_end');
            $table->timestamp('data_start_reale');
            $table->timestamp('data_end_reale');
			$table->boolean('fatturabile');
            $table->boolean('stampa')->default(0);
			$table->text('note');
			$table->text('attivitaPianificate');
			$table->text('attivitaSvolte');
			$table->text('attivitaCaricoCliente');
			$table->text('problemiAperti');
		});
	}

	public function down()
	{
		Schema::drop('intervento');
	}
}