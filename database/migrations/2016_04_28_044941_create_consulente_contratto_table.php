<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsulenteContrattoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consulente_contratto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contratto_id')->unsigned();
            $table->integer('consulente_id')->unsigned();
            $table->string('ruolo', 50);
            $table->text('note');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('consulente_contratto');
    }
}
