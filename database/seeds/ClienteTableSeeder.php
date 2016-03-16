<?php

use Illuminate\Database\Seeder;

class ClienteTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cliente')->delete();
        
        \DB::table('cliente')->insert(array (
            0 => 
            array (
                'id' => '1',
                'codice_fiscale' => 'zccndr84p21d704u',
                'partita_iva' => '12312ewda23',
                'created_at' => '2016-03-15 21:04:22',
                'updated_at' => '2016-03-15 21:04:22',
                'deleted_at' => NULL,
                'ragione_sociale' => 'Ragione Sociale di Prova',
                'rating' => '0',
                'cliente' => '0',
                'settore' => '',
                'softwarehouse' => '0',
                'indirizzo' => 'Via P. Maroncelli 40',
                'citta' => 'Meldola',
                'cap' => '47014',
                'provincia' => 'FC',
                'telefono' => '3289055989',
            ),
        ));
        
        
    }
}
