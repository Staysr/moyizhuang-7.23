<?php

use Illuminate\Database\Seeder;

class ZdSysRoleCategoryTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('zd_sys_role_category')->delete();
        
        \DB::table('zd_sys_role_category')->insert(array (
            0 => 
            array (
                'role_id' => 3,
                'category_id' => 6,
            ),
            1 => 
            array (
                'role_id' => 3,
                'category_id' => 100180,
            ),
            2 => 
            array (
                'role_id' => 3,
                'category_id' => 100182,
            ),
            3 => 
            array (
                'role_id' => 3,
                'category_id' => 100187,
            ),
            4 => 
            array (
                'role_id' => 3,
                'category_id' => 100193,
            ),
            5 => 
            array (
                'role_id' => 4,
                'category_id' => 6,
            ),
            6 => 
            array (
                'role_id' => 4,
                'category_id' => 100180,
            ),
            7 => 
            array (
                'role_id' => 4,
                'category_id' => 100182,
            ),
            8 => 
            array (
                'role_id' => 4,
                'category_id' => 100193,
            ),
            9 => 
            array (
                'role_id' => 5,
                'category_id' => 6,
            ),
            10 => 
            array (
                'role_id' => 5,
                'category_id' => 100180,
            ),
        ));
        
        
    }
}