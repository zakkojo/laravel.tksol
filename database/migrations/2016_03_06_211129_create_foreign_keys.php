<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('consulenteIntervento', function(Blueprint $table) {
			$table->foreign('id_consulente')->references('id')->on('consulenti')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('consulenteIntervento', function(Blueprint $table) {
			$table->dropForeign('consulenteIntervento_id_consulente_foreign');
		});
	}
}