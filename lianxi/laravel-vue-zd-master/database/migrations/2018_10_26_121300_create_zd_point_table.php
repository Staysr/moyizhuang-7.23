<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdPointTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_point', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('point_time_id')->nullable()->default(0)->comment('到仓时间ID');
			$table->string('name')->comment('导入地址');
			$table->string('fixed_name')->nullable()->comment('定位地址');
			$table->text('area', 65535)->comment('地区');
			$table->decimal('lng', 10, 7)->nullable()->comment('配送点地址经度');
			$table->decimal('lat', 10, 7)->nullable()->comment('配送点地址纬度');
			$table->string('contacts', 20)->comment('联系人');
			$table->string('contact_way', 30)->comment('联系方式');
			$table->text('remark', 65535)->nullable()->comment('备注');
			$table->boolean('status')->default(0)->comment('状态 0 不可用 1 可用');
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
		Schema::drop('zd_point');
	}

}
