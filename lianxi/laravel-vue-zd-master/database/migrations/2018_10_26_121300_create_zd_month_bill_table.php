<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdMonthBillTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_month_bill', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('merchant_id')->nullable();
			$table->string('bill_no', 30)->nullable();
			$table->string('bill_time', 50)->nullable();
			$table->integer('status')->nullable()->default(0)->comment('0 待还款  1 部分还款 2 已经还款 3 无需还款');
			$table->decimal('money', 10)->nullable()->default(0.00)->comment('待还款金额');
			$table->decimal('repayment_money', 10)->nullable()->default(0.00)->comment('已还款金额');
			$table->date('last_repayment_time')->nullable()->comment('最后还款时间');
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
		Schema::drop('zd_month_bill');
	}

}
