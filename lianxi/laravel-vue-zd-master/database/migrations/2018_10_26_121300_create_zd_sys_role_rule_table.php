<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdSysRoleRuleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_sys_role_rule', function(Blueprint $table)
		{
			$table->integer('role_id');
			$table->integer('rule_id');
			$table->primary(['role_id','rule_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('zd_sys_role_rule');
	}

}
