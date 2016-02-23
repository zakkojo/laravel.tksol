<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('contatto', function(Blueprint $table) {
			$table->foreign('id_cliente')->references('id_cliente')->on('cliente')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('prodotto', function(Blueprint $table) {
			$table->foreign('id_progetto')->references('id_progetto')->on('progetto')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('attivita', function(Blueprint $table) {
			$table->foreign('id_progetto')->references('id_progetto')->on('progetto')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('progetto_cliente', function(Blueprint $table) {
			$table->foreign('id_cliente')->references('id_cliente')->on('cliente')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('progetto_cliente', function(Blueprint $table) {
			$table->foreign('id_progetto')->references('id_progetto')->on('progetto')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('intervento', function(Blueprint $table) {
			$table->foreign('id_cliente')->references('id_cliente')->on('progetto_cliente')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('intervento', function(Blueprint $table) {
			$table->foreign('id_progetto')->references('id_progetto')->on('progetto_cliente')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('intervento', function(Blueprint $table) {
			$table->foreign('id_attivita')->references('id_attivita')->on('attivita')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('consulente_intervento', function(Blueprint $table) {
			$table->foreign('id_intervento')->references('id_intervento')->on('intervento')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('consulente_intervento', function(Blueprint $table) {
			$table->foreign('id_consulente')->references('id_consulente')->on('consulente')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('contatto', function(Blueprint $table) {
			$table->dropForeign('contatto_id_cliente_foreign');
		});
		Schema::table('prodotto', function(Blueprint $table) {
			$table->dropForeign('prodotto_id_progetto_foreign');
		});
		Schema::table('attivita', function(Blueprint $table) {
			$table->dropForeign('attivita_id_progetto_foreign');
		});
		Schema::table('progetto_cliente', function(Blueprint $table) {
			$table->dropForeign('progetto_cliente_id_cliente_foreign');
		});
		Schema::table('progetto_cliente', function(Blueprint $table) {
			$table->dropForeign('progetto_cliente_id_progetto_foreign');
		});
		Schema::table('intervento', function(Blueprint $table) {
			$table->dropForeign('intervento_id_cliente_foreign');
		});
		Schema::table('intervento', function(Blueprint $table) {
			$table->dropForeign('intervento_id_progetto_foreign');
		});
		Schema::table('intervento', function(Blueprint $table) {
			$table->dropForeign('intervento_id_attivita_foreign');
		});
		Schema::table('consulente_intervento', function(Blueprint $table) {
			$table->dropForeign('consulente_intervento_id_intervento_foreign');
		});
		Schema::table('consulente_intervento', function(Blueprint $table) {
			$table->dropForeign('consulente_intervento_id_consulente_foreign');
		});
	}
}