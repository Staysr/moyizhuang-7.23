<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdSysRoleCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_sys_role_category', function(Blueprint $table)
		{
			$table->integer('role_id')->unsigned()->comment('角色ID');
			$table->integer('category_id')->unsigned()->comment('城市ID');
			$table->primary(['role_id','category_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('zd_sys_role_category');
	}

}
