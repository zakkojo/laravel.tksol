<?php

use Illuminate\Database\Seeder;

class ProgettoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('progetto')->delete();
        
        \DB::table('progetto')->insert(array (
            0 =>
            array (
                'id' => '1',
                'created_at' => '2016-03-22 22:32:48',
                'updated_at' => '2016-03-22 22:32:48',
                'deleted_at' => null,
                'area' => 'Finance',
                'nome' => 'Close Up',
                'codice' => '',
            ),
            1 =>
            array (
                'id' => '2',
                'created_at' => '2016-03-22 22:34:01',
                'updated_at' => '2016-03-22 22:34:01',
                'deleted_at' => null,
                'area' => 'Finance',
                'nome' => 'Centrale rischi',
                'codice' => '',
            ),
            2 =>
            array (
                'id' => '3',
                'created_at' => '2016-03-22 22:34:15',
                'updated_at' => '2016-03-22 22:34:15',
                'deleted_at' => null,
                'area' => 'Finance',
                'nome' => 'CDG Reporting "Installa e parti"',
                'codice' => '',
            ),
            3 =>
            array (
                'id' => '4',
                'created_at' => '2016-03-22 22:34:30',
                'updated_at' => '2016-03-22 22:34:30',
                'deleted_at' => null,
                'area' => 'Finance',
                'nome' => 'CDG Budgeting "Programma"',
                'codice' => '',
            ),
            4 =>
            array (
                'id' => '5',
                'created_at' => '2016-03-22 22:34:56',
                'updated_at' => '2016-03-22 22:34:56',
                'deleted_at' => null,
                'area' => 'Finance',
                'nome' => 'CDG  ANALISI SCOSTAMENTI "VALUTA L\'ORGANIZZAZIONE"',
                'codice' => '',
            ),
            5 =>
            array (
                'id' => '6',
                'created_at' => '2016-03-22 22:35:18',
                'updated_at' => '2016-03-22 22:35:18',
                'deleted_at' => null,
                'area' => 'Finance',
                'nome' => 'DocCredit',
                'codice' => '',
            ),
            6 =>
            array (
                'id' => '7',
                'created_at' => '2016-03-22 22:35:30',
                'updated_at' => '2016-03-22 22:35:30',
                'deleted_at' => null,
                'area' => 'Finance',
                'nome' => 'DocFinance "Verifica e leggi"',
                'codice' => '',
            ),
            7 =>
            array (
                'id' => '8',
                'created_at' => '2016-03-22 22:35:35',
                'updated_at' => '2016-03-22 22:35:35',
                'deleted_at' => null,
                'area' => 'Finance',
                'nome' => 'DocFinance "Programma"',
                'codice' => '',
            ),
            8 =>
            array (
                'id' => '9',
                'created_at' => '2016-03-22 22:35:42',
                'updated_at' => '2016-03-22 22:35:42',
                'deleted_at' => null,
                'area' => 'Finance',
                'nome' => 'DocFinance "Installa e parti"',
                'codice' => '',
            ),
            9 =>
            array (
                'id' => '10',
                'created_at' => '2016-03-22 22:35:50',
                'updated_at' => '2016-03-22 22:35:50',
                'deleted_at' => null,
                'area' => 'Finance',
                'nome' => 'ERP',
                'codice' => '',
            ),
            10 =>
            array (
                'id' => '11',
                'created_at' => '2016-03-22 22:35:58',
                'updated_at' => '2016-03-22 22:35:58',
                'deleted_at' => null,
                'area' => 'Finance',
                'nome' => 'InfoBusiness',
                'codice' => '',
            ),
            11 =>
            array (
                'id' => '12',
                'created_at' => '2016-03-22 22:36:08',
                'updated_at' => '2016-03-22 22:36:08',
                'deleted_at' => null,
                'area' => 'Finance',
                'nome' => 'Outsourcing liquidazioni',
                'codice' => '',
            ),
            12 =>
            array (
                'id' => '13',
                'created_at' => '2016-03-22 22:36:18',
                'updated_at' => '2016-03-22 22:36:18',
                'deleted_at' => null,
                'area' => 'Finance',
                'nome' => 'Pianificazione Eco-Fin',
                'codice' => '',
            ),
            13 =>
            array (
                'id' => '14',
                'created_at' => '2016-03-22 22:36:23',
                'updated_at' => '2016-03-22 22:36:23',
                'deleted_at' => null,
                'area' => 'Finance',
                'nome' => 'Pianificazione Eco-Fin-Pat-Rating',
                'codice' => '',
            ),
            14 =>
            array (
                'id' => '15',
                'created_at' => '2016-03-22 22:36:31',
                'updated_at' => '2016-03-22 22:36:31',
                'deleted_at' => null,
                'area' => 'Finance',
                'nome' => 'QLIK generico',
                'codice' => '',
            ),
            15 =>
            array (
                'id' => '16',
                'created_at' => '2016-03-22 22:36:40',
                'updated_at' => '2016-03-22 22:36:40',
                'deleted_at' => null,
                'area' => 'Finance',
                'nome' => 'Reporting e rating andamentale',
                'codice' => '',
            ),
            16 =>
            array (
                'id' => '17',
                'created_at' => '2016-03-22 22:36:59',
                'updated_at' => '2016-03-22 22:36:59',
                'deleted_at' => null,
                'area' => 'Finance',
                'nome' => 'TFinance',
                'codice' => '',
            ),
            17 =>
            array (
                'id' => '18',
                'created_at' => '2016-03-17 06:09:14',
                'updated_at' => '2016-03-17 06:09:14',
                'deleted_at' => null,
                'area' => 'Finance',
                'nome' => 'Progetto TEST',
                'codice' => '',
            ),
        ));
    }
}
