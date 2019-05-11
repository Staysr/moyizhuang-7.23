<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdSafeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_safe', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('type')->nullable()->default(0)->comment('1 商户险  2 司机险');
			$table->string('title')->nullable()->default('')->comment('保险名称');
			$table->decimal('safe_fee', 11)->nullable()->default(0.00)->comment('保障服务费(元)');
			$table->integer('is_per')->nullable()->default(0)->comment('百分比');
			$table->decimal('max_payment', 11)->nullable()->default(0.00)->comment('最高赔付(万元)');
			$table->boolean('status')->nullable()->default(0)->comment('状态');
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
		Schema::drop('zd_safe');
	}

}
