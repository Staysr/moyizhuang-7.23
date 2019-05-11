<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysCarUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_car_user', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('company_id')->default(0)->comment('车务公司ID');
			$table->string('email')->comment('登录邮箱');
			$table->string('password')->comment('密码');
			$table->integer('role')->default(0)->comment('角色 （0为超级管理员，只有运营后台可以创建！）');
			$table->string('username')->nullable()->comment('姓名');
			$table->string('phone', 100)->nullable()->comment('电话');
			$table->boolean('status')->default(1)->comment('用户状态 1 开启 0 关闭');
			$table->string('last_login_ip')->nullable();
			$table->dateTime('last_login_time')->nullable()->comment('最后一次登录时间');
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
		Schema::drop('sys_car_user');
	}

}
