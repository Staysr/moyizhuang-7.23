<?php

use Illuminate\Database\Seeder;

class MallProductCouponsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('mall_product_coupons')->delete();
        
        \DB::table('mall_product_coupons')->insert(array (
            0 => 
            array (
                'product_id' => 12,
                'coupons_id' => 307,
            ),
            1 => 
            array (
                'product_id' => 15,
                'coupons_id' => 294,
            ),
            2 => 
            array (
                'product_id' => 16,
                'coupons_id' => 6,
            ),
            3 => 
            array (
                'product_id' => 18,
                'coupons_id' => 6,
            ),
            4 => 
            array (
                'product_id' => 20,
                'coupons_id' => 376,
            ),
            5 => 
            array (
                'product_id' => 21,
                'coupons_id' => 377,
            ),
            6 => 
            array (
                'product_id' => 22,
                'coupons_id' => 376,
            ),
            7 => 
            array (
                'product_id' => 24,
                'coupons_id' => 378,
            ),
            8 => 
            array (
                'product_id' => 27,
                'coupons_id' => 379,
            ),
            9 => 
            array (
                'product_id' => 28,
                'coupons_id' => 380,
            ),
            10 => 
            array (
                'product_id' => 30,
                'coupons_id' => 375,
            ),
            11 => 
            array (
                'product_id' => 31,
                'coupons_id' => 376,
            ),
        ));
        
        
    }
}