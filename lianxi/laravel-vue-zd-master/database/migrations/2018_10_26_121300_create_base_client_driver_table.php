<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseClientDriverTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_client_driver', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('driver_id')->comment('司机ID：司机表主键ID');
			$table->integer('client_id')->comment('用户ID：用户表主键ID');
			$table->dateTime('create_time')->comment('创建时间');
			$table->dateTime('modify_time')->nullable()->comment('修改时间');
			$table->unique(['driver_id','client_id'], 'driver_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_client_driver');
	}

}
