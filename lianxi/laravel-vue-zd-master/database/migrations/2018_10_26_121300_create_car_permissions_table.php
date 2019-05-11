<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarPermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('car_permissions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 50)->unique('permissions_name_unique')->comment('权限模块');
			$table->string('display_name')->default('')->comment('名称');
			$table->string('description')->default('');
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
		Schema::drop('car_permissions');
	}

}
