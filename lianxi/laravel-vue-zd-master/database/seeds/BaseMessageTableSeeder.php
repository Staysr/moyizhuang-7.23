<?php

use Illuminate\Database\Seeder;

class BaseMessageTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('base_message')->delete();
        
        \DB::table('base_message')->insert(array (
            0 => 
            array (
                'id' => 6,
                'message' => 'fljlsfsdf',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '18000000000',
                'send_time' => '2017-05-10 15:55:54',
                'create_time' => '2017-05-10 15:55:54',
                'modify_time' => '2017-05-10 15:55:54',
            ),
            1 => 
            array (
                'id' => 7,
                'message' => '干的不错 奖励给你大保健去！！',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13200000000',
                'send_time' => '2017-05-12 11:05:44',
                'create_time' => '2017-05-12 11:05:44',
                'modify_time' => '2017-05-12 11:05:44',
            ),
            2 => 
            array (
                'id' => 8,
                'message' => '测试',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13556873817',
                'send_time' => '2017-05-12 15:13:12',
                'create_time' => '2017-05-12 15:13:12',
                'modify_time' => '2017-05-12 15:13:12',
            ),
            3 => 
            array (
                'id' => 9,
                'message' => '测试',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13682509527',
                'send_time' => '2017-05-12 15:13:48',
                'create_time' => '2017-05-12 15:13:48',
                'modify_time' => '2017-05-12 15:13:48',
            ),
            4 => 
            array (
                'id' => 10,
                'message' => '客户普遍反馈司机服务态度好，奖励5元；',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '17000000000',
                'send_time' => '2017-05-17 12:20:45',
                'create_time' => '2017-05-17 12:20:45',
                'modify_time' => '2017-05-17 12:20:45',
            ),
            5 => 
            array (
                'id' => 11,
                'message' => '客户普遍反馈司机服务态度好，奖励2元',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '17000000000',
                'send_time' => '2017-05-17 12:28:41',
                'create_time' => '2017-05-17 12:28:41',
                'modify_time' => '2017-05-17 12:28:41',
            ),
            6 => 
            array (
                'id' => 12,
                'message' => '客户普遍反馈司机服务态度好，奖励2元',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '17000000000',
                'send_time' => '2017-05-17 12:29:19',
                'create_time' => '2017-05-17 12:29:19',
                'modify_time' => '2017-05-17 12:29:19',
            ),
            7 => 
            array (
                'id' => 13,
                'message' => '客户普遍反馈司机服务态度好，奖励2元',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '17000000000',
                'send_time' => '2017-05-17 13:49:35',
                'create_time' => '2017-05-17 13:49:35',
                'modify_time' => '2017-05-17 13:49:35',
            ),
            8 => 
            array (
                'id' => 14,
                'message' => '* 如客户普遍反馈司机服务态度好，奖励2元；',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13537580621',
                'send_time' => '2017-05-17 14:30:27',
                'create_time' => '2017-05-17 14:30:27',
                'modify_time' => '2017-05-17 14:30:27',
            ),
            9 => 
            array (
                'id' => 15,
                'message' => 'Android和ios的货主端，在地图选择页面的车型规格与后台数据不一致Android和ios的货主端，在地图选择页面的车型规格与后台数据不一致Android和ios的货主端，在地图选择页面的车型规格与后台数据不一致',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13312345678',
                'send_time' => '2017-05-17 15:00:00',
                'create_time' => '2017-05-17 14:51:40',
                'modify_time' => '2017-05-17 14:51:40',
            ),
            10 => 
            array (
                'id' => 16,
                'message' => '您上传的车贴照片已通过审核，奖励金额100.00元，请留意！',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13312345678',
                'send_time' => '2017-05-17 14:53:47',
                'create_time' => '2017-05-17 14:53:47',
                'modify_time' => '2017-05-17 14:53:47',
            ),
            11 => 
            array (
                'id' => 17,
                'message' => '您上传的车贴照片已通过审核，奖励金额100.00元，请留意！',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13510525635',
                'send_time' => '2017-05-17 14:58:56',
                'create_time' => '2017-05-17 14:58:56',
                'modify_time' => '2017-05-17 14:58:56',
            ),
            12 => 
            array (
                'id' => 18,
                'message' => '您上传的车贴照片不合格，未通过审核',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13537580621',
                'send_time' => '2017-05-18 09:21:16',
                'create_time' => '2017-05-18 09:21:16',
                'modify_time' => '2017-05-18 09:21:16',
            ),
            13 => 
            array (
                'id' => 19,
                'message' => '您上传的车贴照片已通过审核，奖励金额50.00元，请留意！',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13312345678',
                'send_time' => '2017-05-18 09:24:53',
                'create_time' => '2017-05-18 09:24:53',
                'modify_time' => '2017-05-18 09:24:53',
            ),
            14 => 
            array (
                'id' => 20,
                'message' => '服务好，客户反馈服务质量很高，以资鼓励，奖励20元',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13312345678',
                'send_time' => '2017-05-18 11:20:27',
                'create_time' => '2017-05-18 11:20:27',
                'modify_time' => '2017-05-18 11:20:27',
            ),
            15 => 
            array (
                'id' => 21,
                'message' => '5月18日小雨',
                'message_type' => 1,
                'user_type' => 1,
                'status' => 1,
                'category_id' => '6',
                'phone' => NULL,
                'send_time' => '2017-05-18 16:00:00',
                'create_time' => '2017-05-18 15:32:03',
                'modify_time' => '2017-05-18 15:32:03',
            ),
            16 => 
            array (
                'id' => 22,
                'message' => '您上传的车贴照片已通过审核，奖励金额7.00元，请留意！',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13912345678',
                'send_time' => '2017-05-19 16:10:48',
                'create_time' => '2017-05-19 16:10:48',
                'modify_time' => '2017-05-19 16:10:48',
            ),
            17 => 
            array (
                'id' => 23,
                'message' => '您上传的车贴照片已通过审核，奖励金额7.00元，请留意！',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13510525635',
                'send_time' => '2017-05-19 16:26:25',
                'create_time' => '2017-05-19 16:26:25',
                'modify_time' => '2017-05-19 16:26:25',
            ),
            18 => 
            array (
                'id' => 24,
                'message' => '65453131234651321635163523323
2652032035立刻机会考和你看 开户行已hiUI刘  就会很   屁股眼 远高于已偶偶偶奇偶欧克后会已hiu9iuiu 欧欧锦 哦哦 胡股份发一套费用我会哦奇偶票 ',
                'message_type' => 1,
                'user_type' => 1,
                'status' => 1,
                'category_id' => 'ALL',
                'phone' => NULL,
                'send_time' => '2017-07-26 16:25:00',
                'create_time' => '2017-07-26 16:21:53',
                'modify_time' => '2017-07-26 16:21:53',
            ),
            19 => 
            array (
                'id' => 25,
                'message' => '尊敬的XXX，您已通过省局互联网平台成功预约科目一考试，日期：2017XX13;时间:08:0009:00;考场：西丽科目一考场。尊敬的XXX，您已通过省局互联网平台成功预约科目一考试，日期：2017XX13;时间:08:0009:00;考场：西丽科目一考场。尊敬的XXX，您已通过省局互联网平台成功预约科目一考试，日期：2017XX13;',
                'message_type' => 1,
                'user_type' => 1,
                'status' => 1,
                'category_id' => 'ALL',
                'phone' => NULL,
                'send_time' => '2017-07-26 16:30:00',
                'create_time' => '2017-07-26 16:22:02',
                'modify_time' => '2017-07-26 16:22:02',
            ),
            20 => 
            array (
                'id' => 26,
                'message' => '654654464654964565465464135468461534685453461546451',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13444444444',
                'send_time' => '2017-07-26 16:25:00',
                'create_time' => '2017-07-26 16:23:04',
                'modify_time' => '2017-07-26 16:23:04',
            ),
            21 => 
            array (
                'id' => 27,
                'message' => '52415163541651353565',
                'message_type' => 1,
                'user_type' => 2,
                'status' => 1,
                'category_id' => 'ALL',
                'phone' => NULL,
                'send_time' => '2017-07-26 16:30:00',
                'create_time' => '2017-07-26 16:27:23',
                'modify_time' => '2017-07-26 16:27:23',
            ),
            22 => 
            array (
                'id' => 28,
                'message' => '科目一，又称科目一理论考试、驾驶员理论考试，是机动车驾驶证考核的一部分。根据《机动车驾驶证申领和使用规定》，考试内容包括驾车理论基础、道路安全法律法规、地方性法规等相关知识。考试形式为上机考试，100道题，90分及以上过关。',
                'message_type' => 1,
                'user_type' => 2,
                'status' => 1,
                'category_id' => 'ALL',
                'phone' => NULL,
                'send_time' => '2017-07-26 16:35:00',
                'create_time' => '2017-07-26 16:31:30',
                'modify_time' => '2017-07-26 16:31:30',
            ),
            23 => 
            array (
                'id' => 29,
                'message' => '给你的教练打个电话问一问，就什么都知道了。给你的教练打个电话问一问，就什么都知道了。给你的教练打个电话问一问，就什么都知道了。给你的教练打个电话问一问，就什么都知道了。给你的教练打个电话问一问，就什么都知道了。给你的教练打个电话问一问，就什么都知道了。给你的教练打个电话问一问，就什么都知道了。',
                'message_type' => 1,
                'user_type' => 3,
                'status' => 1,
                'category_id' => 'ALL',
                'phone' => NULL,
                'send_time' => '2017-07-26 16:36:00',
                'create_time' => '2017-07-26 16:32:30',
                'modify_time' => '2017-07-26 16:32:30',
            ),
            24 => 
            array (
                'id' => 30,
                'message' => 'ggjkfgkw',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '18800000000',
                'send_time' => '2017-09-28 14:21:00',
                'create_time' => '2017-09-28 14:18:55',
                'modify_time' => '2017-09-28 14:18:55',
            ),
            25 => 
            array (
                'id' => 31,
                'message' => '18800000000
18800000000
18800000000',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '18800000000',
                'send_time' => '2017-09-28 14:30:00',
                'create_time' => '2017-09-28 14:20:21',
                'modify_time' => '2017-09-28 14:20:21',
            ),
            26 => 
            array (
                'id' => 32,
                'message' => '个笔记本发没办法，吧，开发边框未百分比没，发布，没办法，白富美，部门，发标书么，bfmsabfbdmfbafbajkds',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '18800000000',
                'send_time' => '2017-09-28 14:29:00',
                'create_time' => '2017-09-28 14:28:32',
                'modify_time' => '2017-09-28 14:28:32',
            ),
            27 => 
            array (
                'id' => 33,
                'message' => '3253166565156655666',
                'message_type' => 1,
                'user_type' => 1,
                'status' => 1,
                'category_id' => '6',
                'phone' => NULL,
                'send_time' => '2017-09-28 14:45:00',
                'create_time' => '2017-09-28 14:41:31',
                'modify_time' => '2017-09-28 14:41:31',
            ),
            28 => 
            array (
                'id' => 34,
                'message' => '546541651651611351',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '18000000000',
                'send_time' => '2017-09-29 15:28:00',
                'create_time' => '2017-09-29 15:27:56',
                'modify_time' => '2017-09-29 15:27:56',
            ),
            29 => 
            array (
                'id' => 35,
                'message' => '65651469464446',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '1800000000',
                'send_time' => '2017-09-29 15:39:00',
                'create_time' => '2017-09-29 15:38:31',
                'modify_time' => '2017-09-29 15:38:31',
            ),
            30 => 
            array (
                'id' => 36,
                'message' => '
深圳：东部华侨城
广州：中山纪念堂
东莞：隐贤山庄
惠州：罗浮山
佛山：三水森林公园
中山：孙中山故居
湛江：寸金桥公园',
                'message_type' => 1,
                'user_type' => 2,
                'status' => 1,
                'category_id' => '6',
                'phone' => NULL,
                'send_time' => '2017-12-06 15:00:00',
                'create_time' => '2017-12-06 14:32:04',
                'modify_time' => '2017-12-06 14:32:04',
            ),
            31 => 
            array (
                'id' => 37,
                'message' => '测试',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '18000000000',
                'send_time' => '2017-12-28 17:00:00',
                'create_time' => '2017-12-28 16:50:00',
                'modify_time' => '2017-12-28 16:50:00',
            ),
            32 => 
            array (
                'id' => 38,
                'message' => '发生的冯绍峰方法阿发',
                'message_type' => 1,
                'user_type' => 1,
                'status' => 1,
                'category_id' => '6',
                'phone' => NULL,
                'send_time' => '2017-12-28 17:20:00',
                'create_time' => '2017-12-28 17:18:30',
                'modify_time' => '2017-12-28 17:18:30',
            ),
            33 => 
            array (
                'id' => 39,
                'message' => '热同行业通融通融高投入高投入高投入',
                'message_type' => 1,
                'user_type' => 1,
                'status' => 1,
                'category_id' => '6',
                'phone' => NULL,
                'send_time' => '2017-12-29 09:25:00',
                'create_time' => '2017-12-29 09:24:38',
                'modify_time' => '2017-12-29 09:24:38',
            ),
            34 => 
            array (
                'id' => 40,
                'message' => 'dsfasdfadfasdf',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13422222222',
                'send_time' => '2017-12-29 11:00:00',
                'create_time' => '2017-12-29 11:28:48',
                'modify_time' => '2017-12-29 11:28:48',
            ),
            35 => 
            array (
                'id' => 41,
                'message' => '测试距离',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13716945731',
                'send_time' => '2018-01-03 10:41:00',
                'create_time' => '2018-01-03 10:39:32',
                'modify_time' => '2018-01-03 10:39:32',
            ),
            36 => 
            array (
                'id' => 42,
                'message' => '中国 刚好灰姑娘   干红那个火锅湖广会馆  孤鸿寡鹄恭候共和国',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '18707640533',
                'send_time' => '2018-08-01 17:00:00',
                'create_time' => '2018-08-01 14:07:15',
                'modify_time' => '2018-08-01 14:07:15',
            ),
            37 => 
            array (
                'id' => 43,
                'message' => '测试消息通知，前方高能，请注意。',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13411100000',
                'send_time' => '2018-08-14 16:31:00',
                'create_time' => '2018-08-14 16:33:19',
                'modify_time' => '2018-08-14 16:33:19',
            ),
            38 => 
            array (
                'id' => 44,
                'message' => '测试消息通知，前方高能，请注意。',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13411100000',
                'send_time' => '2018-08-14 16:34:00',
                'create_time' => '2018-08-14 16:34:51',
                'modify_time' => '2018-08-14 16:34:51',
            ),
            39 => 
            array (
                'id' => 45,
                'message' => '测试消息通知，前方高能，请注意。',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13411100000',
                'send_time' => '2018-08-14 16:36:00',
                'create_time' => '2018-08-14 16:35:47',
                'modify_time' => '2018-08-14 16:35:47',
            ),
            40 => 
            array (
                'id' => 46,
                'message' => '测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试',
                'message_type' => 1,
                'user_type' => 1,
                'status' => 1,
                'category_id' => '6',
                'phone' => NULL,
                'send_time' => '2018-08-23 14:22:00',
                'create_time' => '2018-08-23 14:23:07',
                'modify_time' => '2018-08-23 14:23:07',
            ),
            41 => 
            array (
                'id' => 47,
                'message' => '测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试',
                'message_type' => 1,
                'user_type' => 1,
                'status' => 1,
                'category_id' => 'ALL',
                'phone' => NULL,
                'send_time' => '2018-08-23 14:25:00',
                'create_time' => '2018-08-23 14:25:37',
                'modify_time' => '2018-08-23 14:25:37',
            ),
            42 => 
            array (
                'id' => 48,
                'message' => '测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试',
                'message_type' => 1,
                'user_type' => 1,
                'status' => 1,
                'category_id' => 'ALL',
                'phone' => NULL,
                'send_time' => '2018-08-23 15:04:00',
                'create_time' => '2018-08-23 15:04:31',
                'modify_time' => '2018-08-23 15:04:31',
            ),
            43 => 
            array (
                'id' => 49,
                'message' => '测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部测试内部',
                'message_type' => 1,
                'user_type' => 1,
                'status' => 1,
                'category_id' => '6',
                'phone' => NULL,
                'send_time' => '2018-08-23 15:06:00',
                'create_time' => '2018-08-23 15:06:34',
                'modify_time' => '2018-08-23 15:06:34',
            ),
            44 => 
            array (
                'id' => 50,
                'message' => '测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13411111111',
                'send_time' => '2018-08-23 15:18:00',
                'create_time' => '2018-08-23 15:18:36',
                'modify_time' => '2018-08-23 15:18:36',
            ),
            45 => 
            array (
                'id' => 51,
                'message' => '测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试',
                'message_type' => 2,
                'user_type' => 2,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13410000002',
                'send_time' => '2018-08-23 15:30:00',
                'create_time' => '2018-08-23 15:31:03',
                'modify_time' => '2018-08-23 15:31:03',
            ),
            46 => 
            array (
                'id' => 52,
                'message' => '13410000002134100000021341000000213410000002134100000021341000000213410000002134100000021341000000213410000002134100000021341000000213410000002',
                'message_type' => 2,
                'user_type' => 2,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13410000002',
                'send_time' => '2018-08-23 15:33:00',
                'create_time' => '2018-08-23 15:33:20',
                'modify_time' => '2018-08-23 15:33:20',
            ),
            47 => 
            array (
                'id' => 53,
                'message' => '测试老大测试 测试老大测试测试老大测试测试老大测试',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13411111111,13400000000',
                'send_time' => '2018-08-28 17:12:00',
                'create_time' => '2018-08-28 17:12:58',
                'modify_time' => '2018-08-28 17:12:58',
            ),
            48 => 
            array (
                'id' => 54,
                'message' => ' 测试测试  测试测试   测试测试',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13411111111，13400000000',
                'send_time' => '2018-08-28 17:38:00',
                'create_time' => '2018-08-28 17:38:17',
                'modify_time' => '2018-08-28 17:38:17',
            ),
            49 => 
            array (
                'id' => 55,
                'message' => '拿人的手短,吃人的嘴软,说的是一个人如果沾了人家的便宜,即使人家有缺点或者错误也就不敢说、不敢管了',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13411111111,13400000000',
                'send_time' => '2018-08-28 17:42:00',
                'create_time' => '2018-08-28 17:42:53',
                'modify_time' => '2018-08-28 17:42:53',
            ),
            50 => 
            array (
                'id' => 56,
                'message' => '这是一条给书芳的测试消息，请注意查收。',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13716945731',
                'send_time' => '2018-09-06 15:10:00',
                'create_time' => '2018-09-06 15:09:29',
                'modify_time' => '2018-09-06 15:09:29',
            ),
            51 => 
            array (
                'id' => 57,
                'message' => '测试短信功能，请注意消息查收',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13510525635',
                'send_time' => '2018-09-12 10:45:00',
                'create_time' => '2018-09-12 10:45:18',
                'modify_time' => '2018-09-12 10:45:18',
            ),
            52 => 
            array (
                'id' => 58,
                'message' => '温馨提示与消息发送时间去掉，图标按钮换成喇叭：收到后台发的系统消息后，会自动播放一遍，点关闭按钮后停止播报并关闭消息，如果不关闭消息，再次点击喇叭，则会重新播放一遍；如果消息没有播放完，点击喇叭，则重头开始再播放。再次点击喇叭按钮，可再次语音播放，语音播放时喇叭会有正在播放的动态效果',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13510525635',
                'send_time' => '2018-09-12 10:46:00',
                'create_time' => '2018-09-12 10:46:33',
                'modify_time' => '2018-09-12 10:46:33',
            ),
            53 => 
            array (
                'id' => 59,
                'message' => ' 温馨提示与消息发送时间去掉，图标按钮换成喇叭：收到后台发的系统消息后，会自动播放一遍，点关闭按钮后停止播报并关闭消息，如果不关闭消息，再次点击喇叭，则会重新播放一遍；如果消息没有播放完，点击喇叭，则重头开始再播放。再次点击喇叭按钮，可再次语音播放，语音播放时喇叭会有正在播放的动态效果',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13510525635',
                'send_time' => '2018-09-12 10:48:00',
                'create_time' => '2018-09-12 10:49:43',
                'modify_time' => '2018-09-12 10:49:43',
            ),
            54 => 
            array (
                'id' => 60,
                'message' => '方舟来拉',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13714665529',
                'send_time' => '2018-09-14 12:29:00',
                'create_time' => '2018-09-14 12:32:39',
                'modify_time' => '2018-09-14 12:32:39',
            ),
            55 => 
            array (
                'id' => 61,
                'message' => '家坐落于世界级景区的蔚来中心。在开业仪式现场，蔚来汽车创始人、董事长兼CEO李斌与网通社进行了沟通，他表示：“基于制造端、软件端、服务端三方面因素，蔚来目前已经开始刻意控制ES8的交付节奏，尽可能让用户提车之后马上有服务网点。”',
                'message_type' => 1,
                'user_type' => 1,
                'status' => 1,
                'category_id' => '6',
                'phone' => NULL,
                'send_time' => '2018-09-14 18:30:00',
                'create_time' => '2018-09-14 18:28:56',
                'modify_time' => '2018-09-14 18:28:56',
            ),
            56 => 
            array (
                'id' => 62,
                'message' => '在致辞中，习近平总结了近年来中俄远东合作成果，并为新形势下共同促进东北亚地区和平稳定和发展繁荣提出倡议，强调中方愿同地区国家一道，维护地区和平安宁，实现各国互利共',
                'message_type' => 2,
                'user_type' => 1,
                'status' => 1,
                'category_id' => NULL,
                'phone' => '13714665529',
                'send_time' => '2018-09-14 19:19:00',
                'create_time' => '2018-09-14 19:23:41',
                'modify_time' => '2018-09-14 19:23:41',
            ),
            57 => 
            array (
                'id' => 63,
                'message' => '系统通知：台风即将来临，所有队长务必通知到每位队员，所有队员确保车辆停在安全的地方，为了安全起见，大家今天都不要出车了。休息一天',
                'message_type' => 1,
                'user_type' => 1,
                'status' => 1,
                'category_id' => '6',
                'phone' => NULL,
                'send_time' => '2018-09-17 12:30:00',
                'create_time' => '2018-09-17 12:26:56',
                'modify_time' => '2018-09-17 12:26:56',
            ),
        ));
        
        
    }
}