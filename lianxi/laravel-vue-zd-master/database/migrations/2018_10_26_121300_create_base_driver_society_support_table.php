<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseDriverSocietySupportTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_driver_society_support', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('driver_id')->comment('司机ID');
			$table->date('date')->comment('日期');
			$table->integer('order')->default(0)->comment('订单总数');
			$table->integer('cancel_order')->default(0)->comment('已取消订单数量 ');
			$table->integer('complete_order')->default(0)->comment('行程结束订单数量');
			$table->integer('pay_order')->default(0)->comment('已支付订单数');
			$table->decimal('estimate', 6, 3)->default(0.000)->comment('总里程');
			$table->integer('cash_count')->default(0)->comment('提现次数');
			$table->decimal('pay_order_free', 10)->default(0.00)->comment('正常已支付订单收入');
			$table->decimal('join_free', 10)->default(0.00)->comment('入账金额');
			$table->decimal('reward_free', 10)->default(0.00)->comment('奖励金额');
			$table->decimal('punish_free', 10)->default(0.00)->comment('惩罚金额');
			$table->decimal('cash_free', 10)->default(0.00)->comment('提现金额');
			$table->decimal('pay_cancel_free', 10)->default(0.00)->comment('有责取消并支付的金额');
			$table->integer('work_time')->default(0)->comment('出车时间');
			$table->integer('complaint')->default(0)->comment('被投拆次数');
			$table->dateTime('create_time')->nullable();
			$table->dateTime('modify_time')->nullable();
			$table->unique(['date','driver_id'], 'driver_id_date');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_driver_society_support');
	}

}
