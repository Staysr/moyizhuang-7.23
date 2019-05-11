<?php

use Illuminate\Database\Seeder;

class CarIllegalTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('car_illegal')->delete();
        
        \DB::table('car_illegal')->insert(array (
            0 => 
            array (
                'id' => 8,
                'number' => '1565656',
                'time' => '2018-05-08 06:00:00',
                'car_id' => 415,
                'driver_id' => 5480,
                'company_id' => 11,
                'cost' => '200.00',
                'score' => 3,
                'address' => '北环大道-北环大道沙河东立交西往东',
                'description' => '机动车逆向行驶的/罚款:200/违法记分:3',
                'status' => 1,
                'created_at' => '2018-05-21 10:06:51',
                'updated_at' => '2018-05-21 10:07:52',
            ),
            1 => 
            array (
                'id' => 9,
                'number' => '154656',
                'time' => '2018-05-08 08:00:00',
                'car_id' => 420,
                'driver_id' => 5421,
                'company_id' => 14,
                'cost' => '100.00',
                'score' => 0,
                'address' => '南山道',
                'description' => '机动车逆向行驶的/罚款:200/违法记分:3',
                'status' => 1,
                'created_at' => '2018-05-21 10:09:19',
                'updated_at' => '2018-05-28 17:19:54',
            ),
            2 => 
            array (
                'id' => 10,
                'number' => 'adfasdfa',
                'time' => '2018-05-16 12:00:00',
                'car_id' => 420,
                'driver_id' => 5421,
                'company_id' => 13,
                'cost' => '2342.00',
                'score' => 234,
                'address' => '3234',
                'description' => '2342',
                'status' => 0,
                'created_at' => '2018-05-23 11:31:24',
                'updated_at' => '2018-05-28 17:19:41',
            ),
            3 => 
            array (
                'id' => 11,
                'number' => 'adfadf',
                'time' => '2018-05-16 12:00:00',
                'car_id' => 411,
                'driver_id' => 5503,
                'company_id' => 13,
                'cost' => '23.00',
                'score' => 123,
                'address' => NULL,
                'description' => NULL,
                'status' => 0,
                'created_at' => '2018-05-23 11:31:46',
                'updated_at' => '2018-05-23 11:31:46',
            ),
            4 => 
            array (
                'id' => 12,
                'number' => '15456656',
                'time' => '2018-05-16 12:00:00',
                'car_id' => 415,
                'driver_id' => 5422,
                'company_id' => 12,
                'cost' => '0.00',
                'score' => 0,
                'address' => NULL,
                'description' => NULL,
                'status' => 0,
                'created_at' => '2018-05-23 17:33:45',
                'updated_at' => '2018-05-23 17:33:45',
            ),
            5 => 
            array (
                'id' => 13,
                'number' => '12121212',
                'time' => '2018-05-23 12:00:00',
                'car_id' => 420,
                'driver_id' => 5477,
                'company_id' => 12,
                'cost' => '0.00',
                'score' => 0,
                'address' => NULL,
                'description' => NULL,
                'status' => 0,
                'created_at' => '2018-05-24 09:32:05',
                'updated_at' => '2018-05-24 09:32:05',
            ),
            6 => 
            array (
                'id' => 14,
                'number' => '45454545',
                'time' => '2018-05-16 12:00:00',
                'car_id' => 414,
                'driver_id' => 5477,
                'company_id' => 12,
                'cost' => '0.00',
                'score' => 0,
                'address' => NULL,
                'description' => NULL,
                'status' => 1,
                'created_at' => '2018-05-24 09:42:29',
                'updated_at' => '2018-05-29 10:49:47',
            ),
            7 => 
            array (
                'id' => 15,
                'number' => '2323232',
                'time' => '2018-05-22 07:00:00',
                'car_id' => 412,
                'driver_id' => 5401,
                'company_id' => 14,
                'cost' => '300.00',
                'score' => 2,
                'address' => NULL,
                'description' => NULL,
                'status' => 1,
                'created_at' => '2018-05-24 09:44:12',
                'updated_at' => '2018-05-28 14:02:10',
            ),
            8 => 
            array (
                'id' => 16,
                'number' => '23232322',
                'time' => '2018-05-22 12:00:00',
                'car_id' => 420,
                'driver_id' => 5480,
                'company_id' => 14,
                'cost' => '200.00',
                'score' => 2,
                'address' => '南山',
                'description' => '闯红灯',
                'status' => 1,
                'created_at' => '2018-05-28 10:10:59',
                'updated_at' => '2018-05-31 17:46:59',
            ),
            9 => 
            array (
                'id' => 17,
                'number' => '41255225',
                'time' => '2018-05-29 08:07:06',
                'car_id' => 427,
                'driver_id' => 5423,
                'company_id' => 13,
                'cost' => '200.00',
                'score' => 5,
                'address' => '南山后海大道',
                'description' => '闯红灯，压线',
                'status' => 1,
                'created_at' => '2018-05-29 16:34:25',
                'updated_at' => '2018-05-29 16:34:25',
            ),
            10 => 
            array (
                'id' => 18,
                'number' => '5556698',
                'time' => '2018-05-23 08:08:08',
                'car_id' => 423,
                'driver_id' => 5371,
                'company_id' => 13,
                'cost' => '200.00',
                'score' => 3,
                'address' => '科技园',
                'description' => '违章罚款200，扣分3分，闯红灯',
                'status' => 1,
                'created_at' => '2018-05-29 16:44:06',
                'updated_at' => '2018-05-29 16:44:06',
            ),
            11 => 
            array (
                'id' => 19,
                'number' => '41514351',
                'time' => '2018-05-29 12:00:00',
                'car_id' => 430,
                'driver_id' => 5423,
                'company_id' => 12,
                'cost' => '0.00',
                'score' => 0,
                'address' => NULL,
                'description' => NULL,
                'status' => 1,
                'created_at' => '2018-05-29 16:50:43',
                'updated_at' => '2018-05-31 10:55:04',
            ),
            12 => 
            array (
                'id' => 20,
                'number' => '1235346',
                'time' => '2018-05-31 12:30:22',
                'car_id' => 430,
                'driver_id' => 5423,
                'company_id' => 12,
                'cost' => '244.00',
                'score' => 3,
                'address' => '粤海大道十字路口',
                'description' => '强行变道',
                'status' => 0,
                'created_at' => '2018-05-31 17:55:57',
                'updated_at' => '2018-05-31 17:55:57',
            ),
            13 => 
            array (
                'id' => 21,
                'number' => '234234',
                'time' => '2018-05-31 11:35:22',
                'car_id' => 412,
                'driver_id' => 5401,
                'company_id' => 14,
                'cost' => '522.00',
                'score' => 6,
                'address' => '罗芳立交',
                'description' => '闯红灯',
                'status' => 1,
                'created_at' => '2018-05-31 17:55:57',
                'updated_at' => '2018-06-04 10:27:46',
            ),
            14 => 
            array (
                'id' => 22,
                'number' => '12345678',
                'time' => '2018-06-04 12:00:00',
                'car_id' => 424,
                'driver_id' => 5455,
                'company_id' => 11,
                'cost' => '100.00',
                'score' => 0,
                'address' => '深圳',
                'description' => '变道',
                'status' => 1,
                'created_at' => '2018-06-04 10:31:11',
                'updated_at' => '2018-06-04 10:31:11',
            ),
            15 => 
            array (
                'id' => 23,
                'number' => '69458874',
                'time' => '2018-06-03 08:07:07',
                'car_id' => 432,
                'driver_id' => 0,
                'company_id' => 11,
                'cost' => '0.00',
                'score' => 0,
                'address' => '',
                'description' => '',
                'status' => 1,
                'created_at' => '2018-06-04 10:59:41',
                'updated_at' => '2018-06-21 16:05:51',
            ),
            16 => 
            array (
                'id' => 24,
                'number' => '19846501',
                'time' => '2018-05-14 20:11:06',
                'car_id' => 432,
                'driver_id' => 0,
                'company_id' => 11,
                'cost' => '200.00',
                'score' => 3,
                'address' => '泥岗路-泥岗路金豪人行天桥西往东方向',
                'description' => '驾驶机动车在城市快速路上不按规定车道行驶的',
                'status' => 0,
                'created_at' => '2018-06-04 11:00:42',
                'updated_at' => '2018-06-04 11:00:42',
            ),
            17 => 
            array (
                'id' => 25,
                'number' => '1234432',
                'time' => '2018-06-05 12:00:00',
                'car_id' => 433,
                'driver_id' => 5532,
                'company_id' => 12,
                'cost' => '120.00',
                'score' => 3,
                'address' => '深圳',
                'description' => '闯红灯',
                'status' => 1,
                'created_at' => '2018-06-04 11:04:23',
                'updated_at' => '2018-06-05 14:10:04',
            ),
            18 => 
            array (
                'id' => 26,
                'number' => '45879652',
                'time' => '2016-06-09 08:08:08',
                'car_id' => 434,
                'driver_id' => 5499,
                'company_id' => 11,
                'cost' => '0.00',
                'score' => 0,
                'address' => '',
                'description' => '',
                'status' => 1,
                'created_at' => '2018-06-04 11:35:34',
                'updated_at' => '2018-06-05 12:20:20',
            ),
            19 => 
            array (
                'id' => 27,
                'number' => '11111',
                'time' => '2018-06-05 12:00:00',
                'car_id' => 438,
                'driver_id' => 5426,
                'company_id' => 15,
                'cost' => '10.00',
                'score' => 1,
                'address' => '深圳',
                'description' => '逆行',
                'status' => 1,
                'created_at' => '2018-06-05 14:52:13',
                'updated_at' => '2018-06-05 17:38:24',
            ),
            20 => 
            array (
                'id' => 28,
                'number' => '11112',
                'time' => '2018-06-05 12:00:00',
                'car_id' => 372,
                'driver_id' => 5403,
                'company_id' => 15,
                'cost' => '200.00',
                'score' => 4,
                'address' => '深圳',
                'description' => '闯红灯',
                'status' => 1,
                'created_at' => '2018-06-05 14:53:33',
                'updated_at' => '2018-06-05 14:53:33',
            ),
            21 => 
            array (
                'id' => 29,
                'number' => '34543535245543',
                'time' => '2018-06-21 12:00:00',
                'car_id' => 434,
                'driver_id' => 5457,
                'company_id' => 11,
                'cost' => '1.00',
                'score' => 3,
                'address' => '分啊',
                'description' => '打发打发',
                'status' => 1,
                'created_at' => '2018-06-21 16:10:28',
                'updated_at' => '2018-08-09 09:31:28',
            ),
            22 => 
            array (
                'id' => 30,
                'number' => '19377998',
                'time' => '2017-09-15 15:42:23',
                'car_id' => 501,
                'driver_id' => 0,
                'company_id' => 12,
                'cost' => '1000.00',
                'score' => 0,
                'address' => '根年二路-根年二路路段',
                'description' => '违法停车、交警通告处罚1000元的',
                'status' => 0,
                'created_at' => '2018-08-15 17:25:01',
                'updated_at' => '2018-08-15 17:25:01',
            ),
            23 => 
            array (
                'id' => 31,
                'number' => '19378863',
                'time' => '2016-11-29 16:39:52',
                'car_id' => 450,
                'driver_id' => 0,
                'company_id' => 12,
                'cost' => '300.00',
                'score' => 3,
                'address' => '深南大道-深南大道新洲立交东往西',
                'description' => '驾驶机动车违反禁行、限行规定的',
                'status' => 0,
                'created_at' => '2018-08-15 17:25:26',
                'updated_at' => '2018-08-15 17:25:26',
            ),
            24 => 
            array (
                'id' => 32,
                'number' => '19378860',
                'time' => '2016-11-09 08:57:15',
                'car_id' => 450,
                'driver_id' => 0,
                'company_id' => 12,
                'cost' => '300.00',
                'score' => 3,
                'address' => '南海大道-南海大道学府人行天桥北往南',
                'description' => '驾驶机动车违反禁行、限行规定的',
                'status' => 0,
                'created_at' => '2018-08-15 17:25:26',
                'updated_at' => '2018-08-15 17:25:26',
            ),
            25 => 
            array (
                'id' => 33,
                'number' => '19378855',
                'time' => '2017-09-15 15:44:58',
                'car_id' => 517,
                'driver_id' => 0,
                'company_id' => 12,
                'cost' => '1000.00',
                'score' => 0,
                'address' => '根年二路-根年二路路段',
                'description' => '违法停车、交警通告处罚1000元的',
                'status' => 0,
                'created_at' => '2018-08-15 17:25:48',
                'updated_at' => '2018-08-15 17:25:48',
            ),
            26 => 
            array (
                'id' => 34,
                'number' => '19379721',
                'time' => '2017-09-15 09:45:53',
                'car_id' => 531,
                'driver_id' => 0,
                'company_id' => 12,
                'cost' => '1000.00',
                'score' => 0,
                'address' => '根年二路-根年二路路段',
                'description' => '违法停车、交警通告处罚1000元的',
                'status' => 0,
                'created_at' => '2018-08-15 17:26:29',
                'updated_at' => '2018-08-15 17:26:29',
            ),
            27 => 
            array (
                'id' => 35,
                'number' => '19380079',
                'time' => '2016-04-17 09:53:00',
                'car_id' => 550,
                'driver_id' => 0,
                'company_id' => 12,
                'cost' => '200.00',
                'score' => 3,
                'address' => '219省道207KM+700M',
                'description' => '机动车逆向行驶的',
                'status' => 0,
                'created_at' => '2018-08-15 17:27:09',
                'updated_at' => '2018-08-15 17:27:09',
            ),
            28 => 
            array (
                'id' => 36,
                'number' => '19380272',
                'time' => '2016-06-16 22:29:00',
                'car_id' => 551,
                'driver_id' => 0,
                'company_id' => 12,
                'cost' => '200.00',
                'score' => 0,
                'address' => '广明高速41公里500米',
                'description' => '机动车违反禁止停车标志、禁止长时停车标志或禁止停车线指示的',
                'status' => 0,
                'created_at' => '2018-08-15 17:27:11',
                'updated_at' => '2018-08-15 17:27:11',
            ),
            29 => 
            array (
                'id' => 37,
                'number' => '21654947',
                'time' => '2018-07-31 12:11:00',
                'car_id' => 561,
                'driver_id' => 0,
                'company_id' => 12,
                'cost' => '150.00',
                'score' => 3,
                'address' => '324国道821公里900米',
                'description' => '驾驶中型以上载客载货汽车、危险物品运输车辆以外的其他机动车行驶超过规定时速10%未达20%的',
                'status' => 0,
                'created_at' => '2018-08-15 17:27:33',
                'updated_at' => '2018-08-15 17:27:33',
            ),
            30 => 
            array (
                'id' => 38,
                'number' => '19379774',
                'time' => '2017-09-15 15:41:06',
                'car_id' => 575,
                'driver_id' => 0,
                'company_id' => 12,
                'cost' => '1000.00',
                'score' => 0,
                'address' => '根年二路-根年二路路段',
                'description' => '违法停车、交警通告处罚1000元的',
                'status' => 0,
                'created_at' => '2018-08-15 17:28:10',
                'updated_at' => '2018-08-15 17:28:10',
            ),
            31 => 
            array (
                'id' => 39,
                'number' => '16101818',
                'time' => '2017-11-10 16:20:00',
                'car_id' => 605,
                'driver_id' => 0,
                'company_id' => 12,
                'cost' => '200.00',
                'score' => 3,
                'address' => '中心市场',
                'description' => '机动车违反禁止标线指示的',
                'status' => 0,
                'created_at' => '2018-08-15 17:29:28',
                'updated_at' => '2018-08-15 17:29:28',
            ),
            32 => 
            array (
                'id' => 40,
                'number' => '21654993',
                'time' => '2018-03-02 14:40:00',
                'car_id' => 634,
                'driver_id' => 0,
                'company_id' => 12,
                'cost' => '100.00',
                'score' => 6,
                'address' => '瑞金路兴国路口',
                'description' => '驾驶机动车违反道路交通信号灯通行的',
                'status' => 0,
                'created_at' => '2018-08-15 17:30:40',
                'updated_at' => '2018-08-15 17:30:40',
            ),
            33 => 
            array (
                'id' => 41,
                'number' => '21655003',
                'time' => '2018-07-30 14:58:59',
                'car_id' => 656,
                'driver_id' => 0,
                'company_id' => 12,
                'cost' => '200.00',
                'score' => 6,
                'address' => '惠城区龙湖大道与东江大道路口',
                'description' => '驾驶机动车违反道路交通信号灯通行的',
                'status' => 0,
                'created_at' => '2018-08-15 17:32:04',
                'updated_at' => '2018-08-15 17:32:04',
            ),
            34 => 
            array (
                'id' => 42,
                'number' => '19380044',
                'time' => '2017-01-09 12:54:23',
                'car_id' => 694,
                'driver_id' => 0,
                'company_id' => 12,
                'cost' => '300.00',
                'score' => 3,
                'address' => '笋岗路-笋岗路松园北人行天桥东往西',
                'description' => '驾驶机动车违反禁行、限行规定的',
                'status' => 0,
                'created_at' => '2018-08-15 17:33:34',
                'updated_at' => '2018-08-15 17:33:34',
            ),
            35 => 
            array (
                'id' => 43,
                'number' => '16101923',
                'time' => '2017-09-15 15:43:32',
                'car_id' => 706,
                'driver_id' => 0,
                'company_id' => 12,
                'cost' => '1000.00',
                'score' => 0,
                'address' => '根年二路-根年二路路段',
                'description' => '违法停车、交警通告处罚1000元的',
                'status' => 0,
                'created_at' => '2018-08-15 17:34:02',
                'updated_at' => '2018-08-15 17:34:02',
            ),
            36 => 
            array (
                'id' => 44,
                'number' => '21655091',
                'time' => '2018-07-23 06:16:25',
                'car_id' => 742,
                'driver_id' => 0,
                'company_id' => 12,
                'cost' => '200.00',
                'score' => 0,
                'address' => '如意路-如意路龙凤隧道东侧西行',
                'description' => '在高速公路或城市快速路以外的道路上行驶时，驾驶人未按规定使用安全带的',
                'status' => 0,
                'created_at' => '2018-08-15 17:35:25',
                'updated_at' => '2018-08-15 17:35:25',
            ),
            37 => 
            array (
                'id' => 45,
                'number' => '16101898',
                'time' => '2017-09-15 09:47:17',
                'car_id' => 743,
                'driver_id' => 0,
                'company_id' => 12,
                'cost' => '200.00',
                'score' => 0,
                'address' => '根年二路-根年二路路段',
                'description' => '违法停车、交警通告处罚200元的',
                'status' => 0,
                'created_at' => '2018-08-15 17:35:28',
                'updated_at' => '2018-08-15 17:35:28',
            ),
            38 => 
            array (
                'id' => 46,
                'number' => '16101897',
                'time' => '2017-04-29 09:51:00',
                'car_id' => 743,
                'driver_id' => 0,
                'company_id' => 12,
                'cost' => '100.00',
                'score' => 2,
                'address' => '东莞市凤岗东深二路蓝山锦湾路口',
                'description' => '机动车通过有灯控路口时，不按所需行进方向驶入导向车道的',
                'status' => 0,
                'created_at' => '2018-08-15 17:35:28',
                'updated_at' => '2018-08-15 17:35:28',
            ),
        ));
        
        
    }
}