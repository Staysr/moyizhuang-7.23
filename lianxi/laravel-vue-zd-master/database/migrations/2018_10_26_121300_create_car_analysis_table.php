<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarAnalysisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('car_analysis', function(Blueprint $table)
		{
			$table->increments('id');
			$table->date('date')->comment('日期');
			$table->integer('total')->default(0)->comment('车辆总数');
			$table->integer('running')->default(0)->comment('运营车辆总数');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('car_analysis');
	}

}
