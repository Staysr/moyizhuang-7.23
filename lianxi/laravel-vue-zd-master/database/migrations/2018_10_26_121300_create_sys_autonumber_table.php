<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysAutonumberTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_autonumber', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 32)->default('')->comment('说明');
			$table->string('type', 32)->comment('类型');
			$table->string('business_parameters', 32)->default('0')->comment('类型参数');
			$table->integer('number')->default(0)->comment('自增值');
			$table->dateTime('create_time')->nullable();
			$table->dateTime('modify_time')->nullable();
			$table->unique(['type','business_parameters'], 'type_unqiue');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sys_autonumber');
	}

}
