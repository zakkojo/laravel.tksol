<?php

use Illuminate\Database\Seeder;

class AttivitaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('attivita')->delete();
        
        \DB::table('attivita')->insert(array (
            0 => 
            array (
                'id' => '1',
                'progetto_id' => '3',
                'created_at' => '2016-03-16 06:08:07',
                'updated_at' => '2016-03-16 06:29:10',
                'deleted_at' => NULL,
                'sequenza' => '0',
                'descrizione' => 'attivita1',
                'attivita_padre' => '0',
            ),
            1 => 
            array (
                'id' => '2',
                'progetto_id' => '0',
                'created_at' => '2016-03-16 06:08:18',
                'updated_at' => '2016-03-16 06:18:58',
                'deleted_at' => NULL,
                'sequenza' => '0',
                'descrizione' => 'attivita2',
                'attivita_padre' => '1',
            ),
        ));
        
        
    }
}
