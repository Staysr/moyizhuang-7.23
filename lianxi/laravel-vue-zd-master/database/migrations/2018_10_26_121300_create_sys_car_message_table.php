<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysCarMessageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_car_message', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('car_user_id')->nullable()->default(0)->comment('车务系统人员ID');
			$table->string('title')->nullable()->comment('消息标题');
			$table->integer('status')->nullable()->default(0)->comment('0 未读，1已读');
			$table->text('content', 65535)->nullable()->comment('消息内容');
			$table->dateTime('create_time')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sys_car_message');
	}

}
