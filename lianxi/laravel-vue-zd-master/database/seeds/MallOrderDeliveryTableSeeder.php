<?php

use Illuminate\Database\Seeder;

class MallOrderDeliveryTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('mall_order_delivery')->delete();
        
        \DB::table('mall_order_delivery')->insert(array (
            0 => 
            array (
                'id' => 14,
                'mall_order_id' => 64,
                'remark' => NULL,
                'delivery_time' => '2018-08-30 16:22:39',
                'pic' => '/php-web/2018-08-30/20180830162303_32830.jpg',
                'create_time' => '2018-08-30 16:23:03',
                'modify_time' => '2018-08-30 16:23:03',
            ),
            1 => 
            array (
                'id' => 15,
                'mall_order_id' => 39,
                'remark' => NULL,
                'delivery_time' => '2018-09-07 17:40:32',
                'pic' => '/php-web/2018-09-07/20180907174044_88687.jpg',
                'create_time' => '2018-09-07 17:40:44',
                'modify_time' => '2018-09-07 17:40:44',
            ),
            2 => 
            array (
                'id' => 16,
                'mall_order_id' => 85,
                'remark' => NULL,
                'delivery_time' => '2018-09-07 17:41:39',
                'pic' => '/php-web/2018-09-07/20180907174147_59455.jpg',
                'create_time' => '2018-09-07 17:41:47',
                'modify_time' => '2018-09-07 17:41:47',
            ),
            3 => 
            array (
                'id' => 17,
                'mall_order_id' => 84,
                'remark' => NULL,
                'delivery_time' => '2018-09-10 09:12:27',
                'pic' => '/php-web/2018-09-10/20180910091235_16376.jpg',
                'create_time' => '2018-09-10 09:12:35',
                'modify_time' => '2018-09-10 09:12:35',
            ),
            4 => 
            array (
                'id' => 18,
                'mall_order_id' => 98,
                'remark' => NULL,
                'delivery_time' => '2018-09-12 15:57:08',
                'pic' => '/php-web/2018-09-12/20180912155720_11782.png',
                'create_time' => '2018-09-12 15:57:20',
                'modify_time' => '2018-09-12 15:57:20',
            ),
            5 => 
            array (
                'id' => 19,
                'mall_order_id' => 100,
                'remark' => NULL,
                'delivery_time' => '2018-09-12 16:06:06',
                'pic' => '/php-web/2018-09-12/20180912160611_62019.png',
                'create_time' => '2018-09-12 16:06:11',
                'modify_time' => '2018-09-12 16:06:11',
            ),
            6 => 
            array (
                'id' => 20,
                'mall_order_id' => 105,
                'remark' => NULL,
                'delivery_time' => '2018-09-15 10:04:12',
                'pic' => '/php-web/2018-09-15/20180915100424_61181.jpg',
                'create_time' => '2018-09-15 10:04:24',
                'modify_time' => '2018-09-15 10:04:24',
            ),
            7 => 
            array (
                'id' => 21,
                'mall_order_id' => 109,
                'remark' => NULL,
                'delivery_time' => '2018-09-15 16:18:33',
                'pic' => '/php-web/2018-09-15/20180915161839_11249.png',
                'create_time' => '2018-09-15 16:18:39',
                'modify_time' => '2018-09-15 16:18:39',
            ),
        ));
        
        
    }
}