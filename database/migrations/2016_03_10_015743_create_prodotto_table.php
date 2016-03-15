<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProdottoTable extends Migration {

	public function up()
	{
		Schema::create('prodotto', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('area', 40);
			$table->string('nome', 50);
			$table->integer('progetto_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('prodotto');
	}
}