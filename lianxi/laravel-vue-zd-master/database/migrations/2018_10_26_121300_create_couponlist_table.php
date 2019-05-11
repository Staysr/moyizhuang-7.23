<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCouponlistTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('couponlist', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->decimal('money', 10)->nullable()->default(0.00)->comment('如果type=xianjin，则money为优惠券金额，如果type=zhekou，则money为折扣，如95折用0.95表示');
			$table->integer('status')->nullable()->default(1)->comment('状态');
			$table->string('profession', 50)->nullable()->default('')->comment('职业');
			$table->bigInteger('expiretime')->nullable()->default(0)->comment('失效时间');
			$table->string('uid', 20)->nullable()->default('')->comment('用户uid');
			$table->string('desc', 50)->nullable()->default('')->comment('优惠券描述');
			$table->string('type', 20)->nullable()->default('xianjin')->comment('优惠券类型，xianjin:现金券,zhekou:折扣券');
			$table->decimal('limit', 10)->nullable()->default(0.00)->comment('如果type=xianjin，为最低可使用金额，如果type=zhekou，则为折扣券最高抵扣金额');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('couponlist');
	}

}
