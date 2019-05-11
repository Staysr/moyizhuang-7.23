<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseDriverMoneyDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_driver_money_detail', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('driver_id')->comment('司机ID');
			$table->integer('type')->comment('类型：1订单支付宝，2订单微信，3订单余额，4车贴奖励，5司机服务奖励，6提现，7标书任务');
			$table->integer('foreign_key')->comment('类型外键');
			$table->string('foreign_no', 50)->nullable()->comment('外键编号：如 订单编号，出车单编号 等');
			$table->decimal('money', 10)->comment('金额：可正可负');
			$table->decimal('account_price', 10)->default(0.00)->comment('当前司机账户余额');
			$table->decimal('withdrawal_amount', 10)->comment('冻结金额');
			$table->string('remark')->nullable()->comment('说明');
			$table->dateTime('create_time')->nullable();
			$table->dateTime('modify_time')->nullable();
			$table->unique(['type','foreign_key'], 'type_foreign_key');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_driver_money_detail');
	}

}
