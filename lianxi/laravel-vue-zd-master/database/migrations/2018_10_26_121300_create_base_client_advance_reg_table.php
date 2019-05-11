<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseClientAdvanceRegTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_client_advance_reg', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('phone', 20)->unique('phone')->comment('用户手机号：也作为账户名');
			$table->integer('reg_source')->default(0)->comment('注册来源：4：订单分享领券；5：货主二维码邀请；6：司机二维码邀请；');
			$table->integer('source_foreign_id')->default(0)->comment('来源对象ID: 如订单ID；用户ID;');
			$table->integer('client_id')->nullable()->comment('用户ID');
			$table->integer('is_has_register')->default(0)->comment('是否已注册');
			$table->integer('is_cooperate')->default(0)->comment('是否合作后推荐；0 否；1 是；');
			$table->dateTime('create_time')->comment('创建时间');
			$table->dateTime('modify_time')->comment('修改时间：如禁用客户APP时间等');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_client_advance_reg');
	}

}
