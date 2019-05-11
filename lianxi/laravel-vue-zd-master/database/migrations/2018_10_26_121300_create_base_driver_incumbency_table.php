<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseDriverIncumbencyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_driver_incumbency', function(Blueprint $table)
		{
			$table->increments('id');
			$table->date('date')->comment('日期');
			$table->integer('driver_id')->comment('司机ID');
			$table->string('supervisors', 20)->nullable()->comment('上级关系');
			$table->boolean('driver_type')->comment('司机类型');
			$table->string('category_code', 30)->comment('商圈代码');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_driver_incumbency');
	}

}
