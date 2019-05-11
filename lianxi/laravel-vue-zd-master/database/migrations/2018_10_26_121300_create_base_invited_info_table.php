<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseInvitedInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_invited_info', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('category_id')->comment('所属商圈');
			$table->string('category_code', 32)->nullable()->comment('商圈代码');
			$table->string('name', 32)->comment('地推人员姓名');
			$table->string('my_invite_code', 32)->comment('地推邀请码：现定手机号码');
			$table->integer('code')->default(0)->comment('业务编码');
			$table->boolean('status')->default(1)->comment('状态: 0 禁用 1 启用');
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
		Schema::drop('base_invited_info');
	}

}
