<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysCarRuleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_car_rule', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('parent_id')->default(0)->comment('父菜单');
			$table->string('name', 100)->unique('rulename')->comment('url地址 c+a');
			$table->string('title', 100)->comment('菜单名称');
			$table->boolean('islink')->default(0)->comment('是否菜单');
			$table->boolean('isadmin')->default(0)->comment('是否管理员才有的权限 0 不是 1 是');
			$table->integer('sort')->default(255)->comment('排序');
			$table->boolean('level')->nullable()->comment('级别');
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
		Schema::drop('sys_car_rule');
	}

}
