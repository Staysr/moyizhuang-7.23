<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMallOrderDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mall_order_details', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('client_id')->comment('用户表(base_client_info)主键ID');
			$table->integer('product_id')->default(0)->comment('商品表(mall_products)主键ID');
			$table->integer('product_type')->default(0)->comment('商品类型 0：优惠券 1：虚拟物品 2：实体物品');
			$table->string('name', 50)->comment('商品名称');
			$table->integer('count')->default(0)->comment('商品数量');
			$table->integer('carbon_coin')->unsigned()->default(0)->comment('碳币数量');
			$table->string('receipt_name', 20)->nullable()->comment('收货人姓名');
			$table->string('receipt_phone', 20)->nullable()->comment('收货人电话');
			$table->string('receipt_address', 50)->nullable()->comment('收货地址');
			$table->dateTime('receipt_time')->nullable()->comment('收货时间');
			$table->integer('status')->nullable()->default(1)->comment('收货状态：1 收货中；2 已收货；');
			$table->text('deliveryer', 65535)->nullable()->comment('送货人');
			$table->dateTime('create_time')->comment('创建时间：也是兑换时间');
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
		Schema::drop('mall_order_details');
	}

}
