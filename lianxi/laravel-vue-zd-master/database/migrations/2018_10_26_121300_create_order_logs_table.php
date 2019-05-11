<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_logs', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('order_id')->nullable()->comment('订单号');
			$table->integer('foreign_id')->comment('操作人ID：外键');
			$table->boolean('type')->comment('1 修改费用 2 修改评论 3 允许不上传 4 允许司机滑动到达发货地 5 允许司机滑动结束行程
6 客服备注 7 增加附加费用 8 修改附加费用');
			$table->string('desc', 100)->comment('程序说明');
			$table->string('remark', 100)->nullable()->comment('备注说明');
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
		Schema::drop('order_logs');
	}

}
