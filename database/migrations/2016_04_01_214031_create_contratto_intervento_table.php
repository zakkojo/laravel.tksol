<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContrattoInterventoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrattoIntervento', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('contratto_id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('descrizione', 40);
            $table->float('tariffa_ora');
            $table->float('iva');
            $table->enum('tipo_iva', array('NORMALE', 'SPLIT'));
            $table->integer('ore_previste');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contrattoIntervento');
    }
}