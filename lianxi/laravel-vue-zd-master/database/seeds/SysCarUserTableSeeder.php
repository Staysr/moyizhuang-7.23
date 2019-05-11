<?php

use Illuminate\Database\Seeder;

class SysCarUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_car_user')->delete();
        
        \DB::table('sys_car_user')->insert(array (
            0 => 
            array (
                'id' => 12,
                'company_id' => 11,
                'email' => 'admin@admin.com',
                'password' => 'e10adc3949ba59abbe56e057f20f883e',
                'role' => 0,
                'username' => '在在在',
                'phone' => '18523251254',
                'status' => 1,
                'last_login_ip' => '10.29.56.153',
                'last_login_time' => '2018-03-21 14:18:36',
                'create_time' => '2017-03-29 11:23:06',
                'modify_time' => '2017-03-29 11:23:06',
            ),
            1 => 
            array (
                'id' => 15,
                'company_id' => 12,
                'email' => 'linhuajun@qq.com',
                'password' => 'e10adc3949ba59abbe56e057f20f883e',
                'role' => 0,
                'username' => '测试林',
                'phone' => '13410425217',
                'status' => 1,
                'last_login_ip' => '10.29.56.153',
                'last_login_time' => '2017-12-27 16:06:41',
                'create_time' => '2017-05-10 09:30:10',
                'modify_time' => '2017-05-10 09:30:10',
            ),
            2 => 
            array (
                'id' => 16,
                'company_id' => 15,
                'email' => 'linhua@qq.com',
                'password' => 'e10adc3949ba59abbe56e057f20f883e',
                'role' => 0,
                'username' => '刘谋健',
                'phone' => '13410425217',
                'status' => 1,
                'last_login_ip' => '10.29.56.153',
                'last_login_time' => '2017-06-27 14:31:47',
                'create_time' => '2017-06-13 12:12:19',
                'modify_time' => '2018-05-25 14:44:01',
            ),
            3 => 
            array (
                'id' => 17,
                'company_id' => 16,
                'email' => '111@111.com',
                'password' => 'e10adc3949ba59abbe56e057f20f883e',
                'role' => 0,
                'username' => '赣州用户',
                'phone' => '13723456789',
                'status' => 1,
                'last_login_ip' => '10.29.56.153',
                'last_login_time' => '2017-08-09 11:55:01',
                'create_time' => '2017-08-09 11:43:28',
                'modify_time' => '2017-08-09 11:43:28',
            ),
            4 => 
            array (
                'id' => 18,
                'company_id' => 14,
                'email' => 'luffyzhao@vip.126.com',
                'password' => 'e10adc3949ba59abbe56e057f20f883e',
                'role' => 0,
                'username' => '林华',
                'phone' => '13410425217',
                'status' => 1,
                'last_login_ip' => '10.29.56.153',
                'last_login_time' => '2018-04-17 10:59:05',
                'create_time' => '2017-08-16 15:55:01',
                'modify_time' => '2017-08-16 15:55:01',
            ),
        ));
        
        
    }
}