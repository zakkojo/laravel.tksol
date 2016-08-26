<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Mod1 extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cliente', function ($table)
        {
            $table->string('email')->nullable();
            $table->integer('rating')->nullable()->change();
            $table->integer('distanza')->nullable();
        });

        Schema::table('intervento', function ($table)
        {
            $table->integer('creatore_id')->unsigned();
            $table->timestamp('data_modifica');
            $table->timestamp('data_accettazione')->nullable();
        });


        Schema::table('contatto', function ($table)
        {
            $table->dropColumn('mobile');
            $table->dropColumn('mobile2');
            $table->dropColumn('email2');
            $table->dropColumn('referente');
            $table->dropColumn('fatturazione');
            $table->string('fax', 50)->nullable();
            $table->string('ruolo', 100)->nullable();
        });

        Schema::table('intervento', function ($table)
        {
            $table->dropColumn('stato');
            $table->string('sede', 100)->default('Sede Cliente');
            $table->boolean('fatturabile')->default(1)->change();
        });
        Schema::table('contratto', function ($table)
        {
            $table->dropColumn('capo_progetto');
            $table->string('rimborsi', 100)->default('nessuno');
        });

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cliente', function ($table)
        {
            if(Schema::hasColumn('cliente', 'email')) $table->dropColumn('email');
            if(Schema::hasColumn('cliente', 'distanza')) $table->dropColumn('distanza');
            $table->integer('rating')->nullable()->change();
        });

        Schema::table('intervento', function ($table)
        {
            if(Schema::hasColumn('intervento', 'creatore_id')) $table->dropColumn('creatore_id');
            if(Schema::hasColumn('intervento', 'data_accettazione')) $table->dropColumn('data_accettazione');
            if(Schema::hasColumn('intervento', 'data_modifica')) $table->dropColumn('data_modifica');
        });

        Schema::table('contatto', function ($table)
        {
            if(Schema::hasColumn('contatto', 'fax')) $table->dropColumn('fax');
            if(Schema::hasColumn('contatto', 'ruolo')) $table->dropColumn('ruolo');
            //
            $table->boolean('mobile');
            $table->boolean('mobile2');
            $table->boolean('email2');
            $table->boolean('referente');
            $table->boolean('fatturazione');
        });

        Schema::table('intervento', function ($table)
        {
            if(Schema::hasColumn('intervento', 'sede')) $table->dropColumn('sede');
            //retrocompatibilita
            $table->boolean('stato');
        });

        Schema::table('contratto', function ($table)
        {
            if(Schema::hasColumn('contratto', 'rimborsi')) $table->dropColumn('rimborsi');
            //retrocompatibilita
            $table->boolean('capo_progetto');
        });
    }
}
