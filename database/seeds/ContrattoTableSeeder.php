<?php

use Illuminate\Database\Seeder;

class ContrattoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('contratto')->delete();
        
        \DB::table('contratto')->insert(array (
            0 => 
            array (
                'id' => '1',
                'created_at' => '2016-04-02 07:25:28',
                'updated_at' => '2016-04-02 07:25:28',
                'deleted_at' => NULL,
                'cliente_id' => '1',
                'progetto_id' => '18',
                'stato' => 'PROSPECT',
                'note' => '',
                'data_primo_contatto' => '2016-04-01 07:25:28',
                'data_avvio_progetto' => NULL,
                'data_chiusura_progetto' => NULL,
                'modalita_fattura' => 'CHIAVI_IN_MANO',
                'importo' => '123000.00',
                'data_validita_contratto' => NULL,
                'periodicita_pagamenti' => '3',
                'capo_progetto' => '1',
            ),
        ));
        
        
    }
}
