<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseDriverOrderListTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_driver_order_list', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('driver_id')->unique('driver_id_index')->comment('司机ID：司机表主键ID');
			$table->string('order_ids', 2048)->comment('订单ID集合');
			$table->dateTime('create_time')->comment('创建时间');
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
		Schema::drop('base_driver_order_list');
	}

}
