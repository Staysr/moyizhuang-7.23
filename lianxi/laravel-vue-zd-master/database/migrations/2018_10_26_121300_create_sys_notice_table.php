<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysNoticeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_notice', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('category_id')->default(0)->comment('公告所属城市ID：0 表示全国；');
			$table->string('category_code', 32)->nullable()->default('')->comment('组织结构code');
			$table->integer('user_type')->default(0)->comment('用户类型：0 所有； 1 司机；2 货主；');
			$table->string('title', 50)->comment('公告标题');
			$table->text('content', 65535)->nullable()->comment('文本公告内容');
			$table->string('url')->nullable()->comment('图文公告url链接');
			$table->integer('type')->default(0)->comment('公告类型：0 文本公告； 1 图文公告；');
			$table->boolean('status')->default(1)->comment('状态：0：隐藏；1：显示；');
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
		Schema::drop('sys_notice');
	}

}
