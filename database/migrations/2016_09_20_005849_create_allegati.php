<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllegati extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allegati', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->string('nome', 100);
            $table->text('descrizione')->nullable();
            $table->integer('allega_id')->unsigned();
            $table->string('allega_type', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('allegati');
    }
}
