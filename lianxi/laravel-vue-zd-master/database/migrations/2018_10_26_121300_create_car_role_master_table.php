<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarRoleMasterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('car_role_master', function(Blueprint $table)
		{
			$table->integer('master_id')->unsigned();
			$table->integer('role_id')->unsigned()->index('role_user_role_id_foreign');
			$table->primary(['master_id','role_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('car_role_master');
	}

}
