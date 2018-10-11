<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienteSocietaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_societa', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('cliente_id')->unsigned();
            $table->integer('societa_id')->unsigned();
            $table->string('idGamma', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cliente_societa');
    }
}
