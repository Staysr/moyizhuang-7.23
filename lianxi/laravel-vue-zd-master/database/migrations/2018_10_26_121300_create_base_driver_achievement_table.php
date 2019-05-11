<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseDriverAchievementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_driver_achievement', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('driver_id')->nullable();
			$table->string('category_code', 50)->comment('所属城市 ');
			$table->integer('company_id')->default(0)->comment('司机外包公司');
			$table->integer('supergroup_id')->nullable()->comment('大队ID');
			$table->integer('squad_id')->nullable()->comment('小队长ID');
			$table->date('date')->comment('日期');
			$table->decimal('order_total', 10)->default(0.00)->comment('订单收入');
			$table->decimal('task_order_total', 10)->default(0.00)->comment('出车单收入');
			$table->decimal('total', 10)->nullable()->comment('总收入');
			$table->dateTime('create_time')->nullable();
			$table->dateTime('modify_time')->nullable();
			$table->unique(['driver_id','date'], 'unique_driver_date');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_driver_achievement');
	}

}
