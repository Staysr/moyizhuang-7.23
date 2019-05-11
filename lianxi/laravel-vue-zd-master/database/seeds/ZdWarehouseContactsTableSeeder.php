<?php

use Illuminate\Database\Seeder;

class ZdWarehouseContactsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('zd_warehouse_contacts')->delete();
        
        \DB::table('zd_warehouse_contacts')->insert(array (
            0 => 
            array (
                'id' => 31,
                'warehouse_id' => 113,
                'name' => '吃',
                'phone' => '15012814913',
            ),
            1 => 
            array (
                'id' => 38,
                'warehouse_id' => 114,
                'name' => '贾乃亮',
                'phone' => '13456769467',
            ),
            2 => 
            array (
                'id' => 39,
                'warehouse_id' => 119,
                'name' => '小妹',
                'phone' => '13555555555',
            ),
            3 => 
            array (
                'id' => 40,
                'warehouse_id' => 119,
                'name' => '张飞',
                'phone' => '13585555555',
            ),
            4 => 
            array (
                'id' => 41,
                'warehouse_id' => 119,
                'name' => '李加',
                'phone' => '13655555888',
            ),
            5 => 
            array (
                'id' => 42,
                'warehouse_id' => 119,
                'name' => '亚洲',
                'phone' => '13588888888',
            ),
            6 => 
            array (
                'id' => 43,
                'warehouse_id' => 119,
                'name' => '虹飞',
                'phone' => '13696666666',
            ),
            7 => 
            array (
                'id' => 44,
                'warehouse_id' => 125,
                'name' => '测试1',
                'phone' => '13112345678',
            ),
            8 => 
            array (
                'id' => 45,
                'warehouse_id' => 126,
                'name' => 'fdfdf',
                'phone' => '18676349833',
            ),
            9 => 
            array (
                'id' => 46,
                'warehouse_id' => 135,
                'name' => '廖美婷',
                'phone' => '13823238961',
            ),
            10 => 
            array (
                'id' => 49,
                'warehouse_id' => 137,
                'name' => '李家',
                'phone' => '15572595825',
            ),
            11 => 
            array (
                'id' => 50,
                'warehouse_id' => 136,
                'name' => '张三',
                'phone' => '13510525665',
            ),
            12 => 
            array (
                'id' => 51,
                'warehouse_id' => 138,
                'name' => '袁书芳',
                'phone' => '13716945731',
            ),
            13 => 
            array (
                'id' => 52,
                'warehouse_id' => 139,
                'name' => '陈杨',
                'phone' => '15012814913',
            ),
            14 => 
            array (
                'id' => 53,
                'warehouse_id' => 145,
                'name' => '政治课',
                'phone' => '13266522726',
            ),
            15 => 
            array (
                'id' => 54,
                'warehouse_id' => 155,
                'name' => '李易峰',
                'phone' => '15823568222',
            ),
            16 => 
            array (
                'id' => 58,
                'warehouse_id' => 168,
                'name' => '胡总',
                'phone' => '13431861834',
            ),
            17 => 
            array (
                'id' => 59,
                'warehouse_id' => 168,
                'name' => '图通知我',
                'phone' => '15012121122',
            ),
            18 => 
            array (
                'id' => 60,
                'warehouse_id' => 170,
                'name' => '李四',
                'phone' => '13510255632',
            ),
            19 => 
            array (
                'id' => 62,
                'warehouse_id' => 131,
                'name' => '银行吗',
                'phone' => '13266522726',
            ),
            20 => 
            array (
                'id' => 73,
                'warehouse_id' => 172,
                'name' => '啦啦',
                'phone' => '13666666666',
            ),
            21 => 
            array (
                'id' => 74,
                'warehouse_id' => 172,
                'name' => '啦啦队',
                'phone' => '13416516167',
            ),
            22 => 
            array (
                'id' => 75,
                'warehouse_id' => 172,
                'name' => '银幕',
                'phone' => '13725750396',
            ),
            23 => 
            array (
                'id' => 76,
                'warehouse_id' => 172,
                'name' => '心跳',
                'phone' => '13716919195',
            ),
            24 => 
            array (
                'id' => 77,
                'warehouse_id' => 172,
                'name' => '魁美',
                'phone' => '13516315152',
            ),
            25 => 
            array (
                'id' => 78,
                'warehouse_id' => 178,
                'name' => 'hghhh',
                'phone' => '13266522426',
            ),
        ));
        
        
    }
}