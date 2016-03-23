<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContrattoTable extends Migration {

    public function up()
    {
        Schema::create('contratto', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('cliente_id')->unsigned();
            $table->integer('progetto_id')->unsigned();
            $table->enum('stato', array('CONTACT','PROSPECT','FALL','ACTIVE','CLOSED'));
            $table->text('note', 80);
            $table->date('data_primo_contatto');
            $table->date('data_avvio_contatto');
            $table->date('data_chiusura_contatto');
            $table->enum('modalita_fattura', array('CHIAVI_IN_MANO','TIME_CONSUMING'));
            $table->decimal('importo',10,2);
            $table->date('data_validita_contratto');
            $table->integer('periodicit_pagamenti');
            $table->integer('capo_progetto');
        });
    }

    public function down()
    {
        Schema::drop('contratto');
    }
}