<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysStatusCodeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_status_code', function(Blueprint $table)
		{
			$table->char('id', 32)->primary()->comment('主键ID:32位固定UUID');
			$table->string('type', 32)->nullable()->comment('状态类型');
			$table->string('key', 64)->nullable()->comment('状态码键');
			$table->string('value', 64)->nullable()->comment('状态码值');
			$table->string('remark', 128)->nullable()->comment('备注');
			$table->char('creator', 32)->nullable()->comment('创建者');
			$table->dateTime('create_time')->nullable()->comment('创建时间');
			$table->char('modifier', 32)->nullable()->comment('修改者');
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
		Schema::drop('sys_status_code');
	}

}
