<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseDriverAdvanceRegTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_driver_advance_reg', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('phone', 20)->unique('phone')->comment('司机手机号');
			$table->integer('reg_source')->default(0)->comment('注册来源：1 地推人员推荐； 2 司机推荐； 3 货主推荐；');
			$table->integer('source_foreign_id')->nullable()->comment('推荐人ID: 如：地推人员ID； 司机ID； 货主ID；');
			$table->integer('driver_id')->nullable()->comment('司机ID');
			$table->integer('status')->default(0)->comment('注册状态：0 未注册；1：已注册；2：审核成功；3：审核失败；');
			$table->dateTime('create_time')->comment('创建时间');
			$table->dateTime('modify_time')->comment('修改时间');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_driver_advance_reg');
	}

}
