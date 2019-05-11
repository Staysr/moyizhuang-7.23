<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysCarMaintainRemindTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_car_maintain_remind', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('company_id')->nullable();
			$table->integer('car_style_id')->nullable()->comment('车辆款式');
			$table->integer('max_mileage')->nullable()->comment('保养间隔');
			$table->integer('max_date')->nullable()->comment('保养间隔时间');
			$table->integer('rule')->nullable()->default(0)->comment('提醒天数');
			$table->boolean('is_notice')->nullable()->comment('是否开启通知');
			$table->boolean('notice_driver')->nullable()->comment('是否通知司机');
			$table->string('desc')->nullable()->comment('通知内容');
			$table->dateTime('create_time')->nullable();
			$table->dateTime('modify_time')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sys_car_maintain_remind');
	}

}
