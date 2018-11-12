<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateListinoProgettoTable extends Migration
{

    public function up()
    {
        Schema::create('listinoProgetto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('progetto_id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('consulente_id');
            $table->integer('prodotto_id');
            $table->float('importo');
            $table->float('iva');
            $table->enum('tipo_iva', array('NORMALE', 'SPLIT'));
            $table->float('rimborsi');
            $table->float('fee');
            $table->integer('softwarehouse_id');
            $table->enum('tipo_vendita', array('LICENZA', 'NOLEGGIO'));
            $table->date('scadenza');
        });
    }

    public function down()
    {
        Schema::drop('listinoProgetto');
    }
}
