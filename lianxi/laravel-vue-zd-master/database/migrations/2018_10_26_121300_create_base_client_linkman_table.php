<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseClientLinkmanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_client_linkman', function(Blueprint $table)
		{
			$table->increments('id')->comment('client_id	int	11	0	0	0	0	0	0	0	0	用户ID：用户表主键ID				0	0');
			$table->integer('client_id')->default(0)->comment('用户ID：用户表主键ID');
			$table->string('phone', 20)->comment('用户手机号：也作为账户名');
			$table->string('name', 50)->nullable()->comment('用户名');
			$table->integer('is_main')->default(0)->comment('是否设置为主联系人：0 否； 1 是；');
			$table->dateTime('create_time')->comment('创建时间');
			$table->dateTime('modify_time')->nullable()->comment('修改时间：如禁用客户APP时间等');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_client_linkman');
	}

}
