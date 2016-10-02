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

        Schema::table('intervento', function ($table)
        {
            $table->increments('id')->change();
            $table->integer('intervento_padre')->unsigned()->nullable();
            $table->integer('contratto_id')->unsigned();
            $table->integer('user_id_modifica')->unsigned();
            $table->integer('user_id')->unsigned();
            if(!Schema::hasColumn('intervento', 'data_modifica')) $table->timestamp('data_accettazione');
            $table->string('sede', 100)->default('Sede Cliente');
            $table->boolean('fatturabile')->default(1)->change();
            $table->integer('ore_lavorate')->defaul(0);
            if(Schema::hasColumn('intervento', 'stato')) $table->dropColumn('stato');
            if(Schema::hasColumn('intervento', 'consulente_id')) $table->dropColumn('consulente_id');
        });

        Schema::table('cliente', function ($table)
        {
            $table->string('email')->nullable();
            $table->integer('rating')->nullable()->change();
            $table->integer('distanza')->nullable();
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

        Schema::table('intervento', function ($table)
        {
            if(Schema::hasColumn('intervento', 'intervento_padre')) $table->dropColumn('intervento_padre');
            if(Schema::hasColumn('intervento', 'user_id_creatore')) $table->dropColumn('user_id_creatore');
            if(Schema::hasColumn('intervento', 'user_id_modifica')) $table->dropColumn('user_id_modifica');
            if(Schema::hasColumn('intervento', 'user_id')) $table->dropColumn('user_id');
            if(Schema::hasColumn('intervento', 'data_accettazione')) $table->dropColumn('data_accettazione');
            if(Schema::hasColumn('intervento', 'data_modifica')) $table->dropColumn('data_modifica');
            if(Schema::hasColumn('intervento', 'storico')) $table->dropColumn('storico');
            if(Schema::hasColumn('intervento', 'sede')) $table->dropColumn('sede');
            if(Schema::hasColumn('intervento', 'ore_lavorate')) $table->dropColumn('ore_lavorate');
            if(Schema::hasColumn('intervento', 'contratto_id')) $table->dropColumn('contratto_id');
        });

        Schema::table('cliente', function ($table)
        {
            if(Schema::hasColumn('cliente', 'email')) $table->dropColumn('email');
            if(Schema::hasColumn('cliente', 'distanza')) $table->dropColumn('distanza');
            $table->integer('rating')->nullable()->change();
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

        Schema::table('contratto', function ($table)
        {
            if(Schema::hasColumn('contratto', 'rimborsi')) $table->dropColumn('rimborsi');
            //retrocompatibilita
            $table->boolean('capo_progetto');
        });
    }
}
