<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysCategoryCarTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_category_car_type', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('category_id')->comment('组织ID');
			$table->string('category_code', 32)->comment('组织代码 用于后台权限');
			$table->integer('car_type_id')->comment('车型id');
			$table->integer('wait_time')->default(0)->comment('等待时间单位（分钟）');
			$table->decimal('wait_price', 10)->default(0.00)->comment('等待超时首收费');
			$table->integer('wait_sequel_time')->default(0)->comment('等待续时(分钟)');
			$table->decimal('wait_sequel_price', 10)->default(0.00)->comment('等待续费');
			$table->decimal('start_mileage', 10)->default(0.00)->comment('起步里程 km');
			$table->decimal('start_price', 10)->default(0.00)->comment('起步价');
			$table->decimal('sequel_mileage', 10)->default(0.00)->comment('续里程');
			$table->decimal('sequel_price', 10)->default(0.00)->comment('续价');
			$table->decimal('back_mileage', 10)->default(0.00)->comment('返程首里程');
			$table->decimal('back_price', 10)->default(0.00)->comment('返程首价');
			$table->decimal('back_sequel_mileage', 10)->default(0.00)->comment('返程续里程');
			$table->decimal('back_sequel_price', 10)->default(0.00)->comment('返程续价');
			$table->decimal('route_price', 10)->nullable()->default(0.00)->comment('每个途径点费用');
			$table->decimal('long_mileage', 6)->default(0.00)->comment('远途里程界定值，超过这个距离算远途费，单位公里');
			$table->decimal('long_price', 6)->default(0.00)->comment('远途费每公里收取费用，单位元');
			$table->integer('insurance_price')->default(3)->comment('保险费（元）');
			$table->time('night_start')->default('00:00:00')->comment('夜间服务收费开始时间');
			$table->time('night_end')->default('00:00:00')->comment('夜间服务收费结束时间');
			$table->decimal('night_price', 10)->default(0.00)->comment('夜间服务费');
			$table->decimal('order_push_distance', 10, 3)->default(5.000)->comment('实时订单推送范围');
			$table->integer('is_forced_upload_goods_images')->nullable()->default(0)->comment('是否强制上传货物照片：0 否 1 是');
			$table->integer('is_forced_start_address')->nullable()->default(0)->comment('是否强制指定范围内到达发货地：0 否 1 是;');
			$table->integer('is_forced_end_address')->nullable()->default(0)->comment('是否强制指定范围内到达目的地：0 否 1 是;');
			$table->decimal('half_rent_time', 10)->default(0.00)->comment('半日租时长');
			$table->decimal('half_rent_price', 10)->default(0.00)->comment('半日租价格');
			$table->decimal('half_rent_mileage', 10)->default(0.00)->comment('半日租里程');
			$table->decimal('whole_rent_time', 10)->default(0.00)->comment('全日租时长（单位：小时）');
			$table->decimal('whole_rent_price', 10)->default(0.00)->comment('全日租价格');
			$table->decimal('whole_rent_mileage', 10)->default(0.00)->comment('全日租里程');
			$table->decimal('timeout_time', 10)->default(0.00)->comment('超时时间（单位：分钟）');
			$table->decimal('timeout_fee', 10)->default(0.00)->comment('超时费用');
			$table->decimal('timeout_extra', 10)->default(0.00)->comment('超时续时：超时计费时间（单位：分钟）');
			$table->decimal('timeout_renew', 10)->default(0.00)->comment('超时续费');
			$table->decimal('book_push_distance', 10, 3)->default(20.000)->comment('预约订单推送范围');
			$table->boolean('status')->default(1)->comment('状态:0 关闭 1 开启');
			$table->dateTime('create_time')->nullable();
			$table->dateTime('modify_time')->nullable();
			$table->unique(['category_id','car_type_id'], 'cartype_city');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sys_category_car_type');
	}

}
