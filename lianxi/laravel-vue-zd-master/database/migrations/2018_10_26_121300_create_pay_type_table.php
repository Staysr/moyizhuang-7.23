<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePayTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pay_type', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID:32位固定UUID');
			$table->string('pay_code', 16)->comment('支付方式编码：如：wx 微信；');
			$table->string('pay_name', 32)->comment('支付名称：如：支付宝支付；微信支付');
			$table->string('pay_desc', 32)->nullable()->comment('支付方式描述');
			$table->integer('is_enable')->comment('支付方式是否可用：0 不可用；1 可用；');
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
		Schema::drop('pay_type');
	}

}
