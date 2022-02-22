<?php

use Illuminate\Database\Seeder;

class ConsulenteTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('consulente')->delete();
        
        \DB::table('consulente')->insert(array (
            0 =>
            array (
                'id' => 1,
                'user_id' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'codice_fiscale' => '',
                'cognome' => 'Zaccheroni',
                'nome' => 'Andrea',
                'indirizzo' => '',
                'citta' => '',
                'provincia' => '',
                'cap' => '',
                'telefono' => '',
                'telefono2' => '',
                'mobile' => '3289055989',
                'mobile2' => '',
                'partita_iva' => 'asdsadasda2',
                'tipo' => '',
            ),
            1 =>
            array (
                'id' => 2,
                'user_id' => 2,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'codice_fiscale' => '',
                'cognome' => 'Gentili',
                'nome' => 'Nicola',
                'indirizzo' => '',
                'citta' => '',
                'provincia' => '',
                'cap' => '',
                'telefono' => '',
                'telefono2' => '',
                'mobile' => '36112314123',
                'mobile2' => '',
                'partita_iva' => 'asdsadasda2',
                'tipo' => '',
            ),
            2 =>
            array (
                'id' => 3,
                'user_id' => 3,
                'created_at' => '2016-03-15 20:12:17',
                'updated_at' => '2016-03-15 20:12:17',
                'deleted_at' => null,
                'codice_fiscale' => 'zccndr84p21d704u',
                'cognome' => 'Zaccheronis',
                'nome' => 'Andreas',
                'indirizzo' => '',
                'citta' => '',
                'provincia' => '',
                'cap' => '',
                'telefono' => '0544123154',
                'telefono2' => '',
                'mobile' => '',
                'mobile2' => '',
                'partita_iva' => 'qweqwedqasd',
                'tipo' => 'Junior',
            ),
        ));
    }
}
