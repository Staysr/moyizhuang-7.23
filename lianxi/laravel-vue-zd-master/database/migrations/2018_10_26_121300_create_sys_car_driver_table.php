<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysCarDriverTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_car_driver', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('car_id')->comment('车辆ID');
			$table->integer('driver_id')->comment('司机ID');
			$table->boolean('status')->default(1)->comment('是否有效：0 解绑 1 绑定');
			$table->boolean('is_admin')->nullable()->comment('是否负责人');
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
		Schema::drop('sys_car_driver');
	}

}
