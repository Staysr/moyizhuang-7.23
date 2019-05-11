<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdTaskChooseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_task_choose', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('driver_id')->nullable()->default(0);
			$table->integer('task_id')->nullable()->default(0)->unique('task_unique');
			$table->date('start_date')->comment('开始时间');
			$table->date('end_date')->nullable()->comment('结束时间');
			$table->string('week')->nullable()->comment('每周日期');
			$table->integer('start_time')->comment('开始时间');
			$table->integer('end_time')->nullable()->comment('结束时间');
			$table->time('arrival_warehouse_time')->comment('到仓时间：格式：08:30');
			$table->time('estimate_time')->comment('预计完成时间：格式：09:30');
			$table->dateTime('create_time')->comment('创建时间');
			$table->dateTime('modify_time')->nullable()->comment('修改时间');
			$table->index(['driver_id','task_id'], 'task_choose');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('zd_task_choose');
	}

}
