<?php

use Illuminate\Database\Seeder;

class BaseInvitedInfoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('base_invited_info')->delete();
        
        \DB::table('base_invited_info')->insert(array (
            0 => 
            array (
                'id' => 1,
                'category_id' => 6,
                'category_code' => '0101002',
                'name' => '陈',
                'my_invite_code' => '13410111111',
                'code' => 132,
                'status' => 1,
                'create_time' => '2017-05-17 14:09:27',
                'modify_time' => '2017-05-26 16:06:54',
            ),
            1 => 
            array (
                'id' => 2,
                'category_id' => 6,
                'category_code' => '0101002',
                'name' => '地推',
                'my_invite_code' => '13410000111',
                'code' => 133,
                'status' => 1,
                'create_time' => '2017-06-08 10:55:06',
                'modify_time' => '2017-06-08 10:55:06',
            ),
            2 => 
            array (
                'id' => 3,
                'category_id' => 6,
                'category_code' => '0101002',
                'name' => '地推加货主',
                'my_invite_code' => '13611111111',
                'code' => 134,
                'status' => 1,
                'create_time' => '2017-06-14 15:32:02',
                'modify_time' => '2017-06-14 15:32:02',
            ),
            3 => 
            array (
                'id' => 4,
                'category_id' => 6,
                'category_code' => '0101002',
                'name' => '1231231',
                'my_invite_code' => '13827321259',
                'code' => 135,
                'status' => 1,
                'create_time' => '2018-01-12 15:33:47',
                'modify_time' => '2018-01-12 15:33:47',
            ),
            4 => 
            array (
                'id' => 5,
                'category_id' => 6,
                'category_code' => '0101002',
                'name' => '潘常芳',
                'my_invite_code' => '13824321259',
                'code' => 136,
                'status' => 1,
                'create_time' => '2018-01-12 15:52:37',
                'modify_time' => '2018-01-12 15:52:37',
            ),
        ));
        
        
    }
}