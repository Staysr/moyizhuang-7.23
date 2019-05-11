<?php

use Illuminate\Database\Seeder;

class SysDispatchTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_dispatch')->delete();
        
        \DB::table('sys_dispatch')->insert(array (
            0 => 
            array (
                'id' => 20,
                'name' => '深圳',
                'sort' => 1,
                'status' => 1,
                'create_time' => '2017-05-18 10:18:04',
                'modify_time' => '2018-01-02 16:24:32',
            ),
            1 => 
            array (
                'id' => 21,
                'name' => '广州',
                'sort' => 2,
                'status' => 1,
                'create_time' => '2017-05-18 10:18:11',
                'modify_time' => '2018-06-06 10:30:35',
            ),
            2 => 
            array (
                'id' => 22,
                'name' => '东莞',
                'sort' => 3,
                'status' => 0,
                'create_time' => '2017-05-18 10:18:19',
                'modify_time' => '2018-01-11 17:59:53',
            ),
            3 => 
            array (
                'id' => 23,
                'name' => '惠州',
                'sort' => 4,
                'status' => 0,
                'create_time' => '2017-05-18 10:18:28',
                'modify_time' => '2018-01-09 11:33:26',
            ),
            4 => 
            array (
                'id' => 24,
                'name' => '中山',
                'sort' => 5,
                'status' => 1,
                'create_time' => '2017-05-18 10:18:45',
                'modify_time' => '2018-01-11 17:59:45',
            ),
            5 => 
            array (
                'id' => 25,
                'name' => '佛山',
                'sort' => 6,
                'status' => 0,
                'create_time' => '2017-12-02 11:07:06',
                'modify_time' => '2018-01-11 18:00:14',
            ),
            6 => 
            array (
                'id' => 27,
                'name' => '珠海',
                'sort' => 7,
                'status' => 0,
                'create_time' => '2017-12-07 10:58:05',
                'modify_time' => '2018-01-02 16:18:22',
            ),
            7 => 
            array (
                'id' => 28,
                'name' => '韶关',
                'sort' => 8,
                'status' => 0,
                'create_time' => '2017-12-12 17:48:28',
                'modify_time' => '2018-01-02 16:18:26',
            ),
            8 => 
            array (
                'id' => 29,
                'name' => '湛江',
                'sort' => 9,
                'status' => 0,
                'create_time' => '2017-12-12 17:48:42',
                'modify_time' => '2018-01-02 16:18:28',
            ),
            9 => 
            array (
                'id' => 30,
                'name' => '茂名',
                'sort' => 10,
                'status' => 0,
                'create_time' => '2017-12-12 17:48:53',
                'modify_time' => '2017-12-12 17:48:53',
            ),
            10 => 
            array (
                'id' => 32,
                'name' => '梅州',
                'sort' => 12,
                'status' => 0,
                'create_time' => '2017-12-12 17:49:20',
                'modify_time' => '2017-12-12 17:49:20',
            ),
            11 => 
            array (
                'id' => 34,
                'name' => '河源',
                'sort' => 14,
                'status' => 0,
                'create_time' => '2017-12-12 17:49:42',
                'modify_time' => '2017-12-12 17:49:42',
            ),
            12 => 
            array (
                'id' => 35,
                'name' => '阳江',
                'sort' => 15,
                'status' => 0,
                'create_time' => '2017-12-12 17:49:53',
                'modify_time' => '2017-12-12 17:49:53',
            ),
            13 => 
            array (
                'id' => 37,
                'name' => '潮州',
                'sort' => 17,
                'status' => 0,
                'create_time' => '2017-12-12 17:50:16',
                'modify_time' => '2017-12-12 17:50:16',
            ),
            14 => 
            array (
                'id' => 38,
                'name' => '揭阳',
                'sort' => 18,
                'status' => 0,
                'create_time' => '2017-12-12 17:50:25',
                'modify_time' => '2017-12-12 17:50:25',
            ),
            15 => 
            array (
                'id' => 39,
                'name' => '云浮',
                'sort' => 19,
                'status' => 0,
                'create_time' => '2017-12-12 17:50:38',
                'modify_time' => '2018-01-11 17:40:09',
            ),
            16 => 
            array (
                'id' => 40,
                'name' => '江门',
                'sort' => 20,
                'status' => 1,
                'create_time' => '2017-12-12 17:50:54',
                'modify_time' => '2018-01-11 17:58:43',
            ),
            17 => 
            array (
                'id' => 41,
                'name' => '蛇口',
                'sort' => 21,
                'status' => 1,
                'create_time' => '2017-12-12 17:51:30',
                'modify_time' => '2018-01-11 17:58:35',
            ),
            18 => 
            array (
                'id' => 42,
                'name' => '车公庙',
                'sort' => 22,
                'status' => 1,
                'create_time' => '2017-12-12 17:51:45',
                'modify_time' => '2018-01-09 11:07:58',
            ),
            19 => 
            array (
                'id' => 43,
                'name' => '重庆',
                'sort' => 23,
                'status' => 0,
                'create_time' => '2017-12-13 14:34:29',
                'modify_time' => '2018-01-09 11:08:05',
            ),
            20 => 
            array (
                'id' => 44,
                'name' => '长沙',
                'sort' => 24,
                'status' => 1,
                'create_time' => '2017-12-13 14:36:23',
                'modify_time' => '2018-01-09 10:59:43',
            ),
            21 => 
            array (
                'id' => 48,
                'name' => '广东',
                'sort' => 25,
                'status' => 1,
                'create_time' => '2018-01-09 11:02:14',
                'modify_time' => '2018-01-09 11:02:43',
            ),
        ));
        
        
    }
}