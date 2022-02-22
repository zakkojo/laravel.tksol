<?php

use Illuminate\Database\Seeder;

class ContrattoInterventoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('contratto_intervento')->delete();
        
        \DB::table('contratto_intervento')->insert(array (
            0 =>
            array (
                'id' => '1',
                'contratto_id' => '1',
                'created_at' => '2016-04-02 05:49:03',
                'updated_at' => '2016-04-02 06:16:57',
                'deleted_at' => null,
                'descrizione' => 'Prova1',
                'tariffa_ora' => '123.00',
                'iva' => '12.00',
                'tipo_iva' => 'NORMALE',
                'ore_previste' => '12',
            ),
            1 =>
            array (
                'id' => '2',
                'contratto_id' => '1',
                'created_at' => '2016-04-02 06:03:05',
                'updated_at' => '2016-04-02 06:16:48',
                'deleted_at' => null,
                'descrizione' => 'Prova2',
                'tariffa_ora' => '36.00',
                'iva' => '22.00',
                'tipo_iva' => 'NORMALE',
                'ore_previste' => '1200',
            ),
        ));
    }
}
