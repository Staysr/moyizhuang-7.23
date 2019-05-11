<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseDriverOrderBillingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_driver_order_billing', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID:32位固定UUID');
			$table->integer('driver_id')->nullable()->comment('用户ID：用户表主键ID');
			$table->decimal('paid_money', 10)->nullable()->default(0.00)->comment('已支付金额');
			$table->integer('total_count')->nullable()->comment('总单数');
			$table->integer('paid_count')->nullable()->comment('已支付单数');
			$table->integer('unpaid_count')->nullable()->comment('未支付单数');
			$table->date('create_date')->nullable()->comment('创建日期');
			$table->dateTime('modify_time')->nullable()->comment('修改时间');
			$table->unique(['driver_id','create_date'], 'driver_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_driver_order_billing');
	}

}
