<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMallProductLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mall_product_logs', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('product_id')->comment('商品');
			$table->integer('user_id')->comment('后台操作用户');
			$table->string('remark')->comment('说明');
			$table->dateTime('create_date')->nullable();
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
		Schema::drop('mall_product_logs');
	}

}
