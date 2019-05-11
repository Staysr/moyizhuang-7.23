<?php

use Illuminate\Database\Seeder;

class BaseDriverCarTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('base_driver_car')->delete();
        
        
        
    }
}