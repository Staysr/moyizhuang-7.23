<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseMessageLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_message_log', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('自增主键');
			$table->integer('message_id')->nullable()->comment('消息中心表主键ID：base_message表主键id');
			$table->integer('user_id')->default(0)->comment('司机或货主的ID');
			$table->integer('user_type')->nullable()->comment('人员类别');
			$table->text('message', 65535)->nullable()->comment('信息内容');
			$table->integer('status')->nullable()->comment('状态 0 不可见 1 可见');
			$table->dateTime('create_time')->nullable();
			$table->dateTime('modify_time')->nullable()->comment('更改时间');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_message_log');
	}

}
