<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseDriverSelfMonthCensusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_driver_self_month_census', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('driver_id');
			$table->string('month', 20)->comment('月份');
			$table->integer('pay_order')->default(0)->comment('完成订单数量');
			$table->decimal('estimate', 6, 3)->comment('总里程');
			$table->decimal('pay_order_free', 10)->comment('支付订单金额');
			$table->decimal('pay_cancel_free', 10)->comment('取消支付金额');
			$table->decimal('team_total_free', 10);
			$table->dateTime('create_time')->nullable();
			$table->dateTime('modify_time')->nullable();
			$table->unique(['driver_id','month'], 'month_driver');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_driver_self_month_census');
	}

}
