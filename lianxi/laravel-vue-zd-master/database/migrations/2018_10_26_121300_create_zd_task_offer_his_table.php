<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdTaskOfferHisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_task_offer_his', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('task_id')->comment('线路任务表主键ID');
			$table->integer('driver_id')->comment('司机表主键ID');
			$table->decimal('unit_price')->default(0.00)->comment('单趟报价：没有扣管理费的报价');
			$table->decimal('percentage', 4, 3)->default(0.000)->comment('管理费提成比率：0.12表示12%');
			$table->decimal('manage_fee', 6)->default(0.00)->comment('管理费：等于 单趟报价 * 管理费提成比率（unit_price * percentage）的值');
			$table->decimal('driver_income_fee')->default(0.00)->comment('单趟配送收入：单趟报价 - 管理费（unit_price - manage_fee）');
			$table->string('remark', 128)->nullable()->comment('竞标语');
			$table->integer('status')->default(1)->comment('状态：0 取消报价； 1 已报价；');
			$table->string('cancal_reason')->nullable()->comment('取消报价原因');
			$table->integer('driver_status')->nullable()->default(0)->comment('司机状态：0 等待被选中；1 选中司机；2 确认上岗； 3 任务完成； 4 任务取消；5 无责任解约；');
			$table->dateTime('create_time')->nullable()->comment('创建时间：报价主表的更新时间(modify_time)，也可以用于排序');
			$table->dateTime('modify_time')->nullable()->comment('修改时间');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('zd_task_offer_his');
	}

}
