<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseDriverWorkTimeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_driver_work_time', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('自增主键ID');
			$table->integer('driver_id')->comment('司机表主键ID：base_driver_info表id字段');
			$table->dateTime('start_time')->comment('出车时间点');
			$table->dateTime('end_time')->nullable()->comment('收车时间点');
			$table->string('remark')->nullable()->comment('收车原因');
			$table->date('work_date')->comment('工作日期');
			$table->integer('is_push')->default(0)->comment('是否推送：0 否； 1 是；');
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
		Schema::drop('base_driver_work_time');
	}

}
