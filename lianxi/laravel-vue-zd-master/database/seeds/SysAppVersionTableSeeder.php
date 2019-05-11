<?php

use Illuminate\Database\Seeder;

class SysAppVersionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_app_version')->delete();
        
        \DB::table('sys_app_version')->insert(array (
            0 => 
            array (
                'id' => 1,
                'version_no' => '5.2.0',
                'app_os' => 1,
                'app_type' => 1,
                'downloads' => NULL,
                'download_url' => 'http://images2.fzhd8.cn/app/customer_v5.0.0.apk',
                'download_channel' => '',
                'version_desc' => '一堆更新',
                'status' => 0,
                'force_update' => 0,
                'package_size' => '0.0',
                'create_time' => '2017-05-26 09:47:52',
                'modify_time' => '2017-10-31 09:59:57',
            ),
            1 => 
            array (
                'id' => 2,
                'version_no' => '5.2.0',
                'app_os' => 1,
                'app_type' => 2,
                'downloads' => NULL,
                'download_url' => 'http://images2.fzhd8.cn/app/customer_v5.0.0.apk',
                'download_channel' => '',
                'version_desc' => '减肥啦开始减肥',
                'status' => 1,
                'force_update' => 1,
                'package_size' => '30.0',
                'create_time' => '2017-08-04 11:34:29',
                'modify_time' => '2017-08-04 12:01:37',
            ),
            2 => 
            array (
                'id' => 3,
                'version_no' => '5.1.0',
                'app_os' => 1,
                'app_type' => 1,
                'downloads' => NULL,
                'download_url' => 'http://images2.fzhd8.cn/app/customer_v5.0.0.apk',
                'download_channel' => '',
                'version_desc' => '发的文完全',
                'status' => 1,
                'force_update' => 0,
                'package_size' => '20.0',
                'create_time' => '2017-08-04 14:16:12',
                'modify_time' => '2017-08-04 14:16:12',
            ),
            3 => 
            array (
                'id' => 4,
                'version_no' => '5.3.0',
                'app_os' => 1,
                'app_type' => 1,
                'downloads' => NULL,
                'download_url' => 'http://images2.fzhd8.cn/app/customer_v5.0.0.apk',
                'download_channel' => '',
                'version_desc' => '积分可以发货国际惯例',
                'status' => 0,
                'force_update' => 0,
                'package_size' => '25.0',
                'create_time' => '2017-08-04 14:16:53',
                'modify_time' => '2017-10-31 09:59:48',
            ),
            4 => 
            array (
                'id' => 5,
                'version_no' => '5.1.0',
                'app_os' => 1,
                'app_type' => 2,
                'downloads' => NULL,
                'download_url' => 'http://images2.fzhd8.cn/app/customer_v5.0.0.apk',
                'download_channel' => '',
                'version_desc' => '我完全于于苟富贵',
                'status' => 1,
                'force_update' => 0,
                'package_size' => '24.0',
                'create_time' => '2017-08-04 14:17:38',
                'modify_time' => '2017-08-04 14:17:38',
            ),
            5 => 
            array (
                'id' => 6,
                'version_no' => '5.3.0',
                'app_os' => 1,
                'app_type' => 2,
                'downloads' => NULL,
                'download_url' => 'http://images2.fzhd8.cn/app/customer_v5.0.0.apk',
                'download_channel' => '',
                'version_desc' => '了头发的好浪费大客户',
                'status' => 1,
                'force_update' => 0,
                'package_size' => '28.0',
                'create_time' => '2017-08-04 14:18:18',
                'modify_time' => '2017-08-04 14:18:18',
            ),
            6 => 
            array (
                'id' => 7,
                'version_no' => '6.3.0',
                'app_os' => 1,
                'app_type' => 1,
                'downloads' => NULL,
                'download_url' => 'http://www.baidu.com',
                'download_channel' => 'f ',
                'version_desc' => 'fdsfsfsdfsaf',
                'status' => 0,
                'force_update' => 0,
                'package_size' => '12.0',
                'create_time' => '2018-04-20 12:05:03',
                'modify_time' => '2018-04-20 13:57:50',
            ),
            7 => 
            array (
                'id' => 8,
                'version_no' => '1.1.0',
                'app_os' => 2,
                'app_type' => 3,
                'downloads' => NULL,
                'download_url' => 'http://www.baidu.com',
                'download_channel' => '',
                'version_desc' => '1、测试更新
2、测试更新',
                'status' => 0,
                'force_update' => 0,
                'package_size' => '10.0',
                'create_time' => '2018-07-18 11:25:54',
                'modify_time' => '2018-07-25 16:36:57',
            ),
            8 => 
            array (
                'id' => 9,
                'version_no' => '6.5.0',
                'app_os' => 2,
                'app_type' => 2,
                'downloads' => NULL,
                'download_url' => 'https://www.baidu.com/',
                'download_channel' => '',
                'version_desc' => '1\\
2\\
3\\',
                'status' => 1,
                'force_update' => 1,
                'package_size' => '35.0',
                'create_time' => '2018-09-17 15:59:07',
                'modify_time' => '2018-09-17 16:04:46',
            ),
        ));
        
        
    }
}