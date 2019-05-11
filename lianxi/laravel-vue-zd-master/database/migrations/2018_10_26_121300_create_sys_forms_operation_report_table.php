<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysFormsOperationReportTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_forms_operation_report', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('category_id')->default(6);
			$table->string('category_code', 32)->comment('组织');
			$table->integer('register')->comment('注册用户数');
			$table->integer('order_total')->comment('订单总数');
			$table->integer('order_finish')->comment('完成订单量：包括司机完成行程和已付款两个状态的订单总量；');
			$table->integer('client_cancel')->comment('用户取消订单量');
			$table->integer('operations_cancel')->comment('运营取消订单量');
			$table->decimal('income_total', 10)->comment('营业总收入：已付款订单的总收入；');
			$table->decimal('coupons_fee_total', 10);
			$table->decimal('recharge_total', 10)->comment('预充值总金额：平台预充值总金额');
			$table->decimal('balance_total', 10)->comment('预充值账户余额：平台预充值账户余额');
			$table->date('statistics_date')->comment('统计日期');
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
		Schema::drop('sys_forms_operation_report');
	}

}
