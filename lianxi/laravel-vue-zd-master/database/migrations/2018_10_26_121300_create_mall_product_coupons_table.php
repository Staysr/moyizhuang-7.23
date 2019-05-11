<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMallProductCouponsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mall_product_coupons', function(Blueprint $table)
		{
			$table->integer('product_id');
			$table->integer('coupons_id');
			$table->unique(['product_id','coupons_id'], 'unique_product_coupons');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mall_product_coupons');
	}

}
