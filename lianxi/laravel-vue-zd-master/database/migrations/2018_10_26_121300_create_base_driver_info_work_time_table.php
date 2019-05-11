<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseDriverInfoWorkTimeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_driver_info_work_time', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->date('work_date')->comment('时间');
			$table->integer('driver_id')->comment('司机id');
			$table->integer('company_id')->nullable();
			$table->string('category_code', 32);
			$table->string('driver_name', 20)->comment('司机姓名');
			$table->string('driver_phone', 20);
			$table->string('driver_supervisors', 20)->default('')->comment('上级关系');
			$table->string('driver_supervisor_name')->default('-')->comment('司机姓名');
			$table->integer('work_time')->default(0);
			$table->integer('valid_work_time')->default(0);
			$table->unique(['driver_id','work_date'], 'driver_work_date');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_driver_info_work_time');
	}

}
