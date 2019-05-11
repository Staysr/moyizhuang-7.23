<?php

use Illuminate\Database\Seeder;

class BaseDriverCarStickerTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('base_driver_car_sticker')->delete();
        
        \DB::table('base_driver_car_sticker')->insert(array (
            0 => 
            array (
                'id' => 8,
                'driver_id' => 5374,
                'sticker_rule_id' => 5,
                'car_front_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494315620504_984317.png',
                'car_side_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494315620541_374947.png',
                'reference' => '人手',
                'reward_fee' => '10.00',
                'status' => 2,
                'create_time' => '2017-05-09 15:40:21',
                'modify_time' => '2017-05-09 15:40:36',
            ),
            1 => 
            array (
                'id' => 9,
                'driver_id' => 5383,
                'sticker_rule_id' => 6,
                'car_front_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494483574424_381261.png',
                'car_side_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494483574439_918963.png',
                'reference' => '算得上是',
                'reward_fee' => '5.00',
                'status' => 0,
                'create_time' => '2017-05-11 14:19:34',
                'modify_time' => NULL,
            ),
            2 => 
            array (
                'id' => 10,
                'driver_id' => 5377,
                'sticker_rule_id' => 6,
                'car_front_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494488231986_389916.jpg',
                'car_side_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494488231994_511798.jpg',
                'reference' => '算得上是',
                'reward_fee' => '5.00',
                'status' => 1,
                'create_time' => '2017-05-11 15:37:12',
                'modify_time' => '2017-05-11 15:38:31',
            ),
            3 => 
            array (
                'id' => 11,
                'driver_id' => 5384,
                'sticker_rule_id' => 7,
                'car_front_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494558633154_399848.png',
                'car_side_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494558633194_144036.png',
                'reference' => '大宝剑',
                'reward_fee' => '5.00',
                'status' => 2,
                'create_time' => '2017-05-12 11:10:33',
                'modify_time' => '2017-05-12 11:11:14',
            ),
            4 => 
            array (
                'id' => 12,
                'driver_id' => 5383,
                'sticker_rule_id' => 7,
                'car_front_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494558958261_784886.png',
                'car_side_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494558958270_771639.png',
                'reference' => '大宝剑',
                'reward_fee' => '5.00',
                'status' => 1,
                'create_time' => '2017-05-12 11:15:58',
                'modify_time' => '2017-05-12 11:16:18',
            ),
            5 => 
            array (
                'id' => 13,
                'driver_id' => 5386,
                'sticker_rule_id' => 7,
                'car_front_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494571050966_805749.png',
                'car_side_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494571050975_688111.png',
                'reference' => '大宝剑',
                'reward_fee' => '5.00',
                'status' => 2,
                'create_time' => '2017-05-12 14:37:31',
                'modify_time' => '2017-05-12 14:45:26',
            ),
            6 => 
            array (
                'id' => 14,
                'driver_id' => 5396,
                'sticker_rule_id' => 7,
                'car_front_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494571130278_264460.jpg',
                'car_side_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494571130281_486699.jpg',
                'reference' => '大宝剑',
                'reward_fee' => '5.00',
                'status' => 1,
                'create_time' => '2017-05-12 14:38:50',
                'modify_time' => '2017-05-12 14:43:02',
            ),
            7 => 
            array (
                'id' => 15,
                'driver_id' => 5396,
                'sticker_rule_id' => 8,
                'car_front_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494645468166_384562.png',
                'car_side_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494645468206_449983.png',
                'reference' => '车贴测试',
                'reward_fee' => '10.00',
                'status' => 1,
                'create_time' => '2017-05-13 11:17:48',
                'modify_time' => '2017-05-13 11:26:41',
            ),
            8 => 
            array (
                'id' => 16,
                'driver_id' => 5376,
                'sticker_rule_id' => 8,
                'car_front_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494815144470_892433.jpg',
                'car_side_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494815144480_236388.jpg',
                'reference' => '车贴测试',
                'reward_fee' => '10.00',
                'status' => 2,
                'create_time' => '2017-05-15 10:25:44',
                'modify_time' => '2017-05-15 10:26:03',
            ),
            9 => 
            array (
                'id' => 17,
                'driver_id' => 5386,
                'sticker_rule_id' => 8,
                'car_front_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494815244621_719464.jpg',
                'car_side_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494815244624_332994.jpg',
                'reference' => '车贴测试',
                'reward_fee' => '10.00',
                'status' => 1,
                'create_time' => '2017-05-15 10:27:25',
                'modify_time' => '2017-05-15 10:28:01',
            ),
            10 => 
            array (
                'id' => 18,
                'driver_id' => 5408,
                'sticker_rule_id' => 8,
                'car_front_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494830094540_668922.png',
                'car_side_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494830094565_371760.png',
                'reference' => '车贴测试',
                'reward_fee' => '10.00',
                'status' => 0,
                'create_time' => '2017-05-15 14:34:55',
                'modify_time' => NULL,
            ),
            11 => 
            array (
                'id' => 19,
                'driver_id' => 5410,
                'sticker_rule_id' => 9,
                'car_front_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494922576398_450311.png',
                'car_side_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494922576401_808549.png',
                'reference' => '杯子',
                'reward_fee' => '5.00',
                'status' => 2,
                'create_time' => '2017-05-16 16:16:16',
                'modify_time' => '2017-05-16 16:17:42',
            ),
            12 => 
            array (
                'id' => 21,
                'driver_id' => 5382,
                'sticker_rule_id' => 9,
                'car_front_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494986325287_675741.png',
                'car_side_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494986325291_460912.png',
                'reference' => '杯子',
                'reward_fee' => '5.00',
                'status' => 2,
                'create_time' => '2017-05-17 09:58:45',
                'modify_time' => '2017-05-17 10:21:17',
            ),
            13 => 
            array (
                'id' => 23,
                'driver_id' => 5413,
                'sticker_rule_id' => 9,
                'car_front_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494987120810_900589.jpg',
                'car_side_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494987120813_696715.jpg',
                'reference' => '杯子',
                'reward_fee' => '5.00',
                'status' => 2,
                'create_time' => '2017-05-17 10:12:01',
                'modify_time' => '2017-05-17 10:12:15',
            ),
            14 => 
            array (
                'id' => 24,
                'driver_id' => 5411,
                'sticker_rule_id' => 9,
                'car_front_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494987443478_614968.jpg',
                'car_side_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494987443488_509917.jpg',
                'reference' => '杯子',
                'reward_fee' => '5.00',
                'status' => 2,
                'create_time' => '2017-05-17 10:17:23',
                'modify_time' => '2017-05-17 10:17:32',
            ),
            15 => 
            array (
                'id' => 26,
                'driver_id' => 5415,
                'sticker_rule_id' => 9,
                'car_front_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494987923529_760249.jpg',
                'car_side_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494987923533_678751.jpg',
                'reference' => '杯子',
                'reward_fee' => '5.00',
                'status' => 2,
                'create_time' => '2017-05-17 10:25:24',
                'modify_time' => '2017-05-17 10:25:30',
            ),
            16 => 
            array (
                'id' => 27,
                'driver_id' => 5410,
                'sticker_rule_id' => 10,
                'car_front_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494992928209_134936.png',
                'car_side_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1494992928212_891065.png',
                'reference' => '手机',
                'reward_fee' => '100.00',
                'status' => 1,
                'create_time' => '2017-05-17 11:48:48',
                'modify_time' => '2017-05-17 11:49:41',
            ),
            17 => 
            array (
                'id' => 28,
                'driver_id' => 5419,
                'sticker_rule_id' => 10,
                'car_front_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1495004001834_740626.png',
                'car_side_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1495004001843_267791.png',
                'reference' => '手机',
                'reward_fee' => '100.00',
                'status' => 1,
                'create_time' => '2017-05-17 14:53:22',
                'modify_time' => '2017-05-17 14:53:47',
            ),
            18 => 
            array (
                'id' => 29,
                'driver_id' => 5415,
                'sticker_rule_id' => 10,
                'car_front_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1495004304975_910366.png',
                'car_side_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1495004304990_535425.png',
                'reference' => '手机',
                'reward_fee' => '100.00',
                'status' => 1,
                'create_time' => '2017-05-17 14:58:25',
                'modify_time' => '2017-05-17 14:58:56',
            ),
            19 => 
            array (
                'id' => 30,
                'driver_id' => 5410,
                'sticker_rule_id' => 11,
                'car_front_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1495070459508_165096.png',
                'car_side_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1495070459564_773309.png',
                'reference' => '笔',
                'reward_fee' => '50.00',
                'status' => 2,
                'create_time' => '2017-05-18 09:21:00',
                'modify_time' => '2017-05-18 09:21:16',
            ),
            20 => 
            array (
                'id' => 31,
                'driver_id' => 5419,
                'sticker_rule_id' => 11,
                'car_front_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1495070674841_482955.png',
                'car_side_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1495070674845_931595.png',
                'reference' => '笔',
                'reward_fee' => '50.00',
                'status' => 1,
                'create_time' => '2017-05-18 09:24:35',
                'modify_time' => '2017-05-18 09:24:53',
            ),
            21 => 
            array (
                'id' => 32,
                'driver_id' => 5425,
                'sticker_rule_id' => 12,
                'car_front_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1495181419336_661333.jpg',
                'car_side_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1495181419345_641779.jpg',
                'reference' => '瓶子',
                'reward_fee' => '7.00',
                'status' => 1,
                'create_time' => '2017-05-19 16:10:19',
                'modify_time' => '2017-05-19 16:10:48',
            ),
            22 => 
            array (
                'id' => 33,
                'driver_id' => 5415,
                'sticker_rule_id' => 12,
                'car_front_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1495182363742_224198.jpg',
                'car_side_img' => 'http://images2.fzhd8.cn/images/driverCarSticker/1495182363752_539105.jpg',
                'reference' => '瓶子',
                'reward_fee' => '7.00',
                'status' => 1,
                'create_time' => '2017-05-19 16:26:04',
                'modify_time' => '2017-05-19 16:26:25',
            ),
        ));
        
        
    }
}