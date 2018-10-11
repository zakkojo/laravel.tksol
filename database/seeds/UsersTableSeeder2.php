<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder2 extends Seeder {

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array(
            1 => array ( 'id' => 1, 'email' => 'vgrillandi@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => NULL, 'updated_at' => NULL, 'deleted_at' => NULL, 'remember_token' => NULL, ),
            2 => array ( 'id' => 2, 'email' => 'stizzano@teikoslab.it', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => NULL, 'updated_at' => NULL, 'deleted_at' => NULL, 'remember_token' => NULL, ),
            3 => array ( 'id' => 3, 'email' => 'srotelli@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => NULL, 'updated_at' => NULL, 'deleted_at' => NULL, 'remember_token' => NULL, ),
            4 => array ( 'id' => 4, 'email' => 'sgregori@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => NULL, 'updated_at' => NULL, 'deleted_at' => NULL, 'remember_token' => NULL, ),
            5 => array ( 'id' => 5, 'email' => 'sbaroncini@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => NULL, 'updated_at' => NULL, 'deleted_at' => NULL, 'remember_token' => NULL, ),
            6 => array ( 'id' => 6, 'email' => 'rspaccini@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => NULL, 'updated_at' => NULL, 'deleted_at' => NULL, 'remember_token' => NULL, ),
            7 => array ( 'id' => 7, 'email' => 'mgiovannetti@sfnadriatica.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => NULL, 'updated_at' => NULL, 'deleted_at' => NULL, 'remember_token' => NULL, ),
            8 => array ( 'id' => 8, 'email' => 'mfiorentino@sfnadriatica.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => NULL, 'updated_at' => NULL, 'deleted_at' => NULL, 'remember_token' => NULL, ),
            9 => array ( 'id' => 9, 'email' => 'ggraffiedi@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => NULL, 'updated_at' => NULL, 'deleted_at' => NULL, 'remember_token' => NULL, ),
            10 => array ( 'id' => 10, 'email' => 'gcaselli@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => NULL, 'updated_at' => NULL, 'deleted_at' => NULL, 'remember_token' => NULL, ),
            11 => array ( 'id' => 11, 'email' => 'fmenghetti@sfnadriatica.ne', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => NULL, 'updated_at' => NULL, 'deleted_at' => NULL, 'remember_token' => NULL, ),
            12 => array ( 'id' => 12, 'email' => 'fdellachiara@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => NULL, 'updated_at' => NULL, 'deleted_at' => NULL, 'remember_token' => NULL, ),
            13 => array ( 'id' => 13, 'email' => 'fbiondi@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => NULL, 'updated_at' => NULL, 'deleted_at' => NULL, 'remember_token' => NULL, ),
            14 => array ( 'id' => 14, 'email' => 'evalentini@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => NULL, 'updated_at' => NULL, 'deleted_at' => NULL, 'remember_token' => NULL, ),
            15 => array ( 'id' => 15, 'email' => 'dpaleco@sfnadriatica.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => NULL, 'updated_at' => NULL, 'deleted_at' => NULL, 'remember_token' => NULL, ),
            16 => array ( 'id' => 16, 'email' => 'cpaganelli@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => NULL, 'updated_at' => NULL, 'deleted_at' => NULL, 'remember_token' => NULL, ),
            17 => array ( 'id' => 17, 'email' => 'andrea.zaccheroni@gmail.com', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => NULL, 'updated_at' => NULL, 'deleted_at' => NULL, 'remember_token' => NULL, ),
            18 => array ( 'id' => 18, 'email' => 'amministrazione@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => NULL, 'updated_at' => NULL, 'deleted_at' => NULL, 'remember_token' => NULL, ),
            19 => array ( 'id' => 19, 'email' => 'Adegliesposti@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => NULL, 'updated_at' => NULL, 'deleted_at' => NULL, 'remember_token' => NULL, ),
            20 => array ( 'id' => 20, 'email' => 'aandreani@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => NULL, 'updated_at' => NULL, 'deleted_at' => NULL, 'remember_token' => NULL, ),
        ));


    }
}
