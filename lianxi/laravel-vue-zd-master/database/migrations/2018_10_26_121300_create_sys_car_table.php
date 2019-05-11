<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysCarTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_car', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('number', 12)->unique('unique_number')->comment('车牌号码');
			$table->string('carframe', 50)->comment('车架号');
			$table->string('engine', 50)->comment('发动机号');
			$table->string('archives', 50)->nullable()->comment('档案编号');
			$table->string('charging_clip', 50)->nullable()->comment('充电卡卡号');
			$table->integer('mileage')->default(0)->comment('车辆里程');
			$table->date('collect_date')->nullable()->comment('收车日期');
			$table->string('parts')->nullable()->comment('配件（逗号隔开）');
			$table->boolean('identify_type')->default(0)->comment('0 小B; 1 大B;');
			$table->integer('operate_type')->default(0)->comment('0 非运营车辆 1 货运车辆');
			$table->integer('company_id')->default(0)->comment('外包公司');
			$table->integer('driver_id')->default(0)->comment('司机ID');
			$table->integer('car_style_id')->comment('车辆款式');
			$table->integer('car_type_id')->comment('车辆型号');
			$table->integer('maintain_id')->default(0)->comment('保养车辆ID');
			$table->integer('unscientific_id')->default(0)->comment('交强险ID');
			$table->integer('commercial_id')->default(0)->comment('商业险ID');
			$table->integer('carship_id')->default(0)->comment('车船税ID');
			$table->boolean('maintain_status')->nullable()->default(0)->comment('保养状态');
			$table->boolean('repair_status')->default(0)->comment('车辆维修状态：0 正常；1 维修中');
			$table->boolean('operate_status')->default(0)->comment('运营状态：0 运营 1:考试用车,2:扣车,3:管理用车,4:缺证件,5:待退车,6:特殊情况非运营');
			$table->boolean('operate_property')->nullable()->default(0)->comment('运营性质：0：营运；1：非营运');
			$table->timestamps();
			$table->date('operated_at')->nullable()->comment('修改为非运营车辆时间');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sys_car');
	}

}
