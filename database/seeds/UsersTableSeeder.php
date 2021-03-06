<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 =>
            array (
                'id' => 1,
                'email' => 'andrea.zaccheroni@gmail.com',
                'password' => bcrypt('andrea'),
                'tipo_utente' => 1,
                'created_at' => null,
                'updated_at' => '2016-03-21 22:49:28',
                'deleted_at' => null,
                'remember_token' => null,
            ),
            1 =>
            array (
                'id' => 2,
                'email' => 'nicola.gentili@gmail.com',
                'password' => bcrypt('nicola'),
                'tipo_utente' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'remember_token' => null,
            ),
            2 =>
            array (
                'id' => 3,
                'email' => 'andrea.zaccheronid@gmail.com',
                'password' => bcrypt('tksol'),
                'tipo_utente' => 1,
                'created_at' => '2016-03-15 20:12:17',
                'updated_at' => '2016-03-16 08:42:49',
                'deleted_at' => null,
                'remember_token' => 'mIwGBhlZrTdNbyRUeq7et704Fd24zR0L9TfHiiw1IdfzLc18jowWvWQwlnCK',
            ),
            3 =>
            array (
                'id' => 4,
                'email' => 'cippolippo@gmail.com',
                'password' => bcrypt('tksol'),
                'tipo_utente' => 2,
                'created_at' => '2016-03-16 08:16:06',
                'updated_at' => '2016-03-16 08:33:16',
                'deleted_at' => '2016-03-16 08:16:06',
                'remember_token' => null,
            ),
        ));
    }
}
