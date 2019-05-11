<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSysDepartmentUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sys_department_user', function(Blueprint $table)
		{
			$table->foreign('user_id', 'sys_department_rule_copy_ibfk_1')->references('id')->on('sys_user')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('rule_id', 'sys_department_rule_copy_ibfk_2')->references('id')->on('sys_rule')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sys_department_user', function(Blueprint $table)
		{
			$table->dropForeign('sys_department_rule_copy_ibfk_1');
			$table->dropForeign('sys_department_rule_copy_ibfk_2');
		});
	}

}
