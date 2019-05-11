<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseClientLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_client_logs', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID:32位固定UUID');
			$table->boolean('operater_type')->default(0)->comment('操作人类型 0:后台人员 1:用户 2:司机');
			$table->integer('operater')->comment('操作人ID');
			$table->integer('client_id')->nullable()->comment('用户id');
			$table->boolean('before_status')->comment('操作之前订单状态');
			$table->boolean('after_status')->comment('操作之后订单状态');
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
		Schema::drop('base_client_logs');
	}

}
