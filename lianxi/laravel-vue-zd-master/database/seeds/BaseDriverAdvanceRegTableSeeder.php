<?php

use Illuminate\Database\Seeder;

class BaseDriverAdvanceRegTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('base_driver_advance_reg')->delete();
        
        \DB::table('base_driver_advance_reg')->insert(array (
            0 => 
            array (
                'id' => 11,
                'phone' => '13611111111',
                'reg_source' => 3,
                'source_foreign_id' => 21818,
                'driver_id' => 5443,
                'status' => 1,
                'create_time' => '2017-06-08 10:37:19',
                'modify_time' => '2017-06-08 10:52:44',
            ),
            1 => 
            array (
                'id' => 12,
                'phone' => '13410425217',
                'reg_source' => 2,
                'source_foreign_id' => 5404,
                'driver_id' => 5442,
                'status' => 1,
                'create_time' => '2017-06-08 10:38:31',
                'modify_time' => '2017-06-08 10:43:56',
            ),
            2 => 
            array (
                'id' => 13,
                'phone' => '13450000000',
                'reg_source' => 1,
                'source_foreign_id' => 21824,
                'driver_id' => 5444,
                'status' => 1,
                'create_time' => '2017-06-08 11:02:51',
                'modify_time' => '2017-06-08 11:03:30',
            ),
            3 => 
            array (
                'id' => 14,
                'phone' => '13410101010',
                'reg_source' => 2,
                'source_foreign_id' => 5450,
                'driver_id' => NULL,
                'status' => 0,
                'create_time' => '2017-06-14 15:21:00',
                'modify_time' => '2017-06-14 15:21:00',
            ),
            4 => 
            array (
                'id' => 15,
                'phone' => '13410400000',
                'reg_source' => 1,
                'source_foreign_id' => 21826,
                'driver_id' => NULL,
                'status' => 0,
                'create_time' => '2017-06-14 15:35:21',
                'modify_time' => '2017-06-14 15:35:21',
            ),
            5 => 
            array (
                'id' => 16,
                'phone' => '13477777777',
                'reg_source' => 1,
                'source_foreign_id' => 3,
                'driver_id' => 5451,
                'status' => 2,
                'create_time' => '2017-06-14 16:00:08',
                'modify_time' => '2017-06-14 17:03:21',
            ),
        ));
        
        
    }
}