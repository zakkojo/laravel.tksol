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
                'id' => '1',
                'email' => 'andrea.zaccheroni@gmail.com',
                'password' => bcrypt('andrea'),
                'tipo_utente' => '1',
                'created_at' => NULL,
                'updated_at' => '2016-03-16 04:51:56',
                'deleted_at' => NULL,
                'remember_token' => NULL,
            ),
            1 => 
            array (
                'id' => '2',
                'email' => 'nicola.gentili@gmail.com',
                'password' => bcrypt('nicola'),
                'tipo_utente' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'remember_token' => NULL,
            ),
            2 => 
            array (
                'id' => '3',
                'email' => 'andrea.zaccheronid@gmail.com',
                'password' => bcrypt('tksol'),
                'tipo_utente' => '1',
                'created_at' => '2016-03-15 20:12:17',
                'updated_at' => '2016-03-16 08:42:49',
                'deleted_at' => NULL,
                'remember_token' => NULL,
            ),
            3 => 
            array (
                'id' => '4',
                'email' => 'cippolippo@gmail.com',
                'password' => bcrypt('tksol'),
                'tipo_utente' => '2',
                'created_at' => '2016-03-16 08:16:06',
                'updated_at' => '2016-03-16 08:33:16',
                'deleted_at' => '2016-03-16 08:16:06',
                'remember_token' => NULL,
            ),
        ));
        
        
    }
}
