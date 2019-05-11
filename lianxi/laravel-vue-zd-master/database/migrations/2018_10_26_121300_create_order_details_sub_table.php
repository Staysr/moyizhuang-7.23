<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderDetailsSubTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_details_sub', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('order_id')->comment('订单ID： 订单表主键ID');
			$table->integer('safe_fee')->nullable()->default(0)->comment('保险金额');
			$table->string('safe_icon')->nullable()->comment('保险小图标url');
			$table->string('safe_name', 30)->nullable()->comment('保险名称');
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
		Schema::drop('order_details_sub');
	}

}
