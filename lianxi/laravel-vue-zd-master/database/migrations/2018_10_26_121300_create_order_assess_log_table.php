<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderAssessLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_assess_log', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('order_id')->unique('log_order_id')->comment('订单ID');
			$table->integer('user_id')->comment('用户ID');
			$table->boolean('before')->comment('修改之前');
			$table->boolean('after')->comment('修改之后');
			$table->string('remark')->nullable()->comment('备注');
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
		Schema::drop('order_assess_log');
	}

}
