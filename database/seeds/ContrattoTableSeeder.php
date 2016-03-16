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
                'cliente_id' => '1',
                'progetto_id' => '3',
                'stato' => 'CONTACT',
                'note' => 'contratto 1',
                'data_primo_contatto' => '0000-00-00',
                'data_avvio_progetto' => '0000-00-00',
                'data_chiusura_progetto' => '0000-00-00',
                'modalita_fattura' => 'CHIAVI_IN_MANO;TIME_CONSUMING',
                'importo' => '0.00',
                'data_validita_contratto' => '0000-00-00',
                'periodicita_pagamenti' => '0',
                'deleted_at' => NULL,
                'created_at' => '2016-03-16 05:59:14',
                'updated_at' => '2016-03-16 06:02:08',
            ),
        ));
        
        
    }
}
