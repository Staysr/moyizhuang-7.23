<?php

use Illuminate\Database\Seeder;

class SysExceptionRemindTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_exception_remind')->delete();
        
        \DB::table('sys_exception_remind')->insert(array (
            0 => 
            array (
                'id' => 6,
                'category_id' => 6,
                'category_code' => '0101002',
                'is_send_captain' => 1,
                'is_send_specify' => 1,
                'phones' => '13682509527,13400000000,18988765902,18938904748,18929396435,13200000000,13300000000,13500000000,13600000000,13510525631,',
                'status' => 1,
                'is_send_sms' => 0,
                'create_time' => '2017-12-04 15:14:41',
                'modify_time' => '2018-02-05 10:08:09',
            ),
            1 => 
            array (
                'id' => 7,
                'category_id' => 100180,
                'category_code' => '0101005',
                'is_send_captain' => 1,
                'is_send_specify' => 0,
                'phones' => '',
                'status' => 1,
                'is_send_sms' => 0,
                'create_time' => '2018-02-05 10:08:36',
                'modify_time' => '2018-02-05 10:08:36',
            ),
        ));
        
        
    }
}