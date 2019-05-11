<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdTaskDriverChooseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_task_driver_choose', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('task_id')->default(0)->comment('任务ID');
			$table->integer('driver_id')->default(0)->comment('司机ID');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('zd_task_driver_choose');
	}

}
