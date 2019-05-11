<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('car_images', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('path', 200)->comment('图片地址');
			$table->integer('foreign_id')->comment('模型关联主键');
			$table->string('foreign_type', 200)->comment('数据模型');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('car_images');
	}

}
