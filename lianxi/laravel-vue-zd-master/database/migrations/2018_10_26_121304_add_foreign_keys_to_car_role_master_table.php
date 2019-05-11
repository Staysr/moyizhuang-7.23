<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCarRoleMasterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('car_role_master', function(Blueprint $table)
		{
			$table->foreign('role_id', 'role_user_role_id_foreign')->references('id')->on('car_roles')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('master_id', 'role_user_user_id_foreign')->references('id')->on('car_master')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('car_role_master', function(Blueprint $table)
		{
			$table->dropForeign('role_user_role_id_foreign');
			$table->dropForeign('role_user_user_id_foreign');
		});
	}

}
