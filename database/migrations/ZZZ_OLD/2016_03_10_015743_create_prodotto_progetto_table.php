<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProdottoProgettoTable extends Migration
{

    public function up()
    {
        Schema::create('prodotto_progetto', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('progetto_id');
            $table->integer('prodotto_id');
        });
    }

    public function down()
    {
        Schema::drop('prodotto_progetto');
    }
}
