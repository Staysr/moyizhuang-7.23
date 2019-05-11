<?php

use Illuminate\Database\Seeder;

class ZdFeedbackTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('zd_feedback')->delete();
        
        \DB::table('zd_feedback')->insert(array (
            0 => 
            array (
                'id' => 6,
                'merchant_id' => '101',
                'content' => '111111111111111111',
                'create_time' => '2018-07-04 17:06:27',
                'modify_time' => '2018-07-04 17:06:27',
            ),
            1 => 
            array (
                'id' => 7,
                'merchant_id' => '110',
                'content' => '觉得饿饿饿饿饿饿饿饿饿饿饿饿饿饿饿饿饿饿哦哦哦哦哦哦哦哦哦哦哦哦哦哦哦哦哦哦哦啦啦啦咯哦哦哦哦哦饿哦哦咯咯哦哦哦哦哦哦哦哦哦哦哦哦哦哦',
                'create_time' => '2018-07-06 12:03:18',
                'modify_time' => '2018-07-06 12:03:18',
            ),
            2 => 
            array (
                'id' => 8,
                'merchant_id' => '110',
                'content' => 'ni回去哦哈哈斤斤计较斤斤计较斤斤计较',
                'create_time' => '2018-07-10 17:33:52',
                'modify_time' => '2018-07-10 17:33:52',
            ),
            3 => 
            array (
                'id' => 9,
                'merchant_id' => '113',
                'content' => 'ces85767978664646464949464445',
                'create_time' => '2018-07-23 12:09:34',
                'modify_time' => '2018-07-23 12:09:34',
            ),
            4 => 
            array (
                'id' => 10,
                'merchant_id' => '108',
                'content' => 'ｖｖｂｂｂｈｈｂｂｂｂｂｂｂｂｂｈ宇宇会议?',
                'create_time' => '2018-07-27 17:19:18',
                'modify_time' => '2018-07-27 17:19:18',
            ),
        ));
        
        
    }
}