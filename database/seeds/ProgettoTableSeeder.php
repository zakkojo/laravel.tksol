<?php

use Illuminate\Database\Seeder;

class ProgettoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('progetto')->delete();
        
        \DB::table('progetto')->insert(array (
            0 => 
            array (
                'id' => '3',
                'progetto_padre' => '0',
                'created_at' => '2016-03-15 22:58:34',
                'updated_at' => '2016-03-15 22:58:34',
                'deleted_at' => NULL,
                'area' => 'area1',
                'nome' => 'nome1',
            ),
            1 => 
            array (
                'id' => '4',
                'progetto_padre' => '3',
                'created_at' => '2016-03-15 22:58:42',
                'updated_at' => '2016-03-15 23:14:29',
                'deleted_at' => NULL,
                'area' => 'area2',
                'nome' => 'nome2',
            ),
        ));
        
        
    }
}
