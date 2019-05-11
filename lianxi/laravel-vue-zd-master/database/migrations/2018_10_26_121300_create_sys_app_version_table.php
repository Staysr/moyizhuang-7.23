<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysAppVersionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_app_version', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->string('version_no', 32)->comment('app版本号');
			$table->integer('app_os')->comment('app手机系统：1 Android；2 IOS；');
			$table->integer('app_type')->comment('app类型：1 货主；2 司机；');
			$table->integer('downloads')->nullable()->comment('app下载次数');
			$table->string('download_url')->comment('app下载链接url');
			$table->string('download_channel', 32)->nullable()->comment('下载通道：如：官网；应用宝；APP Store等 ');
			$table->string('version_desc', 512)->nullable()->comment('版本更新描述信息');
			$table->integer('status')->nullable()->default(1)->comment('状态：0 禁用； 1 可用；默认值 1');
			$table->integer('force_update')->default(0)->comment('0、不强制更新 1、强制更新；默认不强制');
			$table->decimal('package_size', 6, 1)->default(0.0)->comment('app包小大,单位：MB；');
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
		Schema::drop('sys_app_version');
	}

}
