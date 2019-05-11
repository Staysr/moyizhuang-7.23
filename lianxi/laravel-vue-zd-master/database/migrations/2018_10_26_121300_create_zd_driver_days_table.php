<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdDriverDaysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_driver_days', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('driver_id')->nullable()->default(0)->comment('司机ID');
			$table->date('finish_date')->nullable()->comment('配送日期');
			$table->integer('times')->nullable()->default(0)->comment('配送完成次数');
			$table->dateTime('create_time')->nullable();
			$table->dateTime('modify_time')->nullable();
			$table->unique(['driver_id','finish_date'], 'driver_id_finish_date');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('zd_driver_days');
	}

}
