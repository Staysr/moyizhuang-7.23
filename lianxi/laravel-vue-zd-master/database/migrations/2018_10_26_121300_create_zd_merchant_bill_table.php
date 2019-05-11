<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdMerchantBillTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_merchant_bill', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('driver_id')->nullable()->default(0)->comment('司机账单');
			$table->integer('order_id')->nullable()->default(0)->comment('账单ID');
			$table->integer('merchant_id')->nullable()->default(0)->comment('商户ID');
			$table->integer('charge_type')->nullable()->default(0)->comment('计费方式 1 出车');
			$table->integer('task_type')->nullable()->default(0)->comment('任务类型 1 长期任务 2 临时任务');
			$table->decimal('merchant_money', 10)->nullable()->default(0.00)->comment('商户金额');
			$table->decimal('money', 10)->nullable()->default(0.00)->comment('还款金额');
			$table->dateTime('arrival_warehouse_time')->nullable()->comment('到仓时间：格式：2017-08-08 08:30:00');
			$table->dateTime('create_time')->nullable()->comment('创建时间');
			$table->dateTime('modify_time')->nullable()->comment('修改时间');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('zd_merchant_bill');
	}

}
