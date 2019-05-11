<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCarCompanyMasterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('car_company_master', function(Blueprint $table)
		{
			$table->foreign('company_id', 'group_user_group_id_foreign')->references('id')->on('sys_car_company')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('master_id', 'group_user_user_id_foreign')->references('id')->on('car_master')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('car_company_master', function(Blueprint $table)
		{
			$table->dropForeign('group_user_group_id_foreign');
			$table->dropForeign('group_user_user_id_foreign');
		});
	}

}
