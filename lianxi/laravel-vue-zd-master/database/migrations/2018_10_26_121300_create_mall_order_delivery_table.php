<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMallOrderDeliveryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mall_order_delivery', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('mall_order_id')->comment('订单ID');
			$table->string('remark')->nullable()->comment('收货备注');
			$table->dateTime('delivery_time')->nullable()->comment('收货时间');
			$table->string('pic')->nullable()->comment('上传收货照片');
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
		Schema::drop('mall_order_delivery');
	}

}
