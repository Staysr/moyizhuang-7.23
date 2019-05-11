<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseDriverInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_driver_info', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->integer('company_id')->nullable()->default(0)->comment('公司所属公司');
			$table->string('phone', 20)->unique('phone')->comment('司机手机号');
			$table->integer('extend_id')->nullable()->default(0)->comment('拓展经理');
			$table->char('password', 32)->comment('司机登录密码');
			$table->string('name', 20)->nullable()->comment('司机姓名');
			$table->integer('is_service_star')->default(0)->comment('是否服务之星：0 否； 1 是；');
			$table->decimal('account_price', 10)->nullable()->default(0.00)->comment('账户余额：单位元；默认值为0；');
			$table->decimal('withdrawal_amount', 10)->nullable()->default(0.00)->comment('提现冻结总金额：单位元；默认值为0；');
			$table->char('device_token', 64)->nullable()->comment('IOS推送token；Android不需要改字段');
			$table->integer('os_type')->nullable()->comment('用户手机系统类型：1 Android；2 IOS；3 其他；');
			$table->string('app_version')->nullable()->comment('程序版本：如4.0,5.1');
			$table->string('device_id', 64)->nullable()->comment('app设备ID');
			$table->string('head_img_url', 200)->nullable()->comment('头像');
			$table->integer('sex')->nullable()->default(0)->comment('性别：0 没有填写性别；1 男；2 女；默认是0');
			$table->string('idcard', 20)->nullable()->comment('身份证');
			$table->integer('deposit_status')->default(0)->comment('缴纳保证金状态：0 未缴纳；1 已缴纳正常；2 申请退款待审核中；3 已退款；默认值0');
			$table->decimal('deposit_fee', 10)->nullable()->default(0.00)->comment('当前支付时间节点的保证金金额');
			$table->integer('last_deposit_id')->nullable()->comment('最近一条保证金主键ID');
			$table->integer('is_plat_service_fee')->nullable()->default(0)->comment('是否缴纳平台服务费：0 未缴纳 1 已缴纳');
			$table->date('plat_fee_start_date')->nullable()->comment('平台服务费开始日期');
			$table->date('plat_fee_end_date')->nullable()->comment('平台服务费截止日期');
			$table->boolean('type')->nullable()->default(0)->comment('身份:0 队员 1 小队长  2 大队长');
			$table->integer('supervisor_id')->nullable()->default(0)->comment('一个司机关联身份(parent_id)跟据type ');
			$table->string('supervisors')->nullable()->default('')->comment('司机上级关系');
			$table->string('native_place', 20)->nullable()->comment('司机的籍贯');
			$table->string('address', 50)->nullable()->comment('司机联系地址');
			$table->string('job_number', 32)->nullable()->comment('司机工号');
			$table->string('job_date', 20)->nullable()->default('0000-00-00')->comment('初次工作时间');
			$table->string('drive_level', 3)->nullable()->comment('"A1","A2","A3","B1","B2","C1","C2","C3","C4","C5","D","E","F","M","N","P"');
			$table->string('issue_date', 20)->nullable()->default('0000-00-00')->comment('初次领证日期');
			$table->integer('car_type_id')->nullable()->comment('车型id ');
			$table->string('car_number', 20)->nullable()->comment('司机当前车牌号');
			$table->integer('category_id')->nullable()->comment('司机所属组织-级别车队或者商圈');
			$table->string('category_code', 32)->nullable()->default('')->comment('组织结构code');
			$table->integer('is_work')->nullable()->default(0)->comment('司机是否出车：0 未出车；1 出车中；');
			$table->integer('is_big_work')->nullable()->default(0)->comment('大B业务是否是否运单中(运单中的定义为:出车单处于已签到、配送中的状态)：0 大B空闲；1 大B运单中；');
			$table->dateTime('work_date')->nullable()->comment('当天出车或收车时间');
			$table->integer('total_work_time')->default(0)->comment('当天总出车时间：单位：秒');
			$table->integer('order_count')->default(0)->comment('司机总的已完成单数');
			$table->integer('count_assess')->default(0)->comment('评价过的订单总数');
			$table->integer('sum_score')->default(0)->comment('司机总评分');
			$table->decimal('assess_score', 3)->nullable()->default(0.00)->comment('最新评价的n单平均分：保留2位小数，1.00~5.00之间');
			$table->boolean('status')->default(4)->comment('状态：0：删除；1：正常；2：待审核；3：审核失败；4：未提交审核资料；默认值4');
			$table->boolean('work_status')->nullable()->default(0)->comment('司机业务状态：0空闲；1送货进行中；');
			$table->boolean('app_status')->nullable()->default(1)->comment('app状态：0 禁用 1 启用');
			$table->integer('is_frozen_out_car')->nullable()->default(1)->comment('是否冻结出车：0 冻结 1 正常');
			$table->integer('is_frozen_task')->nullable()->default(1)->comment('是否冻结投标任务：0 冻结 1 正常');
			$table->string('my_invite_code', 32)->nullable()->comment('我的邀请码');
			$table->string('last_end_work')->nullable()->comment('最后一次收车原因');
			$table->integer('driver_type')->nullable()->default(0)->comment('自营司机 1 合作司机 2 社会司机');
			$table->string('spec')->nullable()->comment('车型规格：用逗号隔开，最多六个(如：带拖车,带尾板,限高2米)');
			$table->string('review_reason')->nullable()->comment('司机资料审核失败原因');
			$table->string('toggle_reason')->nullable()->default('')->comment('状态变更原因');
			$table->string('driver_tag')->nullable()->default('')->comment('司机标签');
			$table->string('entry_time', 20)->nullable()->comment('入职时间');
			$table->boolean('identity_type')->nullable()->default(0)->comment('身份类型:0小b 1大B');
			$table->integer('is_booking_type')->default(0)->comment('是否预约模式：0 否； 1 是；');
			$table->char('book_start_time', 5)->nullable()->comment('预约模式开始时间：格式20:00');
			$table->char('book_end_time', 5)->nullable()->comment('预约模式结束时间：格式08:00');
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
		Schema::drop('base_driver_info');
	}

}
