<?php

use Illuminate\Database\Seeder;

class ContrattoProdottoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('contratto_prodotto')->delete();
        
        \DB::table('contratto_prodotto')->insert(array (
            0 =>
            array (
                'id' => '1',
                'contratto_id' => '1',
                'prodotto_id' => '1',
                'softwarehouse_id' => '442',
                'created_at' => '2016-04-02 07:43:07',
                'updated_at' => '2016-04-02 07:43:07',
                'deleted_at' => null,
                'importo' => '10000.00',
                'iva' => '22.00',
                'tipo_iva' => 'NORMALE',
                'fee' => '0.00',
                'tipo_vendita' => 'LICENZA',
                'scadenza' => '2016-04-15 07:43:07',
            ),
            1 =>
            array (
                'id' => '2',
                'contratto_id' => '1',
                'prodotto_id' => '1',
                'softwarehouse_id' => '442',
                'created_at' => '2016-04-02 07:43:42',
                'updated_at' => '2016-04-02 09:06:35',
                'deleted_at' => null,
                'importo' => '10000.00',
                'iva' => '22.00',
                'tipo_iva' => 'NORMALE',
                'fee' => '0.00',
                'tipo_vendita' => 'LICENZA',
                'scadenza' => '2016-04-22 09:06:35',
            ),
        ));
    }
}
