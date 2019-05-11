<?php

use Illuminate\Database\Seeder;

class MallProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('mall_products')->delete();
        
        \DB::table('mall_products')->insert(array (
            0 => 
            array (
                'id' => 12,
                'type' => 0,
                'title' => '8折优惠券',
                'slogan' => '8折优惠券8折优惠券',
                'description' => '',
                'thumbnail' => '/php-web/2018-08-28/20180828115346_42626.jpg',
                'content' => '没有优惠券就没钱叫车',
                'price' => '20.00',
                'stock' => 0,
                'status' => 1,
                'create_time' => '2018-08-28 11:53:46',
                'modify_time' => '2018-09-07 17:28:25',
            ),
            1 => 
            array (
                'id' => 13,
                'type' => 2,
                'title' => '娃娃',
                'slogan' => '娃娃娃娃娃娃',
                'description' => '/php-web/2018-08-28/20180828142532_94760.jpg',
                'thumbnail' => '/php-web/2018-08-28/20180828142532_27943.jpg',
                'content' => '',
                'price' => '30.00',
                'stock' => 0,
                'status' => 1,
                'create_time' => '2018-08-28 14:25:32',
                'modify_time' => '2018-08-28 14:25:32',
            ),
            2 => 
            array (
                'id' => 14,
                'type' => 0,
                'title' => '8折',
                'slogan' => '图片类型图片类型图片类型图片类型图片类',
                'description' => '',
                'thumbnail' => '/php-web/2018-08-28/20180828150904_779.jpg',
                'content' => '图片类型图片类型图片类型',
                'price' => '20.00',
                'stock' => 2,
                'status' => 1,
                'create_time' => '2018-08-28 15:09:04',
                'modify_time' => '2018-08-28 15:09:04',
            ),
            3 => 
            array (
                'id' => 15,
                'type' => 0,
                'title' => '不兑换就没了',
                'slogan' => '超级无敌划算',
                'description' => '',
                'thumbnail' => '/php-web/2018-08-28/20180828151433_48618.PNG',
                'content' => '跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖跳楼大甩卖',
                'price' => '100.00',
                'stock' => 0,
                'status' => 1,
                'create_time' => '2018-08-28 15:14:33',
                'modify_time' => '2018-09-05 17:38:08',
            ),
            4 => 
            array (
                'id' => 16,
                'type' => 2,
                'title' => '哟哟哟哟',
                'slogan' => '超值兑换没有之一',
                'description' => '/php-web/2018-08-29/20180829144729_20568.png',
                'thumbnail' => '/php-web/2018-08-29/20180829144729_95251.png',
                'content' => '',
                'price' => '30.00',
                'stock' => 0,
                'status' => 1,
                'create_time' => '2018-08-29 14:47:29',
                'modify_time' => '2018-08-29 14:47:29',
            ),
            5 => 
            array (
                'id' => 17,
                'type' => 1,
                'title' => '111111',
                'slogan' => '1111111',
                'description' => '',
                'thumbnail' => '/php-web/2018-08-29/20180829151027_69423.jpg',
                'content' => '11111',
                'price' => '1.00',
                'stock' => 1,
                'status' => 0,
                'create_time' => '2018-08-29 15:10:27',
                'modify_time' => '2018-08-30 11:20:37',
            ),
            6 => 
            array (
                'id' => 18,
                'type' => 0,
                'title' => '2',
                'slogan' => '2',
                'description' => '',
                'thumbnail' => '/php-web/2018-08-29/20180829160044_63133.jpg',
                'content' => '1',
                'price' => '1.00',
                'stock' => 0,
                'status' => 0,
                'create_time' => '2018-08-29 16:00:44',
                'modify_time' => '2018-08-31 09:19:59',
            ),
            7 => 
            array (
                'id' => 19,
                'type' => 2,
                'title' => '买买买',
                'slogan' => '撒点撒大所多撒多撒多所',
                'description' => '/php-web/2018-08-30/20180830143852_19664.jpg',
                'thumbnail' => '/php-web/2018-08-30/20180830143852_41040.jpg',
                'content' => '',
                'price' => '10.00',
                'stock' => 0,
                'status' => 1,
                'create_time' => '2018-08-30 14:38:52',
                'modify_time' => '2018-08-30 16:16:40',
            ),
            8 => 
            array (
                'id' => 20,
                'type' => 0,
                'title' => '50大洋',
                'slogan' => '省五十 系不系很超值',
                'description' => '',
                'thumbnail' => '/php-web/2018-08-31/20180831150026_82173.png',
                'content' => '快兑换啊',
                'price' => '20.00',
                'stock' => 0,
                'status' => 1,
                'create_time' => '2018-08-31 15:00:26',
                'modify_time' => '2018-08-31 15:00:26',
            ),
            9 => 
            array (
                'id' => 21,
                'type' => 0,
                'title' => '广东省兑换券商品',
                'slogan' => '广东省兑换券商品广东省兑换券商品  ',
                'description' => '',
                'thumbnail' => '/php-web/2018-08-31/20180831150721_43333.jpg',
                'content' => '发生的冯绍峰三十',
                'price' => '60.00',
                'stock' => 0,
                'status' => 1,
                'create_time' => '2018-08-31 15:07:21',
                'modify_time' => '2018-08-31 15:07:21',
            ),
            10 => 
            array (
                'id' => 22,
                'type' => 0,
                'title' => '测试',
                'slogan' => '试一试',
                'description' => '',
                'thumbnail' => '/php-web/2018-09-04/20180904094623_79315.png',
                'content' => '0',
                'price' => '111.00',
                'stock' => 0,
                'status' => 1,
                'create_time' => '2018-09-04 09:46:23',
                'modify_time' => '2018-09-04 10:25:24',
            ),
            11 => 
            array (
                'id' => 23,
                'type' => 2,
                'title' => '测试商品',
                'slogan' => '该商品为测试商品，请测试使用',
                'description' => '/php-web/2018-09-12/20180912160318_23868.png',
                'thumbnail' => '/php-web/2018-09-12/20180912160318_9218.png',
                'content' => '测试商品，请测试使用。',
                'price' => '50.00',
                'stock' => 0,
                'status' => 1,
                'create_time' => '2018-09-12 16:03:18',
                'modify_time' => '2018-09-12 16:03:18',
            ),
            12 => 
            array (
                'id' => 24,
                'type' => 0,
                'title' => '测试优惠劵',
                'slogan' => '该商品为测试优惠劵',
                'description' => '',
                'thumbnail' => '/php-web/2018-09-12/20180912161007_60988.png',
                'content' => '该商品为测试优惠劵',
                'price' => '10.00',
                'stock' => 0,
                'status' => 1,
                'create_time' => '2018-09-12 16:10:07',
                'modify_time' => '2018-09-12 16:10:07',
            ),
            13 => 
            array (
                'id' => 25,
                'type' => 2,
                'title' => '测试商品',
                'slogan' => '该商品为测试商品，请测试使用',
                'description' => '/php-web/2018-09-14/20180914182707_69906.png',
                'thumbnail' => '/php-web/2018-09-14/20180914182707_63038.png',
                'content' => '',
                'price' => '5.00',
                'stock' => 1,
                'status' => 1,
                'create_time' => '2018-09-14 18:27:07',
                'modify_time' => '2018-09-14 18:27:07',
            ),
            14 => 
            array (
                'id' => 26,
                'type' => 2,
                'title' => '测试20180914',
                'slogan' => '该商品为测试商品，请测试使用',
                'description' => '/php-web/2018-09-14/20180914185115_59590.png',
                'thumbnail' => '/php-web/2018-09-14/20180914185115_10747.png',
                'content' => '',
                'price' => '5.00',
                'stock' => 0,
                'status' => 1,
                'create_time' => '2018-09-14 18:51:15',
                'modify_time' => '2018-09-14 18:51:15',
            ),
            15 => 
            array (
                'id' => 27,
                'type' => 0,
                'title' => '95折优惠券',
                'slogan' => '零售价：10碳币',
                'description' => '',
                'thumbnail' => '/php-web/2018-09-15/20180915120835_51408.png',
                'content' => '95折优惠券，最高抵扣10元',
                'price' => '10.00',
                'stock' => 192,
                'status' => 1,
                'create_time' => '2018-09-15 12:08:35',
                'modify_time' => '2018-09-15 12:08:35',
            ),
            16 => 
            array (
                'id' => 28,
                'type' => 0,
                'title' => '九折优惠劵',
                'slogan' => '限量500张',
                'description' => '',
                'thumbnail' => '/php-web/2018-09-15/20180915155221_14667.png',
                'content' => '商品兑换价值99碳币  
有效期：领取日30天内有效  
使用条件：仅限中型面包车使用，最高抵扣10元   
已兑换商品的对应碳币不可退回    
兑换成功后，可在兑换记录中查询，或者方舟来拉“我的钱包-优惠劵”中查看',
                'price' => '99.00',
                'stock' => 489,
                'status' => 1,
                'create_time' => '2018-09-15 15:07:16',
                'modify_time' => '2018-09-15 15:52:21',
            ),
            17 => 
            array (
                'id' => 29,
                'type' => 2,
                'title' => '舟舟公仔',
                'slogan' => '零售价：¥68，先到先得',
                'description' => '/php-web/2018-09-15/20180915155146_92058.png',
                'thumbnail' => '/php-web/2018-09-15/20180915155146_22391.png',
                'content' => '',
                'price' => '990.00',
                'stock' => 96,
                'status' => 1,
                'create_time' => '2018-09-15 15:23:51',
                'modify_time' => '2018-09-15 16:14:17',
            ),
            18 => 
            array (
                'id' => 30,
                'type' => 2,
                'title' => '赶快看看光华科技',
                'slogan' => 'fgdfhdfgh',
                'description' => '/php-web/2018-09-17/20180917202328_95639.jpg',
                'thumbnail' => '/php-web/2018-09-17/20180917202237_29428.jpg',
                'content' => '',
                'price' => '34.00',
                'stock' => 22,
                'status' => 0,
                'create_time' => '2018-09-17 20:22:37',
                'modify_time' => '2018-09-17 20:42:11',
            ),
            19 => 
            array (
                'id' => 31,
                'type' => 0,
                'title' => 'sssss',
                'slogan' => 'ssssss',
                'description' => '',
                'thumbnail' => '/php-web/2018-09-21/20180921174337_51081.png',
                'content' => 'ssssssss',
                'price' => '1.00',
                'stock' => 0,
                'status' => 1,
                'create_time' => '2018-09-21 17:43:37',
                'modify_time' => '2018-09-21 17:43:54',
            ),
            20 => 
            array (
                'id' => 32,
                'type' => 2,
                'title' => 'xxxxx',
                'slogan' => 'xxxxxxxxxxx',
                'description' => '/php-web/2018-09-21/20180921174425_11152.png',
                'thumbnail' => '/php-web/2018-09-21/20180921174425_5469.png',
                'content' => '',
                'price' => '20.00',
                'stock' => 0,
                'status' => 1,
                'create_time' => '2018-09-21 17:44:25',
                'modify_time' => '2018-09-21 17:44:25',
            ),
        ));
        
        
    }
}