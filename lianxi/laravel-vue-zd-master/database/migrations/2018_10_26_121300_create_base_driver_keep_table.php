<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseDriverKeepTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_driver_keep', function(Blueprint $table)
		{
			$table->increments('id');
			$table->date('date')->comment('日期');
			$table->string('category_code', 50);
			$table->integer('today')->nullable()->default(0)->comment('今天');
			$table->integer('sub1')->nullable()->default(0)->comment('一天后');
			$table->integer('sub3')->nullable()->default(0)->comment('三天后');
			$table->integer('sub7')->nullable()->default(0)->comment('七天后');
			$table->integer('sub30')->nullable()->default(0)->comment('三十天后');
			$table->unique(['date','category_code'], 'driver_keep');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_driver_keep');
	}

}
