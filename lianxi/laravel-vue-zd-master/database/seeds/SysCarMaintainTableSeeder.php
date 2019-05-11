<?php

use Illuminate\Database\Seeder;

class SysCarMaintainTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_car_maintain')->delete();
        
        \DB::table('sys_car_maintain')->insert(array (
            0 => 
            array (
                'id' => 1,
                'company_id' => 14,
                'title' => NULL,
                'code' => '123',
                'cost' => '0.00',
                'car_id' => 379,
                'driver_id' => 5473,
                'date' => '2017-09-01',
                'desc' => NULL,
                'mileage' => 5000,
                'files' => '["","",""]',
                'create_time' => '2017-09-15 13:59:32',
                'modify_time' => '2017-09-15 13:59:32',
            ),
            1 => 
            array (
                'id' => 2,
                'company_id' => 14,
                'title' => NULL,
                'code' => '213412312',
                'cost' => '522.00',
                'car_id' => 415,
                'driver_id' => 0,
                'date' => '2017-03-09',
                'desc' => NULL,
                'mileage' => 3,
                'files' => NULL,
                'create_time' => '2017-09-15 14:03:01',
                'modify_time' => '2017-09-15 14:03:01',
            ),
            2 => 
            array (
                'id' => 3,
                'company_id' => 14,
                'title' => NULL,
                'code' => '213412312',
                'cost' => '522.00',
                'car_id' => 415,
                'driver_id' => 0,
                'date' => '2017-03-09',
                'desc' => NULL,
                'mileage' => 3,
                'files' => NULL,
                'create_time' => '2017-09-15 14:03:28',
                'modify_time' => '2017-09-15 14:03:28',
            ),
            3 => 
            array (
                'id' => 4,
                'company_id' => 14,
                'title' => NULL,
                'code' => '213412322',
                'cost' => '631.00',
                'car_id' => 415,
                'driver_id' => 0,
                'date' => '2017-03-09',
                'desc' => NULL,
                'mileage' => 2,
                'files' => NULL,
                'create_time' => '2017-09-15 14:03:28',
                'modify_time' => '2017-09-15 14:03:28',
            ),
            4 => 
            array (
                'id' => 5,
                'company_id' => 14,
                'title' => NULL,
                'code' => '213412312',
                'cost' => '522.00',
                'car_id' => 415,
                'driver_id' => 0,
                'date' => '2017-03-09',
                'desc' => NULL,
                'mileage' => 3,
                'files' => NULL,
                'create_time' => '2017-09-15 14:04:12',
                'modify_time' => '2017-09-15 14:04:12',
            ),
            5 => 
            array (
                'id' => 6,
                'company_id' => 14,
                'title' => NULL,
                'code' => '213412322',
                'cost' => '631.00',
                'car_id' => 415,
                'driver_id' => 0,
                'date' => '2017-03-09',
                'desc' => NULL,
                'mileage' => 2,
                'files' => NULL,
                'create_time' => '2017-09-15 14:04:12',
                'modify_time' => '2017-09-15 14:04:12',
            ),
        ));
        
        
    }
}