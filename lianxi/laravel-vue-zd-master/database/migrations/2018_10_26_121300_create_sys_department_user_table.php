<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysDepartmentUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_department_user', function(Blueprint $table)
		{
			$table->integer('rule_id')->index('role_rule_rule_id');
			$table->integer('user_id')->comment('用户ID');
			$table->unique(['user_id','rule_id'], 'fu');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sys_department_user');
	}

}
