<?php

use Illuminate\Database\Seeder;

class CarMaintainTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('car_maintain')->delete();
        
        \DB::table('car_maintain')->insert(array (
            0 => 
            array (
                'id' => 91,
                'number' => '5546543546464',
                'cost' => '10.00',
                'car_id' => 421,
                'driver_id' => 5401,
                'company_id' => 12,
                'date' => '2018-05-18',
                'mileage' => 1000,
                'updated_at' => '2018-05-30 11:49:47',
                'created_at' => '2018-05-19 11:28:27',
            ),
            1 => 
            array (
                'id' => 92,
                'number' => '545464654949555',
                'cost' => '33.00',
                'car_id' => 420,
                'driver_id' => 5404,
                'company_id' => 12,
                'date' => '2018-05-08',
                'mileage' => 50,
                'updated_at' => '2018-05-24 16:33:05',
                'created_at' => '2018-05-19 11:39:47',
            ),
            2 => 
            array (
                'id' => 93,
                'number' => '0000000001',
                'cost' => '200.00',
                'car_id' => 420,
                'driver_id' => 5503,
                'company_id' => 12,
                'date' => '2018-05-23',
                'mileage' => 200,
                'updated_at' => '2018-05-25 15:47:21',
                'created_at' => '2018-05-25 15:47:21',
            ),
            3 => 
            array (
                'id' => 94,
                'number' => 'fgdfgdfsg',
                'cost' => '564.00',
                'car_id' => 424,
                'driver_id' => 5422,
                'company_id' => 12,
                'date' => '2018-05-18',
                'mileage' => 45345353,
                'updated_at' => '2018-05-29 12:10:44',
                'created_at' => '2018-05-29 12:10:44',
            ),
            4 => 
            array (
                'id' => 95,
                'number' => 'sdfasdfa',
                'cost' => '342.00',
                'car_id' => 424,
                'driver_id' => 5421,
                'company_id' => 12,
                'date' => '2018-05-29',
                'mileage' => 4532542,
                'updated_at' => '2018-05-29 12:13:46',
                'created_at' => '2018-05-29 12:13:46',
            ),
            5 => 
            array (
                'id' => 96,
                'number' => '1111234',
                'cost' => '200.00',
                'car_id' => 425,
                'driver_id' => 5423,
                'company_id' => 12,
                'date' => '2018-05-31',
                'mileage' => 1000,
                'updated_at' => '2018-05-30 11:19:28',
                'created_at' => '2018-05-30 11:05:11',
            ),
            6 => 
            array (
                'id' => 97,
                'number' => '11111',
                'cost' => '20.00',
                'car_id' => 424,
                'driver_id' => 5532,
                'company_id' => 11,
                'date' => '2018-06-05',
                'mileage' => 1200,
                'updated_at' => '2018-06-05 11:39:32',
                'created_at' => '2018-06-05 11:39:32',
            ),
            7 => 
            array (
                'id' => 98,
                'number' => '851012',
                'cost' => '10.00',
                'car_id' => 435,
                'driver_id' => 5477,
                'company_id' => 13,
                'date' => '2018-06-14',
                'mileage' => 100,
                'updated_at' => '2018-06-06 17:09:56',
                'created_at' => '2018-06-06 17:09:56',
            ),
            8 => 
            array (
                'id' => 99,
                'number' => '323234244',
                'cost' => '1.00',
                'car_id' => 440,
                'driver_id' => 5401,
                'company_id' => 13,
                'date' => '2018-06-21',
                'mileage' => 1333,
                'updated_at' => '2018-06-21 16:13:40',
                'created_at' => '2018-06-21 16:11:53',
            ),
            9 => 
            array (
                'id' => 100,
                'number' => '111112222333',
                'cost' => '1.00',
                'car_id' => 438,
                'driver_id' => 5404,
                'company_id' => 11,
                'date' => '2018-06-20',
                'mileage' => 222,
                'updated_at' => '2018-06-21 16:23:19',
                'created_at' => '2018-06-21 16:23:19',
            ),
            10 => 
            array (
                'id' => 101,
                'number' => '1246551565',
                'cost' => '21.00',
                'car_id' => 438,
                'driver_id' => 5454,
                'company_id' => 13,
                'date' => '2018-06-21',
                'mileage' => 1000,
                'updated_at' => '2018-06-21 17:52:32',
                'created_at' => '2018-06-21 17:52:32',
            ),
            11 => 
            array (
                'id' => 102,
                'number' => '345435655435',
                'cost' => '2.00',
                'car_id' => 437,
                'driver_id' => 5401,
                'company_id' => 13,
                'date' => '2018-06-21',
                'mileage' => 1222,
                'updated_at' => '2018-06-22 09:57:26',
                'created_at' => '2018-06-22 09:57:26',
            ),
        ));
        
        
    }
}