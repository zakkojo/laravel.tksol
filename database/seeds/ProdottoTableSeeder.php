<?php

use Illuminate\Database\Seeder;

class ProdottoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('prodotto')->delete();
        
        \DB::table('prodotto')->insert(array (
            0 =>
            array (
                'id' => '1',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'codice' => 'tkcrm1',
                'nome' => 'CRM Teikos',
            ),
        ));
    }
}
