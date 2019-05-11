<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysFormsInvitedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_forms_invited', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->date('date');
			$table->integer('invited_id');
			$table->string('name', 20)->nullable()->comment('地推姓名');
			$table->string('phone', 20)->comment('f地推手机');
			$table->integer('category_id')->comment('地推所属');
			$table->string('category_code', 32);
			$table->integer('growth')->default(0)->comment('发展用户数');
			$table->integer('growth_once')->default(0)->comment('发展用户首单量');
			$table->integer('growth_order')->default(0)->comment('发展用户单量（除首单）');
			$table->decimal('pre_charge', 10)->default(0.00)->comment('发展用户预充值总金额');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sys_forms_invited');
	}

}
