<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdTaskBrowseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_task_browse', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('task_id')->comment('线路任务表主键ID');
			$table->integer('driver_id')->comment('司机表主键ID');
			$table->integer('browse_count')->default(0)->comment('浏览次数：一个司机浏览一个任务几次');
			$table->dateTime('create_time')->comment('创建时间');
			$table->dateTime('modify_time')->nullable()->comment('修改时间');
			$table->unique(['task_id','driver_id'], 'taskId_driverId_index');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('zd_task_browse');
	}

}
