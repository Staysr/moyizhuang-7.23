<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseDriverPlatFeeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_driver_plat_fee', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('pay_no')->comment('支付流水号');
			$table->string('third_trans_no', 32)->nullable()->comment('第三方交易流水号：如微信，支付宝等流水号');
			$table->integer('driver_id')->comment('司机ID：司机表主键ID');
			$table->decimal('plat_fee', 11)->unsigned()->default(0.00)->comment('平台信息费金额：单位元；');
			$table->boolean('status')->default(0)->comment('平台信息费状态：0：未支付；1：已支付；2：支付失败；默认值0');
			$table->integer('pay_type')->comment('支付方式: 1 支付宝支付；2 微信支付；');
			$table->dateTime('pay_time')->nullable()->comment('支付时间');
			$table->date('start_date')->nullable()->comment('平台服务费开始日期');
			$table->date('end_date')->nullable()->comment('平台服务费截止日期');
			$table->string('remark')->nullable()->comment('备注');
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
		Schema::drop('base_driver_plat_fee');
	}

}
