<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarMaintainNoticeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('car_maintain_notice', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('car_type_id')->comment('车辆型号');
			$table->integer('car_style_id')->comment('车辆款式');
			$table->integer('mileage')->comment('间隔里程 ');
			$table->integer('day')->comment('间隔时间');
			$table->integer('advance')->comment('提前天数');
			$table->boolean('notice_status')->comment('是否开启通知: 0 关闭; 1 开启');
			$table->boolean('driver_notice_status')->default(0)->comment('是否通知司机: 0 关闭; 1 开启');
			$table->string('description')->nullable()->comment('通知内容');
			$table->timestamps();
			$table->unique(['car_type_id','car_style_id'], 'Unique_type_style');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('car_maintain_notice');
	}

}
