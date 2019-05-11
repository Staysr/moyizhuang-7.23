<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysCarStyleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_car_style', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('car_type_id')->comment('车型ID');
			$table->string('model', 20)->comment('车型型号');
			$table->string('style', 20)->comment('车辆款式');
			$table->float('endurance_mileage', 10, 3)->nullable()->default(0.000)->comment('续航里程(Km)');
			$table->integer('endurance_time')->nullable()->comment('续航时间(分钟)');
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
		Schema::drop('sys_car_style');
	}

}
