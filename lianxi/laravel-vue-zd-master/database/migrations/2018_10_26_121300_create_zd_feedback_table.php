<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdFeedbackTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_feedback', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('merchant_id')->default('')->comment('商户ID');
			$table->string('content')->default('')->comment('内容');
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
		Schema::drop('zd_feedback');
	}

}
