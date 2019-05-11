<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToZdUserRuleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('zd_user_rule', function(Blueprint $table)
		{
			$table->foreign('role_id', 'user_role_rule_ca')->references('role_id')->on('zd_sys_role_rule1')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('zd_user_rule', function(Blueprint $table)
		{
			$table->dropForeign('user_role_rule_ca');
		});
	}

}
