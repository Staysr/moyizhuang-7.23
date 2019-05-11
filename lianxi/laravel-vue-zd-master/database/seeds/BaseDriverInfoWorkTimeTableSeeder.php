<?php

use Illuminate\Database\Seeder;

class BaseDriverInfoWorkTimeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('base_driver_info_work_time')->delete();
        
        \DB::table('base_driver_info_work_time')->insert(array (
            0 => 
            array (
                'id' => 16,
                'work_date' => '2017-07-11',
                'driver_id' => 5367,
                'company_id' => NULL,
                'category_code' => '',
                'driver_name' => '祝攀',
                'driver_phone' => '13168730500',
                'driver_supervisors' => '5367,0,5367',
                'driver_supervisor_name' => '-',
                'work_time' => 31118,
                'valid_work_time' => 9519,
            ),
            1 => 
            array (
                'id' => 17,
                'work_date' => '2017-07-11',
                'driver_id' => 5401,
                'company_id' => NULL,
                'category_code' => '',
                'driver_name' => '大队长',
                'driver_phone' => '13411111111',
                'driver_supervisors' => '5401,0,5401',
                'driver_supervisor_name' => '-',
                'work_time' => 85739,
                'valid_work_time' => 13740,
            ),
            2 => 
            array (
                'id' => 18,
                'work_date' => '2017-07-11',
                'driver_id' => 5402,
                'company_id' => NULL,
                'category_code' => '',
                'driver_name' => '刘谋坚',
                'driver_phone' => '13422222222',
                'driver_supervisors' => '5401,5402,5402',
                'driver_supervisor_name' => '大队长',
                'work_time' => 29682,
                'valid_work_time' => 8083,
            ),
            3 => 
            array (
                'id' => 19,
                'work_date' => '2017-07-11',
                'driver_id' => 5403,
                'company_id' => NULL,
                'category_code' => '',
                'driver_name' => '小队长二',
                'driver_phone' => '13433333333',
                'driver_supervisors' => '5401,5403,5403',
                'driver_supervisor_name' => '大队长',
                'work_time' => 29741,
                'valid_work_time' => 8142,
            ),
            4 => 
            array (
                'id' => 20,
                'work_date' => '2017-07-11',
                'driver_id' => 5405,
                'company_id' => NULL,
                'category_code' => '',
                'driver_name' => '队员二',
                'driver_phone' => '13455555555',
                'driver_supervisors' => '5401,5403,5405',
                'driver_supervisor_name' => '小队长二',
                'work_time' => 20398,
                'valid_work_time' => 6168,
            ),
            5 => 
            array (
                'id' => 21,
                'work_date' => '2017-07-11',
                'driver_id' => 5422,
                'company_id' => NULL,
                'category_code' => '',
                'driver_name' => '测试面包车',
                'driver_phone' => '18929396435',
                'driver_supervisors' => '5436,5423,5422',
                'driver_supervisor_name' => '牛肉面',
                'work_time' => 37218,
                'valid_work_time' => 1619,
            ),
            6 => 
            array (
                'id' => 22,
                'work_date' => '2017-07-11',
                'driver_id' => 5423,
                'company_id' => NULL,
                'category_code' => '',
                'driver_name' => '牛肉面',
                'driver_phone' => '13112345678',
                'driver_supervisors' => '5436,5423,5423',
                'driver_supervisor_name' => '大面包',
                'work_time' => 27785,
                'valid_work_time' => 6186,
            ),
            7 => 
            array (
                'id' => 23,
                'work_date' => '2017-07-11',
                'driver_id' => 5424,
                'company_id' => NULL,
                'category_code' => '',
                'driver_name' => '袁',
                'driver_phone' => '13716945731',
                'driver_supervisors' => '5436,5423,5424',
                'driver_supervisor_name' => '牛肉面',
                'work_time' => 86399,
                'valid_work_time' => 14400,
            ),
            8 => 
            array (
                'id' => 24,
                'work_date' => '2017-07-11',
                'driver_id' => 5436,
                'company_id' => NULL,
                'category_code' => '',
                'driver_name' => '大面包',
                'driver_phone' => '13556873817',
                'driver_supervisors' => '5436,0,5436',
                'driver_supervisor_name' => '-',
                'work_time' => 54906,
                'valid_work_time' => 4506,
            ),
            9 => 
            array (
                'id' => 25,
                'work_date' => '2017-07-11',
                'driver_id' => 5455,
                'company_id' => NULL,
                'category_code' => '',
                'driver_name' => 'UUSee',
                'driver_phone' => '13455555552',
                'driver_supervisors' => '5401,5403,5455',
                'driver_supervisor_name' => '小队长二',
                'work_time' => 86399,
                'valid_work_time' => 14400,
            ),
            10 => 
            array (
                'id' => 31,
                'work_date' => '2017-07-12',
                'driver_id' => 5391,
                'company_id' => NULL,
                'category_code' => '',
                'driver_name' => '自营司机3',
                'driver_phone' => '13410000001',
                'driver_supervisors' => '5436,5423,5391',
                'driver_supervisor_name' => '牛肉面',
                'work_time' => -86401,
                'valid_work_time' => -142200,
            ),
            11 => 
            array (
                'id' => 32,
                'work_date' => '2017-07-12',
                'driver_id' => 5401,
                'company_id' => NULL,
                'category_code' => '',
                'driver_name' => '大队长',
                'driver_phone' => '13411111111',
                'driver_supervisors' => '5401,0,5401',
                'driver_supervisor_name' => '-',
                'work_time' => 53030,
                'valid_work_time' => 18830,
            ),
            12 => 
            array (
                'id' => 33,
                'work_date' => '2017-07-12',
                'driver_id' => 5436,
                'company_id' => NULL,
                'category_code' => '',
                'driver_name' => '大面包',
                'driver_phone' => '13556873817',
                'driver_supervisors' => '5436,0,5436',
                'driver_supervisor_name' => '-',
                'work_time' => 202,
                'valid_work_time' => 159,
            ),
            13 => 
            array (
                'id' => 34,
                'work_date' => '2017-07-26',
                'driver_id' => 5371,
                'company_id' => NULL,
                'category_code' => '',
                'driver_name' => '莫兵臣',
                'driver_phone' => '14725836969',
                'driver_supervisors' => '5436,5423,5371',
                'driver_supervisor_name' => '牛肉面',
                'work_time' => 64236,
                'valid_work_time' => 30036,
            ),
            14 => 
            array (
                'id' => 35,
                'work_date' => '2017-07-26',
                'driver_id' => 5422,
                'company_id' => NULL,
                'category_code' => '',
                'driver_name' => '测试面包车',
                'driver_phone' => '18929396435',
                'driver_supervisors' => '5436,5423,5422',
                'driver_supervisor_name' => '牛肉面',
                'work_time' => 44031,
                'valid_work_time' => 9831,
            ),
        ));
        
        
    }
}