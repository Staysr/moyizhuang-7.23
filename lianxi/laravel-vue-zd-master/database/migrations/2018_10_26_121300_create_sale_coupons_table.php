<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSaleCouponsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sale_coupons', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('category_id')->comment('组织结构code');
			$table->string('category_code', 32)->comment('组织结构code');
			$table->integer('car_type_id')->default(0)->comment('车辆类型：sys_car_type表的主键ID； 0表示所有车型通用；');
			$table->boolean('call_type')->default(0)->comment('调用类型：0 后台发放; 1 套餐充值; 2 程序调用; 默认 0');
			$table->string('call_code', 32)->nullable()->default('')->comment('调用代码:只有在call_type = 2 时 call_code才生效;');
			$table->string('name', 64)->nullable()->comment('优惠券名称');
			$table->decimal('coupons_value', 10)->nullable()->comment('优惠额度：单位元；如果是折扣券，75则表示7.5折(75/100=0.75)');
			$table->integer('type')->nullable()->comment('优惠券类型：1 现金券；2 折扣券；');
			$table->decimal('max_fee', 11)->nullable()->comment('最高抵扣金额：单位 元');
			$table->integer('valid_days')->nullable()->comment('有效期：单位天；0 表示永久有效；');
			$table->integer('status')->default(1)->comment('状态：0 删除；1：有效；');
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
		Schema::drop('sale_coupons');
	}

}
