<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseMerchantStatisticsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_merchant_statistics', function(Blueprint $table)
		{
			$table->increments('id')->comment('主键ID');
			$table->integer('merchant_id')->comment('合作商家ID：合作商家表主键ID');
			$table->integer('client_id')->unique('clientId_unique')->comment('用户ID：用户表主键ID，主要用于生成二维码');
			$table->integer('invited_id')->comment('地推ID：地推人员表主键ID');
			$table->integer('recommend_user_total')->default(0)->comment('推荐用户总数');
			$table->integer('settlement_total')->default(0)->comment('结算次数');
			$table->dateTime('create_time')->comment('创建时间');
			$table->dateTime('modify_time')->nullable()->comment('修改时间');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_merchant_statistics');
	}

}
