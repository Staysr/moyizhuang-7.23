<?php

use Illuminate\Database\Seeder;

class MallSwipersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('mall_swipers')->delete();
        
        \DB::table('mall_swipers')->insert(array (
            0 => 
            array (
                'id' => 23,
                'title' => '图片1',
                'pic' => '/php-web/2018-09-15/20180915160707_57214.png',
                'sort' => 1,
                'create_date' => '2018-09-17 14:32:39',
                'modify_time' => NULL,
            ),
            1 => 
            array (
                'id' => 24,
                'title' => '图片2',
                'pic' => '/php-web/2018-09-17/20180917143238_40839.png',
                'sort' => 2,
                'create_date' => '2018-09-17 14:32:39',
                'modify_time' => NULL,
            ),
            2 => 
            array (
                'id' => 25,
                'title' => '图片3',
                'pic' => '/php-web/2018-09-17/20180917143238_17214.png',
                'sort' => 3,
                'create_date' => '2018-09-17 14:32:39',
                'modify_time' => NULL,
            ),
        ));
        
        
    }
}