<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdSysRoleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_sys_role', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 32)->comment('部门名称');
			$table->string('remark')->nullable()->default('')->comment('简单说明');
			$table->boolean('is_admin')->default(0)->comment('是否超级管理员');
			$table->boolean('authority')->nullable()->default(0)->comment('数据权限  0否,1 是 ');
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
		Schema::drop('zd_sys_role');
	}

}
