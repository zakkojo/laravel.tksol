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
        Schema::create('contratto_intervento', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contratto_id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('descrizione', 40);
            $table->float('tariffa_ora');
            $table->float('iva');
            $table->enum('tipo_iva', ['NORMALE', 'SPLIT']);
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
        Schema::drop('contratto_intervento');
    }
}
