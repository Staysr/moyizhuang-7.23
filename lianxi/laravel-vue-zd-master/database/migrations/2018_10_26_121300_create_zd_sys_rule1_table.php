<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdSysRule1Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_sys_rule1', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('parent_id')->default(0)->comment('父菜单');
			$table->string('name', 100)->unique('rulename')->comment('url地址 c+a');
			$table->string('title', 100)->comment('菜单名称');
			$table->boolean('islink')->default(0)->comment('是否菜单');
			$table->string('icon', 100)->nullable()->comment('图标');
			$table->integer('sort')->default(255)->comment('排序');
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
		Schema::drop('zd_sys_rule1');
	}

}
