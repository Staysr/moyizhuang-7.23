<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdMerchantTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_merchant', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('quality_id')->default(0)->comment('品质经理ID');
			$table->integer('advice_id')->default(0)->comment('客户顾问ID');
			$table->integer('running_id')->nullable()->default(0)->comment('运行经理ID');
			$table->integer('user_id')->nullable()->default(0)->comment('创建人ID');
			$table->string('title')->nullable()->default('')->comment('商户全称');
			$table->string('short_name')->nullable()->default('')->comment('商户简称');
			$table->string('city')->nullable()->default('')->comment('所属城市');
			$table->string('trade')->nullable()->default('')->comment('行业');
			$table->string('bank')->nullable()->comment('开户银行');
			$table->string('bank_no')->nullable()->comment('银行卡号');
			$table->string('telephone')->nullable()->default('')->comment('办公室座机号码');
			$table->date('agreement_start_time')->nullable()->comment('合同开始时间');
			$table->date('agreement_end_time')->nullable()->comment('合同结束时间');
			$table->boolean('invoice')->nullable()->default(0)->comment('是否开发票 0不需要 1 需要');
			$table->integer('repayment')->nullable()->default(0)->comment('结算方式  1 月结');
			$table->integer('repayment_day')->nullable()->default(0)->comment('承诺回款天数');
			$table->boolean('sop')->nullable()->comment('SOP启用状态');
			$table->text('content')->nullable()->comment('联系人信息');
			$table->integer('task_count')->nullable()->default(0)->comment('发任务数');
			$table->integer('unless_task_count')->nullable()->default(0)->comment('任务作废数');
			$table->integer('warehouse_count')->nullable()->default(0)->comment('仓库数');
			$table->integer('contract_count')->nullable()->default(0)->comment('商户合同数目');
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
		Schema::drop('zd_merchant');
	}

}
