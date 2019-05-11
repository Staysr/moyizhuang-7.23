<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseClientRouteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_client_route', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('client_id')->nullable()->comment('用户ID：用户表主键ID');
			$table->string('route_name', 64)->nullable()->comment('路径名称');
			$table->string('end_city')->nullable()->comment('目的地城市名称');
			$table->string('end_address')->nullable()->comment('目的地');
			$table->decimal('end_longitude', 10, 7)->nullable()->comment('目的地经度');
			$table->decimal('end_latitude', 10, 7)->nullable()->comment('目的地纬度');
			$table->dateTime('create_time')->nullable()->comment('创建时间');
			$table->dateTime('modify_time')->nullable()->comment('修改时间');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_client_route');
	}

}
