<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysCarStickerRuleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_car_sticker_rule', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID：车贴批号');
			$table->date('start_date')->comment('上传开始时间');
			$table->date('end_date')->comment('上传截止时间');
			$table->string('remark')->nullable()->comment('上传要求');
			$table->string('reference', 20)->nullable()->comment('参照物');
			$table->decimal('reward_fee')->nullable()->default(0.00)->comment('奖励金额：单位元');
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
		Schema::drop('sys_car_sticker_rule');
	}

}
