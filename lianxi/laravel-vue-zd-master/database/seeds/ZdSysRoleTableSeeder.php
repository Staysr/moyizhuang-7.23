<?php

use Illuminate\Database\Seeder;

class ZdSysRoleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('zd_sys_role')->delete();
        
        \DB::table('zd_sys_role')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '超级管理员',
                'remark' => '超级管理员',
                'is_admin' => 1,
                'authority' => 0,
                'create_time' => '2018-07-24 13:37:12',
                'modify_time' => '2018-07-24 13:37:14',
            ),
            1 => 
            array (
                'id' => 3,
                'name' => '岗控林经理',
                'remark' => NULL,
                'is_admin' => 0,
                'authority' => 1,
                'create_time' => '2018-09-25 17:47:08',
                'modify_time' => '2018-09-25 17:47:08',
            ),
            2 => 
            array (
                'id' => 4,
                'name' => '客户顾问',
                'remark' => NULL,
                'is_admin' => 0,
                'authority' => 1,
                'create_time' => '2018-09-26 15:13:46',
                'modify_time' => '2018-09-26 15:13:46',
            ),
            3 => 
            array (
                'id' => 5,
                'name' => '运作经理',
                'remark' => NULL,
                'is_admin' => 0,
                'authority' => 1,
                'create_time' => '2018-09-26 15:14:47',
                'modify_time' => '2018-09-26 15:14:47',
            ),
        ));
        
        
    }
}