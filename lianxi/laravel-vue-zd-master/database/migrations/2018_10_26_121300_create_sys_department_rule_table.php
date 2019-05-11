<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysDepartmentRuleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_department_rule', function(Blueprint $table)
		{
			$table->integer('department_id');
			$table->integer('rule_id')->index('role_rule_rule_id');
			$table->unique(['department_id','rule_id'], 'fu');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sys_department_rule');
	}

}
