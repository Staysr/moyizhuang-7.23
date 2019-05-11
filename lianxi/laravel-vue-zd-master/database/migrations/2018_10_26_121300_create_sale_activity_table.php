<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSaleActivityTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sale_activity', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('category_id')->default(0)->comment('活动适用范围：城市ID，0表示全国');
			$table->string('category_code', 32)->nullable()->comment('活动适用范围：城市code');
			$table->string('name', 32)->comment('活动名称');
			$table->string('url')->comment('h5 url地址');
			$table->string('main')->comment('主图');
			$table->string('popup')->nullable()->comment('副图');
			$table->string('share_content')->nullable()->comment('分享后显示的内容');
			$table->date('start_date');
			$table->date('end_date');
			$table->boolean('status')->default(1)->comment('状态 0 下线; 1 上线;');
			$table->boolean('rule_type')->nullable()->default(0)->comment('规则类型：0没有应用规则，1 单单返 2 首单返 3 注册送');
			$table->dateTime('create_time')->comment('创建时间');
			$table->dateTime('modify_time')->comment('更新时间');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sale_activity');
	}

}
