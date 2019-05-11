<?php

use Illuminate\Database\Seeder;

class MallProductLogsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('mall_product_logs')->delete();
        
        \DB::table('mall_product_logs')->insert(array (
            0 => 
            array (
                'id' => 6,
                'product_id' => 12,
                'user_id' => 7,
                'remark' => '初始库存为2',
                'create_date' => '2018-08-28 11:53:46',
                'modify_time' => NULL,
            ),
            1 => 
            array (
                'id' => 7,
                'product_id' => 13,
                'user_id' => 7,
                'remark' => '初始库存为3',
                'create_date' => '2018-08-28 14:25:32',
                'modify_time' => NULL,
            ),
            2 => 
            array (
                'id' => 8,
                'product_id' => 14,
                'user_id' => 7,
                'remark' => '初始库存为2',
                'create_date' => '2018-08-28 15:09:04',
                'modify_time' => NULL,
            ),
            3 => 
            array (
                'id' => 9,
                'product_id' => 15,
                'user_id' => 49,
                'remark' => '初始库存为5',
                'create_date' => '2018-08-28 15:14:33',
                'modify_time' => NULL,
            ),
            4 => 
            array (
                'id' => 10,
                'product_id' => 16,
                'user_id' => 49,
                'remark' => '初始库存为1',
                'create_date' => '2018-08-29 14:47:29',
                'modify_time' => NULL,
            ),
            5 => 
            array (
                'id' => 11,
                'product_id' => 17,
                'user_id' => 49,
                'remark' => '初始库存为1',
                'create_date' => '2018-08-29 15:10:27',
                'modify_time' => NULL,
            ),
            6 => 
            array (
                'id' => 12,
                'product_id' => 18,
                'user_id' => 49,
                'remark' => '初始库存为2',
                'create_date' => '2018-08-29 16:00:44',
                'modify_time' => NULL,
            ),
            7 => 
            array (
                'id' => 13,
                'product_id' => 18,
                'user_id' => 49,
                'remark' => '减少库存2',
                'create_date' => '2018-08-29 16:03:21',
                'modify_time' => NULL,
            ),
            8 => 
            array (
                'id' => 14,
                'product_id' => 18,
                'user_id' => 49,
                'remark' => '增加库存1',
                'create_date' => '2018-08-29 16:04:20',
                'modify_time' => NULL,
            ),
            9 => 
            array (
                'id' => 15,
                'product_id' => 19,
                'user_id' => 49,
                'remark' => '初始库存为2',
                'create_date' => '2018-08-30 14:38:52',
                'modify_time' => NULL,
            ),
            10 => 
            array (
                'id' => 16,
                'product_id' => 19,
                'user_id' => 49,
                'remark' => '增加库存1',
                'create_date' => '2018-08-30 16:16:40',
                'modify_time' => NULL,
            ),
            11 => 
            array (
                'id' => 17,
                'product_id' => 18,
                'user_id' => 49,
                'remark' => '增加库存10',
                'create_date' => '2018-08-31 09:19:59',
                'modify_time' => NULL,
            ),
            12 => 
            array (
                'id' => 18,
                'product_id' => 20,
                'user_id' => 49,
                'remark' => '初始库存为5',
                'create_date' => '2018-08-31 15:00:26',
                'modify_time' => NULL,
            ),
            13 => 
            array (
                'id' => 19,
                'product_id' => 21,
                'user_id' => 7,
                'remark' => '初始库存为4',
                'create_date' => '2018-08-31 15:07:21',
                'modify_time' => NULL,
            ),
            14 => 
            array (
                'id' => 20,
                'product_id' => 22,
                'user_id' => 7,
                'remark' => '初始库存为1',
                'create_date' => '2018-09-04 09:46:23',
                'modify_time' => NULL,
            ),
            15 => 
            array (
                'id' => 21,
                'product_id' => 22,
                'user_id' => 7,
                'remark' => '增加库存1',
                'create_date' => '2018-09-04 10:24:55',
                'modify_time' => NULL,
            ),
            16 => 
            array (
                'id' => 22,
                'product_id' => 22,
                'user_id' => 7,
                'remark' => '减少库存1',
                'create_date' => '2018-09-04 10:25:24',
                'modify_time' => NULL,
            ),
            17 => 
            array (
                'id' => 23,
                'product_id' => 12,
                'user_id' => 7,
                'remark' => '增加库存2',
                'create_date' => '2018-09-07 17:28:25',
                'modify_time' => NULL,
            ),
            18 => 
            array (
                'id' => 24,
                'product_id' => 23,
                'user_id' => 7,
                'remark' => '初始库存为2',
                'create_date' => '2018-09-12 16:03:18',
                'modify_time' => NULL,
            ),
            19 => 
            array (
                'id' => 25,
                'product_id' => 24,
                'user_id' => 7,
                'remark' => '初始库存为1',
                'create_date' => '2018-09-12 16:10:07',
                'modify_time' => NULL,
            ),
            20 => 
            array (
                'id' => 26,
                'product_id' => 25,
                'user_id' => 7,
                'remark' => '初始库存为2',
                'create_date' => '2018-09-14 18:27:07',
                'modify_time' => NULL,
            ),
            21 => 
            array (
                'id' => 27,
                'product_id' => 26,
                'user_id' => 7,
                'remark' => '初始库存为2',
                'create_date' => '2018-09-14 18:51:15',
                'modify_time' => NULL,
            ),
            22 => 
            array (
                'id' => 28,
                'product_id' => 27,
                'user_id' => 7,
                'remark' => '初始库存为200',
                'create_date' => '2018-09-15 12:08:35',
                'modify_time' => NULL,
            ),
            23 => 
            array (
                'id' => 29,
                'product_id' => 28,
                'user_id' => 7,
                'remark' => '初始库存为500',
                'create_date' => '2018-09-15 15:07:16',
                'modify_time' => NULL,
            ),
            24 => 
            array (
                'id' => 30,
                'product_id' => 29,
                'user_id' => 7,
                'remark' => '初始库存为100',
                'create_date' => '2018-09-15 15:23:51',
                'modify_time' => NULL,
            ),
            25 => 
            array (
                'id' => 31,
                'product_id' => 29,
                'user_id' => 7,
                'remark' => '增加库存2',
                'create_date' => '2018-09-15 15:53:07',
                'modify_time' => NULL,
            ),
            26 => 
            array (
                'id' => 32,
                'product_id' => 30,
                'user_id' => 7,
                'remark' => '初始库存为23',
                'create_date' => '2018-09-17 20:22:37',
                'modify_time' => NULL,
            ),
            27 => 
            array (
                'id' => 33,
                'product_id' => 31,
                'user_id' => 49,
                'remark' => '初始库存为10',
                'create_date' => '2018-09-21 17:43:37',
                'modify_time' => NULL,
            ),
            28 => 
            array (
                'id' => 34,
                'product_id' => 32,
                'user_id' => 49,
                'remark' => '初始库存为1',
                'create_date' => '2018-09-21 17:44:25',
                'modify_time' => NULL,
            ),
        ));
        
        
    }
}