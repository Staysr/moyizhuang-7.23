<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseDriverCarStickerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_driver_car_sticker', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('driver_id')->comment('司机ID：司机表主键ID');
			$table->integer('sticker_rule_id')->comment('车贴规则ID：车贴规则表主键ID');
			$table->string('car_front_img')->comment('车辆正面照url');
			$table->string('car_side_img')->comment('车辆侧面照url');
			$table->string('reference', 20)->nullable()->comment('参照物');
			$table->decimal('reward_fee')->nullable()->default(0.00)->comment('奖励金额：单位元');
			$table->boolean('status')->default(0)->comment('状态：0：待审核；1：审核通过；2：审核不通过；默认值0');
			$table->dateTime('create_time')->nullable()->comment('创建时间：上传时间');
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
		Schema::drop('base_driver_car_sticker');
	}

}
