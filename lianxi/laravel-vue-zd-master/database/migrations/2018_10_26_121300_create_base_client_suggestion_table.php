<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseClientSuggestionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_client_suggestion', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('user_id')->nullable()->comment('用户ID：用户表主键ID');
			$table->string('phone', 20)->comment('用户手机号');
			$table->string('content')->comment('投诉内容');
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
		Schema::drop('base_client_suggestion');
	}

}
