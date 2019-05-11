<?php

use Illuminate\Database\Seeder;

class SysCarSafeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_car_safe')->delete();
        
        \DB::table('sys_car_safe')->insert(array (
            0 => 
            array (
                'id' => 1,
                'company_id' => 12,
                'code' => '65441534165465531354',
                'car_id' => 375,
                'safe_id' => 9,
                'type' => '["交强险","商业险","车船税"]',
                'start_date' => '2017-07-04',
                'end_date' => '2017-10-07',
                'cost' => '1.00',
                'files' => '["","",""]',
                'create_time' => '2017-07-07 15:01:26',
                'modify_time' => '2017-07-07 15:01:26',
            ),
            1 => 
            array (
                'id' => 2,
                'company_id' => 12,
                'code' => '435436346747865857',
                'car_id' => 358,
                'safe_id' => 9,
                'type' => '["交强险","商业险","车船税"]',
                'start_date' => '2017-07-04',
                'end_date' => '2017-07-06',
                'cost' => '4.00',
                'files' => '["\\/uploads\\/20170708\\/5ab3bb0177e8a868cb9a169ddebef24b.jpg","\\/uploads\\/20170708\\/ee702cdbd28bd47b09f601b59d4f6a44.jpg","\\/uploads\\/20170708\\/bbcac0dfa7df17c0d721119c3d2b44a6.jpg"]',
                'create_time' => '2017-07-07 15:13:32',
                'modify_time' => '2017-07-08 09:15:53',
            ),
            2 => 
            array (
                'id' => 3,
                'company_id' => 14,
                'code' => '121581115',
                'car_id' => 414,
                'safe_id' => 10,
                'type' => '["交强险"]',
                'start_date' => '2017-03-09',
                'end_date' => '2017-11-20',
                'cost' => '20.55',
                'files' => '["","",""]',
                'create_time' => '2017-09-13 14:03:24',
                'modify_time' => '2017-09-13 14:17:05',
            ),
            3 => 
            array (
                'id' => 4,
                'company_id' => 14,
                'code' => '121581116',
                'car_id' => 414,
                'safe_id' => 10,
                'type' => '{"1":"商业险"}',
                'start_date' => '2017-03-09',
                'end_date' => '2017-11-20',
                'cost' => '20.55',
                'files' => '["\\/uploads\\/20180117\\/6876086e46334cb0b83738d6c6b5cfb4.jpg","",""]',
                'create_time' => '2017-09-13 14:04:44',
                'modify_time' => '2018-01-17 11:30:11',
            ),
        ));
        
        
    }
}