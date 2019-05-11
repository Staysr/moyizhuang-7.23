<?php

use Illuminate\Database\Seeder;

class SysAutonumberTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_autonumber')->delete();
        
        \DB::table('sys_autonumber')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '',
                'type' => 'SysCategory',
                'business_parameters' => '0',
                'number' => 1,
                'create_time' => '2016-09-21 19:56:24',
                'modify_time' => '2016-09-21 19:56:24',
            ),
            1 => 
            array (
                'id' => 4,
                'name' => '',
                'type' => 'SysCategory',
                'business_parameters' => '2',
                'number' => 8,
                'create_time' => '2016-09-21 19:46:43',
                'modify_time' => '2016-09-21 19:46:43',
            ),
            2 => 
            array (
                'id' => 5,
                'name' => '',
                'type' => 'SysCategory',
                'business_parameters' => '3',
                'number' => 8,
                'create_time' => '2016-09-21 19:54:51',
                'modify_time' => '2016-09-21 19:54:51',
            ),
            3 => 
            array (
                'id' => 6,
                'name' => '',
                'type' => 'SysCategory',
                'business_parameters' => '1',
                'number' => 4,
                'create_time' => '2016-09-21 19:56:24',
                'modify_time' => '2016-09-21 19:56:24',
            ),
            4 => 
            array (
                'id' => 7,
                'name' => '',
                'type' => 'SysCategory',
                'business_parameters' => '4',
                'number' => 7,
                'create_time' => '2016-09-21 19:57:15',
                'modify_time' => '2016-09-21 19:57:15',
            ),
            5 => 
            array (
                'id' => 8,
                'name' => '',
                'type' => 'SysCategory',
                'business_parameters' => '5',
                'number' => 2,
                'create_time' => '2016-09-21 19:58:04',
                'modify_time' => '2016-09-21 19:58:04',
            ),
        ));
        
        
    }
}