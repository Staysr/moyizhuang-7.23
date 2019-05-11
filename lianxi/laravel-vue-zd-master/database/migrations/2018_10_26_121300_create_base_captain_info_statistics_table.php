<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseCaptainInfoStatisticsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_captain_info_statistics', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->date('work_date')->comment('统计日期');
			$table->boolean('type')->comment('类型');
			$table->string('driver_id', 20)->comment('司机iD');
			$table->string('driver_name', 20)->comment('司机姓名');
			$table->string('driver_phone', 50)->comment('司机手机号码');
			$table->integer('supervisor_id')->default(0)->comment('上级');
			$table->decimal('total_fee', 10)->default(0.00)->comment('总支付');
			$table->decimal('total_cancel_fee', 10)->default(0.00)->comment('取消已支付');
			$table->decimal('total_estimate', 10, 0)->default(0)->comment('总里程');
			$table->integer('total_order')->default(0)->comment('总单量');
			$table->integer('total_pay_order')->default(0)->comment('支付订单量');
			$table->integer('total_pay_cancel_order')->default(0)->comment('取消支付');
			$table->integer('total_complete_order')->default(0)->comment('完成单量');
			$table->integer('total_cancel_order')->default(0)->comment('取消订单');
			$table->integer('total_complaint')->default(0)->comment('投诉次数');
			$table->integer('total_people')->default(0)->comment('总人数');
			$table->integer('total_people_all')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_captain_info_statistics');
	}

}
