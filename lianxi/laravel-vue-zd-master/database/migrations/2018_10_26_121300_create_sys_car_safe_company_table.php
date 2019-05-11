<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysCarSafeCompanyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_car_safe_company', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 200)->comment('保险公司名称');
			$table->integer('company_id')->comment('所属公司');
			$table->string('desc')->nullable()->comment('说明');
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
		Schema::drop('sys_car_safe_company');
	}

}
