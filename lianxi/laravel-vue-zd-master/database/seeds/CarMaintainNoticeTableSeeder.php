<?php

use Illuminate\Database\Seeder;

class CarMaintainNoticeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('car_maintain_notice')->delete();
        
        \DB::table('car_maintain_notice')->insert(array (
            0 => 
            array (
                'id' => 28,
                'car_type_id' => 1,
                'car_style_id' => 7,
                'mileage' => 100,
                'day' => 2,
                'advance' => 1,
                'notice_status' => 1,
                'driver_notice_status' => 1,
                'description' => '通知保养过期',
                'created_at' => '2018-05-19 11:47:23',
                'updated_at' => '2018-05-19 11:47:23',
            ),
            1 => 
            array (
                'id' => 29,
                'car_type_id' => 2,
                'car_style_id' => 8,
                'mileage' => 500,
                'day' => 3,
                'advance' => 1,
                'notice_status' => 1,
                'driver_notice_status' => 1,
                'description' => '是的冯绍峰第三方',
                'created_at' => '2018-05-19 11:47:57',
                'updated_at' => '2018-05-19 11:47:57',
            ),
            2 => 
            array (
                'id' => 30,
                'car_type_id' => 1,
                'car_style_id' => 6,
                'mileage' => 100,
                'day' => 20,
                'advance' => 2,
                'notice_status' => 1,
                'driver_notice_status' => 1,
                'description' => 'jghtfhtjfhg',
                'created_at' => '2018-05-29 17:00:40',
                'updated_at' => '2018-05-29 17:00:40',
            ),
            3 => 
            array (
                'id' => 31,
                'car_type_id' => 7,
                'car_style_id' => 7,
                'mileage' => 20023,
                'day' => 13,
                'advance' => 5,
                'notice_status' => 1,
                'driver_notice_status' => 1,
                'description' => '环境客户',
                'created_at' => '2018-05-30 10:46:57',
                'updated_at' => '2018-05-31 18:02:46',
            ),
        ));
        
        
    }
}