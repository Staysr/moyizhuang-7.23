<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdMerchantAccountTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_merchant_account', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('merchant_id')->nullable()->default(0)->unique('merchant_id')->comment('商户ID');
			$table->decimal('account', 10)->nullable()->default(0.00)->comment('账户金额');
			$table->dateTime('latest_repayment_time')->nullable()->comment('最近还款时间');
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
		Schema::drop('zd_merchant_account');
	}

}
