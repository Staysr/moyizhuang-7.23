<?php

use Illuminate\Database\Seeder;

class MycatSequenceTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('mycat_sequence')->delete();
        
        
        
    }
}