<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContrattoProdottoTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratto_prodotto', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('contratto_id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('descrizione', 40);
            $table->float('importo');
            $table->float('iva');
            $table->enum('tipo_iva', array('NORMALE', 'SPLIT'));
            $table->float('fee');
            $table->integer('softwarehouse_id')->unsigned();
            $table->enum('tipo_vendita', array('LICENZA', 'NOLEGGIO'));
            $table->timestamp('scadenza');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contratto_prodotto');
    }
}
