<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder2 extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array(
            1 => array ( 'id' => 1, 'email' => 'vgrillandi@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null, 'remember_token' => null, ),
            2 => array ( 'id' => 2, 'email' => 'stizzano@teikoslab.it', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null, 'remember_token' => null, ),
            3 => array ( 'id' => 3, 'email' => 'srotelli@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null, 'remember_token' => null, ),
            4 => array ( 'id' => 4, 'email' => 'sgregori@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null, 'remember_token' => null, ),
            5 => array ( 'id' => 5, 'email' => 'sbaroncini@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null, 'remember_token' => null, ),
            6 => array ( 'id' => 6, 'email' => 'rspaccini@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null, 'remember_token' => null, ),
            7 => array ( 'id' => 7, 'email' => 'mgiovannetti@sfnadriatica.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null, 'remember_token' => null, ),
            8 => array ( 'id' => 8, 'email' => 'mfiorentino@sfnadriatica.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null, 'remember_token' => null, ),
            9 => array ( 'id' => 9, 'email' => 'ggraffiedi@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null, 'remember_token' => null, ),
            10 => array ( 'id' => 10, 'email' => 'gcaselli@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null, 'remember_token' => null, ),
            11 => array ( 'id' => 11, 'email' => 'fmenghetti@sfnadriatica.ne', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null, 'remember_token' => null, ),
            12 => array ( 'id' => 12, 'email' => 'fdellachiara@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null, 'remember_token' => null, ),
            13 => array ( 'id' => 13, 'email' => 'fbiondi@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null, 'remember_token' => null, ),
            14 => array ( 'id' => 14, 'email' => 'evalentini@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null, 'remember_token' => null, ),
            15 => array ( 'id' => 15, 'email' => 'dpaleco@sfnadriatica.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null, 'remember_token' => null, ),
            16 => array ( 'id' => 16, 'email' => 'cpaganelli@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null, 'remember_token' => null, ),
            17 => array ( 'id' => 17, 'email' => 'andrea.zaccheroni@gmail.com', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null, 'remember_token' => null, ),
            18 => array ( 'id' => 18, 'email' => 'amministrazione@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null, 'remember_token' => null, ),
            19 => array ( 'id' => 19, 'email' => 'Adegliesposti@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null, 'remember_token' => null, ),
            20 => array ( 'id' => 20, 'email' => 'aandreani@tksol.net', 'password' => bcrypt('TKsol2017'), 'tipo_utente' => 1, 'created_at' => null, 'updated_at' => null, 'deleted_at' => null, 'remember_token' => null, ),
        ));
    }
}
