<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdOrderDeliveryPointTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_order_delivery_point', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('task_id')->nullable();
			$table->integer('order_id')->comment('出车单ID：出车单表主键ID');
			$table->string('name', 100)->nullable()->comment('交付点地址');
			$table->decimal('lng', 10, 7)->nullable()->comment('交付点地址经度');
			$table->decimal('lat', 10, 7)->nullable()->comment('交付点地址纬度');
			$table->string('contacts', 20)->nullable()->comment('联系人');
			$table->string('contact_way', 30)->nullable()->comment('联系方式');
			$table->integer('sort')->comment('排序');
			$table->integer('is_fixed_point')->comment('配送点是否固定：0 否；1 是；');
			$table->integer('status')->default(0)->comment('是否妥投：0 未做任何操作；1 已妥投；2 未妥投；');
			$table->string('put_address', 100)->nullable()->comment('实际交付点地址');
			$table->decimal('put_lng', 10, 7)->nullable()->comment('实际交付点地址经度');
			$table->decimal('put_lat', 10, 7)->nullable()->comment('实际交付点地址纬度');
			$table->string('reason')->nullable()->comment('妥投或未妥投原因');
			$table->string('img_one')->nullable()->comment('妥投或未妥投图片1，至少一张图片');
			$table->string('img_two')->nullable()->comment('妥投或未妥投图片2');
			$table->string('img_three')->nullable()->comment('妥投或未妥投图片3，最多三张图片');
			$table->dateTime('finish_time')->nullable()->comment('妥投或未妥投时间');
			$table->dateTime('create_time')->nullable()->comment('创建时间');
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
		Schema::drop('zd_order_delivery_point');
	}

}
