<?php

use Illuminate\Database\Seeder;

class ZdTagTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('zd_tag')->delete();
        
        \DB::table('zd_tag')->insert(array (
            0 => 
            array (
                'id' => 1,
                'tag_name' => '轻车熟路',
                'create_time' => '2017-11-16 14:24:53',
                'modify_time' => '2017-11-16 14:24:53',
            ),
        ));
        
        
    }
}