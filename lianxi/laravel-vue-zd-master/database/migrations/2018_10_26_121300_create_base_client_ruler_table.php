<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseClientRulerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_client_ruler', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('等级ID');
			$table->string('level_name', 50)->comment('等级名称');
			$table->integer('start_growth')->comment('成长值开始区间');
			$table->integer('end_growth')->comment('成长值结束区间');
			$table->decimal('growth_speed', 10, 1)->comment('碳币积累增速');
			$table->integer('connect_driver_count')->comment('收藏司机个数');
			$table->dateTime('create_time')->nullable()->comment('创建时间');
			$table->dateTime('modify_time')->nullable()->comment('修改时间');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_client_ruler');
	}

}
