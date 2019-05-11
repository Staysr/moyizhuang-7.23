<?php

use Illuminate\Database\Seeder;

class SysCarServiceTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_car_service')->delete();
        
        \DB::table('sys_car_service')->insert(array (
            0 => 
            array (
                'id' => 1,
                'company_id' => 14,
                'code' => '170701005',
                'workshop' => '深圳市金添发汽车修配厂',
                'car_id' => 413,
                'driver_id' => 5478,
                'date_start' => '2017-07-01 00:00:00',
                'date_end' => '2017-07-01 23:59:00',
                'cost' => '265',
                'status' => 1,
                'info' => NULL,
                'parts' => NULL,
                'desc' => NULL,
                'files' => NULL,
                'create_time' => '2017-09-13 16:15:22',
                'modify_time' => '2017-09-13 16:15:22',
            ),
            1 => 
            array (
                'id' => 2,
                'company_id' => 14,
                'code' => '170701006',
                'workshop' => '深圳市金添发汽车修配厂',
                'car_id' => 401,
                'driver_id' => 5478,
                'date_start' => '2017-07-01 00:00:00',
                'date_end' => '2017-07-01 23:59:00',
                'cost' => '265',
                'status' => 1,
                'info' => NULL,
                'parts' => NULL,
                'desc' => NULL,
                'files' => NULL,
                'create_time' => '2017-09-13 16:15:22',
                'modify_time' => '2017-09-13 16:15:22',
            ),
            2 => 
            array (
                'id' => 3,
                'company_id' => 14,
                'code' => '170701007',
                'workshop' => '深圳市金添发汽车修配厂',
                'car_id' => 413,
                'driver_id' => 5478,
                'date_start' => '2017-07-01 00:00:00',
                'date_end' => '2017-07-01 23:59:00',
                'cost' => '265',
                'status' => 1,
                'info' => NULL,
                'parts' => NULL,
                'desc' => '换摆臂、前摆臂总成左边',
                'files' => NULL,
                'create_time' => '2017-09-13 16:18:05',
                'modify_time' => '2017-09-13 16:18:05',
            ),
            3 => 
            array (
                'id' => 4,
                'company_id' => 14,
                'code' => '170701008',
                'workshop' => '深圳市金添发汽车修配厂',
                'car_id' => 401,
                'driver_id' => 5478,
                'date_start' => '2017-07-01 00:00:00',
                'date_end' => '2017-07-01 23:59:00',
                'cost' => '265',
                'status' => 1,
                'info' => NULL,
                'parts' => NULL,
                'desc' => 'H4灯泡、刹车灯泡2个',
                'files' => NULL,
                'create_time' => '2017-09-13 16:18:05',
                'modify_time' => '2017-09-13 16:18:05',
            ),
        ));
        
        
    }
}