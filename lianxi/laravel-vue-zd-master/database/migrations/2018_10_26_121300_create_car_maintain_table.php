<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarMaintainTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('car_maintain', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('number', 50)->comment('保养单号');
			$table->decimal('cost', 10)->comment('保养费用 ');
			$table->integer('car_id')->comment('车辆ID');
			$table->integer('driver_id')->comment('司机ID');
			$table->integer('company_id')->comment('外包公司ID');
			$table->date('date')->comment('保养时间');
			$table->integer('mileage')->comment('保养里程');
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
		Schema::drop('car_maintain');
	}

}
