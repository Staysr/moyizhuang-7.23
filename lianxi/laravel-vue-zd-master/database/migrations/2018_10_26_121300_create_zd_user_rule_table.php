<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdUserRuleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_user_rule', function(Blueprint $table)
		{
			$table->integer('user_id');
			$table->integer('role_id');
			$table->integer('rule_id');
			$table->primary(['user_id','rule_id']);
			$table->index(['role_id','rule_id'], 'user_role_rule_ca');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('zd_user_rule');
	}

}
