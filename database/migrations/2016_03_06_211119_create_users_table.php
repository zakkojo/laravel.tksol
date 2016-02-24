<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->string('email')->unique();
			$table->string('password');
			$table->string('name');
			$table->tinyInteger('tipo_utente');
			$table->integer('id_esterno')->index();
			$table->tinyInteger('tipo_esterno');
			$table->timestamps();
			$table->softDeletes();
			$table->rememberToken('rememberToken');
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}