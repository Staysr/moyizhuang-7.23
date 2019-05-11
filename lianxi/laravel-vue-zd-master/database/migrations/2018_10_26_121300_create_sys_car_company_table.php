<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysCarCompanyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_car_company', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100)->comment('外包公司名称');
			$table->string('contacts', 20)->comment('联系人');
			$table->string('contact_way', 100)->comment('联系方式');
			$table->integer('admin_id')->nullable()->default(0);
			$table->integer('status')->nullable()->default(0)->comment('状态（0 禁用 1 正常）');
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
		Schema::drop('sys_car_company');
	}

}
