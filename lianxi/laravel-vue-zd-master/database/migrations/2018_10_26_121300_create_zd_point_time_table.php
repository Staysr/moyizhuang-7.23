<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdPointTimeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_point_time', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('warehouse_id')->comment('仓库ID');
			$table->date('arrival_warehouse_day')->comment('到仓天数');
			$table->time('arrival_warehouse_time')->comment('到仓时间');
			$table->integer('total_count')->nullable()->default(0)->comment('导入个数');
			$table->integer('exception_count')->nullable()->default(0)->comment('地址异常数目');
			$table->integer('plan_count')->nullable()->default(0)->comment('已排线数目');
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
		Schema::drop('zd_point_time');
	}

}
