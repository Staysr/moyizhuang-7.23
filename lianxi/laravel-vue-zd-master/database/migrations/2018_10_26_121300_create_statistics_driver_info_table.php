<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStatisticsDriverInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('statistics_driver_info', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->date('date')->nullable()->comment('日期');
			$table->integer('driver_id')->default(0)->comment('司机ID');
			$table->integer('big_id')->default(0)->comment('大队长ID');
			$table->integer('small_id')->default(0)->comment('小队长ID');
			$table->boolean('driver_type')->default(0)->comment('司机类型');
			$table->integer('category_id')->default(0)->comment('城市ID');
			$table->decimal('order_complete_fee', 10)->default(0.00)->comment('完成订单金额（已付款未付款已评价-不包括有责取消）');
			$table->integer('order_complete_total')->default(0)->comment('完成订单数（已付款未付款已评价）');
			$table->integer('order_cancel_total')->default(0)->comment('订单取消数量');
			$table->integer('work_time')->unsigned()->default(0)->comment('在线时长');
			$table->integer('task_order_total')->default(0)->comment('大B单数（统计已完成的出车单）');
			$table->decimal('task_order_fee', 10)->default(0.00)->comment('大B金额（统计已完成的出车单）');
			$table->unique(['date','driver_id'], 'date_driver_unique');
			$table->index(['date','big_id'], 'date_big');
			$table->index(['date','small_id'], 'date_small');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('statistics_driver_info');
	}

}
