<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseDriverSelfBill201707Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_driver_self_bill_2017-07', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('driver_id')->comment('司机ID');
			$table->integer('little_id')->comment('小队');
			$table->integer('big_id')->comment('大队');
			$table->integer('total_pay')->default(0)->comment('订单总数');
			$table->integer('total_cancel')->default(0)->comment('有责取消次数');
			$table->decimal('total_pay_fee', 10)->default(0.00)->comment('订单总金额');
			$table->decimal('total_cancel_fee', 10)->default(0.00)->comment('有责取消支付总金额');
			$table->date('date')->index('date_key');
			$table->unique(['driver_id','date'], 'date_driver');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_driver_self_bill_2017-07');
	}

}
