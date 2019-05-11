<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseDriverReviewTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_driver_review_type', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('code', 32)->nullable();
			$table->string('name', 50)->comment('司机审核证件类型名称');
			$table->string('input_type', 10)->default('input')->comment('输出框 input 图片上传 image');
			$table->string('default')->nullable()->comment('默认值');
			$table->string('remark')->nullable()->comment('备注');
			$table->integer('sort')->default(255)->comment('排序');
			$table->boolean('require')->default(0)->comment('是否必填 0否 1是');
			$table->boolean('status')->default(0)->comment('状态: 0 否 1 是');
			$table->dateTime('create_time')->nullable();
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
		Schema::drop('base_driver_review_type');
	}

}
