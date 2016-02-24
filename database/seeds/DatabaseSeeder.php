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
            'name' => 'Andrea Zaccheroni',
            'email' => 'andrea.zaccheroni@gmail.com',
            'password' => bcrypt('irst0601'),
        ]);

        DB::table('users')->insert([
            'name' => 'Nicola Gentili',
            'email' => 'nicola.gentili@gmail.com',
            'password' => bcrypt('nicola'),
        ]);
    }
}
