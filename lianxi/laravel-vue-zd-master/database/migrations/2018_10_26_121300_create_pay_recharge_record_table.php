<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePayRechargeRecordTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pay_recharge_record', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('client_id')->nullable()->index('prr_client_id')->comment('用户ID：用户表主键ID');
			$table->string('recharge_no', 32)->comment('充值号');
			$table->boolean('type')->default(0)->comment('充值类型：0 套餐充值; 1 自定义充值');
			$table->decimal('real_fee', 11)->default(0.00)->comment('实充金额');
			$table->decimal('discount_fee', 11)->default(0.00)->comment('优惠金额: 规则跟据type 定');
			$table->decimal('pay_fee', 11)->default(0.00)->comment('充值金额：单位元；');
			$table->integer('pay_type')->comment('支付方式: 1 支付宝支付；2 微信APP支付；5 微信小程序支付');
			$table->string('third_trans_no', 32)->nullable()->comment('第三方交易流水号：如微信，支付宝等流水号');
			$table->integer('status')->default(0)->comment('充值状态： 0 充值中；1 充值成功；2 充值失败；');
			$table->integer('recharge_package_id')->nullable()->comment('套餐ID：关联pay_recharge_package表');
			$table->string('type_name')->nullable()->comment('类型名称');
			$table->string('type_description')->nullable()->comment('类型描述');
			$table->string('currency', 16)->default('RMB')->comment('充值币种：默认币种 RMB');
			$table->string('remark')->nullable()->comment('备注');
			$table->boolean('nominate_type')->nullable()->default(0)->comment('推荐用户类型: 0 并没有人推荐; 1 用户推荐; 2 地推人员推荐; 3 司机推荐
PS:用户现在不管
顺序：2>3>1');
			$table->string('nominate_phone', 20)->nullable()->default('0')->comment('推荐人手机号码 和 nominate_type 组合');
			$table->string('nominate_code')->default('0')->comment('业务编码');
			$table->integer('recharge_count')->default(0)->comment('充值次数');
			$table->dateTime('pay_time')->comment('充值时间');
			$table->integer('sloga_id')->default(0)->comment('关联的促销标语ID');
			$table->string('sloga_msg', 32)->nullable()->comment('促销标语');
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
		Schema::drop('pay_recharge_record');
	}

}
