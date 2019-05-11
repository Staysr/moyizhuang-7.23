<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSysUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sys_user', function(Blueprint $table)
		{
			$table->foreign('department_id', 'sys_user_ibfk_1')->references('id')->on('sys_department')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sys_user', function(Blueprint $table)
		{
			$table->dropForeign('sys_user_ibfk_1');
		});
	}

}
