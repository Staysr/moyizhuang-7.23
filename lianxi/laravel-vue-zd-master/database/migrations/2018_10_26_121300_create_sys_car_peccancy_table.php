<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysCarPeccancyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_car_peccancy', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('company_id')->comment('所属公司');
			$table->string('code', 50)->comment('违章单号');
			$table->dateTime('date')->comment('违章时间');
			$table->integer('car_id');
			$table->integer('driver_id');
			$table->string('address')->nullable();
			$table->integer('deducting')->nullable()->comment('违章扣分 ');
			$table->decimal('fine', 10)->nullable()->comment('违章罚款');
			$table->boolean('status')->default(1)->comment('状态：0  未处理 1 处理');
			$table->text('files', 65535)->nullable();
			$table->text('desc', 65535)->nullable()->comment('违章行为');
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
		Schema::drop('sys_car_peccancy');
	}

}
