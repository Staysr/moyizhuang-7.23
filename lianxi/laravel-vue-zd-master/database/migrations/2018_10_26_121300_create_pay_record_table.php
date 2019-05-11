<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePayRecordTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pay_record', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID:32位固定UUID');
			$table->string('pay_no', 32)->comment('交易流水号');
			$table->integer('foreign_id')->nullable()->comment('外键ID：订单表主键ID或者用户充值ID');
			$table->integer('client_id')->nullable()->comment('用户ID：用户表主键ID');
			$table->string('third_trans_no', 32)->nullable()->comment('第三方交易流水号：如微信，支付宝等流水号');
			$table->integer('trans_type')->comment('交易类型：1 消费；2 充值；');
			$table->integer('pay_type')->comment('支付方式: 1 支付宝支付；2 APP微信支付；3 账户余额支付；4 公众号微信支付 5 小程序微信支付');
			$table->integer('pay_trade_type')->default(0)->comment('支付交易类型： 0 APP支付；1 扫码支付；2 微信公众号支付； 3 小程序微信支付');
			$table->integer('pay_status')->default(2)->comment('支付状态： 0 支付中；1 支付成功；2 支付失败；');
			$table->dateTime('pay_time')->nullable()->comment('支付时间');
			$table->decimal('pay_fee', 11)->comment('支付金额：单位元；');
			$table->integer('client_coupons_id')->nullable()->comment('优惠卷ID');
			$table->string('currency', 16)->default('RMB')->comment('支付币种：默认币种 RMB');
			$table->string('remark')->nullable()->comment('备注');
			$table->dateTime('create_time')->comment('创建时间');
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
		Schema::drop('pay_record');
	}

}
