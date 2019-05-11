<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdSysUserDriverTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_sys_user_driver', function(Blueprint $table)
		{
			$table->integer('user_id')->comment('舟到后台用户ID');
			$table->integer('driver_id')->comment('司机ID');
			$table->primary(['user_id','driver_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('zd_sys_user_driver');
	}

}
