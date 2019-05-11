<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdDriverSubTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_driver_sub', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('driver_id')->unique('driver_in_index')->comment('司机表主键ID');
			$table->integer('offer_count')->default(0)->comment('司机报价次数');
			$table->integer('checked_count')->default(0)->comment('被选中次数');
			$table->integer('complete_count')->default(0)->comment('成功配送次数：一次出车单配送完成计一次');
			$table->integer('complaint_count')->default(0)->comment('被大B客户投诉次数');
			$table->integer('b_assess_count')->default(0)->comment('大B商户评价过的出车单总数');
			$table->integer('b_score_sum')->default(0)->comment('司机大B业务出车单总评分');
			$table->integer('work_count')->nullable()->default(0)->comment('上岗次数');
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
		Schema::drop('zd_driver_sub');
	}

}
