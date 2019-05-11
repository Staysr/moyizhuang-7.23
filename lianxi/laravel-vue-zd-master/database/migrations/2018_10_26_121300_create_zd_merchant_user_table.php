<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdMerchantUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_merchant_user', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('merchant_id')->default(0)->comment('商户ID');
			$table->char('phone', 11)->default('')->comment('手机号码');
			$table->string('password')->default('0')->comment('所属商圈');
			$table->boolean('status')->nullable()->default(0)->comment('0 禁用 1 启用 2冻结');
			$table->integer('role')->nullable()->default(0)->comment('级别');
			$table->string('device_token')->nullable()->default('')->comment('手机设备Token');
			$table->string('os')->nullable()->default('')->comment('手机操作系统');
			$table->string('os_version')->nullable()->default('')->comment('手机操作系统版本');
			$table->string('model')->nullable()->default('')->comment('手机型号');
			$table->string('app_version')->nullable()->default('')->comment('手机APP版本');
			$table->string('resolution')->nullable()->default('')->comment('手机分辨率');
			$table->dateTime('create_time')->nullable()->comment('创建时间');
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
		Schema::drop('zd_merchant_user');
	}

}
