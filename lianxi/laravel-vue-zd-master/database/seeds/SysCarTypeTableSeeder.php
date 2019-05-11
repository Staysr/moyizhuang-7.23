<?php

use Illuminate\Database\Seeder;

class SysCarTypeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_car_type')->delete();
        
        \DB::table('sys_car_type')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '中型面包',
                'code' => 'C001',
                'capacity' => 2000,
                'length' => 4.5,
                'width' => 1.68,
                'height' => 2.0,
                'remark' => '中型面包（4.5*1.68*2.0m）',
                'icon' => 'icon-weibiaoti--',
                'spec' => '',
                'is_join' => 1,
                'create_time' => '2016-09-22 16:47:41',
                'modify_time' => '2017-08-02 17:42:35',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '小型平板',
                'code' => 'C004',
                'capacity' => 5000,
                'length' => 2.0,
                'width' => 1.5,
                'height' => 1.8,
                'remark' => '小型平板（2~2.6m）',
                'icon' => 'icon-weibiaoti--2',
                'spec' => '无上限,无下限,带尾板,加长版,敞开式,带拖车',
                'is_join' => 1,
                'create_time' => '2016-09-23 14:25:20',
                'modify_time' => '2017-08-02 17:42:46',
            ),
            2 => 
            array (
                'id' => 6,
                'name' => '中型平板',
                'code' => 'C005',
                'capacity' => 10000,
                'length' => 2.6,
                'width' => 5.0,
                'height' => 2.3,
                'remark' => '中型平板（2.6~3.2m）',
                'icon' => 'icon-weibiaoti--1',
                'spec' => '特长版,加宽型',
                'is_join' => 1,
                'create_time' => '2016-09-23 14:58:11',
                'modify_time' => '2017-09-12 14:25:20',
            ),
            3 => 
            array (
                'id' => 7,
                'name' => '小型厢货',
                'code' => 'C006',
                'capacity' => 7000,
                'length' => 2.0,
                'width' => 1.6,
                'height' => 1.5,
                'remark' => '小型厢货（2~3.8m）',
                'icon' => 'icon-weibiaoti--3',
                'spec' => '封闭式,后封闭',
                'is_join' => 1,
                'create_time' => '2017-05-08 10:27:24',
                'modify_time' => '2017-08-02 17:43:17',
            ),
            4 => 
            array (
                'id' => 8,
                'name' => '大型厢货',
                'code' => 'C007',
                'capacity' => 30000,
                'length' => 4.2,
                'width' => 2.0,
                'height' => 1.8,
                'remark' => '大型厢货（3.8m以上）',
                'icon' => 'icon-weibiaoti--4',
                'spec' => '特大型',
                'is_join' => 1,
                'create_time' => '2017-05-08 10:28:15',
                'modify_time' => '2017-08-02 17:44:48',
            ),
            5 => 
            array (
                'id' => 9,
                'name' => '小型面包',
                'code' => 'C002',
                'capacity' => 1500,
                'length' => 1.0,
                'width' => 2.0,
                'height' => 3.0,
                'remark' => '小型面包',
                'icon' => 'icon-weibiaoti--3',
                'spec' => '费,23,42个',
                'is_join' => 1,
                'create_time' => '2017-08-02 10:36:46',
                'modify_time' => '2017-08-02 17:43:47',
            ),
            6 => 
            array (
                'id' => 10,
                'name' => '冷链车',
                'code' => 'C003',
                'capacity' => 10000,
                'length' => 2.66,
                'width' => 1.47,
                'height' => 1.47,
                'remark' => '冷链车',
                'icon' => 'icon-weibiaoti--4',
                'spec' => '',
                'is_join' => 0,
                'create_time' => '2017-08-02 10:38:34',
                'modify_time' => '2018-07-06 15:14:14',
            ),
        ));
        
        
    }
}