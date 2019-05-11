<?php

use Illuminate\Database\Seeder;

class BaseClientActiveTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('base_client_active')->delete();
        
        
        
    }
}