<?php

use Illuminate\Database\Seeder;

class ZdSysRoleRule1TableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('zd_sys_role_rule1')->delete();
        
        \DB::table('zd_sys_role_rule1')->insert(array (
            0 => 
            array (
                'role_id' => 1,
                'rule_id' => 1,
            ),
            1 => 
            array (
                'role_id' => 1,
                'rule_id' => 2,
            ),
            2 => 
            array (
                'role_id' => 1,
                'rule_id' => 5,
            ),
            3 => 
            array (
                'role_id' => 1,
                'rule_id' => 6,
            ),
            4 => 
            array (
                'role_id' => 1,
                'rule_id' => 7,
            ),
            5 => 
            array (
                'role_id' => 1,
                'rule_id' => 8,
            ),
            6 => 
            array (
                'role_id' => 1,
                'rule_id' => 9,
            ),
        ));
        
        
    }
}