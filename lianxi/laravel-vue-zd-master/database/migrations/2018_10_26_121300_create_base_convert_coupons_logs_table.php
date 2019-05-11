<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseConvertCouponsLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_convert_coupons_logs', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('client_id')->comment('用户ID：用户表主键ID');
			$table->string('convert_code')->comment('兑换码');
			$table->boolean('call_type')->default(0)->comment('调用类型：0 后台发放; 1 套餐充值; 2 程序调用; 3:口令领取;默认 0');
			$table->integer('category_id')->comment('组织结构code');
			$table->string('category_code', 32)->comment('组织结构code');
			$table->dateTime('create_time')->comment('创建时间');
			$table->dateTime('modify_time')->nullable()->comment('修改时间');
			$table->unique(['client_id','convert_code'], 'client_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_convert_coupons_logs');
	}

}
