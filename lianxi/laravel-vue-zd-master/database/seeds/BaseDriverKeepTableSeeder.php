<?php

use Illuminate\Database\Seeder;

class BaseDriverKeepTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('base_driver_keep')->delete();
        
        
        
    }
}