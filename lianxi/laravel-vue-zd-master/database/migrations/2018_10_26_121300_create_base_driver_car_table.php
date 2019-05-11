<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseDriverCarTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_driver_car', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('driver_id')->nullable()->comment('司机ID：司机表主键ID');
			$table->string('car_number', 20)->nullable()->comment('司机当前车牌号');
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
		Schema::drop('base_driver_car');
	}

}
