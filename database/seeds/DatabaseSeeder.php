<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('UsersTableSeeder');
        $this->call('ConsulenteTableSeeder');
        $this->call('ClienteTableSeeder');
        $this->call('ProgettoTableSeeder');
        $this->call('RolesTableSeeder');
        $this->call('AttivitaTableSeeder');
        $this->call('ContrattoTableSeeder');
        $this->call('ContattoTableSeeder');
        $this->call('ContrattoInterventoTableSeeder');
        $this->call('ProdottoTableSeeder');
        $this->call('ContrattoProdottoTableSeeder');
    }
}
