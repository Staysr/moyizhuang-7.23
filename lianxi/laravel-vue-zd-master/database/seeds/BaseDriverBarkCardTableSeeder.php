<?php

use Illuminate\Database\Seeder;

class BaseDriverBarkCardTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('base_driver_bark_card')->delete();
        
        \DB::table('base_driver_bark_card')->insert(array (
            0 => 
            array (
                'id' => 6,
                'driver_id' => 5376,
                'bank_name' => '北京银行',
                'bank_city' => '深圳市',
                'bank_subbranch' => '深南支行',
                'card_name' => '测试订单',
                'card_no' => '1235 5588 4888 5588 80888',
                'remark' => NULL,
                'create_time' => '2017-05-08 15:34:59',
                'modify_time' => '2017-05-08 15:34:59',
            ),
            1 => 
            array (
                'id' => 7,
                'driver_id' => 5379,
                'bank_name' => '北京银行',
                'bank_city' => '深圳市',
                'bank_subbranch' => 'Avc ',
                'card_name' => '123',
                'card_no' => '1234550000000',
                'remark' => NULL,
                'create_time' => '2017-05-08 15:38:48',
                'modify_time' => '2017-05-08 15:38:48',
            ),
            2 => 
            array (
                'id' => 8,
                'driver_id' => 5374,
                'bank_name' => '平安银行',
                'bank_city' => '深圳市',
                'bank_subbranch' => '捏你',
                'card_name' => '我收到',
                'card_no' => '4666666666666543',
                'remark' => NULL,
                'create_time' => '2017-05-10 15:59:56',
                'modify_time' => '2017-05-10 15:59:56',
            ),
            3 => 
            array (
                'id' => 9,
                'driver_id' => 5377,
                'bank_name' => '北京银行',
                'bank_city' => '深圳市',
                'bank_subbranch' => 'Jacky',
                'card_name' => 'kkkkk',
                'card_no' => '1236 5825 7556 8852 59999',
                'remark' => NULL,
                'create_time' => '2017-05-11 14:53:40',
                'modify_time' => '2017-05-11 14:53:40',
            ),
            4 => 
            array (
                'id' => 10,
                'driver_id' => 5383,
                'bank_name' => '发展银行',
                'bank_city' => '广州市',
                'bank_subbranch' => '你定',
                'card_name' => '我热死了',
                'card_no' => '4643 7938 3653 8386 83',
                'remark' => NULL,
                'create_time' => '2017-05-11 15:31:45',
                'modify_time' => '2017-05-11 15:31:45',
            ),
            5 => 
            array (
                'id' => 11,
                'driver_id' => 5396,
                'bank_name' => '光大银行',
                'bank_city' => '深圳市',
                'bank_subbranch' => '深南大道',
                'card_name' => '测试',
                'card_no' => '6226620409267853855',
                'remark' => NULL,
                'create_time' => '2017-05-11 16:08:26',
                'modify_time' => '2017-05-11 16:08:26',
            ),
            6 => 
            array (
                'id' => 12,
                'driver_id' => 5386,
                'bank_name' => '北京银行',
                'bank_city' => '深圳市',
                'bank_subbranch' => '深南支行',
                'card_name' => 'test',
                'card_no' => '4568 5557 5369 5423 65',
                'remark' => NULL,
                'create_time' => '2017-05-12 15:25:51',
                'modify_time' => '2017-05-12 15:25:51',
            ),
            7 => 
            array (
                'id' => 13,
                'driver_id' => 5408,
                'bank_name' => '平安银行',
                'bank_city' => '深圳市',
                'bank_subbranch' => '12356',
                'card_name' => 'crazy',
                'card_no' => '6222 9800 1234 5231 41',
                'remark' => NULL,
                'create_time' => '2017-05-15 12:12:18',
                'modify_time' => '2017-05-15 12:12:18',
            ),
            8 => 
            array (
                'id' => 14,
                'driver_id' => 5410,
                'bank_name' => '招商银行',
                'bank_city' => '深圳市',
                'bank_subbranch' => '人民路支行',
                'card_name' => '诺基亚英语',
                'card_no' => '3535353533663666',
                'remark' => NULL,
                'create_time' => '2017-05-15 15:16:33',
                'modify_time' => '2017-05-15 15:16:33',
            ),
            9 => 
            array (
                'id' => 15,
                'driver_id' => 5411,
                'bank_name' => '北京银行',
                'bank_city' => '深圳市',
                'bank_subbranch' => '惊喜交加的',
                'card_name' => '癣疥之疾',
                'card_no' => '4675576868668668656',
                'remark' => NULL,
                'create_time' => '2017-05-15 16:28:46',
                'modify_time' => '2017-05-15 16:28:46',
            ),
            10 => 
            array (
                'id' => 16,
                'driver_id' => 5382,
                'bank_name' => '光大银行',
                'bank_city' => '深圳市',
                'bank_subbranch' => '深南大道',
                'card_name' => '123',
                'card_no' => '5488 4646 8789 97',
                'remark' => NULL,
                'create_time' => '2017-05-15 16:34:35',
                'modify_time' => '2017-05-15 16:34:35',
            ),
            11 => 
            array (
                'id' => 17,
                'driver_id' => 5413,
                'bank_name' => '光大银行',
                'bank_city' => '海淀区',
                'bank_subbranch' => '深圳g车公庙支行行长戴眼镜66',
                'card_name' => '二法国红酒2578899999',
                'card_no' => '76576558668653535251',
                'remark' => NULL,
                'create_time' => '2017-05-16 14:01:03',
                'modify_time' => '2017-05-16 14:01:03',
            ),
            12 => 
            array (
                'id' => 18,
                'driver_id' => 5419,
                'bank_name' => '北京银行',
                'bank_city' => '广州市',
                'bank_subbranch' => '八点半才下班啊啊啊',
                'card_name' => '罗志祥',
                'card_no' => '1525 0200 0005 2555 35',
                'remark' => NULL,
                'create_time' => '2017-05-18 10:38:03',
                'modify_time' => '2017-05-18 10:38:03',
            ),
            13 => 
            array (
                'id' => 19,
                'driver_id' => 5428,
                'bank_name' => '光大银行',
                'bank_city' => '广州市',
                'bank_subbranch' => '你们是我自己都觉得我',
                'card_name' => '我是',
                'card_no' => '1352452542555555555',
                'remark' => NULL,
                'create_time' => '2017-05-18 16:12:09',
                'modify_time' => '2017-05-18 16:12:09',
            ),
            14 => 
            array (
                'id' => 20,
                'driver_id' => 5415,
                'bank_name' => '平安银行',
                'bank_city' => '深圳市',
                'bank_subbranch' => '12278993',
            'card_name' => '122356)$8jggg',
            'card_no' => '236666666666666666999',
            'remark' => NULL,
            'create_time' => '2017-05-19 16:04:59',
            'modify_time' => '2017-05-19 16:04:59',
        ),
        15 => 
        array (
            'id' => 21,
            'driver_id' => 5425,
            'bank_name' => '北京银行',
            'bank_city' => '深圳市',
            'bank_subbranch' => '会不会再见你是个大',
            'card_name' => '家具',
            'card_no' => '5252525255888811111',
            'remark' => NULL,
            'create_time' => '2017-05-19 16:12:16',
            'modify_time' => '2017-05-19 16:12:16',
        ),
        16 => 
        array (
            'id' => 22,
            'driver_id' => 5378,
            'bank_name' => '平安银行',
            'bank_city' => '深圳市',
            'bank_subbranch' => '我',
            'card_name' => '我',
            'card_no' => '123456789012345699633',
            'remark' => NULL,
            'create_time' => '2017-06-30 14:17:27',
            'modify_time' => '2017-06-30 14:17:27',
        ),
        17 => 
        array (
            'id' => 23,
            'driver_id' => 5372,
            'bank_name' => '招商银行',
            'bank_city' => '深圳市',
            'bank_subbranch' => '白石洲支行',
            'card_name' => '莫莫',
            'card_no' => '1245 3214 5785 4165 874',
            'remark' => NULL,
            'create_time' => '2017-07-04 16:35:51',
            'modify_time' => '2017-07-04 16:35:51',
        ),
        18 => 
        array (
            'id' => 24,
            'driver_id' => 5463,
            'bank_name' => '招商银行',
            'bank_city' => '海淀区',
            'bank_subbranch' => '深南大道9966支行ghhjjvgg',
            'card_name' => '测试test',
            'card_no' => '5758686868653565686',
            'remark' => NULL,
            'create_time' => '2017-07-06 15:28:05',
            'modify_time' => '2017-07-06 15:28:05',
        ),
        19 => 
        array (
            'id' => 25,
            'driver_id' => 5462,
            'bank_name' => '北京银行',
            'bank_city' => '深圳市',
            'bank_subbranch' => 'dnd3dndbndvnsc地县级洗涤剂',
            'card_name' => 'n林话就好',
            'card_no' => '7686468346968364638',
            'remark' => NULL,
            'create_time' => '2017-07-06 15:33:57',
            'modify_time' => '2017-07-06 15:33:57',
        ),
        20 => 
        array (
            'id' => 26,
            'driver_id' => 5464,
            'bank_name' => '北京银行',
            'bank_city' => '深圳市',
            'bank_subbranch' => '深南大道中988',
            'card_name' => 'test测试f',
            'card_no' => '4568665655555586565',
            'remark' => NULL,
            'create_time' => '2017-07-06 15:55:10',
            'modify_time' => '2017-07-06 15:55:10',
        ),
        21 => 
        array (
            'id' => 27,
            'driver_id' => 5486,
            'bank_name' => '请选择',
            'bank_city' => '请选择',
            'bank_subbranch' => '儿童自行车',
            'card_name' => '九点半',
            'card_no' => '6655 5668 8888 0885 58',
            'remark' => NULL,
            'create_time' => '2017-09-14 15:41:51',
            'modify_time' => '2017-09-14 15:41:51',
        ),
        22 => 
        array (
            'id' => 28,
            'driver_id' => 5470,
            'bank_name' => '平安银行',
            'bank_city' => '深圳市',
            'bank_subbranch' => '测试',
            'card_name' => '测试',
            'card_no' => '456543654654567664235',
            'remark' => NULL,
            'create_time' => '2017-12-13 10:37:55',
            'modify_time' => '2017-12-13 10:37:55',
        ),
        23 => 
        array (
            'id' => 29,
            'driver_id' => 5484,
            'bank_name' => '平安银行',
            'bank_city' => '海淀区',
            'bank_subbranch' => 'Cdgdhfhfugjgjfu',
            'card_name' => '张家界',
            'card_no' => '123456789012345678901',
            'remark' => NULL,
            'create_time' => '2017-12-21 16:19:52',
            'modify_time' => '2017-12-21 16:19:52',
        ),
        24 => 
        array (
            'id' => 30,
            'driver_id' => 5483,
            'bank_name' => '平安银行',
            'bank_city' => '广州市',
            'bank_subbranch' => 'Yuhuhh',
            'card_name' => 'Mkkk ',
            'card_no' => '366552635545566325552',
            'remark' => NULL,
            'create_time' => '2017-12-21 16:21:05',
            'modify_time' => '2017-12-21 16:21:05',
        ),
        25 => 
        array (
            'id' => 31,
            'driver_id' => 5485,
            'bank_name' => '招商银行',
            'bank_city' => '广州市',
            'bank_subbranch' => '张家界国家森林公园',
            'card_name' => '车公庙泰然',
            'card_no' => '123456789012345678900',
            'remark' => NULL,
            'create_time' => '2017-12-22 14:37:24',
            'modify_time' => '2017-12-22 14:37:24',
        ),
        26 => 
        array (
            'id' => 32,
            'driver_id' => 5498,
            'bank_name' => '平安银行',
            'bank_city' => '深圳市',
            'bank_subbranch' => 'Ndj ',
            'card_name' => 'Bd Jc',
            'card_no' => '556464646646466461161',
            'remark' => NULL,
            'create_time' => '2018-01-04 10:29:11',
            'modify_time' => '2018-01-04 10:29:11',
        ),
        27 => 
        array (
            'id' => 33,
            'driver_id' => 5497,
            'bank_name' => '平安银行',
            'bank_city' => '深圳市',
            'bank_subbranch' => 'Fg ',
            'card_name' => 'Fg ',
            'card_no' => '455655555566545565556',
            'remark' => NULL,
            'create_time' => '2018-01-04 10:32:26',
            'modify_time' => '2018-01-04 10:32:26',
        ),
    ));
        
        
    }
}