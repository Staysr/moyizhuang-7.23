<?php

use Illuminate\Database\Seeder;

class CarMasterTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('car_master')->delete();
        
        \DB::table('car_master')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '张傲飞',
                'email' => '228589060@qq.com',
                'phone' => '13692110628',
                'password' => '$2y$10$LlceKNapbWEgadgKuAY7O.uO8KW6gOAnyCi4nrLfinTlI3KPBdOG2',
                'status' => 1,
                'is_admin' => 1,
                'last_login_time' => '2018-04-12 14:32:20',
                'last_login_ip' => '201',
                'updated_at' => '2018-05-18 16:49:43',
                'created_at' => '2018-04-12 14:32:29',
            ),
            1 => 
            array (
                'id' => 7,
                'name' => '赵福堂煞笔',
                'email' => '13410425217@qq.com',
                'phone' => '13410425217',
                'password' => '$2y$10$LlceKNapbWEgadgKuAY7O.uO8KW6gOAnyCi4nrLfinTlI3KPBdOG2',
                'status' => 1,
                'is_admin' => 0,
                'last_login_time' => NULL,
                'last_login_ip' => NULL,
                'updated_at' => '2018-05-18 17:16:16',
                'created_at' => '2018-05-18 16:32:20',
            ),
            2 => 
            array (
                'id' => 8,
                'name' => '车子',
                'email' => '18269446750@163.com',
                'phone' => '18269446750',
                'password' => '$2y$10$gBwyBzsxGxOquIAn08Tc0OLRDW.tWzLVxCXNNJouaAaSyog/tY3jC',
                'status' => 1,
                'is_admin' => 0,
                'last_login_time' => NULL,
                'last_login_ip' => NULL,
                'updated_at' => '2018-06-12 11:14:04',
                'created_at' => '2018-05-22 11:11:56',
            ),
            3 => 
            array (
                'id' => 9,
                'name' => '田甜',
                'email' => '282032091@qq.com',
                'phone' => '15919408756',
                'password' => '$2y$10$djP9iGmIMWRXIXd0w6P7GOeC5xt2O3Fkxcr2jZ3BW7sDUhmT8OX9C',
                'status' => 1,
                'is_admin' => 1,
                'last_login_time' => NULL,
                'last_login_ip' => NULL,
                'updated_at' => '2018-06-15 11:24:10',
                'created_at' => '2018-05-23 14:22:34',
            ),
            4 => 
            array (
                'id' => 10,
                'name' => '邓小华',
                'email' => 'xxx@xx.com',
                'phone' => '13537580621',
                'password' => '$2y$10$1R5ixJyxfA3LWovXGdMQz.UT9.Wgd2nFOSkXDdb1X3gmWVAzkNXD6',
                'status' => 1,
                'is_admin' => 0,
                'last_login_time' => NULL,
                'last_login_ip' => NULL,
                'updated_at' => '2018-06-06 19:06:56',
                'created_at' => '2018-05-25 10:11:26',
            ),
            5 => 
            array (
                'id' => 11,
                'name' => 'dsa',
                'email' => 'dsa@dsa.com',
                'phone' => '13692110628',
                'password' => '$2y$10$tbWSY56PMOcgyUvUPhxF/e/25C7IbriqvVP5AASjBm568onTx9swW',
                'status' => 0,
                'is_admin' => 0,
                'last_login_time' => NULL,
                'last_login_ip' => NULL,
                'updated_at' => '2018-07-25 10:39:42',
                'created_at' => '2018-07-25 10:39:42',
            ),
            6 => 
            array (
                'id' => 12,
                'name' => '林林林',
                'email' => '11111@qq.com',
                'phone' => '13410000000',
                'password' => '$2y$10$m8mnR2hK623BV6asb8bzNOOqsiYNDjkl6FHEGliAHAwIEMEa4.oe2',
                'status' => 1,
                'is_admin' => 1,
                'last_login_time' => NULL,
                'last_login_ip' => NULL,
                'updated_at' => '2018-07-25 12:00:53',
                'created_at' => '2018-07-25 11:28:40',
            ),
        ));
        
        
    }
}