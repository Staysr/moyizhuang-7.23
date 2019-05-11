<?php

use Illuminate\Database\Seeder;

class BaseDriverAwardTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('base_driver_award')->delete();
        
        \DB::table('base_driver_award')->insert(array (
            0 => 
            array (
                'id' => 32,
                'driver_id' => 5374,
                'money' => 30,
                'remark' => 'fljlsfsdf',
                'create_time' => '2017-05-10 15:55:54',
                'modify_time' => '2017-05-10 15:55:54',
            ),
            1 => 
            array (
                'id' => 33,
                'driver_id' => 5384,
                'money' => 500,
                'remark' => '干的不错 奖励给你大保健去！！',
                'create_time' => '2017-05-12 11:05:44',
                'modify_time' => '2017-05-12 11:05:44',
            ),
            2 => 
            array (
                'id' => 34,
                'driver_id' => 5386,
                'money' => 5,
                'remark' => '测试',
                'create_time' => '2017-05-12 15:13:12',
                'modify_time' => '2017-05-12 15:13:12',
            ),
            3 => 
            array (
                'id' => 35,
                'driver_id' => 5396,
                'money' => 5,
                'remark' => '测试',
                'create_time' => '2017-05-12 15:13:48',
                'modify_time' => '2017-05-12 15:13:48',
            ),
            4 => 
            array (
                'id' => 36,
                'driver_id' => 5376,
                'money' => 5,
                'remark' => '客户普遍反馈司机服务态度好，奖励5元；',
                'create_time' => '2017-05-17 12:20:45',
                'modify_time' => '2017-05-17 12:20:45',
            ),
            5 => 
            array (
                'id' => 37,
                'driver_id' => 5376,
                'money' => 2,
                'remark' => '客户普遍反馈司机服务态度好，奖励2元',
                'create_time' => '2017-05-17 12:28:41',
                'modify_time' => '2017-05-17 12:28:41',
            ),
            6 => 
            array (
                'id' => 38,
                'driver_id' => 5376,
                'money' => 2,
                'remark' => '客户普遍反馈司机服务态度好，奖励2元',
                'create_time' => '2017-05-17 12:29:19',
                'modify_time' => '2017-05-17 12:29:19',
            ),
            7 => 
            array (
                'id' => 39,
                'driver_id' => 5376,
                'money' => 2,
                'remark' => '客户普遍反馈司机服务态度好，奖励2元',
                'create_time' => '2017-05-17 13:49:35',
                'modify_time' => '2017-05-17 13:49:35',
            ),
            8 => 
            array (
                'id' => 40,
                'driver_id' => 5410,
                'money' => 2,
                'remark' => '* 如客户普遍反馈司机服务态度好，奖励2元；',
                'create_time' => '2017-05-17 14:30:27',
                'modify_time' => '2017-05-17 14:30:27',
            ),
            9 => 
            array (
                'id' => 41,
                'driver_id' => 5419,
                'money' => 20,
                'remark' => '服务好，客户反馈服务质量很高，以资鼓励，奖励20元',
                'create_time' => '2017-05-18 11:20:27',
                'modify_time' => '2017-05-18 11:20:27',
            ),
        ));
        
        
    }
}