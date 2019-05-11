<?php

use Illuminate\Database\Seeder;

class SysCarSafeCompanyTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_car_safe_company')->delete();
        
        \DB::table('sys_car_safe_company')->insert(array (
            0 => 
            array (
                'id' => 7,
                'name' => '太平洋',
                'company_id' => 11,
                'desc' => '',
                'create_time' => '2017-03-29 15:24:31',
                'modify_time' => '2017-03-29 15:24:31',
            ),
            1 => 
            array (
                'id' => 8,
                'name' => '平安',
                'company_id' => 11,
                'desc' => '',
                'create_time' => '2017-03-29 15:24:53',
                'modify_time' => '2017-03-29 15:24:53',
            ),
            2 => 
            array (
                'id' => 9,
                'name' => '小妹妹保险',
                'company_id' => 12,
                'desc' => '',
                'create_time' => '2017-07-07 15:00:34',
                'modify_time' => '2017-07-07 15:00:34',
            ),
            3 => 
            array (
                'id' => 10,
                'name' => '太平洋',
                'company_id' => 14,
                'desc' => '',
                'create_time' => '2017-09-13 14:03:56',
                'modify_time' => '2017-09-13 14:03:56',
            ),
        ));
        
        
    }
}