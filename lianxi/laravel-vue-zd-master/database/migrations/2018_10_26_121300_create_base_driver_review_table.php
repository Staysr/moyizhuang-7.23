<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseDriverReviewTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_driver_review', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID:32位固定UUID');
			$table->integer('driver_id')->nullable()->comment('司机ID：司机表主键ID');
			$table->string('type_code', 32)->comment('证件类型');
			$table->string('value')->comment('司机值');
			$table->string('remark')->nullable()->comment('备注：如：身份证正面照等');
			$table->dateTime('create_time')->comment('创建时间');
			$table->dateTime('modify_time')->nullable()->comment('修改时间');
			$table->unique(['driver_id','type_code'], 'driver_type_code');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_driver_review');
	}

}
