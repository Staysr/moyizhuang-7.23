<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePayRechargePackageInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pay_recharge_package_info', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('package_id')->comment('套餐ID');
			$table->integer('coupons_id')->comment('优惠券Id');
			$table->integer('quantity')->comment('数量');
			$table->unique(['package_id','coupons_id'], 'package_coupons');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pay_recharge_package_info');
	}

}
