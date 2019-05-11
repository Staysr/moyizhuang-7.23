<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdTaskOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_task_order', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->string('order_no', 20)->comment('出车单编号');
			$table->integer('merchant_id')->comment('商户表主键ID');
			$table->integer('task_id')->comment('线路任务表主键ID');
			$table->string('name', 50)->comment('线路名称');
			$table->integer('warehouse_id')->comment('仓库表主键ID');
			$table->integer('driver_id')->nullable()->comment('司机ID');
			$table->integer('car_type_id')->default(0)->comment('车辆类型：车辆类型：sys_car_type 表');
			$table->decimal('unit_price')->default(0.00)->comment('单趟报价：没有扣管理费的报价');
			$table->decimal('safe_fee')->default(0.00)->comment('保险费(元)');
			$table->decimal('merchant_safe_fee')->nullable()->default(0.00)->comment('商户保险费(元)');
			$table->decimal('total_fee')->default(0.00)->comment('总费用(元)：司机报价(unit_price) - 管理费(manage_fee) - 保险费(safe_fee)');
			$table->decimal('manage_fee')->default(0.00)->comment('管理费：等于 单趟报价 * 管理费提成比率（unit_price * percentage）的值');
			$table->decimal('percentage', 4, 1)->default(0.0)->comment('管理费提成比率：12表示12%');
			$table->dateTime('arrival_warehouse_time')->nullable()->comment('到仓时间：格式：2017-08-08 08:30:00');
			$table->dateTime('punch_time')->nullable()->comment('签到时间');
			$table->dateTime('leaves_warehouse_time')->nullable()->comment('离仓时间');
			$table->dateTime('finish_time')->nullable()->comment('配送完成时间');
			$table->dateTime('cancel_time')->nullable()->comment('运营取消时间');
			$table->dateTime('rescind_time')->nullable()->comment('无责任解约时间');
			$table->dateTime('undo_time')->nullable()->comment('设置不配送时间');
			$table->integer('is_agent')->default(0)->comment('是否代签到：0 否； 1 是；');
			$table->integer('is_one_step_finish')->default(0)->comment('是否一键完成：0 否； 1 是；');
			$table->integer('safe_id')->nullable()->default(0)->comment('保险表主键ID');
			$table->integer('merchant_safe_id')->nullable()->default(0)->comment('商户购买保险ID');
			$table->integer('status')->default(0)->comment('状态：0 未签到； 1 已签到；2 配送中(离仓)；3 配送完成；4 设置不配送；5 无责任解约；6 运营取消；');
			$table->integer('remind_status')->nullable()->default(0)->comment('是否提醒：0没有;1有');
			$table->integer('is_confirm_posts')->nullable()->default(0)->comment('是否确认上岗：0 否；1 是');
			$table->integer('cancel_count')->nullable()->default(0)->comment('重新置送次数');
			$table->integer('point_count')->default(0)->comment('配送点数量');
			$table->integer('exception_count')->default(0)->comment('未妥投点个数');
			$table->integer('is_reassigned')->default(0)->comment('出车单是否改派：0 未改派；1 已改派；默认是0');
			$table->string('delivery_point_remark', 300)->nullable()->comment('配送点备注：固定点和非固定点配送备注说明');
			$table->string('reassignment_reason')->nullable()->comment('改派理由');
			$table->string('remark')->nullable()->comment('备注：运营取消，代签到，一键完成，改派司机时填写的原因');
			$table->dateTime('create_time')->comment('创建时间');
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
		Schema::drop('zd_task_order');
	}

}
