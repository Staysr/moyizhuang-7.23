<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseDriverEarningRecordTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_driver_earning_record', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('driver_id')->comment('司机ID');
			$table->integer('order_id')->comment('订单ID');
			$table->integer('cash_id')->nullable()->comment('提现ID');
			$table->boolean('status')->default(0)->comment('状态：0 未提款; 1 提款中 2 提款完成');
			$table->integer('type')->comment('类型：1订单支付宝，2订单微信，3订单余额，4车贴奖励，5司机服务奖励');
			$table->dateTime('create_time')->nullable();
			$table->dateTime('modify_time')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_driver_earning_record');
	}

}
