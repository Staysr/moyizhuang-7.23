<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysDepartmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_department', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 32)->comment('部门名称');
			$table->boolean('status')->default(0)->comment('是否启用');
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
		Schema::drop('sys_department');
	}

}
