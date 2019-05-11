<?php

use Illuminate\Database\Seeder;

class SysCarDepartmentTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_car_department')->delete();
        
        \DB::table('sys_car_department')->insert(array (
            0 => 
            array (
                'id' => 4,
                'company_id' => 11,
                'name' => 'soso',
                'remark' => '',
                'create_time' => '2017-03-29 15:48:26',
                'modify_time' => '2017-03-29 15:48:26',
            ),
        ));
        
        
    }
}