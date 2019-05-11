<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdMerchantAssessTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_merchant_assess', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('merchant_id')->comment('商户ID：商户表主键ID');
			$table->integer('driver_id')->comment('司机ID：司机表主键ID');
			$table->integer('task_id')->comment('任务ID：线路任务表主键ID');
			$table->integer('order_id')->comment('出车单ID：出车单表主键ID');
			$table->integer('score')->default(0)->comment('评价星级：1~5颗星');
			$table->string('content')->comment('投诉内容');
			$table->dateTime('create_time')->nullable()->comment('创建时间：投诉时间');
			$table->dateTime('modify_time')->nullable()->comment('修改时间：客服审核时间或用户取消投诉时间');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('zd_merchant_assess');
	}

}
