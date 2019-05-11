<?php

use Illuminate\Database\Seeder;

class PayRechargePackageTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pay_recharge_package')->delete();
        
        \DB::table('pay_recharge_package')->insert(array (
            0 => 
            array (
                'id' => 17,
                'category_id' => 5,
                'category_code' => '0101',
                'car_type_id' => 0,
                'name' => '充100送100',
                'fee' => '200.00',
                'hot' => 1,
                'status' => 1,
                'sloga_id' => 0,
                'modify_time' => '2018-04-25 15:43:29',
                'create_time' => '2017-03-29 14:33:54',
            ),
            1 => 
            array (
                'id' => 18,
                'category_id' => 6,
                'category_code' => '0101002',
                'car_type_id' => 0,
                'name' => '充100送50',
                'fee' => '10.00',
                'hot' => 1,
                'status' => 1,
                'sloga_id' => 2,
                'modify_time' => '2018-05-07 10:36:51',
                'create_time' => '2017-05-12 16:17:30',
            ),
            2 => 
            array (
                'id' => 19,
                'category_id' => 6,
                'category_code' => '0101002',
                'car_type_id' => 0,
                'name' => '198套餐',
                'fee' => '0.01',
                'hot' => 1,
                'status' => 1,
                'sloga_id' => 1,
                'modify_time' => '2018-05-11 14:32:36',
                'create_time' => '2017-05-13 15:40:54',
            ),
            3 => 
            array (
                'id' => 20,
                'category_id' => 100182,
                'category_code' => '0102006',
                'car_type_id' => 0,
                'name' => ' 海淀充值100送20',
                'fee' => '100.00',
                'hot' => 1,
                'status' => 1,
                'sloga_id' => 0,
                'modify_time' => '2017-05-15 10:18:36',
                'create_time' => '2017-05-15 10:13:37',
            ),
            4 => 
            array (
                'id' => 21,
                'category_id' => 100180,
                'category_code' => '0101005',
                'car_type_id' => 0,
                'name' => '广州充值100送20',
                'fee' => '100.00',
                'hot' => 1,
                'status' => 1,
                'sloga_id' => 0,
                'modify_time' => '2017-05-15 10:18:27',
                'create_time' => '2017-05-15 10:14:18',
            ),
            5 => 
            array (
                'id' => 23,
                'category_id' => 6,
                'category_code' => '0101002',
                'car_type_id' => 0,
                'name' => '深圳充值100送20',
                'fee' => '100.00',
                'hot' => 1,
                'status' => 1,
                'sloga_id' => 0,
                'modify_time' => '2017-05-15 10:18:18',
                'create_time' => '2017-05-15 10:18:18',
            ),
            6 => 
            array (
                'id' => 24,
                'category_id' => 100187,
                'category_code' => '0103007',
                'car_type_id' => 0,
                'name' => '赣州套餐1',
                'fee' => '198.00',
                'hot' => 0,
                'status' => 1,
                'sloga_id' => 0,
                'modify_time' => '2017-08-09 12:11:24',
                'create_time' => '2017-08-09 12:10:29',
            ),
            7 => 
            array (
                'id' => 25,
                'category_id' => 100187,
                'category_code' => '0103007',
                'car_type_id' => 0,
                'name' => '赣州套餐2',
                'fee' => '998.00',
                'hot' => 0,
                'status' => 1,
                'sloga_id' => 0,
                'modify_time' => '2017-08-09 12:11:10',
                'create_time' => '2017-08-09 12:11:10',
            ),
            8 => 
            array (
                'id' => 26,
                'category_id' => 6,
                'category_code' => '0101002',
                'car_type_id' => 0,
                'name' => '广东省通用',
                'fee' => '1.00',
                'hot' => 0,
                'status' => 1,
                'sloga_id' => 0,
                'modify_time' => '2018-01-03 11:44:29',
                'create_time' => '2018-01-03 11:41:36',
            ),
            9 => 
            array (
                'id' => 27,
                'category_id' => 6,
                'category_code' => '0101002',
                'car_type_id' => 0,
                'name' => '不同车型',
                'fee' => '1.00',
                'hot' => 0,
                'status' => 1,
                'sloga_id' => 0,
                'modify_time' => '2018-01-10 14:42:07',
                'create_time' => '2018-01-10 14:38:14',
            ),
            10 => 
            array (
                'id' => 28,
                'category_id' => 6,
                'category_code' => '0101002',
                'car_type_id' => 0,
                'name' => '胜多负少',
                'fee' => '122.00',
                'hot' => 0,
                'status' => 1,
                'sloga_id' => 0,
                'modify_time' => '2018-01-10 14:47:56',
                'create_time' => '2018-01-10 14:47:56',
            ),
            11 => 
            array (
                'id' => 29,
                'category_id' => 6,
                'category_code' => '0101002',
                'car_type_id' => 0,
                'name' => '修改套餐',
                'fee' => '33.00',
                'hot' => 0,
                'status' => 1,
                'sloga_id' => 0,
                'modify_time' => '2018-04-16 10:08:13',
                'create_time' => '2018-01-12 09:28:24',
            ),
            12 => 
            array (
                'id' => 30,
                'category_id' => 6,
                'category_code' => '0101002',
                'car_type_id' => 0,
                'name' => '套餐大放送',
                'fee' => '20.00',
                'hot' => 0,
                'status' => 0,
                'sloga_id' => 0,
                'modify_time' => '2018-04-16 10:05:00',
                'create_time' => '2018-04-16 10:05:00',
            ),
            13 => 
            array (
                'id' => 31,
                'category_id' => 1,
                'category_code' => '01',
                'car_type_id' => 0,
                'name' => '中国套餐',
                'fee' => '1.00',
                'hot' => 1,
                'status' => 1,
                'sloga_id' => 0,
                'modify_time' => '2018-04-25 15:40:09',
                'create_time' => '2018-04-25 15:21:34',
            ),
            14 => 
            array (
                'id' => 32,
                'category_id' => 1,
                'category_code' => '01',
                'car_type_id' => 0,
                'name' => '全国套餐',
                'fee' => '1000.00',
                'hot' => 1,
                'status' => 1,
                'sloga_id' => 2,
                'modify_time' => '2018-04-28 16:37:18',
                'create_time' => '2018-04-28 16:37:18',
            ),
            15 => 
            array (
                'id' => 33,
                'category_id' => 5,
                'category_code' => '0101',
                'car_type_id' => 0,
                'name' => '广东省套餐',
                'fee' => '1000.00',
                'hot' => 1,
                'status' => 1,
                'sloga_id' => 3,
                'modify_time' => '2018-04-28 16:44:23',
                'create_time' => '2018-04-28 16:43:46',
            ),
            16 => 
            array (
                'id' => 34,
                'category_id' => 6,
                'category_code' => '0101002',
                'car_type_id' => 0,
                'name' => '4.28',
                'fee' => '22.00',
                'hot' => 1,
                'status' => 1,
                'sloga_id' => 1,
                'modify_time' => '2018-04-28 16:45:21',
                'create_time' => '2018-04-28 16:45:21',
            ),
            17 => 
            array (
                'id' => 35,
                'category_id' => 6,
                'category_code' => '0101002',
                'car_type_id' => 0,
                'name' => '广东套餐',
                'fee' => '100.00',
                'hot' => 1,
                'status' => 1,
                'sloga_id' => 1,
                'modify_time' => '2018-05-10 15:34:49',
                'create_time' => '2018-05-07 12:24:05',
            ),
            18 => 
            array (
                'id' => 36,
                'category_id' => 6,
                'category_code' => '0101002',
                'car_type_id' => 0,
                'name' => '2688优惠套餐',
                'fee' => '2688.00',
                'hot' => 0,
                'status' => 1,
                'sloga_id' => 1,
                'modify_time' => '2018-06-06 10:01:58',
                'create_time' => '2018-06-06 10:01:58',
            ),
        ));
        
        
    }
}