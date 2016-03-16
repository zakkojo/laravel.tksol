<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConsulenteTable extends Migration {

	public function up()
	{
		Schema::create('consulente', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('codice_fiscale', 16)->unique();
			$table->string('cognome', 50);
			$table->string('nome', 50);
			$table->string('indirizzo', 120);
			$table->string('citta', 50);
			$table->string('provincia', 10);
			$table->string('cap', 10);
			$table->string('telefono', 30);
			$table->string('telefono2', 30);
			$table->string('mobile', 30);
			$table->string('mobile2', 30);
			$table->string('mail', 100);
			$table->string('partita_iva', 11);
			$table->enum('tipo', array('Partner', 'Senior', 'Junior'));
		});
	}

	public function down()
	{
		Schema::drop('consulente');
	}

	public function interventi()
	{
		return $this->hasMany('consulente_intervento');
	}

}