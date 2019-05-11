<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseMerchantMonthStatisticsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_merchant_month_statistics', function(Blueprint $table)
		{
			$table->increments('id')->comment('主键ID');
			$table->integer('merchant_id')->comment('合作商家ID：合作商家表主键ID');
			$table->integer('client_id')->comment('用户ID：用户表主键ID，跟商家ID是一一对应的');
			$table->integer('recommend_user_total')->default(0)->comment('推荐用户总数');
			$table->char('date', 7)->comment('月份：按月统计');
			$table->integer('status')->default(0)->comment('是否结算：0 未结算； 1 已结算；');
			$table->string('operator')->nullable();
			$table->dateTime('create_time')->comment('创建时间');
			$table->dateTime('modify_time')->nullable()->comment('修改时间');
			$table->unique(['client_id','date'], 'clientId_date');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_merchant_month_statistics');
	}

}
