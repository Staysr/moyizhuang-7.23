<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdTaskSubTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_task_sub', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('task_id')->comment('任务主表主键ID');
			$table->string('delivery_require', 500)->nullable()->comment('配送要求json数组格式：["生鲜农产品","食品行业","电子产品","图书","共享单车","服装","建材","汽车配件"]');
			$table->string('carry_remark', 300)->nullable()->comment('搬运说明');
			$table->integer('is_worker')->default(0)->comment('是否自带小工：0 否； 1 是；');
			$table->integer('is_loading')->default(0)->comment('是否帮忙装货：0 否； 1 是；');
			$table->integer('is_unloading')->default(0)->comment('是否帮忙卸货：0 否； 1 是；');
			$table->integer('is_remove_seat')->default(0)->comment('需要拆后座：0 否； 1 是；');
			$table->integer('is_trolley')->default(0)->comment('需要小推车：0 否； 1 是；');
			$table->integer('is_tail_plate')->default(0)->comment('需要带尾板：0 否； 1 是；');
			$table->integer('is_extinguisher')->default(0)->comment('需要配备双灭火器：0 否； 1 是；');
			$table->integer('is_lock')->default(0)->comment('需要配备明锁/暗锁：0 否； 1 是；');
			$table->string('other_require', 300)->nullable()->comment('其他上岗要求');
			$table->string('extra_remark', 30)->nullable()->comment('任务补充说明json格式：["需要出仓清点货物","需要交接时清点货物","需要参与仓内分拣","需要代收现金"]');
			$table->string('welfare', 30)->nullable()->comment('司机福利补贴奖励json格式：["超里程/超时间/超点补助","报销油费","报销过路费","报销停车费"]');
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
		Schema::drop('zd_task_sub');
	}

}
