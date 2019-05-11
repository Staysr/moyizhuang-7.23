<?php

use Illuminate\Database\Seeder;

class CarCompanyMasterTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('car_company_master')->delete();
        
        \DB::table('car_company_master')->insert(array (
            0 => 
            array (
                'master_id' => 7,
                'company_id' => 11,
            ),
            1 => 
            array (
                'master_id' => 7,
                'company_id' => 12,
            ),
            2 => 
            array (
                'master_id' => 8,
                'company_id' => 13,
            ),
            3 => 
            array (
                'master_id' => 7,
                'company_id' => 14,
            ),
            4 => 
            array (
                'master_id' => 8,
                'company_id' => 14,
            ),
            5 => 
            array (
                'master_id' => 8,
                'company_id' => 15,
            ),
            6 => 
            array (
                'master_id' => 9,
                'company_id' => 15,
            ),
            7 => 
            array (
                'master_id' => 10,
                'company_id' => 15,
            ),
        ));
        
        
    }
}