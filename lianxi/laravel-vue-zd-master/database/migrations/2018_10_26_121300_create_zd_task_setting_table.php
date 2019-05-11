<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdTaskSettingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_task_setting', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('task_id')->comment('任务ID');
			$table->string('type', 20)->comment('配置类型：
dispatching 配送要求; 
carry 搬运说明;
supply:任务补充说明;
welfare:司机福利补贴奖励; 
receipt 回单; 
other 其他');
			$table->string('key', 50)->comment('配送要求：
搬运说明：
    is_worker:自带小工
    is_loading:帮忙装货
    is_unloading:帮忙卸货
任务补充:
福利补贴奖励:
回单:
    type:回单方式;1 返仓交回; 2 下次配送交回; 3 快递; 4 拍照发电子版
    recipient:接收人
    phone:联系方式
    address:收件地址
    express:快递费1;司机承担 2;客户承担
其他：
    is_remove_seat:拆后座
    is_trolley:小推车
    is_tail_plate:带尾板
    is_extinguisher:双灭火器
    is_lock:明锁/暗锁
    other_require:上岗要求');
			$table->string('value', 300)->nullable()->comment('配置的值');
			$table->dateTime('create_time')->nullable();
			$table->dateTime('modify_time')->nullable();
			$table->unique(['task_id','type','key'], 'delivery_task_key');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('zd_task_setting');
	}

}
