<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProdottoTable extends Migration
{

    public function up()
    {
        Schema::create('prodotto', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('codice', 20);
            $table->string('nome', 50);
        });
    }

    public function down()
    {
        Schema::drop('prodotto');
    }
}
