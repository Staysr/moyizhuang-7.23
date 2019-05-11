<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdTaskDeliveryPointTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_task_delivery_point', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('task_id')->comment('线路任务表主键ID');
			$table->string('name', 100)->comment('配送点地址');
			$table->decimal('lng', 10, 7)->comment('配送点地址经度');
			$table->decimal('lat', 10, 7)->comment('配送点地址纬度');
			$table->string('contacts', 20)->comment('联系人');
			$table->string('contact_way', 30)->comment('联系方式');
			$table->integer('sort')->comment('排序');
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
		Schema::drop('zd_task_delivery_point');
	}

}
