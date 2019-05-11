<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMallProductCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mall_product_category', function(Blueprint $table)
		{
			$table->integer('product_id');
			$table->integer('category_id');
			$table->unique(['product_id','category_id'], 'unique_category_product');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mall_product_category');
	}

}
