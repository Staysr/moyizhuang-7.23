<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdMerchantComplaintTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_merchant_complaint', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('order_id')->comment('出车单ID：出车单表主键ID');
			$table->integer('user_id')->nullable()->default(0)->comment('审核者');
			$table->string('content')->comment('投诉内容');
			$table->string('audit_content')->nullable()->comment('审核内容：驳回用户投诉的原因');
			$table->integer('status')->nullable()->default(0)->comment('投诉状态：0 未审核；1 审核通过；2 驳回投诉');
			$table->dateTime('create_time')->nullable()->comment('创建时间：投诉时间');
			$table->dateTime('modify_time')->nullable()->comment('修改时间：客服审核时间或用户取消投诉时间');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('zd_merchant_complaint');
	}

}
