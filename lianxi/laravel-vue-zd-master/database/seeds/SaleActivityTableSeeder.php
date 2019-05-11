<?php

use Illuminate\Database\Seeder;

class SaleActivityTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sale_activity')->delete();
        
        \DB::table('sale_activity')->insert(array (
            0 => 
            array (
                'id' => 7,
                'category_id' => 0,
                'category_code' => NULL,
                'name' => '年底充值倾情巨献',
                'url' => 'http://192.168.2.240/index/index/index.html',
                'main' => '/php-web/2017-03-29/20170329145809_9529.png',
                'popup' => '/php-web/2017-03-29/20170329145809_40887.png',
                'share_content' => '',
                'start_date' => '2017-03-01',
                'end_date' => '2017-10-01',
                'status' => 0,
                'rule_type' => 0,
                'create_time' => '2017-03-29 14:58:09',
                'modify_time' => '2017-09-30 17:10:27',
            ),
            1 => 
            array (
                'id' => 8,
                'category_id' => 0,
                'category_code' => NULL,
                'name' => '单单返',
                'url' => 'http://192.168.2.240:8099/client-controller/activityPage/share-there.html#51256/a5041ca188f4b86ce56e4c7c0fef9e50',
                'main' => '/php-web/2017-06-05/20170605160634_21944.png',
                'popup' => '/php-web/2017-06-05/20170605160634_81848.png',
                'share_content' => '',
                'start_date' => '2017-03-28',
                'end_date' => '2017-10-30',
                'status' => 1,
                'rule_type' => 1,
                'create_time' => '2017-03-29 14:59:39',
                'modify_time' => '2017-08-17 15:04:19',
            ),
            2 => 
            array (
                'id' => 9,
                'category_id' => 0,
                'category_code' => NULL,
                'name' => '大肥大',
                'url' => 'http://192.168.2.240:8099/client-controller/activityPage/share-there.html#51256/a5041ca188f4b86ce56e4c7c0fef9e50',
                'main' => '/php-web/2017-06-05/20170605160756_48060.png',
                'popup' => '/php-web/2017-06-05/20170605160756_20287.png',
                'share_content' => '测试活动',
                'start_date' => '2017-06-03',
                'end_date' => '2017-10-12',
                'status' => 1,
                'rule_type' => 0,
                'create_time' => '2017-06-05 16:07:56',
                'modify_time' => '2017-08-17 15:04:00',
            ),
            3 => 
            array (
                'id' => 10,
                'category_id' => 0,
                'category_code' => NULL,
                'name' => '玩鸡鸡',
                'url' => 'http://cartest.fzhd8.cn/car/index.html',
                'main' => '/php-web/2017-08-17/20170817153415_13083.png',
                'popup' => '/php-web/2017-08-17/20170817153415_3844.png',
                'share_content' => '',
                'start_date' => '2017-08-09',
                'end_date' => '2017-09-20',
                'status' => 1,
                'rule_type' => 0,
                'create_time' => '2017-08-17 15:34:15',
                'modify_time' => '2017-08-17 15:34:15',
            ),
            4 => 
            array (
                'id' => 11,
                'category_id' => 0,
                'category_code' => '',
                'name' => '你妹的',
                'url' => 'http://192.168.2.187:8100/zentao/bug-browse-1-0-bymodule-0-id_desc-0-20.html',
                'main' => '/php-web/2017-08-17/20170817153511_22750.png',
                'popup' => '/php-web/2017-08-17/20170817153511_26372.png',
                'share_content' => '',
                'start_date' => '2017-08-14',
                'end_date' => '2017-10-12',
                'status' => 1,
                'rule_type' => 0,
                'create_time' => '2017-08-17 15:35:11',
                'modify_time' => '2017-10-31 10:02:02',
            ),
            5 => 
            array (
                'id' => 12,
                'category_id' => 0,
                'category_code' => NULL,
                'name' => '规范合格',
                'url' => 'http://gu.qq.com/sh603676/gp',
                'main' => '/php-web/2017-08-17/20170817153707_60552.png',
                'popup' => '/php-web/2017-08-17/20170817153707_33494.png',
                'share_content' => '',
                'start_date' => '2017-08-09',
                'end_date' => '2017-10-23',
                'status' => 0,
                'rule_type' => 0,
                'create_time' => '2017-08-17 15:37:07',
                'modify_time' => '2017-09-30 17:10:43',
            ),
            6 => 
            array (
                'id' => 13,
                'category_id' => 0,
                'category_code' => '',
                'name' => '电饭锅',
                'url' => 'http://backtest.fzhd8.cn/index/index/index.html',
                'main' => '/php-web/2017-08-17/20170817153752_3011.png',
                'popup' => '/php-web/2017-08-17/20170817153752_94100.png',
                'share_content' => '',
                'start_date' => '2017-07-31',
                'end_date' => '2017-10-12',
                'status' => 1,
                'rule_type' => 0,
                'create_time' => '2017-08-17 15:37:52',
                'modify_time' => '2017-10-31 10:02:42',
            ),
            7 => 
            array (
                'id' => 14,
                'category_id' => 0,
                'category_code' => NULL,
                'name' => '二恶为',
                'url' => 'http://image.so.com/',
                'main' => '/php-web/2017-08-17/20170817153910_36477.png',
                'popup' => '/php-web/2017-08-17/20170817153910_14509.png',
                'share_content' => '',
                'start_date' => '2017-08-08',
                'end_date' => '2017-09-01',
                'status' => 1,
                'rule_type' => 0,
                'create_time' => '2017-08-17 15:39:10',
                'modify_time' => '2017-08-17 15:39:10',
            ),
            8 => 
            array (
                'id' => 15,
                'category_id' => 6,
                'category_code' => '0101002',
                'name' => '首单返',
                'url' => 'http://www.baidu.com',
                'main' => '/php-web/2017-10-30/20171030095553_78814.jpg',
                'popup' => '',
                'share_content' => '首单返',
                'start_date' => '2017-10-29',
                'end_date' => '2018-02-13',
                'status' => 1,
                'rule_type' => 2,
                'create_time' => '2017-10-30 09:55:53',
                'modify_time' => '2018-01-09 15:54:52',
            ),
            9 => 
            array (
                'id' => 16,
                'category_id' => 100180,
                'category_code' => '0101005',
                'name' => '广州首单返',
                'url' => 'http://www.bing.com',
                'main' => '/php-web/2017-10-30/20171030111026_38501.jpg',
                'popup' => '',
                'share_content' => '佛挡杀佛佛挡杀佛',
                'start_date' => '2017-10-30',
                'end_date' => '2017-10-31',
                'status' => 0,
                'rule_type' => 2,
                'create_time' => '2017-10-30 11:10:26',
                'modify_time' => '2017-10-30 15:31:47',
            ),
            10 => 
            array (
                'id' => 17,
                'category_id' => 0,
                'category_code' => '',
                'name' => '舒服方式发生的，。，。师傅师傅说发顺丰刚刚',
                'url' => 'http://www.58.com',
                'main' => '/php-web/2017-10-30/20171030151013_630.jpg',
                'popup' => '/php-web/2017-10-31/20171031100431_64971.png',
                'share_content' => '的方法对方答复地方',
                'start_date' => '2017-10-27',
                'end_date' => '2017-10-27',
                'status' => 1,
                'rule_type' => 2,
                'create_time' => '2017-10-30 15:10:13',
                'modify_time' => '2017-10-31 10:40:53',
            ),
            11 => 
            array (
                'id' => 18,
                'category_id' => 0,
                'category_code' => '',
                'name' => '个股',
                'url' => 'http://www.bing.com',
                'main' => '/php-web/2018-08-28/20180828102827_38814.png',
                'popup' => '/php-web/2018-08-28/20180828102827_78684.png',
                'share_content' => '',
                'start_date' => '2017-10-29',
                'end_date' => '2019-10-29',
                'status' => 0,
                'rule_type' => 2,
                'create_time' => '2017-10-30 16:27:10',
                'modify_time' => '2018-09-15 09:55:52',
            ),
            12 => 
            array (
                'id' => 19,
                'category_id' => 0,
                'category_code' => '',
                'name' => '双11首单返',
                'url' => 'http://ftp.www.com',
                'main' => '/php-web/2017-10-31/20171031104312_6682.png',
                'popup' => '',
                'share_content' => '',
                'start_date' => '2017-10-30',
                'end_date' => '2019-10-30',
                'status' => 0,
                'rule_type' => 2,
                'create_time' => '2017-10-31 10:43:12',
                'modify_time' => '2018-09-15 09:55:36',
            ),
            13 => 
            array (
                'id' => 20,
                'category_id' => 0,
                'category_code' => '',
                'name' => '优惠劵',
                'url' => 'http://www.baidu.com',
                'main' => '/php-web/2017-10-31/20171031105147_34653.jpg',
                'popup' => '',
                'share_content' => '测试',
                'start_date' => '2017-10-01',
                'end_date' => '2019-12-10',
                'status' => 0,
                'rule_type' => 2,
                'create_time' => '2017-10-31 10:51:47',
                'modify_time' => '2018-09-15 09:55:23',
            ),
            14 => 
            array (
                'id' => 21,
                'category_id' => 6,
                'category_code' => '0101002',
                'name' => '货主注册',
                'url' => 'https://www.baidu.com/',
                'main' => '/php-web/2017-11-06/20171106143200_36742.png',
                'popup' => '',
                'share_content' => '',
                'start_date' => '2017-11-02',
                'end_date' => '2018-04-18',
                'status' => 1,
                'rule_type' => 3,
                'create_time' => '2017-11-06 14:32:00',
                'modify_time' => '2018-04-02 17:12:32',
            ),
            15 => 
            array (
                'id' => 22,
                'category_id' => 100180,
                'category_code' => '0101005',
                'name' => '货主送劵2',
                'url' => 'https://www.baidu.com/',
                'main' => '/php-web/2017-11-06/20171106143501_42112.png',
                'popup' => '',
                'share_content' => '',
                'start_date' => '2017-11-05',
                'end_date' => '2017-11-09',
                'status' => 1,
                'rule_type' => 3,
                'create_time' => '2017-11-06 14:35:01',
                'modify_time' => '2017-11-06 14:35:01',
            ),
            16 => 
            array (
                'id' => 23,
                'category_id' => 0,
                'category_code' => '',
                'name' => '赣州优惠劵2块',
                'url' => 'https://www.baidu.com/',
                'main' => '/php-web/2017-11-07/20171107135151_91893.png',
                'popup' => '',
                'share_content' => '组成',
                'start_date' => '2017-11-08',
                'end_date' => '2019-11-12',
                'status' => 1,
                'rule_type' => 3,
                'create_time' => '2017-11-07 13:51:51',
                'modify_time' => '2018-08-28 10:26:34',
            ),
            17 => 
            array (
                'id' => 24,
                'category_id' => 6,
                'category_code' => '0101002',
                'name' => '圣诞节',
                'url' => 'https://www.wenjuan.in/s/QNzqyip/',
                'main' => '/php-web/2018-01-09/20180109155657_25440.png',
                'popup' => '/php-web/2018-01-09/20180109155657_42629.png',
                'share_content' => '',
                'start_date' => '2018-01-09',
                'end_date' => '2019-04-25',
                'status' => 1,
                'rule_type' => 0,
                'create_time' => '2018-01-09 15:55:14',
                'modify_time' => '2018-08-28 10:26:09',
            ),
            18 => 
            array (
                'id' => 25,
                'category_id' => 0,
                'category_code' => '',
                'name' => '测试-特惠充值，倾情巨献',
                'url' => 'https://client.fzhd8.cn/client-controller/activityPage/charge.html',
                'main' => '/php-web/2018-03-27/20180327095030_12551.png',
                'popup' => '/php-web/2018-03-27/20180327095030_7022.png',
                'share_content' => '测试-特惠充值，倾情巨献；狗富贵，互相旺-测试',
                'start_date' => '2018-04-20',
                'end_date' => '2019-04-22',
                'status' => 1,
                'rule_type' => 0,
                'create_time' => '2018-03-27 09:50:30',
                'modify_time' => '2018-08-28 10:25:01',
            ),
        ));
        
        
    }
}