<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseMerchantStatisticsLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_merchant_statistics_log', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('month_id')->comment('合作商家月度拉新用户统计表ID');
			$table->integer('user_id')->comment('操作用户');
			$table->string('remark')->comment('操作说明');
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
		Schema::drop('base_merchant_statistics_log');
	}

}
