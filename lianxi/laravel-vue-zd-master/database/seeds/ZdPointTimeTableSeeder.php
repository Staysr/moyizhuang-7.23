<?php

use Illuminate\Database\Seeder;

class ZdPointTimeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('zd_point_time')->delete();
        
        \DB::table('zd_point_time')->insert(array (
            0 => 
            array (
                'id' => 314,
                'warehouse_id' => 173,
                'arrival_warehouse_day' => '2018-08-23',
                'arrival_warehouse_time' => '09:00:00',
                'total_count' => 1,
                'exception_count' => 0,
                'plan_count' => 1,
                'create_time' => '2018-08-10 14:41:11',
                'modify_time' => '2018-08-10 14:41:11',
            ),
            1 => 
            array (
                'id' => 315,
                'warehouse_id' => 171,
                'arrival_warehouse_day' => '2018-09-22',
                'arrival_warehouse_time' => '08:20:52',
                'total_count' => 1,
                'exception_count' => 0,
                'plan_count' => 0,
                'create_time' => '2018-09-26 09:21:09',
                'modify_time' => '2018-09-26 09:21:09',
            ),
            2 => 
            array (
                'id' => 316,
                'warehouse_id' => 171,
                'arrival_warehouse_day' => '2018-09-25',
                'arrival_warehouse_time' => '08:20:52',
                'total_count' => 1,
                'exception_count' => 0,
                'plan_count' => 1,
                'create_time' => '2018-09-26 09:21:11',
                'modify_time' => '2018-09-26 09:22:57',
            ),
            3 => 
            array (
                'id' => 317,
                'warehouse_id' => 172,
                'arrival_warehouse_day' => '2017-11-23',
                'arrival_warehouse_time' => '09:00:00',
                'total_count' => 11,
                'exception_count' => 0,
                'plan_count' => 8,
                'create_time' => '2018-09-28 17:34:19',
                'modify_time' => '2018-09-29 11:00:32',
            ),
            4 => 
            array (
                'id' => 318,
                'warehouse_id' => 173,
                'arrival_warehouse_day' => '2017-11-24',
                'arrival_warehouse_time' => '09:00:00',
                'total_count' => 1,
                'exception_count' => 0,
                'plan_count' => 0,
                'create_time' => '2018-09-28 17:50:16',
                'modify_time' => '2018-09-28 17:50:16',
            ),
            5 => 
            array (
                'id' => 319,
                'warehouse_id' => 174,
                'arrival_warehouse_day' => '2017-11-25',
                'arrival_warehouse_time' => '09:00:00',
                'total_count' => 1,
                'exception_count' => 0,
                'plan_count' => 0,
                'create_time' => '2018-09-28 17:50:16',
                'modify_time' => '2018-09-28 17:50:16',
            ),
            6 => 
            array (
                'id' => 320,
                'warehouse_id' => 178,
                'arrival_warehouse_day' => '2017-11-29',
                'arrival_warehouse_time' => '09:00:00',
                'total_count' => 1,
                'exception_count' => 0,
                'plan_count' => 0,
                'create_time' => '2018-09-28 17:50:19',
                'modify_time' => '2018-09-28 17:50:19',
            ),
            7 => 
            array (
                'id' => 321,
                'warehouse_id' => 172,
                'arrival_warehouse_day' => '2017-11-24',
                'arrival_warehouse_time' => '09:00:00',
                'total_count' => 1,
                'exception_count' => 0,
                'plan_count' => 0,
                'create_time' => '2018-09-28 17:54:10',
                'modify_time' => '2018-09-28 17:54:10',
            ),
            8 => 
            array (
                'id' => 322,
                'warehouse_id' => 172,
                'arrival_warehouse_day' => '2017-11-25',
                'arrival_warehouse_time' => '09:00:00',
                'total_count' => 1,
                'exception_count' => 0,
                'plan_count' => 0,
                'create_time' => '2018-09-28 17:54:10',
                'modify_time' => '2018-09-28 17:54:10',
            ),
            9 => 
            array (
                'id' => 323,
                'warehouse_id' => 172,
                'arrival_warehouse_day' => '2017-11-26',
                'arrival_warehouse_time' => '09:00:00',
                'total_count' => 1,
                'exception_count' => 0,
                'plan_count' => 0,
                'create_time' => '2018-09-28 17:54:11',
                'modify_time' => '2018-09-28 17:54:11',
            ),
            10 => 
            array (
                'id' => 324,
                'warehouse_id' => 172,
                'arrival_warehouse_day' => '2017-11-27',
                'arrival_warehouse_time' => '09:00:00',
                'total_count' => 1,
                'exception_count' => 0,
                'plan_count' => 0,
                'create_time' => '2018-09-28 17:54:11',
                'modify_time' => '2018-09-28 17:54:11',
            ),
            11 => 
            array (
                'id' => 325,
                'warehouse_id' => 172,
                'arrival_warehouse_day' => '2017-11-28',
                'arrival_warehouse_time' => '09:00:00',
                'total_count' => 1,
                'exception_count' => 0,
                'plan_count' => 0,
                'create_time' => '2018-09-28 17:54:12',
                'modify_time' => '2018-09-28 17:54:12',
            ),
            12 => 
            array (
                'id' => 326,
                'warehouse_id' => 172,
                'arrival_warehouse_day' => '2017-11-29',
                'arrival_warehouse_time' => '09:00:00',
                'total_count' => 1,
                'exception_count' => 0,
                'plan_count' => 0,
                'create_time' => '2018-09-28 17:54:13',
                'modify_time' => '2018-09-28 17:54:13',
            ),
            13 => 
            array (
                'id' => 327,
                'warehouse_id' => 172,
                'arrival_warehouse_day' => '2017-11-30',
                'arrival_warehouse_time' => '09:00:00',
                'total_count' => 1,
                'exception_count' => 0,
                'plan_count' => 0,
                'create_time' => '2018-09-28 17:54:13',
                'modify_time' => '2018-09-28 17:54:13',
            ),
        ));
        
        
    }
}