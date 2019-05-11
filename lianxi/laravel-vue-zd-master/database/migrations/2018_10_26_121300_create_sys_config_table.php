<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysConfigTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_config', function(Blueprint $table)
		{
			$table->char('id', 32)->primary()->comment('主键ID:32位固定UUID');
			$table->string('name', 32)->nullable()->comment('参数名称');
			$table->string('value', 1024)->nullable()->comment('参数值');
			$table->string('remark', 128)->nullable()->comment('备注');
			$table->char('type', 2)->nullable()->comment('类型：0 公共的；1 web后台；2 APP');
			$table->char('creator', 32)->nullable()->comment('创建者');
			$table->dateTime('create_time')->comment('创建时间');
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
		Schema::drop('sys_config');
	}

}
