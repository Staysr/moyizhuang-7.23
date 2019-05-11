<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysAreaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_area', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('code');
			$table->string('area_name')->nullable();
			$table->string('parent_code')->nullable();
			$table->string('short_name')->nullable();
			$table->string('lng')->nullable();
			$table->string('lat')->nullable();
			$table->integer('level')->nullable();
			$table->string('position')->nullable();
			$table->integer('sort')->nullable();
			$table->index(['id','code','short_name'], 'area');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sys_area');
	}

}
