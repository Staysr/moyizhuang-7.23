<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseClientCarbonTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_client_carbon', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('client_id')->comment('用户表(base_client_info)主键ID');
			$table->integer('foreign_id')->default(0)->comment('外键ID：type=1时foreign_id表示订单表(order_details)的主键ID；type=2时foreign_id表示商品订单表(mall_order_details)的主键ID；默认值0表示碳币过期');
			$table->integer('carbon_coin')->default(0)->comment('碳币数量：可正可负：正值表示收入碳币；负值表示支出碳币；');
			$table->integer('type')->comment('类型：1 订单支付；2 商品兑换；3 碳币过期；');
			$table->string('remark', 50)->comment('兑换描述：(如：订单支付；兑换舟舟公仔；碳币过期；)');
			$table->dateTime('create_time')->comment('创建时间');
			$table->dateTime('modify_time')->nullable()->comment('修改时间');
			$table->integer('client_level')->nullable()->comment('专家等级');
			$table->decimal('growth_speed', 10, 1)->nullable()->comment('碳币增速');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_client_carbon');
	}

}
