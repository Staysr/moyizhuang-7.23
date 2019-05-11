<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdTaskTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_task', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('type')->comment('任务类型：1 主任务；2 临时任务；');
			$table->string('name', 50)->comment('线路名称');
			$table->integer('merchant_id')->comment('商户表主键ID');
			$table->string('car_type_ids', 50)->comment('车型ID集合：(格式以英文逗号隔开：如 1,4,5,6,7,8)');
			$table->integer('warehouse_id')->comment('仓库表主键ID');
			$table->integer('driver_id')->nullable()->default(0)->comment('被选中的司机ID');
			$table->integer('is_fixed_point')->comment('配送点是否固定：0 否；1 是；');
			$table->string('unfixed_json', 50)->nullable()->comment('非固定配送点数量json格式：{"min":10,"max":80}');
			$table->string('delivery_point_remark', 300)->nullable()->comment('配送点备注：固定点和非固定点配送备注说明');
			$table->integer('is_back')->default(0)->comment('是否返程：0 不返程； 1 返程；');
			$table->string('distance_json', 50)->comment('配送总里程json格式(单位：公里)：{"min":100.55,"max":2000.45}');
			$table->date('arrival_date')->nullable()->comment('司机上岗日期');
			$table->string('send_time', 50)->nullable()->comment('配送时间json数组(1表示周一)：[1,2,3,4,5,6,7] ');
			$table->date('temp_start_date')->nullable()->comment('临时任务配送开始时间');
			$table->date('temp_end_date')->nullable()->comment('临时任务配送结束时间');
			$table->time('arrival_warehouse_time')->comment('到仓时间：格式：08:30');
			$table->time('estimate_time')->comment('预计完成时间：格式：09:30');
			$table->integer('total_time')->default(0)->comment('预计总耗时(单位分钟）：预计完成时间 - 到仓时间');
			$table->integer('safe_id')->nullable()->default(0)->comment('保险表主键ID');
			$table->integer('merchant_safe_id')->nullable()->default(0)->comment('商户购买保险ID');
			$table->string('goods_remark', 300)->comment('货物类型(货物描述)');
			$table->string('goods_volume', 30)->comment('货物总体积json格式(单位：立方米)：{"min":1.25,"max":4.75}');
			$table->string('goods_weight', 30)->comment('货物重量json格式(单位：吨)：{"min":0.75,"max":2.25}');
			$table->string('goods_num', 30)->nullable()->comment('货物件数json格式(单位：个/件/捆/箱)：{"min":3,"max":50}');
			$table->integer('back_bill')->default(0)->comment('是否回单：0不需要，1需要');
			$table->string('unit_price', 50)->nullable()->comment('预期单趟价格json格式(单位：元)：{"min":200.55,"max":800.00}');
			$table->string('price_remark', 20)->nullable()->comment('报价说明');
			$table->integer('is_delivery')->default(0)->comment('是否需要配送经验：0:不需要 1:需要');
			$table->dateTime('offer_end_time')->comment('报价截止时间');
			$table->dateTime('choose_driver_end_time')->comment('选司机截止时间');
			$table->dateTime('choose_driver_time')->nullable()->comment('选中司机时间');
			$table->integer('carry_type')->default(0)->comment('搬运类型：0 无需搬运； 1 轻度搬运； 2 中度搬运； 3 重度搬运；');
			$table->integer('status')->default(0)->comment('任务状态：0 司机报价中；1 选司机中； 2 选到可用司机； 3 客户不选司机； 4 过期不选司机； 5 无司机报价； 6 任务作废；');
			$table->boolean('driver_status')->default(0)->comment('司机状态：0 无司机; 1 被选中;，2 确认上岗;， 3任务完成 4 任务取消 ');
			$table->dateTime('work_time')->nullable()->comment('确定上岗时间');
			$table->boolean('merchant_status')->default(1)->comment('客户状态：0 删除 1 正常');
			$table->boolean('assign_status')->default(0)->comment('选择司机来源：0:商户自选;1:指派;');
			$table->integer('browse_count')->default(0)->comment('任务被浏览次数：一个司机浏览多次算一次');
			$table->integer('offer_count')->default(0)->comment('任务被报价次数：取消报价要-1');
			$table->integer('generated')->default(0)->comment('是否初次生成出车单');
			$table->string('create_er', 30)->nullable();
			$table->integer('rescind_id')->nullable()->default(0)->comment('无责任解约的当前司机ID');
			$table->dateTime('rescind_time')->nullable()->comment('解约时间');
			$table->dateTime('delete_time')->nullable()->comment('删除时间');
			$table->integer('is_show')->default(1)->comment('任务是否显示：0 不显示；1 显示；');
			$table->text('remark', 65535)->nullable()->comment('原因');
			$table->dateTime('create_time')->nullable()->comment('创建时间');
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
		Schema::drop('zd_task');
	}

}
