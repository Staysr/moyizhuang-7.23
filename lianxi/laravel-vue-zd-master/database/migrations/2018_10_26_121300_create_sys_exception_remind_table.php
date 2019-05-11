<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysExceptionRemindTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_exception_remind', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('自增主键');
			$table->integer('category_id')->default(0)->comment('所属城市ID');
			$table->string('category_code', 32)->nullable()->comment('所属城市Code');
			$table->integer('is_send_captain')->default(0)->comment('是否发送消息给所属小队长：0 否； 1 是；');
			$table->integer('is_send_specify')->default(0)->comment('是否发送指定的手机号码：0 否； 1 是；');
			$table->string('phones')->nullable()->comment('指定发送人的手机号码：多个用半角逗号隔开');
			$table->integer('status')->default(1)->comment('状态：0 禁用； 1 启用；');
			$table->integer('is_send_sms')->default(0)->comment('是否发送短信：0 否； 1 是；');
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
		Schema::drop('sys_exception_remind');
	}

}
