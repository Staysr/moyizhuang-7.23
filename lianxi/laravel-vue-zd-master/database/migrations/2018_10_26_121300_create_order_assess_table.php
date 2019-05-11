<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderAssessTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_assess', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID:32位固定UUID');
			$table->integer('order_id')->nullable()->unique('order_id')->comment('订单ID');
			$table->integer('client_id')->nullable()->comment('用户ID：用户表主键ID');
			$table->integer('driver_id')->comment('司机ID');
			$table->integer('score')->nullable()->default(4)->comment('订单评价：1~5颗星，默认4星');
			$table->string('content', 256)->nullable()->comment('评价内容');
			$table->dateTime('create_time')->comment('创建时间');
			$table->dateTime('modify_time')->comment('修改时间');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('order_assess');
	}

}
