<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMallReceiptTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mall_receipt', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('client_id')->unique('client_id')->comment('用户表(base_client_info)主键ID');
			$table->string('receipt_name', 20)->comment('收货人姓名');
			$table->string('receipt_phone', 20)->comment('收货人电话');
			$table->string('receipt_address', 50)->comment('收货地址');
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
		Schema::drop('mall_receipt');
	}

}
