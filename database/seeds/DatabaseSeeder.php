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
        $this->call('ClienteTableSeeder');
        $this->call('ProgettoTableSeeder');
        $this->call('ContrattoTableSeeder');
        $this->call('ConsulenteTableSeeder');
        $this->call('AttivitaTableSeeder');
        $this->call('ContattoTableSeeder');
    }
}
