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
                'created_at' => '2016-04-02 00:24:56',
                'updated_at' => '2016-04-02 00:24:56',
                'deleted_at' => null,
                'user_id' => '5',
                'cliente_id' => '1',
                'descrizione' => 'Cippo Lippo',
                'telefono' => '0544123154',
                'telefono2' => '',
                'mobile' => '',
                'mobile2' => '',
                'email' => 'lippo.cippo@rsdp.com',
                'email2' => 'cippolippo@gmail.com',
                'indirizzo' => 'Via del Cippo 12',
                'citta' => 'Ravenna',
                'cap' => '45100',
                'provincia' => 'RA',
                'referente' => '0',
                'fatturazione' => '0',
            ),
        ));
    }
}
