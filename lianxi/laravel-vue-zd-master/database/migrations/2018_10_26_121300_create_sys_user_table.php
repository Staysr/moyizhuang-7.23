<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_user', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 32)->comment('用户姓名');
			$table->string('email', 100)->unique('email')->comment('用户邮件地址');
			$table->string('password', 64)->comment('用户密码');
			$table->string('job_code', 64)->comment('工号');
			$table->integer('category_id');
			$table->string('category_code', 32);
			$table->integer('department_id')->index('user_department_id')->comment('用户部门');
			$table->boolean('status')->comment('是否启用');
			$table->boolean('is_admin')->default(0);
			$table->boolean('sex')->nullable()->default(0)->comment('0：保密 1：男 2：女');
			$table->string('head', 150)->nullable();
			$table->string('birthday', 20)->nullable()->default('1000-01-01')->comment('生日');
			$table->string('mobile', 20)->nullable()->comment('手机号码');
			$table->string('tel', 20)->nullable()->default('')->comment('电话号码');
			$table->dateTime('create_time')->comment('创建时间');
			$table->dateTime('modify_time')->comment('更新时间');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sys_user');
	}

}
