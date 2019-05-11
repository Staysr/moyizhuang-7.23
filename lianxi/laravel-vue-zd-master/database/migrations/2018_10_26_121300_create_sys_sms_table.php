<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysSmsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_sms', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->char('mobile', 11)->comment('手机号码');
			$table->string('contents')->nullable()->comment('短信内容');
			$table->boolean('status')->nullable()->default(0)->comment('状态(0=未发送,1=已发送)');
			$table->string('remark', 32)->nullable()->comment('备注');
			$table->integer('type')->nullable()->comment('类型  1：注册验证码 2：找回登录密码 3：找回支付密码 4：微信公众号登录 5：推荐司机 6：微信小程序登录');
			$table->dateTime('create_time')->comment('创建时间');
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
		Schema::drop('sys_sms');
	}

}
