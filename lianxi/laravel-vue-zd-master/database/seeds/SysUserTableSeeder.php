<?php

use Illuminate\Database\Seeder;

class SysUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_user')->delete();
        
        \DB::table('sys_user')->insert(array (
            0 => 
            array (
                'id' => 7,
                'name' => '大家好',
                'email' => 'luffyzhao@vip.126.com',
                'password' => 'e10adc3949ba59abbe56e057f20f883e',
                'job_code' => 'DF0001',
                'category_id' => 1,
                'category_code' => '01',
                'department_id' => 1,
                'status' => 1,
                'is_admin' => 1,
                'sex' => 0,
                'head' => NULL,
                'birthday' => '2016-09-19',
                'mobile' => '18620313777',
                'tel' => '0755-1488888',
                'create_time' => '2016-09-10 17:01:03',
                'modify_time' => '2017-03-27 15:05:04',
            ),
            1 => 
            array (
                'id' => 46,
                'name' => '产品何',
                'email' => 'heshiqiang@qq.com',
                'password' => 'e10adc3949ba59abbe56e057f20f883e',
                'job_code' => '',
                'category_id' => 5,
                'category_code' => '0101',
                'department_id' => 1,
                'status' => 1,
                'is_admin' => 1,
                'sex' => 0,
                'head' => NULL,
                'birthday' => '',
                'mobile' => '',
                'tel' => '',
                'create_time' => '2017-05-15 14:43:54',
                'modify_time' => '2017-05-15 14:43:54',
            ),
            2 => 
            array (
                'id' => 47,
                'name' => '比亚迪',
                'email' => '995289132@qq.com',
                'password' => 'e10adc3949ba59abbe56e057f20f883e',
                'job_code' => '',
                'category_id' => 5,
                'category_code' => '0101',
                'department_id' => 2,
                'status' => 1,
                'is_admin' => 1,
                'sex' => 0,
                'head' => NULL,
                'birthday' => '',
                'mobile' => '13266522726',
                'tel' => '',
                'create_time' => '2017-06-05 11:37:06',
                'modify_time' => '2018-04-16 09:21:10',
            ),
            3 => 
            array (
                'id' => 48,
                'name' => '比亚',
                'email' => '837623699@qq.com',
                'password' => 'e10adc3949ba59abbe56e057f20f883e',
                'job_code' => '',
                'category_id' => 5,
                'category_code' => '0101',
                'department_id' => 2,
                'status' => 0,
                'is_admin' => 0,
                'sex' => 0,
                'head' => NULL,
                'birthday' => '',
                'mobile' => '13266522727',
                'tel' => '',
                'create_time' => '2017-06-05 11:37:42',
                'modify_time' => '2017-06-05 11:53:23',
            ),
            4 => 
            array (
                'id' => 49,
                'name' => '测试',
                'email' => '529184865@qq.com',
                'password' => 'e10adc3949ba59abbe56e057f20f883e',
                'job_code' => '',
                'category_id' => 6,
                'category_code' => '0101002',
                'department_id' => 1,
                'status' => 1,
                'is_admin' => 1,
                'sex' => 0,
                'head' => NULL,
                'birthday' => '',
                'mobile' => '13682509527',
                'tel' => '',
                'create_time' => '2017-06-29 17:40:22',
                'modify_time' => '2017-06-29 17:40:22',
            ),
            5 => 
            array (
                'id' => 50,
                'name' => '赣州用户',
                'email' => '111@111.com',
                'password' => 'e10adc3949ba59abbe56e057f20f883e',
                'job_code' => '',
                'category_id' => 100187,
                'category_code' => '0103007',
                'department_id' => 3,
                'status' => 1,
                'is_admin' => 1,
                'sex' => 0,
                'head' => NULL,
                'birthday' => '',
                'mobile' => '',
                'tel' => '',
                'create_time' => '2017-08-09 11:32:44',
                'modify_time' => '2018-04-16 09:21:52',
            ),
        ));
        
        
    }
}