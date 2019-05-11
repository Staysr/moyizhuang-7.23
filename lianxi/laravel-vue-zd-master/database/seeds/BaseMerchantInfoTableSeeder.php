<?php

use Illuminate\Database\Seeder;

class BaseMerchantInfoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('base_merchant_info')->delete();
        
        \DB::table('base_merchant_info')->insert(array (
            0 => 
            array (
                'id' => 226,
                'client_id' => 21912,
                'invited_id' => 2,
                'name' => '小华猪脚饭',
                'address' => '中洲控股中心',
                'bank_id' => 17,
                'bank_user' => '邓小华',
                'bank_no' => '88888888888888888',
                'bank_img' => '',
                'business_license' => '',
                'create_time' => '2018-07-12 16:55:11',
                'modify_time' => '2018-07-16 16:45:28',
            ),
            1 => 
            array (
                'id' => 229,
                'client_id' => 21798,
                'invited_id' => 5,
                'name' => '小强汤粉',
                'address' => '中洲控股中心',
                'bank_id' => 13,
                'bank_user' => '何世强',
                'bank_no' => '66666666666666666666',
                'bank_img' => '/php-web/2018-07-16/20180716105107_53537.gif',
                'business_license' => '/php-web/2018-07-16/20180716105107_2407.jpg',
                'create_time' => '2018-07-13 16:56:59',
                'modify_time' => '2018-07-16 10:51:07',
            ),
            2 => 
            array (
                'id' => 230,
                'client_id' => 21906,
                'invited_id' => 5,
                'name' => '方舟',
                'address' => '深圳南山中洲',
                'bank_id' => 10,
                'bank_user' => '天天',
                'bank_no' => '6225887851308881',
                'bank_img' => '',
                'business_license' => '',
                'create_time' => '2018-07-14 10:41:22',
                'modify_time' => '2018-07-14 14:52:19',
            ),
            3 => 
            array (
                'id' => 231,
                'client_id' => 21812,
                'invited_id' => 3,
                'name' => '天天美食1',
                'address' => '深圳南山科技园',
                'bank_id' => 13,
                'bank_user' => '幸福',
                'bank_no' => '622512312365478998',
                'bank_img' => '',
                'business_license' => '',
                'create_time' => '2018-07-14 11:04:38',
                'modify_time' => '2018-07-16 14:32:50',
            ),
            4 => 
            array (
                'id' => 242,
                'client_id' => 21800,
                'invited_id' => 4,
                'name' => '一二三四五六七八九十一二三四五六七八九十',
                'address' => '深圳南山科技园科技园深圳南山科技园科技深圳南山科技园深圳南山科技园科技深圳南山科技园科深圳南山深技园',
                'bank_id' => 10,
                'bank_user' => '天天12345678',
                'bank_no' => '621234569874125836986325896325',
                'bank_img' => '',
                'business_license' => '',
                'create_time' => '2018-07-14 14:02:04',
                'modify_time' => NULL,
            ),
            5 => 
            array (
                'id' => 337,
                'client_id' => 21856,
                'invited_id' => 5,
                'name' => '测试1',
                'address' => '结婚红红火火恍恍惚惚',
                'bank_id' => 13,
                'bank_user' => '天天',
                'bank_no' => '66666666666666',
                'bank_img' => '',
                'business_license' => '',
                'create_time' => '2018-07-16 13:33:22',
                'modify_time' => NULL,
            ),
            6 => 
            array (
                'id' => 338,
                'client_id' => 21802,
                'invited_id' => 5,
                'name' => '测试123',
                'address' => '深圳',
                'bank_id' => 13,
                'bank_user' => '天天',
                'bank_no' => '6666666666666666666666',
                'bank_img' => '',
                'business_license' => '',
                'create_time' => '2018-07-16 13:38:09',
                'modify_time' => NULL,
            ),
            7 => 
            array (
                'id' => 340,
                'client_id' => 21809,
                'invited_id' => 5,
                'name' => '测试1234',
                'address' => '甜甜的味道',
                'bank_id' => 13,
                'bank_user' => '甜甜',
                'bank_no' => '666666666666666666666',
                'bank_img' => '',
                'business_license' => '',
                'create_time' => '2018-07-16 14:05:15',
                'modify_time' => NULL,
            ),
            8 => 
            array (
                'id' => 341,
                'client_id' => 21804,
                'invited_id' => 4,
                'name' => '测试3',
                'address' => '深圳南山',
                'bank_id' => 15,
                'bank_user' => '天天',
                'bank_no' => '66666666666666666666',
                'bank_img' => '',
                'business_license' => '',
                'create_time' => '2018-07-16 14:22:55',
                'modify_time' => '2018-07-16 14:26:47',
            ),
            9 => 
            array (
                'id' => 343,
                'client_id' => 21816,
                'invited_id' => 1,
                'name' => '好',
                'address' => '工',
                'bank_id' => 15,
                'bank_user' => '厂',
                'bank_no' => '456',
                'bank_img' => '',
                'business_license' => '',
                'create_time' => '2018-07-16 14:23:36',
                'modify_time' => '2018-07-16 14:23:41',
            ),
            10 => 
            array (
                'id' => 347,
                'client_id' => 21815,
                'invited_id' => 5,
                'name' => '方舟测试1',
                'address' => '深圳南山',
                'bank_id' => 13,
                'bank_user' => '幸福',
                'bank_no' => '6666666666666666666',
                'bank_img' => '',
                'business_license' => '',
                'create_time' => '2018-07-16 14:34:24',
                'modify_time' => '2018-07-16 14:37:01',
            ),
            11 => 
            array (
                'id' => 348,
                'client_id' => 21945,
                'invited_id' => 1,
                'name' => '安卓新用户注册',
                'address' => '深圳南山',
                'bank_id' => 13,
                'bank_user' => '测试4',
                'bank_no' => '666666966666666666',
                'bank_img' => '',
                'business_license' => '',
                'create_time' => '2018-07-16 14:50:29',
                'modify_time' => NULL,
            ),
            12 => 
            array (
                'id' => 349,
                'client_id' => 21946,
                'invited_id' => 1,
                'name' => '苹果新用户注册',
                'address' => '深圳福田',
                'bank_id' => 13,
                'bank_user' => '美丽',
                'bank_no' => '测试5',
                'bank_img' => '',
                'business_license' => '',
                'create_time' => '2018-07-16 14:52:32',
                'modify_time' => NULL,
            ),
            13 => 
            array (
                'id' => 351,
                'client_id' => 21942,
                'invited_id' => 1,
                'name' => '苹果123',
                'address' => '深圳警方',
                'bank_id' => 13,
                'bank_user' => '咯了了',
                'bank_no' => '666666666666666',
                'bank_img' => '',
                'business_license' => '',
                'create_time' => '2018-07-16 14:56:10',
                'modify_time' => NULL,
            ),
            14 => 
            array (
                'id' => 381,
                'client_id' => 21954,
                'invited_id' => 3,
                'name' => '儿了',
                'address' => '吗要拉',
                'bank_id' => 15,
                'bank_user' => '吗这',
                'bank_no' => '525425425222',
                'bank_img' => '',
                'business_license' => '',
                'create_time' => '2018-07-16 16:23:19',
                'modify_time' => '2018-07-16 16:23:38',
            ),
            15 => 
            array (
                'id' => 382,
                'client_id' => 21959,
                'invited_id' => 1,
                'name' => '苹果测试23',
                'address' => '深圳南山',
                'bank_id' => 13,
                'bank_user' => '天天',
                'bank_no' => '66666666666666666',
                'bank_img' => '',
                'business_license' => '',
                'create_time' => '2018-07-16 16:51:13',
                'modify_time' => NULL,
            ),
            16 => 
            array (
                'id' => 385,
                'client_id' => 21961,
                'invited_id' => 5,
                'name' => '测试合作',
                'address' => '深圳南山公园',
                'bank_id' => 13,
                'bank_user' => '天天',
                'bank_no' => '66666666666666666666',
                'bank_img' => '',
                'business_license' => '',
                'create_time' => '2018-07-17 09:08:03',
                'modify_time' => '2018-07-17 09:08:38',
            ),
            17 => 
            array (
                'id' => 386,
                'client_id' => 21826,
                'invited_id' => 2,
                'name' => '小华猪脚粉',
                'address' => '中洲控股中心城',
                'bank_id' => 17,
                'bank_user' => '邓大华',
                'bank_no' => '3333333333333333333',
                'bank_img' => '',
                'business_license' => '',
                'create_time' => '2018-07-17 11:27:01',
                'modify_time' => '2018-07-17 11:27:24',
            ),
            18 => 
            array (
                'id' => 387,
                'client_id' => 21817,
                'invited_id' => 1,
                'name' => '尚客快餐',
                'address' => '梅龙大道113号',
                'bank_id' => 13,
                'bank_user' => '方舟人',
                'bank_no' => '6352442511442525',
                'bank_img' => '',
                'business_license' => '',
                'create_time' => '2018-08-01 16:38:42',
                'modify_time' => NULL,
            ),
        ));
        
        
    }
}