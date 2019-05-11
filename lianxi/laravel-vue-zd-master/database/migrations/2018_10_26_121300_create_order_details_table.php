<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_details', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID:32位固定UUID');
			$table->string('order_no', 32)->comment('订单号');
			$table->integer('category_id')->nullable()->default(0)->comment('订单所属区域code');
			$table->string('category_code', 32)->nullable()->default('');
			$table->string('district', 32)->nullable()->comment('区域名称（区名称）');
			$table->integer('car_type_id')->default(1)->comment('车辆类型：车辆类型：sys_car_type 表');
			$table->integer('client_id')->default(0)->index('od_client_id')->comment('用户ID：用户表主键ID');
			$table->integer('driver_id')->nullable()->default(0)->comment('司机ID');
			$table->integer('supervisor_id')->nullable()->default(0)->comment('直属上级。队员上级 队长 队长上级大队长');
			$table->string('supervisors')->nullable()->default('')->comment('司机上级关系');
			$table->decimal('estimate_distance', 8, 3)->nullable()->default(0.000)->comment('里程数：单位KM，保留两位小数；');
			$table->decimal('estimate_fee', 10)->nullable()->default(0.00)->comment('预估金额 起步费+续步费+返程费+途经点费-优惠券金额');
			$table->decimal('total_fee', 10)->nullable()->default(0.00)->comment('订单总价; 里程费+夜间费+等待费+返程费+途经点费');
			$table->decimal('actual_fee', 10)->nullable()->default(0.00)->comment('实收金额：订单总价-优惠金额；单位分；');
			$table->decimal('extra_fee')->nullable()->default(0.00)->comment('附加费用');
			$table->decimal('income_percent', 5)->default(0.00)->comment('社会司机抽成比例，值范围：0-100 ， 允许两位小数');
			$table->string('currency', 16)->nullable()->default('RMB')->comment('支付币种：默认币种 RMB');
			$table->integer('client_coupons_id')->nullable()->default(0)->comment('优惠券ID：base_client_coupons 优惠券表主键ID;');
			$table->decimal('coupons_fee', 11)->nullable()->default(0.00)->comment('优惠券抵扣金额');
			$table->integer('pay_type')->nullable()->comment('支付方式: 1 支付宝支付；2 微信支付；3 账户余额支付；');
			$table->integer('pay_trade_type')->default(0)->comment('支付交易类型： 0 APP支付；1 扫码支付；2 微信公众号支付；');
			$table->string('third_trans_no', 32)->nullable()->default('')->comment('第三方支付交易号');
			$table->integer('order_type')->nullable()->default(1)->comment('订单类型：1 实时订单；2 预约订单；');
			$table->integer('order_source')->nullable()->comment('订单来源：1 android app端下单；2 iOS app端下单；3 微信公众号下单；');
			$table->string('app_version')->nullable()->comment('程序版本：如4.0,5.1');
			$table->boolean('assign_type')->nullable()->default(0)->comment('分配类型:0 系统分派; 1 人工指派; 2 人工改派 3 司机抢实时订单');
			$table->integer('order_status')->nullable()->default(0)->comment('订单状态： 0 等待分配司机；1 司机已分配；2 司机到达发货地；3 订单进行中；4 用户取消订单；5 运营取消订单；6 行程结束待支付；7 行程结束已支付；8 订单已评价; 9 订单超时自动关闭；10 用户有责取消未支付；11 用户有责取消已支付；');
			$table->string('start_city')->nullable()->comment('发货城市名称');
			$table->integer('driver_type')->nullable()->comment('司机类型： 0 自营司机 1 合作司机 2 社会司机');
			$table->string('start_address', 64)->nullable()->comment('起始地址名称');
			$table->decimal('start_longitude', 10, 7)->nullable()->comment('起始地址经度');
			$table->decimal('start_latitude', 10, 7)->nullable()->comment('起始地址纬度');
			$table->string('end_city')->nullable()->comment('收货城市名称');
			$table->string('end_address', 64)->nullable()->comment('终点地址名称');
			$table->decimal('end_longitude', 10, 7)->nullable()->comment('终点地址经度');
			$table->decimal('end_latitude', 10, 7)->nullable()->comment('终点地址纬度');
			$table->integer('is_back')->nullable()->default(0)->comment('是否返程：0 不返程；1 返程；');
			$table->integer('is_carry')->nullable()->default(0)->comment('是否搬运：0 不搬运；1 搬运；');
			$table->integer('is_back_bill')->nullable()->default(0)->comment('是否回单：0 不回单；1 回单；');
			$table->integer('is_replace')->nullable()->default(0)->comment('是否代收货款：0 不代收；1 代收；');
			$table->integer('is_insurance')->default(0)->comment('是否投保');
			$table->integer('is_high_speed')->default(0)->comment('是否走高速：0 不走高速； 1 走高速；');
			$table->integer('is_range_get_to_start_address')->nullable()->default(1)->comment('是否在指定范围内到达发货地：0 否；1 是；');
			$table->integer('is_range_get_to_end_address')->nullable()->default(1)->comment('是否在指定范围内到达目的地：0 否；1 是；');
			$table->integer('is_push')->nullable()->default(0)->comment('是否提醒预约订单接货超时：0 否；1 是；');
			$table->decimal('back_mileage', 10)->nullable()->default(0.00)->comment('返程免费公里数');
			$table->decimal('back_distance', 6)->nullable()->default(0.00)->comment('返程里程：单位KM，保留两位小数；');
			$table->decimal('start_fee', 11)->nullable()->default(0.00)->comment('起步价：单位元；');
			$table->decimal('sequel_fee', 11)->nullable()->default(0.00)->comment('续里程费：单位元');
			$table->decimal('back_fee', 11)->nullable()->default(0.00)->comment('返程费用：单位元；');
			$table->integer('insurance_price')->default(0)->comment('保险费（元），不参与折扣');
			$table->integer('is_send_timeout')->nullable()->default(0)->comment('是否派单超时（目前为20秒）：1 超时；0 没有超时；');
			$table->integer('is_receive_timeout')->nullable()->default(0)->comment('是否接货超时（目前为20分钟）：1 超时；0 没有超时；');
			$table->integer('is_transport_timeout')->nullable()->default(0)->comment('是否送货超时（目前为2小时）：1 超时；0 没有超时；');
			$table->integer('is_invoice')->nullable()->default(0)->comment('是否已开发票：0 未开；1 已开；');
			$table->integer('is_forced_upload_goods_images')->nullable()->default(0)->comment('是否强制上传货物照片：0 否 1 是');
			$table->integer('is_forced_start_address')->nullable()->default(0)->comment('是否强制指定范围内到达发货地：0 否 1 是;');
			$table->integer('is_forced_end_address')->nullable()->default(0)->comment('是否强制指定范围内到达目的地：0 否 1 是;');
			$table->integer('is_upload_goods_img')->nullable()->default(0)->comment('是否已上传货物图片：0 未上传；1 已上传;');
			$table->integer('is_upload_back_bill_img')->nullable()->default(0)->comment('是否已上传回单图片：0 未上传；1 已上传;');
			$table->integer('wait_time')->nullable()->default(0)->comment('等待时间(分钟)');
			$table->decimal('wait_fee', 11, 0)->nullable()->default(0)->comment('等待服务费');
			$table->integer('timer_status')->nullable()->default(-1)->comment('计时状态: -1 从未点击计时 0 暂停或结束计时；1 开始计时；');
			$table->dateTime('wait_begin_time')->nullable()->comment('等待开始时间');
			$table->dateTime('wait_end_time')->nullable()->comment('暂停时间或结束计时时间或开始计时时间');
			$table->integer('wait_total_time')->nullable()->default(0)->comment('计时等待累计时间：秒；');
			$table->decimal('night_fee', 10)->nullable()->default(0.00)->comment('夜间服务费');
			$table->decimal('route_fee', 10)->nullable()->default(0.00)->comment('途径点总费用');
			$table->decimal('long_fee', 6)->nullable()->default(0.00)->comment('远途费：单位元');
			$table->decimal('long_mileage')->default(20.00)->comment('远途里程界定值，超过这个距离算远途费，单位：公里');
			$table->integer('is_reassigned')->nullable()->default(0)->comment('订单是否改派：0 未改派；1 已改派；默认是0');
			$table->string('remark')->nullable()->default('')->comment('订单备注说明');
			$table->string('abolish_reason')->nullable()->comment('取消订单理由');
			$table->dateTime('pay_time')->nullable()->comment('支付时间');
			$table->dateTime('appointment_time')->nullable()->comment('预约时间');
			$table->integer('is_appoint_remind')->nullable()->default(0)->comment('是否发送过预约提醒（0：未发送；1：已发送；）');
			$table->integer('is_wait_fee_remind')->default(0)->comment('是否通知货主即将产生等待服务费（0：未通知；1：已通知；）');
			$table->integer('no_pay_remind_sum')->default(0)->comment('未支付短信提醒次数：最多提醒3次');
			$table->integer('is_remind_no_match_driver')->default(0)->comment('该订单是否提醒了货主2分钟内没有匹配到司机 0 表示没有提醒；1 表示已经提醒 默认为0');
			$table->dateTime('submit_allocation_time')->nullable()->comment('订单用户提交取消时间');
			$table->dateTime('allocation_time')->nullable()->comment('订单取消时间');
			$table->dateTime('assign_time')->nullable()->comment('派单时间');
			$table->dateTime('reach_time')->nullable()->comment('到达时间');
			$table->dateTime('start_time')->nullable()->comment('开始行程时间');
			$table->dateTime('end_time')->nullable()->comment('结束行程时间');
			$table->string('complaint_content')->nullable()->default('')->comment('投诉内容');
			$table->boolean('edit_assess')->default(0)->comment('修改评价次数');
			$table->integer('district_id')->nullable()->default(0)->comment('订单所属商圈ID');
			$table->string('district_code', 32)->nullable()->default('')->comment('订单所属商圈code');
			$table->boolean('custom_remark')->nullable()->default(0)->comment('客服是否有备注:0 否, 1 是');
			$table->dateTime('create_time')->comment('创建时间');
			$table->dateTime('modify_time')->nullable()->comment('修改时间：订单取消时间等');
			$table->string('assigns_reason')->nullable()->comment('指派理由');
			$table->string('reassignment_reason')->nullable()->comment('改派理由');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('order_details');
	}

}
