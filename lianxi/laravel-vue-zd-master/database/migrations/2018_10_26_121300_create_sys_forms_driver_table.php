<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysFormsDriverTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_forms_driver', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->date('date');
			$table->integer('driver_id')->comment('司机');
			$table->string('name', 20)->comment('姓名');
			$table->string('phone', 20)->comment('手机');
			$table->integer('category_id')->default(1)->comment('所属商圈');
			$table->string('category_code', 32)->default('1')->comment('商圈权限');
			$table->integer('growth')->default(0)->comment('发展用户数量:司机所发展的用户，有多少用户完成首次订单，这个完成订单的概念为完成付款；');
			$table->integer('growth_once')->default(0)->comment('发展用户首单量');
			$table->integer('order')->default(0)->comment('营运订单总数：司机派单+抢单的订单总数，包括所有的状态；');
			$table->decimal('income', 10)->comment('营运总金额：营运的总金额包括司机完成行程和已付款两个状态都计入；');
			$table->decimal('mileage', 10)->default(0.00)->comment('营运总里程：营运的总里程包括司机完成行程和已付款两个状态都计入，数据取每个订单的“预估里程”；');
			$table->integer('order_end')->default(0)->comment('完成订单数：司机完成的订单数包括司机完成行程和已付款这两个状态都计入；');
			$table->integer('client_cancel')->default(0)->comment('客户取消订单数');
			$table->integer('operation_cancel')->default(0)->comment('运营取消');
			$table->integer('delivery_end')->default(0)->comment('接货超时次数');
			$table->integer('pay_end')->default(0)->comment('送货超时次数');
			$table->integer('complaint');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sys_forms_driver');
	}

}
