<?php

use Illuminate\Database\Seeder;

class BaseDriverOrderListTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('base_driver_order_list')->delete();
        
        \DB::table('base_driver_order_list')->insert(array (
            0 => 
            array (
                'id' => 3,
                'driver_id' => 5372,
                'order_ids' => '159917,159918,159920',
                'create_time' => '2017-07-04 16:39:14',
                'modify_time' => '2017-07-04 17:10:49',
            ),
            1 => 
            array (
                'id' => 4,
                'driver_id' => 5463,
                'order_ids' => '',
                'create_time' => '2017-07-06 15:27:13',
                'modify_time' => '2017-07-06 15:39:30',
            ),
            2 => 
            array (
                'id' => 5,
                'driver_id' => 5462,
                'order_ids' => '160003,160004,160005',
                'create_time' => '2017-07-06 15:33:17',
                'modify_time' => '2017-07-06 17:12:35',
            ),
            3 => 
            array (
                'id' => 6,
                'driver_id' => 5464,
                'order_ids' => '160006',
                'create_time' => '2017-07-06 15:54:31',
                'modify_time' => '2017-07-06 17:20:17',
            ),
            4 => 
            array (
                'id' => 7,
                'driver_id' => 5413,
                'order_ids' => '160011',
                'create_time' => '2017-07-06 17:33:11',
                'modify_time' => '2017-07-06 17:55:33',
            ),
            5 => 
            array (
                'id' => 8,
                'driver_id' => 5469,
                'order_ids' => '160223,160224',
                'create_time' => '2017-08-03 10:32:52',
                'modify_time' => NULL,
            ),
            6 => 
            array (
                'id' => 9,
                'driver_id' => 5486,
                'order_ids' => '',
                'create_time' => '2017-09-14 14:33:08',
                'modify_time' => '2017-09-14 15:41:53',
            ),
            7 => 
            array (
                'id' => 10,
                'driver_id' => 5377,
                'order_ids' => '',
                'create_time' => '2017-09-14 16:38:17',
                'modify_time' => '2018-04-28 14:36:50',
            ),
            8 => 
            array (
                'id' => 11,
                'driver_id' => 5381,
                'order_ids' => '160261,160603,160608',
                'create_time' => '2017-09-21 13:56:52',
                'modify_time' => NULL,
            ),
            9 => 
            array (
                'id' => 12,
                'driver_id' => 5411,
                'order_ids' => '160769',
                'create_time' => '2017-09-26 14:02:57',
                'modify_time' => '2018-04-11 14:39:15',
            ),
            10 => 
            array (
                'id' => 13,
                'driver_id' => 5374,
                'order_ids' => '160979',
                'create_time' => '2017-12-06 10:55:10',
                'modify_time' => '2017-12-07 16:56:05',
            ),
            11 => 
            array (
                'id' => 14,
                'driver_id' => 5484,
                'order_ids' => '161493',
                'create_time' => '2017-12-21 16:13:09',
                'modify_time' => '2018-01-09 10:18:44',
            ),
            12 => 
            array (
                'id' => 15,
                'driver_id' => 5483,
                'order_ids' => '161666',
                'create_time' => '2017-12-21 16:20:38',
                'modify_time' => '2018-01-09 10:55:57',
            ),
            13 => 
            array (
                'id' => 16,
                'driver_id' => 5485,
                'order_ids' => '',
                'create_time' => '2017-12-22 14:36:44',
                'modify_time' => '2018-01-09 10:26:07',
            ),
        ));
        
        
    }
}