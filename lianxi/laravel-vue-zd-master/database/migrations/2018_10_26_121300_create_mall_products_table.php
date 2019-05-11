<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMallProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mall_products', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->boolean('type')->default(0)->comment('商品类型：0 优惠券 1 虚拟商品 2 实体物品');
			$table->string('title', 100)->comment('商品名称');
			$table->string('slogan', 100)->default('')->comment('一句话介绍');
			$table->string('description')->comment('图文介绍');
			$table->string('thumbnail')->comment('商品图片');
			$table->string('content')->nullable()->comment('文本介绍');
			$table->decimal('price', 10)->default(0.00)->comment('价格');
			$table->integer('stock')->default(0)->comment('库存');
			$table->boolean('status')->default(0)->comment('状态 0 下架 1 上架');
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
		Schema::drop('mall_products');
	}

}
