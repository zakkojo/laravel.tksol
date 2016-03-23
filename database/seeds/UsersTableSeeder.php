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
                'password' => '$2y$10$XnLdjclIJcXd6Y85xD9DYO1pE75nR6r6QxaqOuBzcpmWaQT12jAm2',
                'tipo_utente' => 1,
                'created_at' => NULL,
                'updated_at' => '2016-03-21 22:49:28',
                'deleted_at' => '2016-03-21 22:49:28',
                'remember_token' => 'eQKtCAOzqLV8g8XkG9jrLrcT15hVpccSp7kFugdGp0Z1dTIZAPkMlj7RZ5Mk',
            ),
            1 => 
            array (
                'id' => 2,
                'email' => 'nicola.gentili@gmail.com',
                'password' => '$2y$10$fcWLFor76NwvF7q98OsUpepU8xJfwpdW0dKxniXCSEUQ.qsqAjoaC',
                'tipo_utente' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'remember_token' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'email' => 'andrea.zaccheronid@gmail.com',
                'password' => '$2y$10$PmhDRN10XMQp7yzSt.8J8eridgnvk5n.wfF7fSpNItZeQjn9RVIDa',
                'tipo_utente' => 1,
                'created_at' => '2016-03-15 20:12:17',
                'updated_at' => '2016-03-16 08:42:49',
                'deleted_at' => NULL,
                'remember_token' => 'mIwGBhlZrTdNbyRUeq7et704Fd24zR0L9TfHiiw1IdfzLc18jowWvWQwlnCK',
            ),
            3 => 
            array (
                'id' => 4,
                'email' => 'cippolippo@gmail.com',
                'password' => '$2y$10$CnynsGRf8zL.uGvIuaOune26qSrvadO4nvT09jc47RkeJ4V0qN9eK',
                'tipo_utente' => 2,
                'created_at' => '2016-03-16 08:16:06',
                'updated_at' => '2016-03-16 08:33:16',
                'deleted_at' => '2016-03-16 08:16:06',
                'remember_token' => NULL,
            ),
        ));
        
        
    }
}
