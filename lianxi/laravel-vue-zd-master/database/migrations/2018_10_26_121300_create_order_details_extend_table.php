<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderDetailsExtendTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_details_extend', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('order_id')->comment('订单ID： 订单表主键ID');
			$table->decimal('rent_time', 10)->default(0.00)->comment('包车时长');
			$table->decimal('rent_price', 10)->default(0.00)->comment('包车价格');
			$table->decimal('rent_mileage', 10)->default(0.00)->comment('包车里程');
			$table->integer('rent_type')->default(1)->comment('包车时长类型： 半日租：1，全日租：2');
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
		Schema::drop('order_details_extend');
	}

}
