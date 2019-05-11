<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseDriverCashTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_driver_cash', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('driver_id')->comment('提现司机');
			$table->string('cash_no', 32)->unique('cash_no')->comment('提现编号');
			$table->decimal('fee', 10)->default(0.00)->comment('提现金额');
			$table->decimal('balance', 10)->default(0.00)->comment('余额');
			$table->integer('status')->default(0)->comment('状态：0未审核，1审核不通过，2审核通过，3已打款');
			$table->string('bank_city', 50)->comment('提现地区');
			$table->string('bank_name', 50)->comment('提现银行');
			$table->string('bank_subbranch', 100)->comment('提现支行');
			$table->string('card_name', 20)->comment('持卡人姓名');
			$table->string('card_no', 32)->comment('银行卡号');
			$table->dateTime('auditing_time')->nullable()->comment('审核时间');
			$table->string('auditing_remark')->nullable()->comment('审核说明');
			$table->integer('auditinger')->nullable()->comment('审核人');
			$table->dateTime('remark_paytime')->nullable()->comment('标记打款时间');
			$table->dateTime('pay_time')->nullable()->comment('打款时间');
			$table->integer('payer')->nullable()->comment('打款人');
			$table->string('pay_remark')->nullable()->comment('打款备注');
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
		Schema::drop('base_driver_cash');
	}

}
