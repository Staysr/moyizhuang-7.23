<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysCarMileageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_car_mileage', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('driver_id')->default(0)->comment('司机ID');
			$table->integer('car_id')->nullable()->comment('车辆表主键ID：sys_car表主键ID');
			$table->string('car_number', 20)->nullable()->comment('车牌号');
			$table->decimal('mileage', 6, 0)->default(0)->comment('车辆里程');
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
		Schema::drop('sys_car_mileage');
	}

}
