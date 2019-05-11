<?php

use Illuminate\Database\Seeder;

class SysCarPeccancyTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_car_peccancy')->delete();
        
        \DB::table('sys_car_peccancy')->insert(array (
            0 => 
            array (
                'id' => 1,
                'company_id' => 14,
                'code' => '111111',
                'date' => '2017-07-17 00:00:00',
                'car_id' => 415,
                'driver_id' => 5480,
                'address' => '北环大道-北环大道沙河东立交西往东',
                'deducting' => 0,
                'fine' => '500.00',
                'status' => 0,
                'files' => NULL,
                'desc' => '机动车逆向行驶的/罚款:200/违法记分:3',
                'create_time' => '2017-09-13 11:48:10',
                'modify_time' => '2017-09-13 11:48:10',
            ),
            1 => 
            array (
                'id' => 2,
                'company_id' => 14,
                'code' => '111112',
                'date' => '2017-07-17 00:00:00',
                'car_id' => 415,
                'driver_id' => 5480,
                'address' => '北环大道-北环大道沙河东立交西往东',
                'deducting' => 0,
                'fine' => '500.00',
                'status' => 1,
                'files' => NULL,
                'desc' => '机动车逆向行驶的/罚款:200/违法记分:3',
                'create_time' => '2017-09-13 11:51:06',
                'modify_time' => '2017-09-13 11:51:06',
            ),
            2 => 
            array (
                'id' => 3,
                'company_id' => 14,
                'code' => '111113',
                'date' => '2017-07-07 00:00:00',
                'car_id' => 415,
                'driver_id' => 5480,
                'address' => '北环大道-北环大道沙河东立交西往东',
                'deducting' => 0,
                'fine' => '500.00',
                'status' => 1,
                'files' => NULL,
                'desc' => '机动车逆向行驶的/罚款:200/违法记分:3',
                'create_time' => '2017-09-13 11:52:54',
                'modify_time' => '2017-09-13 11:52:54',
            ),
        ));
        
        
    }
}