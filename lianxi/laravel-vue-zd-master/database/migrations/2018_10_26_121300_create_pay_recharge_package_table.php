<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePayRechargePackageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pay_recharge_package', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('category_id')->default(0)->comment('所属区域 到城市级别');
			$table->string('category_code', 32)->nullable()->comment('所属区域代码');
			$table->integer('car_type_id')->default(0)->comment('车辆类型：sys_car_type表的主键ID； 0表示所有车型通用；');
			$table->string('name', 32)->comment('套餐名称');
			$table->decimal('fee', 11)->default(0.00)->comment('套餐金额');
			$table->boolean('hot')->default(0)->comment('是否热销');
			$table->boolean('status')->default(0)->comment('状态：0 禁用; 1 启用;');
			$table->integer('sloga_id')->default(0)->comment('关联的促销标语ID');
			$table->dateTime('modify_time')->nullable();
			$table->dateTime('create_time')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pay_recharge_package');
	}

}
