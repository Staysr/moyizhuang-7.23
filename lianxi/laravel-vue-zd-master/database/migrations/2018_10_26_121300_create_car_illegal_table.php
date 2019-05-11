<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarIllegalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('car_illegal', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('number', 50)->comment('违章单号');
			$table->dateTime('time')->comment('违章时间');
			$table->integer('car_id')->unsigned();
			$table->integer('driver_id');
			$table->integer('company_id')->unsigned();
			$table->decimal('cost', 10)->default(0.00)->comment('违章罚款');
			$table->integer('score')->unsigned()->default(0)->comment('违章扣分');
			$table->string('address')->nullable()->default('')->comment('违章地点');
			$table->string('description')->nullable()->default('')->comment('违章行为');
			$table->boolean('status')->nullable()->default(0)->comment('违章状态(0未处理; 1已处理)');
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
		Schema::drop('car_illegal');
	}

}
