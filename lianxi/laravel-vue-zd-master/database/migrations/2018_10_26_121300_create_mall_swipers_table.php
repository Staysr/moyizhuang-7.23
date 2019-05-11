<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMallSwipersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mall_swipers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('title')->comment('轮播图标题');
			$table->string('pic')->nullable()->comment('图片地址');
			$table->boolean('sort')->nullable()->comment('排序');
			$table->dateTime('create_date')->nullable();
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
		Schema::drop('mall_swipers');
	}

}
