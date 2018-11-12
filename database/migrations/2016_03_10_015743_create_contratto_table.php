<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContrattoTable extends Migration
{

    public function up()
    {
        Schema::create('contratto', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('cliente_id')->unsigned();
            $table->integer('progetto_id')->unsigned();
            $table->enum('stato', array('CONTACT','PROSPECT','FALL','ACTIVE','CLOSED'));
            $table->text('note');
            $table->timestamp('data_primo_contatto');
            $table->timestamp('data_avvio_progetto')->nullable();
            $table->timestamp('data_chiusura_progetto')->nullable();
            $table->enum('modalita_fattura', array('CHIAVI_IN_MANO','TIME_CONSUMING'));
            $table->decimal('importo', 10, 2);
            $table->timestamp('data_validita_contratto')->nullable();
            $table->integer('periodicita_pagamenti');
            $table->integer('capo_progetto');
        });
    }

    public function down()
    {
        Schema::drop('contratto');
    }
}
