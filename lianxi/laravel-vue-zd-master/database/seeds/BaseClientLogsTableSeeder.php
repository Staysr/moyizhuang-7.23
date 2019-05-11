<?php

use Illuminate\Database\Seeder;

class BaseClientLogsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('base_client_logs')->delete();
        
        \DB::table('base_client_logs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'operater_type' => 0,
                'operater' => 7,
                'client_id' => 21820,
                'before_status' => 1,
                'after_status' => 0,
                'remark' => '111',
                'create_time' => '2017-08-14 17:00:44',
                'modify_time' => '2017-08-14 17:00:44',
            ),
            1 => 
            array (
                'id' => 2,
                'operater_type' => 0,
                'operater' => 7,
                'client_id' => 21800,
                'before_status' => 1,
                'after_status' => 0,
                'remark' => '发的光伏发电',
                'create_time' => '2017-09-21 15:55:44',
                'modify_time' => '2017-09-21 15:55:44',
            ),
            2 => 
            array (
                'id' => 3,
                'operater_type' => 0,
                'operater' => 7,
                'client_id' => 21800,
                'before_status' => 0,
                'after_status' => 1,
                'remark' => '6844648648',
                'create_time' => '2017-09-21 17:24:42',
                'modify_time' => '2017-09-21 17:24:42',
            ),
            3 => 
            array (
                'id' => 4,
                'operater_type' => 0,
                'operater' => 7,
                'client_id' => 21800,
                'before_status' => 1,
                'after_status' => 0,
                'remark' => '+-*++*88*',
                'create_time' => '2017-09-21 17:24:58',
                'modify_time' => '2017-09-21 17:24:58',
            ),
            4 => 
            array (
                'id' => 5,
                'operater_type' => 0,
                'operater' => 7,
                'client_id' => 21800,
                'before_status' => 0,
                'after_status' => 1,
                'remark' => '+9898498',
                'create_time' => '2017-09-21 17:25:25',
                'modify_time' => '2017-09-21 17:25:25',
            ),
            5 => 
            array (
                'id' => 6,
                'operater_type' => 0,
                'operater' => 7,
                'client_id' => 21800,
                'before_status' => 1,
                'after_status' => 0,
                'remark' => '984584984',
                'create_time' => '2017-09-21 17:26:06',
                'modify_time' => '2017-09-21 17:26:06',
            ),
            6 => 
            array (
                'id' => 7,
                'operater_type' => 0,
                'operater' => 7,
                'client_id' => 21800,
                'before_status' => 0,
                'after_status' => 1,
                'remark' => '发的个',
                'create_time' => '2017-09-28 11:08:21',
                'modify_time' => '2017-09-28 11:08:21',
            ),
            7 => 
            array (
                'id' => 8,
                'operater_type' => 0,
                'operater' => 7,
                'client_id' => 21820,
                'before_status' => 0,
                'after_status' => 1,
                'remark' => '测试测试',
                'create_time' => '2017-12-28 18:37:17',
                'modify_time' => '2017-12-28 18:37:17',
            ),
        ));
        
        
    }
}