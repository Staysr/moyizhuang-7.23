<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarRepairTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('car_repair', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('company_id')->unsigned()->default(0)->comment('公司ID');
			$table->integer('car_id')->nullable()->comment('车辆ID');
			$table->integer('driver_id')->nullable()->comment('司机ID');
			$table->string('code', 50)->comment('维修单号');
			$table->string('workshop', 100)->comment('维修厂');
			$table->string('start_date', 20)->nullable()->comment('开始时间');
			$table->string('end_date', 20)->nullable()->comment('结束时间');
			$table->decimal('cost', 10)->unsigned()->nullable()->comment('维修费用');
			$table->boolean('status')->nullable()->default(0)->comment('状态：0 未处理 1 已处理');
			$table->text('info', 65535)->nullable()->comment('项目信息');
			$table->text('parts', 65535)->nullable()->comment('配件信息');
			$table->text('description', 65535)->nullable()->comment('车辆故障说明');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('car_repair');
	}

}
