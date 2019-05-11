<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseClientInfoCensusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_client_info_census', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('client_id')->index('client_id')->comment('用户ID');
			$table->integer('wait_assign')->nullable()->default(0)->comment('未分配的订单');
			$table->integer('hand_order')->nullable()->default(0)->comment('进行中的订单');
			$table->integer('cancel_order')->nullable()->default(0)->comment('取消订单个数');
			$table->integer('operations_cancel')->nullable()->default(0)->comment('运营取消');
			$table->integer('wait_pay_order')->nullable()->default(0)->comment('待付款订单个数');
			$table->integer('finish_order')->nullable()->default(0)->comment('完成订单个数');
			$table->integer('convert_driver')->nullable()->default(0)->comment('收藏司机个数');
			$table->dateTime('create_time')->nullable();
			$table->dateTime('modify_time')->nullable()->comment('用户统计表');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_client_info_census');
	}

}
