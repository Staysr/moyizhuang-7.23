<?php

use Illuminate\Database\Seeder;

class SysCarStickerRuleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_car_sticker_rule')->delete();
        
        \DB::table('sys_car_sticker_rule')->insert(array (
            0 => 
            array (
                'id' => 5,
                'start_date' => '2017-05-09',
                'end_date' => '2017-05-09',
                'remark' => '计价范德萨发333111',
                'reference' => '人手',
                'reward_fee' => '10.00',
                'create_time' => '2017-05-09 15:39:56',
                'modify_time' => '2017-05-11 16:23:54',
            ),
            1 => 
            array (
                'id' => 6,
                'start_date' => '2017-05-11',
                'end_date' => '2017-05-11',
                'remark' => '事实上',
                'reference' => '算得上是',
                'reward_fee' => '5.00',
                'create_time' => '2017-05-11 14:19:08',
                'modify_time' => '2017-05-11 14:19:08',
            ),
            2 => 
            array (
                'id' => 7,
                'start_date' => '2017-05-11',
                'end_date' => '2017-03-06',
                'remark' => '请上传以笔为参照物的车辆图片，笔要出现在图片中',
                'reference' => '大宝剑',
                'reward_fee' => '5.00',
                'create_time' => '2017-05-12 11:09:53',
                'modify_time' => '2017-05-13 10:50:56',
            ),
            3 => 
            array (
                'id' => 8,
                'start_date' => '2017-05-15',
                'end_date' => '2017-05-15',
                'remark' => '请上传以笔为参照物的车辆图片，笔要出现在图片中
笔不能遮挡车贴或车牌号,车贴和车牌号需清晰可识别',
                'reference' => '车贴测试',
                'reward_fee' => '10.00',
                'create_time' => '2017-05-13 10:56:36',
                'modify_time' => '2017-05-15 10:25:05',
            ),
            4 => 
            array (
                'id' => 9,
                'start_date' => '2017-05-16',
                'end_date' => '2017-05-16',
                'remark' => '1，请上传以杯子为参照物的车辆图片，杯子要出现在图片中
2，杯子不能遮挡车贴或车牌号,车贴和车牌号需清晰可识别
3，左手持杯子,右手拍照',
                'reference' => '杯子',
                'reward_fee' => '5.00',
                'create_time' => '2017-05-16 16:15:39',
                'modify_time' => '2017-05-17 11:47:37',
            ),
            5 => 
            array (
                'id' => 10,
                'start_date' => '2017-05-17',
                'end_date' => '2017-05-17',
                'remark' => '1，请上传以手机为参照物的车辆图片，手机要出现在图片中
2，手机不能遮挡车贴或车牌号,车贴和车牌号需清晰可识别
3，左手持手机,右手拍照',
                'reference' => '手机',
                'reward_fee' => '100.00',
                'create_time' => '2017-05-17 11:48:19',
                'modify_time' => '2017-05-18 09:20:09',
            ),
            6 => 
            array (
                'id' => 11,
                'start_date' => '2017-05-18',
                'end_date' => '2017-05-18',
                'remark' => '1，请上传以笔为参照物的车辆图片，笔要出现在图片中

2，笔不能遮挡车贴或车牌号,车贴和车牌号需清晰可识别

3，左手持笔,右手拍照',
                'reference' => '笔',
                'reward_fee' => '50.00',
                'create_time' => '2017-05-18 09:20:33',
                'modify_time' => '2017-05-18 09:20:33',
            ),
            7 => 
            array (
                'id' => 12,
                'start_date' => '2017-05-19',
                'end_date' => '2017-05-21',
                'remark' => '1，请上传以瓶子为参照物的车辆图片，瓶子要出现在图片中

2，瓶子不能遮挡车贴或车牌号,车贴和车牌号需清晰可识别

3，左手持瓶子,右手拍照',
                'reference' => '瓶子',
                'reward_fee' => '7.00',
                'create_time' => '2017-05-19 16:09:52',
                'modify_time' => '2017-05-19 16:09:52',
            ),
            8 => 
            array (
                'id' => 13,
                'start_date' => '2018-06-13',
                'end_date' => '2018-06-12',
                'remark' => '测试测试测试测试测试测试测试测试',
                'reference' => '10元纸币',
                'reward_fee' => '10.00',
                'create_time' => '2018-06-06 10:04:55',
                'modify_time' => '2018-06-06 10:04:55',
            ),
        ));
        
        
    }
}