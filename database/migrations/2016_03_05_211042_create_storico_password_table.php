<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoricoPasswordTable extends Migration {

	public function up()
	{
		Schema::create('storico_password', function(Blueprint $table) {
			$table->increments('id_password');
			$table->timestamps();
			$table->softDeletes();
			$table->string('password', 100);
			$table->date('data_inizio_validita');
			$table->enum('tipo_soggetto', array('contatto', 'consulente'));
			$table->integer('id_soggetto');
		});
	}

	public function down()
	{
		Schema::drop('storico_password');
	}
}