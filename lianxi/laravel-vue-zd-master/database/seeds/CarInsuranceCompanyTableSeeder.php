<?php

use Illuminate\Database\Seeder;

class CarInsuranceCompanyTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('car_insurance_company')->delete();
        
        \DB::table('car_insurance_company')->insert(array (
            0 => 
            array (
                'id' => 7,
                'name' => '铁道部想妹纸',
                'created_at' => '2018-05-18 16:30:53',
                'updated_at' => '2018-05-28 09:26:29',
            ),
            1 => 
            array (
                'id' => 8,
                'name' => '太平洋货运险',
                'created_at' => '2018-05-18 17:09:55',
                'updated_at' => '2018-05-18 17:09:55',
            ),
            2 => 
            array (
                'id' => 9,
                'name' => '中国平安',
                'created_at' => '2018-05-21 15:39:51',
                'updated_at' => '2018-05-21 15:39:51',
            ),
            3 => 
            array (
                'id' => 10,
                'name' => '全国保',
                'created_at' => '2018-05-24 16:16:19',
                'updated_at' => '2018-05-24 16:16:19',
            ),
            4 => 
            array (
                'id' => 11,
                'name' => '没有删除按钮',
                'created_at' => '2018-05-28 12:06:14',
                'updated_at' => '2018-05-28 12:06:32',
            ),
            5 => 
            array (
                'id' => 12,
                'name' => '测试保险公司1',
                'created_at' => '2018-05-31 10:44:55',
                'updated_at' => '2018-05-31 10:45:21',
            ),
            6 => 
            array (
                'id' => 13,
                'name' => '好运来保险公司',
                'created_at' => '2018-06-06 14:15:23',
                'updated_at' => '2018-06-06 14:15:23',
            ),
        ));
        
        
    }
}