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
                'progetto_id' => '18',
                'parent_id' => '0',
                '_lft' => '1',
                '_rgt' => '10',
                'created_at' => '2016-03-17 05:49:33',
                'updated_at' => '2016-03-17 05:50:44',
                'deleted_at' => NULL,
                'sequenza' => '0',
                'descrizione' => 'attivita 1',
            ),
            1 => 
            array (
                'id' => '2',
                'progetto_id' => '18',
                'parent_id' => '0',
                '_lft' => '11',
                '_rgt' => '12',
                'created_at' => '2016-03-17 05:53:05',
                'updated_at' => '2016-03-17 05:53:05',
                'deleted_at' => NULL,
                'sequenza' => '0',
                'descrizione' => 'attivita 2',
            ),
            2 => 
            array (
                'id' => '3',
                'progetto_id' => '18',
                'parent_id' => '0',
                '_lft' => '13',
                '_rgt' => '14',
                'created_at' => '2016-03-17 05:53:22',
                'updated_at' => '2016-03-17 05:53:22',
                'deleted_at' => NULL,
                'sequenza' => '0',
                'descrizione' => 'attivita 3',
            ),
            3 => 
            array (
                'id' => '4',
                'progetto_id' => '18',
                'parent_id' => '1',
                '_lft' => '2',
                '_rgt' => '3',
                'created_at' => '2016-03-17 05:55:51',
                'updated_at' => '2016-03-17 05:55:51',
                'deleted_at' => NULL,
                'sequenza' => '0',
                'descrizione' => 'attivita 4',
            ),
            4 => 
            array (
                'id' => '5',
                'progetto_id' => '18',
                'parent_id' => '1',
                '_lft' => '4',
                '_rgt' => '5',
                'created_at' => '2016-03-17 05:56:19',
                'updated_at' => '2016-03-17 05:56:19',
                'deleted_at' => NULL,
                'sequenza' => '0',
                'descrizione' => 'attivita 5',
            ),
            5 => 
            array (
                'id' => '6',
                'progetto_id' => '18',
                'parent_id' => '1',
                '_lft' => '6',
                '_rgt' => '9',
                'created_at' => '2016-03-17 05:56:32',
                'updated_at' => '2016-03-17 05:56:32',
                'deleted_at' => NULL,
                'sequenza' => '0',
                'descrizione' => 'attivita 6',
            ),
            6 => 
            array (
                'id' => '7',
                'progetto_id' => '18',
                'parent_id' => '6',
                '_lft' => '7',
                '_rgt' => '8',
                'created_at' => '2016-03-17 05:56:42',
                'updated_at' => '2016-03-17 05:56:42',
                'deleted_at' => NULL,
                'sequenza' => '0',
                'descrizione' => 'attivita 7',
            ),
            7 => 
            array (
                'id' => '8',
                'progetto_id' => '18',
                'parent_id' => '0',
                '_lft' => '15',
                '_rgt' => '16',
                'created_at' => '2016-03-17 05:59:07',
                'updated_at' => '2016-03-17 05:59:07',
                'deleted_at' => NULL,
                'sequenza' => '0',
                'descrizione' => 'attivita 1',
            ),
        ));
        
        
    }
}
