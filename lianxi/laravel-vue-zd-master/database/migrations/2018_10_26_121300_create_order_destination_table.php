<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderDestinationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_destination', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID:32位固定UUID');
			$table->integer('order_id')->comment('订单ID：订单表主键ID');
			$table->string('address', 64)->comment('联系人手机号');
			$table->string('phone')->nullable()->comment('途经点地址');
			$table->decimal('longitude', 10, 7)->comment('起始地址经度');
			$table->decimal('latitude', 10, 7)->comment('起始地址纬度');
			$table->boolean('sort')->comment('排序');
			$table->integer('status')->default(1)->comment('状态： 0 未确认；1 已确认；默认是 1');
			$table->dateTime('create_time')->comment('创建时间');
			$table->dateTime('modify_time')->comment('修改时间');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('order_destination');
	}

}
