<?php

use Illuminate\Database\Seeder;

class ZdMerchantAccountTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('zd_merchant_account')->delete();
        
        \DB::table('zd_merchant_account')->insert(array (
            0 => 
            array (
                'id' => 22,
                'merchant_id' => 129,
                'account' => '0.00',
                'latest_repayment_time' => NULL,
                'create_time' => '2018-07-24 16:14:54',
                'modify_time' => '2018-07-24 16:14:54',
            ),
            1 => 
            array (
                'id' => 23,
                'merchant_id' => 130,
                'account' => '0.00',
                'latest_repayment_time' => NULL,
                'create_time' => '2018-07-25 11:24:52',
                'modify_time' => '2018-07-25 11:24:52',
            ),
            2 => 
            array (
                'id' => 24,
                'merchant_id' => 131,
                'account' => '0.00',
                'latest_repayment_time' => NULL,
                'create_time' => '2018-07-25 12:10:41',
                'modify_time' => '2018-07-25 12:10:41',
            ),
            3 => 
            array (
                'id' => 25,
                'merchant_id' => 132,
                'account' => '0.00',
                'latest_repayment_time' => NULL,
                'create_time' => '2018-07-25 15:23:32',
                'modify_time' => '2018-07-25 15:23:32',
            ),
            4 => 
            array (
                'id' => 26,
                'merchant_id' => 133,
                'account' => '0.00',
                'latest_repayment_time' => NULL,
                'create_time' => '2018-09-26 16:11:15',
                'modify_time' => '2018-09-26 16:11:15',
            ),
            5 => 
            array (
                'id' => 27,
                'merchant_id' => 134,
                'account' => '0.00',
                'latest_repayment_time' => NULL,
                'create_time' => '2018-09-26 16:50:53',
                'modify_time' => '2018-09-26 16:50:53',
            ),
            6 => 
            array (
                'id' => 28,
                'merchant_id' => 135,
                'account' => '0.00',
                'latest_repayment_time' => NULL,
                'create_time' => '2018-09-26 16:51:01',
                'modify_time' => '2018-09-26 16:51:01',
            ),
            7 => 
            array (
                'id' => 29,
                'merchant_id' => 136,
                'account' => '0.00',
                'latest_repayment_time' => NULL,
                'create_time' => '2018-09-26 16:59:11',
                'modify_time' => '2018-09-26 16:59:11',
            ),
            8 => 
            array (
                'id' => 30,
                'merchant_id' => 137,
                'account' => '0.00',
                'latest_repayment_time' => NULL,
                'create_time' => '2018-09-26 17:08:43',
                'modify_time' => '2018-09-26 17:08:43',
            ),
        ));
        
        
    }
}