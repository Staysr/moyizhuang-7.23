<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarMasterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('car_master', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->default('')->comment('名称');
			$table->string('email', 50)->unique('unique_email')->comment('邮箱');
			$table->string('phone')->nullable()->default('')->comment('手机号');
			$table->string('password');
			$table->boolean('status')->default(0)->comment('状态：0关闭 1开启');
			$table->boolean('is_admin')->nullable()->default(0)->comment('是否管理帐号');
			$table->dateTime('last_login_time')->nullable()->comment('最后登录时间');
			$table->string('last_login_ip', 15)->nullable()->comment('最后登录IP');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('car_master');
	}

}
