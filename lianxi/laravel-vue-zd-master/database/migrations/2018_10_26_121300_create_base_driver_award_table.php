<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseDriverAwardTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_driver_award', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('driver_id')->nullable()->default(0)->comment('司机ID');
			$table->integer('money')->nullable()->default(0);
			$table->text('remark', 65535)->nullable()->comment('奖惩备注');
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
		Schema::drop('base_driver_award');
	}

}
