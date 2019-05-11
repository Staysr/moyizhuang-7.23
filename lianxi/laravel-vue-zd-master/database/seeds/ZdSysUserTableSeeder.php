<?php

use Illuminate\Database\Seeder;

class ZdSysUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('zd_sys_user')->delete();
        
        \DB::table('zd_sys_user')->insert(array (
            0 => 
            array (
                'id' => 1,
                'password' => 'e10adc3949ba59abbe56e057f20f883e',
                'role' => 1,
                'manager' => 1,
                'name' => '总账号',
                'phone' => '13692110628',
                'sex' => 2,
                'authority_level' => 4,
                'job_number' => '123456',
                'contact' => '13266522726',
                'birthday' => '1990-12-15',
                'status' => 1,
                'last_ip' => '10.29.56.153',
                'last_time' => '2018-09-26 14:59:51',
                'change_place' => 0,
                'create_time' => '2017-06-28 13:42:18',
                'modify_time' => '2017-11-09 16:29:47',
            ),
            1 => 
            array (
                'id' => 16,
                'password' => 'e10adc3949ba59abbe56e057f20f883e',
                'role' => 0,
                'manager' => 0,
                'name' => '测试林大哥',
                'phone' => '13410425217',
                'sex' => 1,
                'authority_level' => 4,
                'job_number' => NULL,
                'contact' => NULL,
                'birthday' => NULL,
                'status' => 1,
                'last_ip' => '10.29.56.153',
                'last_time' => '2018-09-26 15:02:41',
                'change_place' => 0,
                'create_time' => '2018-09-25 17:48:42',
                'modify_time' => '2018-09-26 15:26:34',
            ),
            2 => 
            array (
                'id' => 17,
                'password' => 'e10adc3949ba59abbe56e057f20f883e',
                'role' => 4,
                'manager' => 0,
                'name' => '客户经理',
                'phone' => '13410101010',
                'sex' => 1,
                'authority_level' => 1,
                'job_number' => NULL,
                'contact' => NULL,
                'birthday' => NULL,
                'status' => 1,
                'last_ip' => NULL,
                'last_time' => NULL,
                'change_place' => 0,
                'create_time' => '2018-09-26 15:26:18',
                'modify_time' => '2018-09-26 15:26:18',
            ),
            3 => 
            array (
                'id' => 18,
                'password' => 'e10adc3949ba59abbe56e057f20f883e',
                'role' => 5,
                'manager' => 0,
                'name' => '运作经理',
                'phone' => '13411110010',
                'sex' => 0,
                'authority_level' => 2,
                'job_number' => NULL,
                'contact' => NULL,
                'birthday' => NULL,
                'status' => 1,
                'last_ip' => NULL,
                'last_time' => NULL,
                'change_place' => 0,
                'create_time' => '2018-09-26 15:27:35',
                'modify_time' => '2018-09-26 15:27:35',
            ),
            4 => 
            array (
                'id' => 19,
                'password' => 'e10adc3949ba59abbe56e057f20f883e',
                'role' => 5,
                'manager' => 0,
                'name' => '拓展经理',
                'phone' => '13100110011',
                'sex' => 1,
                'authority_level' => 3,
                'job_number' => NULL,
                'contact' => NULL,
                'birthday' => NULL,
                'status' => 1,
                'last_ip' => NULL,
                'last_time' => NULL,
                'change_place' => 0,
                'create_time' => '2018-09-26 15:28:16',
                'modify_time' => '2018-09-26 15:28:16',
            ),
        ));
        
        
    }
}