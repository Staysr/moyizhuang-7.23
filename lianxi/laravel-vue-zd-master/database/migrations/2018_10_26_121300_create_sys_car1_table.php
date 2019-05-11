<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysCar1Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_car1', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('company_id');
			$table->integer('car_style_id')->comment('车辆款式');
			$table->integer('driver_id')->nullable()->default(0)->comment('司机ID');
			$table->string('number', 20)->comment('车牌号码');
			$table->integer('mileage')->default(0)->comment('车辆里程');
			$table->string('carframe', 50)->nullable()->comment('车架号');
			$table->string('engine', 50)->nullable()->comment('发动机号');
			$table->string('charging_clip', 50)->nullable()->comment('充电卡卡号');
			$table->string('archives', 50)->nullable()->comment('档案编号');
			$table->date('collect_car_date')->nullable()->comment('收车日期');
			$table->boolean('is_peccancy')->nullable()->default(0)->comment('是否有违章未处理 0 无 1 有');
			$table->boolean('is_service')->nullable()->default(0)->comment('是否有未处理的维修 0 无 1 有');
			$table->boolean('is_safe')->nullable()->default(1)->comment('是否在保 0:否 1 是');
			$table->string('parts')->nullable()->comment('车辆配件');
			$table->text('files', 65535)->nullable()->comment('车辆文件');
			$table->integer('last_maintain_mileage')->nullable()->default(0)->comment('最后一次保养里程');
			$table->date('last_maintain_date')->nullable()->comment('最后保养时间');
			$table->boolean('identity_type')->nullable()->default(0)->comment('是否大小B: 0 小B; 1 大B;');
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
		Schema::drop('sys_car1');
	}

}
