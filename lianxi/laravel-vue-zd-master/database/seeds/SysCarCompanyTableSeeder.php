<?php

use Illuminate\Database\Seeder;

class SysCarCompanyTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_car_company')->delete();
        
        \DB::table('sys_car_company')->insert(array (
            0 => 
            array (
                'id' => 11,
                'name' => '测试',
                'contacts' => '测试',
                'contact_way' => '15212521224',
                'admin_id' => 0,
                'status' => 1,
                'create_time' => '2017-03-29 11:22:41',
                'modify_time' => '2017-03-29 11:22:41',
            ),
            1 => 
            array (
                'id' => 12,
                'name' => '我是测试',
                'contacts' => '琳琳',
                'contact_way' => '13410425217',
                'admin_id' => 7,
                'status' => 1,
                'create_time' => '2017-03-29 14:25:53',
                'modify_time' => '2017-05-10 09:30:10',
            ),
            2 => 
            array (
                'id' => 13,
                'name' => 'soso',
                'contacts' => '金丽娜',
                'contact_way' => '18611751785',
                'admin_id' => 0,
                'status' => 1,
                'create_time' => '2017-03-29 14:28:38',
                'modify_time' => '2017-03-29 14:29:52',
            ),
            3 => 
            array (
                'id' => 14,
                'name' => '测试林',
                'contacts' => '林生',
                'contact_way' => '13410425217',
                'admin_id' => 7,
                'status' => 1,
                'create_time' => '2017-05-10 14:16:42',
                'modify_time' => '2017-08-16 15:55:01',
            ),
            4 => 
            array (
                'id' => 15,
                'name' => '东莞市佳鑫人力资源深圳分公司',
                'contacts' => '林林',
                'contact_way' => '13410425217',
                'admin_id' => 7,
                'status' => 1,
                'create_time' => '2017-06-13 12:09:49',
                'modify_time' => '2017-07-07 15:26:07',
            ),
            5 => 
            array (
                'id' => 16,
                'name' => '赣州加盟公司',
                'contacts' => '赣州人',
                'contact_way' => '13652525252',
                'admin_id' => 7,
                'status' => 1,
                'create_time' => '2017-08-09 11:11:49',
                'modify_time' => '2017-08-09 11:43:28',
            ),
        ));
        
        
    }
}