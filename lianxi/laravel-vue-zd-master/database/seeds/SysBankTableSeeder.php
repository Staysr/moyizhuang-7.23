<?php

use Illuminate\Database\Seeder;

class SysBankTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_bank')->delete();
        
        \DB::table('sys_bank')->insert(array (
            0 => 
            array (
                'id' => 13,
                'name' => '招商银行',
                'remark' => NULL,
                'create_time' => '2017-05-15 15:42:38',
                'modify_time' => '2017-05-15 15:42:38',
            ),
            1 => 
            array (
                'id' => 15,
                'name' => '农业银行',
                'remark' => NULL,
                'create_time' => '2018-07-16 11:11:23',
                'modify_time' => '2018-07-16 11:11:23',
            ),
            2 => 
            array (
                'id' => 16,
                'name' => '建设银行',
                'remark' => NULL,
                'create_time' => '2018-07-16 11:11:38',
                'modify_time' => '2018-07-16 11:11:38',
            ),
            3 => 
            array (
                'id' => 17,
                'name' => '中国银行',
                'remark' => NULL,
                'create_time' => '2018-07-16 11:11:45',
                'modify_time' => '2018-07-16 11:11:45',
            ),
        ));
        
        
    }
}