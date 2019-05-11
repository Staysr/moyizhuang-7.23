<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseDriverSelfSupportTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_driver_self_support', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('driver_id');
			$table->date('date')->comment('日期');
			$table->integer('little_team_id')->default(0)->comment('所属小队（小队长接的单所属小队是自己，大队长接的单所属为0）');
			$table->integer('big_team_id')->default(0)->comment('所属大队(大队长接的单所属是自己）');
			$table->integer('order')->default(0)->comment('订单总数');
			$table->integer('cancel_order')->default(0)->comment('已取消订单数量 ');
			$table->integer('complete_order')->default(0)->comment('行程结束订单数量');
			$table->integer('pay_order')->default(0)->comment('已支付订单数量(不包括保险的费用)');
			$table->decimal('estimate', 6, 3)->default(0.000)->comment('订单总里程');
			$table->decimal('pay_order_free', 10)->default(0.00)->comment('正常已支付订单收入');
			$table->decimal('pay_cancel_free', 10)->default(0.00)->comment('有责取消并支付的金额');
			$table->integer('work_time')->default(0)->comment('出车时间');
			$table->integer('complaint')->default(0)->comment('被投拆次数');
			$table->dateTime('create_time')->nullable()->comment('添加时间');
			$table->dateTime('modify_time')->nullable()->comment('修改时间');
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
		Schema::drop('base_driver_self_support');
	}

}
