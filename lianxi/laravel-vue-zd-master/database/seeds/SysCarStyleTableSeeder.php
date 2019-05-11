<?php

use Illuminate\Database\Seeder;

class SysCarStyleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_car_style')->delete();
        
        \DB::table('sys_car_style')->insert(array (
            0 => 
            array (
                'id' => 6,
                'car_type_id' => 1,
                'model' => '222',
                'style' => '222',
                'endurance_mileage' => 2222.0,
                'endurance_time' => 2222,
                'create_time' => '2017-03-29 14:17:12',
                'modify_time' => '2017-03-29 14:17:12',
            ),
            1 => 
            array (
                'id' => 7,
                'car_type_id' => 2,
                'model' => '环球牌',
                'style' => '环球牌GZQ5021CCY',
                'endurance_mileage' => 100000.0,
                'endurance_time' => 100000,
                'create_time' => '2017-09-08 11:33:23',
                'modify_time' => '2017-09-08 11:33:50',
            ),
            2 => 
            array (
                'id' => 8,
                'car_type_id' => 7,
                'model' => '环球牌',
                'style' => '环球牌GZQ5022XXY',
                'endurance_mileage' => 100000.0,
                'endurance_time' => 100000,
                'create_time' => '2017-09-08 12:15:57',
                'modify_time' => '2017-09-08 12:15:57',
            ),
            3 => 
            array (
                'id' => 9,
                'car_type_id' => 1,
                'model' => '9527',
                'style' => 'adb',
                'endurance_mileage' => 100.0,
                'endurance_time' => 5000,
                'create_time' => '2018-05-23 11:36:48',
                'modify_time' => '2018-05-23 11:36:48',
            ),
            4 => 
            array (
                'id' => 10,
                'car_type_id' => 1,
                'model' => 'X35',
                'style' => 'H3',
                'endurance_mileage' => 270.0,
                'endurance_time' => 720,
                'create_time' => '2018-07-05 17:07:29',
                'modify_time' => '2018-07-05 17:07:29',
            ),
        ));
        
        
    }
}