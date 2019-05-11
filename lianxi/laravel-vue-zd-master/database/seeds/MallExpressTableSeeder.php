<?php

use Illuminate\Database\Seeder;

class MallExpressTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('mall_express')->delete();
        
        \DB::table('mall_express')->insert(array (
            0 => 
            array (
                'id' => 13,
                'express_name' => '圆通',
                'create_time' => '2018-09-03 17:27:54',
                'delete_time' => '2018-09-04 10:47:28',
            ),
            1 => 
            array (
                'id' => 14,
                'express_name' => '中通',
                'create_time' => '2018-09-03 17:28:03',
                'delete_time' => '2018-09-11 15:24:31',
            ),
            2 => 
            array (
                'id' => 15,
                'express_name' => '顺丰',
                'create_time' => '2018-09-03 17:28:26',
                'delete_time' => NULL,
            ),
            3 => 
            array (
                'id' => 16,
                'express_name' => '申通',
                'create_time' => '2018-09-05 17:16:51',
                'delete_time' => '2018-09-05 17:16:57',
            ),
            4 => 
            array (
                'id' => 17,
                'express_name' => '申通',
                'create_time' => '2018-09-05 17:17:01',
                'delete_time' => NULL,
            ),
            5 => 
            array (
                'id' => 18,
                'express_name' => '中通',
                'create_time' => '2018-09-11 15:24:45',
                'delete_time' => NULL,
            ),
        ));
        
        
    }
}