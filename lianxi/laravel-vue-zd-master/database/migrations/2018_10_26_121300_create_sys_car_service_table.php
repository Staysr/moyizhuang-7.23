<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysCarServiceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_car_service', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('company_id')->comment('公司ID');
			$table->string('code', 50)->comment('维修单号');
			$table->string('workshop', 100)->comment('维修厂');
			$table->integer('car_id')->nullable()->comment('车辆ID');
			$table->integer('driver_id')->nullable()->comment('司机ID');
			$table->string('date_start', 20)->nullable()->comment('开始时间');
			$table->string('date_end', 20)->nullable()->comment('结束时间');
			$table->decimal('cost', 10, 0)->nullable()->comment('维修费用');
			$table->boolean('status')->nullable()->default(0)->comment('状态：0 未处理 1 已处理');
			$table->text('info', 65535)->nullable()->comment('项目信息');
			$table->text('parts', 65535)->nullable()->comment('配件信息');
			$table->text('desc', 65535)->nullable()->comment('车辆故障说明');
			$table->text('files', 65535)->nullable()->comment('图片');
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
		Schema::drop('sys_car_service');
	}

}
