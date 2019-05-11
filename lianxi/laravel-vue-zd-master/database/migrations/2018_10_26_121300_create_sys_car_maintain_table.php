<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysCarMaintainTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_car_maintain', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('company_id')->nullable()->comment('外包公司');
			$table->string('title', 50)->nullable()->comment('保养项目');
			$table->string('code', 50)->nullable()->comment('保养单号');
			$table->decimal('cost', 10)->nullable()->comment('保养费用');
			$table->integer('car_id')->nullable();
			$table->integer('driver_id')->nullable();
			$table->date('date')->nullable()->comment('保养时间');
			$table->string('desc')->nullable()->comment('保养说明');
			$table->integer('mileage')->nullable()->comment('保养里程');
			$table->text('files', 65535)->nullable()->comment('文件');
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
		Schema::drop('sys_car_maintain');
	}

}
