<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdTaskOfferTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_task_offer', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('task_id')->comment('线路任务表主键ID');
			$table->integer('driver_id')->comment('司机表主键ID');
			$table->decimal('unit_price')->default(0.00)->comment('单趟报价：没有扣管理费的报价');
			$table->decimal('percentage', 4, 1)->default(0.0)->comment('管理费提成比率：12表示12%');
			$table->decimal('manage_fee')->default(0.00)->comment('管理费：等于 单趟报价 * 管理费提成比率（unit_price * percentage）的值');
			$table->decimal('driver_income_fee')->default(0.00)->comment('单趟配送收入：单趟报价 - 管理费（unit_price - manage_fee）');
			$table->string('remark', 128)->comment('竞标语');
			$table->integer('status')->default(1)->comment('状态：0 取消报价； 1 已报价；2 已解约');
			$table->string('rescind_reason')->nullable()->default('')->comment('解约原因');
			$table->string('cancel_reason')->nullable()->comment('取消报价原因');
			$table->dateTime('create_time')->comment('创建时间');
			$table->dateTime('modify_time')->nullable()->comment('修改时间');
			$table->unique(['task_id','driver_id'], 'taskId_driverId');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('zd_task_offer');
	}

}
