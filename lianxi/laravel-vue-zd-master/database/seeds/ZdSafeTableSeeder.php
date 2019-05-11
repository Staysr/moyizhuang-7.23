<?php

use Illuminate\Database\Seeder;

class ZdSafeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('zd_safe')->delete();
        
        \DB::table('zd_safe')->insert(array (
            0 => 
            array (
                'id' => 1,
                'type' => 1,
                'title' => '测试商业险',
                'safe_fee' => '5.00',
                'is_per' => 0,
                'max_payment' => '5.00',
                'status' => 1,
                'create_time' => '2017-11-27 11:33:00',
                'modify_time' => '2018-10-10 15:15:09',
            ),
            1 => 
            array (
                'id' => 2,
                'type' => 2,
                'title' => '测试司机险',
                'safe_fee' => '3.00',
                'is_per' => 0,
                'max_payment' => '3.00',
                'status' => 1,
                'create_time' => '2017-11-27 11:33:12',
                'modify_time' => '2018-10-09 12:02:48',
            ),
        ));
        
        
    }
}