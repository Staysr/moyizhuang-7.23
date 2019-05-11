<?php

use Illuminate\Database\Seeder;

class CarInsuranceTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('car_insurance')->delete();
        
        \DB::table('car_insurance')->insert(array (
            0 => 
            array (
                'id' => 77,
                'number' => '10515003900193260860',
                'insurance_company_id' => 8,
                'company_id' => 11,
                'car_id' => 420,
                'type' => 1,
                'start_date' => '2018-05-18',
                'end_date' => '2018-06-05',
                'cost' => '500.00',
                'created_at' => '2018-05-18 17:25:52',
                'updated_at' => '2018-05-24 15:29:45',
            ),
            1 => 
            array (
                'id' => 78,
                'number' => '1351000',
                'insurance_company_id' => 9,
                'company_id' => 13,
                'car_id' => 420,
                'type' => 2,
                'start_date' => '2018-05-08',
                'end_date' => '2018-06-14',
                'cost' => '10.00',
                'created_at' => '2018-05-23 11:33:51',
                'updated_at' => '2018-05-24 15:29:38',
            ),
            2 => 
            array (
                'id' => 79,
                'number' => '857858758875875',
                'insurance_company_id' => 7,
                'company_id' => 14,
                'car_id' => 420,
                'type' => 3,
                'start_date' => '2018-05-24',
                'end_date' => '2018-06-20',
                'cost' => '400.00',
                'created_at' => '2018-05-24 15:29:32',
                'updated_at' => '2018-05-24 15:29:32',
            ),
            3 => 
            array (
                'id' => 80,
                'number' => '11111111',
                'insurance_company_id' => 9,
                'company_id' => 16,
                'car_id' => 424,
                'type' => 1,
                'start_date' => '2018-05-25',
                'end_date' => '2018-06-26',
                'cost' => '122222.00',
                'created_at' => '2018-05-25 14:20:54',
                'updated_at' => '2018-05-25 14:20:54',
            ),
            4 => 
            array (
                'id' => 81,
                'number' => '234234',
                'insurance_company_id' => 9,
                'company_id' => 12,
                'car_id' => 422,
                'type' => 1,
                'start_date' => '2018-05-24',
                'end_date' => '2018-06-19',
                'cost' => '234.00',
                'created_at' => '2018-05-25 14:48:40',
                'updated_at' => '2018-05-25 14:48:40',
            ),
            5 => 
            array (
                'id' => 82,
                'number' => '2345234',
                'insurance_company_id' => 9,
                'company_id' => 12,
                'car_id' => 424,
                'type' => 3,
                'start_date' => '2018-05-30',
                'end_date' => '2018-06-08',
                'cost' => '3234.00',
                'created_at' => '2018-05-25 14:49:17',
                'updated_at' => '2018-05-31 16:37:03',
            ),
            6 => 
            array (
                'id' => 83,
                'number' => '1111',
                'insurance_company_id' => 9,
                'company_id' => 12,
                'car_id' => 424,
                'type' => 2,
                'start_date' => '2018-05-17',
                'end_date' => '2018-06-19',
                'cost' => '333.00',
                'created_at' => '2018-05-25 14:55:17',
                'updated_at' => '2018-05-31 11:42:12',
            ),
            7 => 
            array (
                'id' => 84,
                'number' => '11111',
                'insurance_company_id' => 9,
                'company_id' => 12,
                'car_id' => 424,
                'type' => 3,
                'start_date' => '2018-05-18',
                'end_date' => '2018-06-18',
                'cost' => '123.00',
                'created_at' => '2018-05-25 14:55:47',
                'updated_at' => '2018-06-04 10:29:24',
            ),
            8 => 
            array (
                'id' => 87,
                'number' => '345454',
                'insurance_company_id' => 9,
                'company_id' => 12,
                'car_id' => 421,
                'type' => 3,
                'start_date' => '2018-05-16',
                'end_date' => '2018-05-29',
                'cost' => '45245.00',
                'created_at' => '2018-05-28 09:21:05',
                'updated_at' => '2018-05-29 16:52:26',
            ),
            9 => 
            array (
                'id' => 89,
                'number' => '35465415',
                'insurance_company_id' => 11,
                'company_id' => 11,
                'car_id' => 430,
                'type' => 1,
                'start_date' => '2018-05-01',
                'end_date' => '2018-05-29',
                'cost' => '20.00',
                'created_at' => '2018-05-29 16:49:42',
                'updated_at' => '2018-05-29 16:51:04',
            ),
            10 => 
            array (
                'id' => 90,
                'number' => '547567',
                'insurance_company_id' => 11,
                'company_id' => 12,
                'car_id' => 423,
                'type' => 1,
                'start_date' => '2018-06-01',
                'end_date' => '2018-07-18',
                'cost' => '54643564.00',
                'created_at' => '2018-06-04 10:21:23',
                'updated_at' => '2018-06-21 16:18:40',
            ),
            11 => 
            array (
                'id' => 91,
                'number' => '4656',
                'insurance_company_id' => 9,
                'company_id' => 11,
                'car_id' => 423,
                'type' => 2,
                'start_date' => '2018-06-19',
                'end_date' => '2018-07-03',
                'cost' => '435645.00',
                'created_at' => '2018-06-04 10:21:51',
                'updated_at' => '2018-06-21 16:33:22',
            ),
            12 => 
            array (
                'id' => 92,
                'number' => '123443',
                'insurance_company_id' => 9,
                'company_id' => 11,
                'car_id' => 424,
                'type' => 1,
                'start_date' => '2018-06-04',
                'end_date' => '2018-07-09',
                'cost' => '100.00',
                'created_at' => '2018-06-04 15:20:43',
                'updated_at' => '2018-06-04 15:20:43',
            ),
            13 => 
            array (
                'id' => 93,
                'number' => '123333333',
                'insurance_company_id' => 10,
                'company_id' => 11,
                'car_id' => 438,
                'type' => 2,
                'start_date' => '2018-06-19',
                'end_date' => '2018-07-03',
                'cost' => '1200.00',
                'created_at' => '2018-06-05 10:31:11',
                'updated_at' => '2018-06-21 16:32:43',
            ),
            14 => 
            array (
                'id' => 94,
                'number' => '1',
                'insurance_company_id' => 9,
                'company_id' => 15,
                'car_id' => 438,
                'type' => 1,
                'start_date' => '2018-06-19',
                'end_date' => '2018-07-03',
                'cost' => '1000.00',
                'created_at' => '2018-06-05 16:07:24',
                'updated_at' => '2018-06-21 16:32:29',
            ),
            15 => 
            array (
                'id' => 95,
                'number' => 'sfgsdfgsdfg34534',
                'insurance_company_id' => 11,
                'company_id' => 11,
                'car_id' => 435,
                'type' => 2,
                'start_date' => '2018-06-01',
                'end_date' => '2018-07-18',
                'cost' => '34235.00',
                'created_at' => '2018-06-05 17:55:39',
                'updated_at' => '2018-06-05 17:55:39',
            ),
            16 => 
            array (
                'id' => 96,
                'number' => '955855555',
                'insurance_company_id' => 13,
                'company_id' => 11,
                'car_id' => 435,
                'type' => 1,
                'start_date' => '2018-06-20',
                'end_date' => '2018-06-25',
                'cost' => '200.00',
                'created_at' => '2018-06-06 14:59:07',
                'updated_at' => '2018-06-21 16:30:47',
            ),
            17 => 
            array (
                'id' => 97,
                'number' => '46565211',
                'insurance_company_id' => 13,
                'company_id' => 11,
                'car_id' => 439,
                'type' => 2,
                'start_date' => '2018-06-20',
                'end_date' => '2018-06-26',
                'cost' => '100.00',
                'created_at' => '2018-06-06 15:00:43',
                'updated_at' => '2018-06-21 16:29:40',
            ),
            18 => 
            array (
                'id' => 98,
                'number' => '1045662212123123123123123123',
                'insurance_company_id' => 13,
                'company_id' => 12,
                'car_id' => 439,
                'type' => 1,
                'start_date' => '2018-06-20',
                'end_date' => '2018-06-26',
                'cost' => '50.00',
                'created_at' => '2018-06-06 15:01:30',
                'updated_at' => '2018-08-10 18:31:57',
            ),
            19 => 
            array (
                'id' => 99,
                'number' => '123654',
                'insurance_company_id' => 13,
                'company_id' => 12,
                'car_id' => 447,
                'type' => 2,
                'start_date' => '2018-08-10',
                'end_date' => '2018-09-15',
                'cost' => '100.00',
                'created_at' => '2018-08-10 18:42:58',
                'updated_at' => '2018-08-10 18:42:58',
            ),
        ));
        
        
    }
}