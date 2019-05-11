<?php

use Illuminate\Database\Seeder;

class BaseMerchantStatisticsLogTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('base_merchant_statistics_log')->delete();
        
        \DB::table('base_merchant_statistics_log')->insert(array (
            0 => 
            array (
                'id' => 5,
                'month_id' => 43,
                'user_id' => 7,
                'remark' => '标记为已提现',
                'create_time' => '2018-07-16 10:55:03',
                'modify_time' => '2018-07-16 10:55:03',
            ),
            1 => 
            array (
                'id' => 6,
                'month_id' => 44,
                'user_id' => 7,
                'remark' => '标记为已提现',
                'create_time' => '2018-07-16 10:55:08',
                'modify_time' => '2018-07-16 10:55:08',
            ),
            2 => 
            array (
                'id' => 7,
                'month_id' => 41,
                'user_id' => 7,
                'remark' => '标记为已提现',
                'create_time' => '2018-07-16 11:02:28',
                'modify_time' => '2018-07-16 11:02:28',
            ),
            3 => 
            array (
                'id' => 8,
                'month_id' => 36,
                'user_id' => 7,
                'remark' => '标记为已提现',
                'create_time' => '2018-07-16 11:27:41',
                'modify_time' => '2018-07-16 11:27:41',
            ),
            4 => 
            array (
                'id' => 9,
                'month_id' => 39,
                'user_id' => 7,
                'remark' => '标记为已提现',
                'create_time' => '2018-07-16 11:58:51',
                'modify_time' => '2018-07-16 11:58:51',
            ),
            5 => 
            array (
                'id' => 10,
                'month_id' => 39,
                'user_id' => 7,
                'remark' => '标记为未提现',
                'create_time' => '2018-07-16 11:58:59',
                'modify_time' => '2018-07-16 11:58:59',
            ),
        ));
        
        
    }
}