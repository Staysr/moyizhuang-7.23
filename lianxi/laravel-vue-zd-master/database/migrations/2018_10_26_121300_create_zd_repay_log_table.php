<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdRepayLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_repay_log', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('merchant_id')->nullable()->default(0)->comment('商户ID');
			$table->decimal('repay_money', 10)->nullable()->default(0.00)->comment('商户还款金额');
			$table->string('trade_no')->nullable()->comment('支付单号');
			$table->string('payee')->nullable()->comment('收款方名称');
			$table->boolean('type')->nullable()->default(0)->comment('1 转账  2 微信支付 3 支付宝支付');
			$table->text('remark')->nullable()->comment('备注');
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
		Schema::drop('zd_repay_log');
	}

}
