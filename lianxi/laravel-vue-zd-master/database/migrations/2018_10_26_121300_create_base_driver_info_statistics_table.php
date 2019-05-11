<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseDriverInfoStatisticsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_driver_info_statistics', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->date('work_date')->comment('统计日期');
			$table->string('driver_id', 20)->comment('司机iD');
			$table->string('driver_name', 20)->comment('司机姓名');
			$table->string('driver_phone', 50)->comment('司机手机号码');
			$table->integer('supervisor_id')->default(0)->comment('上级');
			$table->integer('little_team_id')->default(0)->comment('所属小队');
			$table->integer('big_team_id')->default(0)->comment('所属大队');
			$table->decimal('total_fee', 10)->default(0.00)->comment('总支付');
			$table->decimal('total_cancel_fee', 10)->default(0.00)->comment('取消已支付');
			$table->decimal('total_estimate', 10, 0)->default(0)->comment('总里程');
			$table->integer('total_order')->default(0)->comment('总单量');
			$table->integer('total_pay_order')->default(0)->comment('支付订单量');
			$table->integer('total_pay_cancel_order')->default(0)->comment('取消支付');
			$table->integer('total_complete_order')->default(0)->comment('完成单量');
			$table->integer('total_cancel_order')->default(0)->comment('取消订单');
			$table->integer('total_complaint')->default(0)->comment('投诉次数');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_driver_info_statistics');
	}

}
