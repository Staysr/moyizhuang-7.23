<?php

use Illuminate\Database\Seeder;

class BaseDriverLogsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('base_driver_logs')->delete();
        
        \DB::table('base_driver_logs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'operater_type' => 0,
                'operater' => 7,
                'driver_id' => 5368,
                'before_status' => 0,
                'after_status' => 4,
                'remark' => '饼干吃',
                'create_time' => '2018-09-05 17:31:52',
                'modify_time' => '2018-09-05 17:31:52',
            ),
            1 => 
            array (
                'id' => 2,
                'operater_type' => 0,
                'operater' => 7,
                'driver_id' => 5369,
                'before_status' => 0,
                'after_status' => 4,
                'remark' => '佛挡杀佛',
                'create_time' => '2018-09-11 15:56:13',
                'modify_time' => '2018-09-11 15:56:13',
            ),
            2 => 
            array (
                'id' => 3,
                'operater_type' => 0,
                'operater' => 49,
                'driver_id' => 5405,
                'before_status' => 0,
                'after_status' => 3,
                'remark' => '测试1',
                'create_time' => '2018-09-17 09:56:43',
                'modify_time' => '2018-09-17 09:56:43',
            ),
            3 => 
            array (
                'id' => 4,
                'operater_type' => 0,
                'operater' => 49,
                'driver_id' => 5405,
                'before_status' => 0,
                'after_status' => 4,
                'remark' => '测试2',
                'create_time' => '2018-09-17 09:57:24',
                'modify_time' => '2018-09-17 09:57:24',
            ),
            4 => 
            array (
                'id' => 5,
                'operater_type' => 0,
                'operater' => 7,
                'driver_id' => 5499,
                'before_status' => 0,
                'after_status' => 3,
                'remark' => '司机拉私单',
                'create_time' => '2018-09-19 16:01:05',
                'modify_time' => '2018-09-19 16:01:05',
            ),
            5 => 
            array (
                'id' => 6,
                'operater_type' => 0,
                'operater' => 7,
                'driver_id' => 5410,
                'before_status' => 0,
                'after_status' => 3,
                'remark' => '挖的我的',
                'create_time' => '2018-09-19 17:00:50',
                'modify_time' => '2018-09-19 17:00:50',
            ),
            6 => 
            array (
                'id' => 7,
                'operater_type' => 0,
                'operater' => 7,
                'driver_id' => 5410,
                'before_status' => 0,
                'after_status' => 4,
                'remark' => '的冯绍峰',
                'create_time' => '2018-09-19 17:01:09',
                'modify_time' => '2018-09-19 17:01:09',
            ),
        ));
        
        
    }
}