<?php

use Illuminate\Database\Seeder;

class SysDepartmentTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_department')->delete();
        
        \DB::table('sys_department')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '总裁办',
                'status' => 1,
                'remark' => '',
                'create_time' => '2016-09-19 16:59:41',
                'modify_time' => '2018-09-27 11:48:50',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '测试部',
                'status' => 1,
                'remark' => '发送',
                'create_time' => '2017-06-05 11:35:58',
                'modify_time' => '2018-09-05 17:20:25',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '赣州加盟公司',
                'status' => 1,
                'remark' => '',
                'create_time' => '2017-08-09 11:28:10',
                'modify_time' => '2018-01-10 09:42:51',
            ),
        ));
        
        
    }
}