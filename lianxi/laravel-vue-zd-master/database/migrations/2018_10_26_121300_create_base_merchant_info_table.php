<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseMerchantInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_merchant_info', function(Blueprint $table)
		{
			$table->increments('id')->comment('主键ID');
			$table->integer('client_id')->unique('client_id_unique')->comment('用户ID：用户表主键ID');
			$table->integer('invited_id')->comment('地推人员表主键ID');
			$table->string('name', 50)->comment('合作商家名称');
			$table->string('address')->nullable()->comment('商家地址');
			$table->integer('bank_id')->comment('银行卡开户行ID：sys_bank表的主键ID');
			$table->string('bank_user', 50)->comment('银行卡开户名称');
			$table->string('bank_no', 50)->comment('银行卡号');
			$table->string('bank_img')->comment('银行卡照片url');
			$table->string('business_license')->nullable()->comment('营业执照url');
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
		Schema::drop('base_merchant_info');
	}

}
