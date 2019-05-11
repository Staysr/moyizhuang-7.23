<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseDriverReviewLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_driver_review_logs', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID:32位固定UUID');
			$table->integer('operater')->comment('操作人ID');
			$table->integer('type')->nullable()->default(0)->comment('审核人类型: 0 后台系统 1 舟到系统');
			$table->integer('driver_id')->nullable()->comment('司机id');
			$table->boolean('status')->comment('状态：0审核不通过 1审核通过');
			$table->string('code', 32)->nullable()->comment('失败类别：关联 base_driver_review_type 表');
			$table->string('remark', 100)->nullable()->comment('失败备注说明');
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
		Schema::drop('base_driver_review_logs');
	}

}
