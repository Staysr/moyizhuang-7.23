<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseSuggestionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_suggestion', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->comment('用户外键ID：货主表主键ID或者司机表主键ID');
			$table->string('name')->nullable()->comment('用户姓名');
			$table->string('phone')->comment('用户手机号');
			$table->integer('user_type')->comment('用户类型：1：货主；2：司机');
			$table->string('content', 1000)->default('')->comment('意见反馈内容');
			$table->timestamp('create_time')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('创建时间');
			$table->timestamp('modify_time')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('修改时间');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_suggestion');
	}

}
