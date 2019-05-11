<?php

use Illuminate\Database\Seeder;

class CarAnalysisTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('car_analysis')->delete();
        
        \DB::table('car_analysis')->insert(array (
            0 => 
            array (
                'id' => 5,
                'date' => '2018-05-24',
                'total' => 75,
                'running' => 73,
                'created_at' => '2018-04-01 11:23:46',
                'updated_at' => '2017-04-01 11:23:46',
            ),
            1 => 
            array (
                'id' => 6,
                'date' => '2018-05-14',
                'total' => 102,
                'running' => 62,
                'created_at' => '2018-04-08 11:23:46',
                'updated_at' => '2018-04-08 11:23:46',
            ),
            2 => 
            array (
                'id' => 7,
                'date' => '2018-05-13',
                'total' => 172,
                'running' => 22,
                'created_at' => '2018-04-16 11:23:46',
                'updated_at' => '2018-04-16 11:23:46',
            ),
            3 => 
            array (
                'id' => 8,
                'date' => '2018-05-05',
                'total' => 62,
                'running' => 32,
                'created_at' => '2018-04-24 11:23:46',
                'updated_at' => '2018-04-24 11:23:46',
            ),
            4 => 
            array (
                'id' => 9,
                'date' => '2018-04-24',
                'total' => 666,
                'running' => 332,
                'created_at' => '2018-05-01 11:23:46',
                'updated_at' => '2018-05-01 11:23:46',
            ),
            5 => 
            array (
                'id' => 10,
                'date' => '2018-04-26',
                'total' => 453,
                'running' => 86,
                'created_at' => '2018-05-08 11:23:46',
                'updated_at' => '2018-05-08 11:23:46',
            ),
            6 => 
            array (
                'id' => 11,
                'date' => '2018-05-28',
                'total' => 760,
                'running' => 68,
                'created_at' => '2018-05-16 15:11:07',
                'updated_at' => '2018-05-16 15:11:07',
            ),
        ));
        
        
    }
}