<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseDriverBarkCardTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_driver_bark_card', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('driver_id')->default(0)->comment('司机ID(base_driver_info表的主键id)');
			$table->string('bank_name', 50)->comment('银行名称');
			$table->string('bank_city', 20)->comment('开户地区');
			$table->string('bank_subbranch', 50)->nullable()->comment('开户支行');
			$table->string('card_name', 20)->comment('持卡人姓名');
			$table->string('card_no', 30)->comment('银行卡号');
			$table->string('remark')->nullable()->comment('银行卡说明');
			$table->dateTime('create_time')->comment('创建时间');
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
		Schema::drop('base_driver_bark_card');
	}

}
