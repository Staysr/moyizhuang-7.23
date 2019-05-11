<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCarPermissionRoleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('car_permission_role', function(Blueprint $table)
		{
			$table->foreign('permission_id', 'permission_role_permission_id_foreign')->references('id')->on('car_permissions')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('role_id', 'permission_role_role_id_foreign')->references('id')->on('car_roles')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('car_permission_role', function(Blueprint $table)
		{
			$table->dropForeign('permission_role_permission_id_foreign');
			$table->dropForeign('permission_role_role_id_foreign');
		});
	}

}
