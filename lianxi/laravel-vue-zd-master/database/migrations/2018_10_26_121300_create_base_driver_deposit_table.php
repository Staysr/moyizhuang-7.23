<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseDriverDepositTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_driver_deposit', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('pay_no')->comment('支付流水号');
			$table->integer('driver_id')->comment('司机ID：司机表主键ID');
			$table->decimal('deposit_fee', 11)->unsigned()->default(0.00)->comment('支付金额：单位元；');
			$table->boolean('status')->default(0)->comment('保证金状态：0：未缴纳；1：已缴纳正常；2：申请退款待审核中；3 审核通过待打款； 4 已退款；5 退款审核失败；默认值0');
			$table->integer('pay_type')->comment('支付方式: 1 支付宝支付；2 微信支付；');
			$table->dateTime('defray_time')->nullable()->comment('支付时间');
			$table->string('third_trans_no', 32)->nullable()->comment('第三方交易流水号：如微信，支付宝等流水号');
			$table->dateTime('refund_time')->nullable()->comment('申请退款时间');
			$table->dateTime('auditing_time')->nullable()->comment('审核时间');
			$table->integer('auditinger')->nullable()->comment('审核人');
			$table->string('auditing_remark')->nullable()->comment('审核备注');
			$table->dateTime('pay_time')->nullable()->comment('打款时间');
			$table->integer('payer')->nullable()->comment('标记打款操作人');
			$table->string('pay_remark')->nullable()->comment('打款备注');
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
		Schema::drop('base_driver_deposit');
	}

}
