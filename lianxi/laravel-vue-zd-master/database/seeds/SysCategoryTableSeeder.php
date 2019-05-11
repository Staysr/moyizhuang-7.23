<?php

use Illuminate\Database\Seeder;

class SysCategoryTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_category')->delete();
        
        \DB::table('sys_category')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_id' => 0,
                'name' => '中国',
                'code' => '01',
                'level' => 1,
                'status' => 1,
                'create_time' => '2016-09-21 15:49:03',
                'modify_time' => '2016-10-27 10:24:30',
            ),
            1 => 
            array (
                'id' => 5,
                'parent_id' => 1,
                'name' => '广东省',
                'code' => '0101',
                'level' => 2,
                'status' => 1,
                'create_time' => '2016-09-21 19:56:24',
                'modify_time' => '2017-05-09 16:47:05',
            ),
            2 => 
            array (
                'id' => 6,
                'parent_id' => 5,
                'name' => '深圳市',
                'code' => '0101002',
                'level' => 3,
                'status' => 1,
                'create_time' => '2016-09-21 19:56:40',
                'modify_time' => '2017-03-29 14:23:22',
            ),
            3 => 
            array (
                'id' => 100179,
                'parent_id' => 6,
                'name' => '南山区',
                'code' => '01010020005',
                'level' => 4,
                'status' => 1,
                'create_time' => '2017-03-29 14:18:38',
                'modify_time' => '2018-08-16 16:15:40',
            ),
            4 => 
            array (
                'id' => 100180,
                'parent_id' => 5,
                'name' => '广州市',
                'code' => '0101005',
                'level' => 3,
                'status' => 1,
                'create_time' => '2017-05-08 10:42:03',
                'modify_time' => '2017-05-08 10:42:03',
            ),
            5 => 
            array (
                'id' => 100181,
                'parent_id' => 1,
                'name' => '北京市',
                'code' => '0102',
                'level' => 2,
                'status' => 1,
                'create_time' => '2017-05-09 16:47:25',
                'modify_time' => '2017-05-09 16:47:25',
            ),
            6 => 
            array (
                'id' => 100182,
                'parent_id' => 100181,
                'name' => '海淀区',
                'code' => '0102006',
                'level' => 3,
                'status' => 1,
                'create_time' => '2017-05-09 16:47:47',
                'modify_time' => '2017-05-09 16:47:47',
            ),
            7 => 
            array (
                'id' => 100183,
                'parent_id' => 100179,
                'name' => '南山商圈',
                'code' => '01010020005003',
                'level' => 5,
                'status' => 1,
                'create_time' => '2017-05-13 14:20:37',
                'modify_time' => '2018-08-16 16:15:48',
            ),
            8 => 
            array (
                'id' => 100184,
                'parent_id' => 100180,
                'name' => '白云区',
                'code' => '01010050006',
                'level' => 4,
                'status' => 1,
                'create_time' => '2017-05-13 14:22:53',
                'modify_time' => '2017-05-13 14:22:53',
            ),
            9 => 
            array (
                'id' => 100185,
                'parent_id' => 100184,
                'name' => '罗湖商圈',
                'code' => '01010020006004',
                'level' => 5,
                'status' => 1,
                'create_time' => '2017-05-13 14:23:12',
                'modify_time' => '2017-05-13 14:23:12',
            ),
            10 => 
            array (
                'id' => 100186,
                'parent_id' => 1,
                'name' => '江西省',
                'code' => '0103',
                'level' => 2,
                'status' => 1,
                'create_time' => '2017-08-09 11:05:56',
                'modify_time' => '2017-08-09 11:05:56',
            ),
            11 => 
            array (
                'id' => 100187,
                'parent_id' => 100186,
                'name' => '赣州市',
                'code' => '0103007',
                'level' => 3,
                'status' => 1,
                'create_time' => '2017-08-09 11:06:12',
                'modify_time' => '2017-08-09 11:06:12',
            ),
            12 => 
            array (
                'id' => 100188,
                'parent_id' => 100187,
                'name' => '东城区',
                'code' => '01030070007',
                'level' => 4,
                'status' => 1,
                'create_time' => '2017-08-09 14:54:22',
                'modify_time' => '2017-08-09 14:54:22',
            ),
            13 => 
            array (
                'id' => 100189,
                'parent_id' => 100187,
                'name' => '西城区',
                'code' => '01030070008',
                'level' => 4,
                'status' => 1,
                'create_time' => '2017-08-09 14:54:43',
                'modify_time' => '2017-08-09 14:54:43',
            ),
            14 => 
            array (
                'id' => 100190,
                'parent_id' => 100188,
                'name' => '建材商圈',
                'code' => '01030070007005',
                'level' => 5,
                'status' => 1,
                'create_time' => '2017-08-09 14:55:28',
                'modify_time' => '2017-08-09 14:55:28',
            ),
            15 => 
            array (
                'id' => 100191,
                'parent_id' => 100189,
                'name' => '农批商圈',
                'code' => '01030070008006',
                'level' => 5,
                'status' => 1,
                'create_time' => '2017-08-09 14:55:53',
                'modify_time' => '2017-08-09 14:55:53',
            ),
            16 => 
            array (
                'id' => 100192,
                'parent_id' => 1,
                'name' => '湖北省',
                'code' => '0104',
                'level' => 2,
                'status' => 1,
                'create_time' => '2017-12-28 11:45:18',
                'modify_time' => '2017-12-28 11:45:18',
            ),
            17 => 
            array (
                'id' => 100193,
                'parent_id' => 100192,
                'name' => '武汉市',
                'code' => '0104008',
                'level' => 3,
                'status' => 1,
                'create_time' => '2017-12-28 11:45:36',
                'modify_time' => '2017-12-28 11:45:44',
            ),
            18 => 
            array (
                'id' => 100194,
                'parent_id' => 100179,
                'name' => '宝安商圈',
                'code' => '01010020005007',
                'level' => 5,
                'status' => 1,
                'create_time' => '2018-08-16 16:17:21',
                'modify_time' => '2018-08-16 16:17:21',
            ),
        ));
        
        
    }
}