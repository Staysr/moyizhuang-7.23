<?php

use Illuminate\Database\Seeder;

class BaseClientRulerTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('base_client_ruler')->delete();
        
        \DB::table('base_client_ruler')->insert(array (
            0 => 
            array (
                'id' => 1,
                'level_name' => '普通会员',
                'start_growth' => 0,
                'end_growth' => 19,
                'growth_speed' => '1.0',
                'connect_driver_count' => 1,
                'create_time' => '2018-07-25 10:40:11',
                'modify_time' => '2018-09-17 19:52:25',
            ),
            1 => 
            array (
                'id' => 2,
                'level_name' => '青铜会员',
                'start_growth' => 20,
                'end_growth' => 49,
                'growth_speed' => '1.2',
                'connect_driver_count' => 3,
                'create_time' => '2018-07-25 10:40:11',
                'modify_time' => '2018-09-17 19:52:25',
            ),
            2 => 
            array (
                'id' => 3,
                'level_name' => '白银会员',
                'start_growth' => 50,
                'end_growth' => 69,
                'growth_speed' => '1.6',
                'connect_driver_count' => 5,
                'create_time' => '2018-07-25 10:40:11',
                'modify_time' => '2018-09-17 19:52:25',
            ),
            3 => 
            array (
                'id' => 4,
                'level_name' => '黄金会员',
                'start_growth' => 70,
                'end_growth' => 79,
                'growth_speed' => '1.8',
                'connect_driver_count' => 8,
                'create_time' => '2018-07-25 10:40:11',
                'modify_time' => '2018-09-17 19:52:25',
            ),
            4 => 
            array (
                'id' => 5,
                'level_name' => '钻石会员',
                'start_growth' => 80,
                'end_growth' => 10000000,
                'growth_speed' => '2.0',
                'connect_driver_count' => 9,
                'create_time' => '2018-07-25 10:40:11',
                'modify_time' => '2018-09-17 19:52:25',
            ),
        ));
        
        
    }
}