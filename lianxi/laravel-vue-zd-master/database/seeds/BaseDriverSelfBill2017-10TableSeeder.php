<?php

use Illuminate\Database\Seeder;

class BaseDriverSelfBill2017-10TableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('base_driver_self_bill_2017-10')->delete();
        
        \DB::table('base_driver_self_bill_2017-10')->insert(array (
            0 => 
            array (
                'id' => 1,
                'driver_id' => 5401,
                'little_id' => 0,
                'big_id' => 5401,
                'total_pay' => 1,
                'total_cancel' => 0,
                'total_pay_fee' => '90.01',
                'total_cancel_fee' => '0.00',
                'date' => '2017-10-13',
            ),
            1 => 
            array (
                'id' => 2,
                'driver_id' => 5403,
                'little_id' => 5403,
                'big_id' => 5467,
                'total_pay' => 1,
                'total_cancel' => 0,
                'total_pay_fee' => '358.43',
                'total_cancel_fee' => '0.00',
                'date' => '2017-10-13',
            ),
            2 => 
            array (
                'id' => 3,
                'driver_id' => 5478,
                'little_id' => 5370,
                'big_id' => 5436,
                'total_pay' => 1,
                'total_cancel' => 0,
                'total_pay_fee' => '33.00',
                'total_cancel_fee' => '0.00',
                'date' => '2017-10-13',
            ),
            3 => 
            array (
                'id' => 4,
                'driver_id' => 5479,
                'little_id' => 5403,
                'big_id' => 5467,
                'total_pay' => 1,
                'total_cancel' => 0,
                'total_pay_fee' => '79.13',
                'total_cancel_fee' => '0.00',
                'date' => '2017-10-13',
            ),
            4 => 
            array (
                'id' => 5,
                'driver_id' => 5424,
                'little_id' => 5423,
                'big_id' => 5436,
                'total_pay' => 1,
                'total_cancel' => 0,
                'total_pay_fee' => '103.25',
                'total_cancel_fee' => '0.00',
                'date' => '2017-10-16',
            ),
            5 => 
            array (
                'id' => 6,
                'driver_id' => 5405,
                'little_id' => 5403,
                'big_id' => 5467,
                'total_pay' => 1,
                'total_cancel' => 0,
                'total_pay_fee' => '581.80',
                'total_cancel_fee' => '0.00',
                'date' => '2017-10-16',
            ),
        ));
        
        
    }
}