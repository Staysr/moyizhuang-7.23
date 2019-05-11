<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_category', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('parent_id')->default(0);
			$table->string('name', 64)->comment('组织名称');
			$table->string('code', 32)->comment('组织代码 前2位国 前5位省 前9位市 前12位区 前14位商圈 前16位车队');
			$table->boolean('level')->default(0)->comment('组织级别 1 全国 2 省 3 市 4 区 5 商圈 6 车队');
			$table->boolean('status')->default(0)->comment('状态 0 关闭 1开启');
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
		Schema::drop('sys_category');
	}

}
