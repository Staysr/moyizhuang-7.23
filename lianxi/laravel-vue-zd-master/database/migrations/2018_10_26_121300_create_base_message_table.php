<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseMessageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_message', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('自增主键');
			$table->text('message', 65535)->nullable()->comment('消息内容');
			$table->integer('message_type')->nullable()->comment('信息发送类型   1系统消息  2 自定义消息');
			$table->integer('user_type')->comment('用户类型：1 司机；2 货主；3 所有');
			$table->integer('status')->nullable()->comment('是否发送');
			$table->text('category_id', 65535)->nullable()->comment('地区ID');
			$table->text('phone', 65535)->nullable()->comment('要发送的手机号');
			$table->dateTime('send_time')->nullable()->comment('推送发送时间');
			$table->dateTime('create_time')->nullable()->comment('实际发送时间');
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
		Schema::drop('base_message');
	}

}
