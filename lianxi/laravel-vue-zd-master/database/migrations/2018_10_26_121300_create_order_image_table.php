<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderImageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_image', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键id');
			$table->integer('order_id')->nullable()->comment('订单ID');
			$table->string('img_url')->nullable()->comment('图片路径');
			$table->integer('img_type')->nullable()->comment('图片类型： 1 货物  2 回单');
			$table->dateTime('create_time')->comment('创建时间');
			$table->dateTime('modify_time')->comment('修改时间：如禁用客户APP时间等');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('order_image');
	}

}
