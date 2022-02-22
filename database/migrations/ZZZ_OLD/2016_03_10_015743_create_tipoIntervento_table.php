<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipoInterventoTable extends Migration
{

    public function up()
    {
        Schema::create('tipoIntervento', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('descrizione', 40);
        });
    }

    public function down()
    {
        Schema::drop('tipoIntervento');
    }
}
