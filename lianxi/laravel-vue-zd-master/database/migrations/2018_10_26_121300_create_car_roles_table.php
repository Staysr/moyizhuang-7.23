<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('car_roles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 50)->default('')->unique('roles_name_unique')->comment('角色名称');
			$table->string('description')->nullable()->default('');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('car_roles');
	}

}
