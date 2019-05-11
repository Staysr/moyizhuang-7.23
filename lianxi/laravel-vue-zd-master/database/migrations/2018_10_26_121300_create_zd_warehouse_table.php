<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdWarehouseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_warehouse', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('merchant_id')->default(0)->comment('商户id');
			$table->string('title')->default('')->comment('仓库名称');
			$table->string('category_position')->nullable()->default('')->comment('省市区关系');
			$table->string('category_zone')->nullable()->default('')->comment('省市区');
			$table->string('contacts')->nullable()->default('')->comment('联系人');
			$table->string('contacts_phone')->nullable()->default('')->comment('联系人手机');
			$table->string('backup_contacts')->nullable()->default('')->comment('备用联系人');
			$table->string('address')->comment('仓库详细地址');
			$table->text('description')->nullable()->comment('位置描述');
			$table->text('instruction')->nullable()->comment('行车指引');
			$table->float('longitude', 10, 6)->comment('经度');
			$table->float('latitude', 10, 6)->comment('维度');
			$table->text('remark')->nullable()->comment('仓备注');
			$table->boolean('status')->nullable()->default(0)->comment('状态 0 不可用 1 可用');
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
		Schema::drop('zd_warehouse');
	}

}
