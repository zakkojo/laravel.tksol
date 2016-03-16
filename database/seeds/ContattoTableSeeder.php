<?php

use Illuminate\Database\Seeder;

class ContattoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('contatto')->delete();
        
        \DB::table('contatto')->insert(array (
            0 => 
            array (
                'id' => '1',
                'created_at' => '2016-03-16 08:16:06',
                'updated_at' => '2016-03-16 08:33:16',
                'deleted_at' => NULL,
                'user_id' => '4',
                'cliente_id' => '1',
                'descrizione' => 'Cippo Lippo',
                'telefono' => '3289055989',
                'telefono2' => '3289055989',
                'mobile' => '3289055989',
                'mobile2' => '3289055989',
                'email' => 'cippolippo@gmail.com',
                'email2' => '',
                'indirizzo' => 'Via P. Maroncelli 40',
                'citta' => 'Meldola',
                'cap' => '47014',
                'provincia' => 'FC',
            ),
        ));
        
        
    }
}
