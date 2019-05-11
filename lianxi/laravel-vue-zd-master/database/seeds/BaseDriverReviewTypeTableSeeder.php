<?php

use Illuminate\Database\Seeder;

class BaseDriverReviewTypeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('base_driver_review_type')->delete();
        
        \DB::table('base_driver_review_type')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'driverlicense',
                'name' => '驾驶证正面照',
                'input_type' => 'image',
                'default' => NULL,
                'remark' => '驾驶证正面照',
                'sort' => 255,
                'require' => 0,
                'status' => 1,
                'create_time' => '2016-11-04 13:49:02',
                'modify_time' => '2016-11-04 13:49:04',
            ),
            1 => 
            array (
                'id' => 2,
                'code' => 'drivinglicense',
                'name' => '行驶证正面照',
                'input_type' => 'image',
                'default' => NULL,
                'remark' => '行驶证正面照',
                'sort' => 255,
                'require' => 0,
                'status' => 1,
                'create_time' => '2016-11-04 13:49:29',
                'modify_time' => '2016-11-04 13:49:32',
            ),
            2 => 
            array (
                'id' => 3,
                'code' => 'positivephotosofIDcard',
                'name' => '身份证正面照',
                'input_type' => 'image',
                'default' => NULL,
                'remark' => '身份证正面照',
                'sort' => 255,
                'require' => 0,
                'status' => 1,
                'create_time' => '2016-11-04 13:49:55',
                'modify_time' => '2016-11-04 13:49:57',
            ),
            3 => 
            array (
                'id' => 4,
                'code' => 'bankcard',
                'name' => '银行卡正面照',
                'input_type' => 'image',
                'default' => NULL,
                'remark' => '银行卡正面照',
                'sort' => 255,
                'require' => 0,
                'status' => 1,
                'create_time' => '2016-11-04 13:50:15',
                'modify_time' => '2016-11-04 13:50:17',
            ),
            4 => 
            array (
                'id' => 5,
                'code' => 'carImage',
                'name' => '车辆45度侧面照',
                'input_type' => 'image',
                'default' => NULL,
                'remark' => '车辆45度侧面照',
                'sort' => 255,
                'require' => 0,
                'status' => 1,
                'create_time' => '2017-05-06 11:05:05',
                'modify_time' => '2017-05-06 11:05:05',
            ),
        ));
        
        
    }
}