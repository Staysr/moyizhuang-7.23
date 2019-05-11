<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseClientComplaintTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_client_complaint', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('client_id')->nullable()->comment('用户ID：用户表主键ID');
			$table->integer('driver_id')->nullable()->comment('司机ID：司机表主键ID');
			$table->integer('order_id')->comment('订单ID：订单表主键ID');
			$table->integer('user_id')->nullable()->default(0)->comment('审核者');
			$table->string('content')->comment('投诉内容');
			$table->string('audit_content')->nullable()->comment('审核内容：驳回用户投诉的原因');
			$table->integer('status')->nullable()->default(0)->comment('投诉状态：0 未审核；1 审核通过；2 驳回投诉');
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
		Schema::drop('base_client_complaint');
	}

}
