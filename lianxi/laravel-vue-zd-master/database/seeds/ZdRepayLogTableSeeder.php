<?php

use Illuminate\Database\Seeder;

class ZdRepayLogTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('zd_repay_log')->delete();
        
        \DB::table('zd_repay_log')->insert(array (
            0 => 
            array (
                'id' => 21,
                'merchant_id' => 115,
                'repay_money' => '150.00',
                'trade_no' => NULL,
                'payee' => NULL,
                'type' => 1,
                'remark' => '',
                'create_time' => '2018-07-27 10:24:07',
                'modify_time' => '2018-07-27 10:24:07',
            ),
            1 => 
            array (
                'id' => 22,
                'merchant_id' => 114,
                'repay_money' => '250.00',
                'trade_no' => NULL,
                'payee' => NULL,
                'type' => 1,
                'remark' => '',
                'create_time' => '2018-07-27 10:24:18',
                'modify_time' => '2018-07-27 10:24:18',
            ),
            2 => 
            array (
                'id' => 23,
                'merchant_id' => 113,
                'repay_money' => '2500.00',
                'trade_no' => NULL,
                'payee' => NULL,
                'type' => 1,
                'remark' => '',
                'create_time' => '2018-07-27 10:25:05',
                'modify_time' => '2018-07-27 10:25:05',
            ),
            3 => 
            array (
                'id' => 24,
                'merchant_id' => 108,
                'repay_money' => '1.00',
                'trade_no' => NULL,
                'payee' => NULL,
                'type' => 1,
                'remark' => '111',
                'create_time' => '2018-08-06 17:18:21',
                'modify_time' => '2018-08-06 17:18:21',
            ),
            4 => 
            array (
                'id' => 25,
                'merchant_id' => 108,
                'repay_money' => '1.00',
                'trade_no' => NULL,
                'payee' => NULL,
                'type' => 1,
                'remark' => '111',
                'create_time' => '2018-08-06 17:18:58',
                'modify_time' => '2018-08-06 17:18:58',
            ),
        ));
        
        
    }
}