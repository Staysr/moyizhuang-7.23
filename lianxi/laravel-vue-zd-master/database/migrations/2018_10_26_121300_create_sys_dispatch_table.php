<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysDispatchTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_dispatch', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name')->comment('配送城市名称');
			$table->boolean('sort')->nullable()->default(100);
			$table->integer('status')->default(0)->comment('是否开放离线地图下载：0 否； 1 开放；');
			$table->dateTime('create_time')->nullable();
			$table->dateTime('modify_time')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sys_dispatch');
	}

}
