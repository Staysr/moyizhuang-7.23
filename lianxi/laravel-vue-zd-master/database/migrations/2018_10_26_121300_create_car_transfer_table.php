<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarTransferTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('car_transfer', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('car_id')->default(0);
			$table->boolean('type')->comment('交接类型（1:出车单;2收车单）');
			$table->char('time', 16)->comment('交接时间');
			$table->string('description')->nullable()->comment('备注');
			$table->integer('master_id')->nullable()->default(0);
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
		Schema::drop('car_transfer');
	}

}
