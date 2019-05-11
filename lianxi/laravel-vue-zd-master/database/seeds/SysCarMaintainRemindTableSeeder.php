<?php

use Illuminate\Database\Seeder;

class SysCarMaintainRemindTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_car_maintain_remind')->delete();
        
        \DB::table('sys_car_maintain_remind')->insert(array (
            0 => 
            array (
                'id' => 1,
                'company_id' => 14,
                'car_style_id' => 6,
                'max_mileage' => 5000,
                'max_date' => 5000,
                'rule' => 10,
                'is_notice' => 1,
                'notice_driver' => 0,
                'desc' => '111',
                'create_time' => '2017-09-15 14:00:41',
                'modify_time' => '2017-09-15 14:00:41',
            ),
        ));
        
        
    }
}