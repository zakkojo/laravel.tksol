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
        DB::table('users')->insert([
            'email' => 'andrea.zaccheroni@gmail.com',
            'password' => bcrypt('irst0601'),
            'tipo_utente' => '1', //1- Consulente 2- Contatto/Cliente
        ]);

        DB::table('consulente')->insert([
            'nome' => 'Andrea',
            'cognome' => 'Zaccheroni',
            'user_id' => '1',
            'mobile' => '3289055989',
            'partita_iva' => 'asdsadasda2132',
            'tipo' => 'Admin',
        ]);

        DB::table('users')->insert([
            'email' => 'nicola.gentili@gmail.com',
            'password' => bcrypt('nicola'),
            'tipo_utente' => '1', //1- Consulente 2- Contatto/Cliente
        ]);

        DB::table('consulente')->insert([
            'nome' => 'Nicola',
            'cognome' => 'Gentili',
            'user_id' => '2',
            'mobile' => '36112314123',
            'partita_iva' => 'asdsadasda2132',
            'tipo' => 'Admin',
        ]);

    }
}
