<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysCarSafeNoticeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_car_safe_notice', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('company_id')->comment('所属公司');
			$table->integer('rule')->nullable()->comment('提前多少天通知');
			$table->boolean('is_notice')->default(0)->comment('是否开启通知');
			$table->boolean('notice_driver')->default(0)->comment('是否通知司机');
			$table->string('desc')->nullable()->comment('提醒内容');
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
		Schema::drop('sys_car_safe_notice');
	}

}
