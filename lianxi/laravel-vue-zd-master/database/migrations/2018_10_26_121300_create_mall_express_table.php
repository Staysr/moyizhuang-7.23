<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMallExpressTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mall_express', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('express_name')->default('')->comment('快递公司名称');
			$table->dateTime('create_time')->comment('创建时间');
			$table->dateTime('delete_time')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mall_express');
	}

}
