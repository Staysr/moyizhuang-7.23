<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysCarDepartmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_car_department', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('company_id')->nullable()->default(0)->comment('车务公司ID');
			$table->string('name', 32)->comment('部门名称');
			$table->string('remark')->nullable()->default('')->comment('简单说明');
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
		Schema::drop('sys_car_department');
	}

}
