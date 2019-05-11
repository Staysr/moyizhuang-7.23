<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysCarSafeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_car_safe', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('company_id')->nullable();
			$table->string('code')->comment('保险单号');
			$table->integer('car_id');
			$table->integer('safe_id')->nullable()->comment('保险公司ID');
			$table->string('type')->nullable()->comment('保险类型,例：[*]，[1][2][3]   1:交强险 2:商业险 3:车船税');
			$table->date('start_date')->nullable()->comment('开始时间');
			$table->date('end_date')->nullable()->comment('结束时间');
			$table->decimal('cost', 10)->nullable()->comment('保险费用');
			$table->text('files', 65535)->nullable();
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
		Schema::drop('sys_car_safe');
	}

}
