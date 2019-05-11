<?php

use Illuminate\Database\Seeder;

class MallReceiptTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('mall_receipt')->delete();
        
        \DB::table('mall_receipt')->insert(array (
            0 => 
            array (
                'id' => 40,
                'client_id' => 21963,
                'receipt_name' => '测试',
                'receipt_phone' => '17620496365',
                'receipt_address' => '中州大厦',
                'create_time' => '2018-08-28 15:52:37',
                'modify_time' => '2018-08-29 11:52:20',
            ),
            1 => 
            array (
                'id' => 42,
                'client_id' => 21900,
                'receipt_name' => '我',
                'receipt_phone' => '11111111111',
                'receipt_address' => '我的人都有',
                'create_time' => '2018-08-30 15:18:07',
                'modify_time' => '2018-09-29 09:38:01',
            ),
            2 => 
            array (
                'id' => 43,
                'client_id' => 21800,
                'receipt_name' => '测试',
                'receipt_phone' => '13410425217',
                'receipt_address' => '就瞬间觉得简单哈哈哈哈',
                'create_time' => '2018-08-30 15:44:43',
                'modify_time' => '2018-09-21 17:08:03',
            ),
            3 => 
            array (
                'id' => 44,
                'client_id' => 21894,
                'receipt_name' => '我',
                'receipt_phone' => '12457545454',
                'receipt_address' => '你的',
                'create_time' => '2018-08-30 16:17:06',
                'modify_time' => NULL,
            ),
            4 => 
            array (
                'id' => 46,
                'client_id' => 21804,
                'receipt_name' => '何世强',
                'receipt_phone' => '15327276711',
                'receipt_address' => '广东省中医院',
                'create_time' => '2018-09-05 11:17:09',
                'modify_time' => '2018-09-17 10:33:03',
            ),
            5 => 
            array (
                'id' => 49,
                'client_id' => 21817,
                'receipt_name' => '何',
                'receipt_phone' => '13510525935',
                'receipt_address' => '深圳市南山区白石洲东四坊800栋，京基百纳',
                'create_time' => '2018-09-12 16:04:44',
                'modify_time' => '2018-09-15 16:15:43',
            ),
            6 => 
            array (
                'id' => 51,
                'client_id' => 21816,
                'receipt_name' => '华为',
                'receipt_phone' => '13537580621',
                'receipt_address' => '11',
                'create_time' => '2018-09-14 18:53:52',
                'modify_time' => '2018-09-15 10:01:44',
            ),
        ));
        
        
    }
}