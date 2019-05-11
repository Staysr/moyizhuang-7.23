<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdSysUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_sys_user', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('password')->comment('密码');
			$table->integer('role')->default(0)->comment('角色 ：0为超级管理员，只能有一个超级管理员，并且超级管理员不可禁用');
			$table->boolean('manager')->default(0)->comment('是否部门管理者 0 否 1是');
			$table->string('name')->nullable()->comment('姓名');
			$table->string('phone', 100)->nullable()->comment('电话');
			$table->boolean('sex')->nullable()->default(0)->comment('性别 0 未设 1 男 2女');
			$table->boolean('authority_level')->nullable()->default(0)->comment('0 全部 1 客户顾问 2 运行经理  3 拓展经理  4 品质交互经理');
			$table->string('job_number')->nullable()->default('')->comment('工号');
			$table->string('contact')->nullable()->default('')->comment('联系电话');
			$table->date('birthday')->nullable()->comment('生日');
			$table->boolean('status')->default(1)->comment('用户状态 1 开启 0 关闭');
			$table->string('last_ip')->nullable();
			$table->dateTime('last_time')->nullable()->comment('最后一次登录时间');
			$table->boolean('change_place')->nullable()->default(0)->comment('异地登录 0 否 1 是');
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
		Schema::drop('zd_sys_user');
	}

}
