<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseClientInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_client_info', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('phone', 20)->unique('phone')->comment('用户手机号：也作为账户名');
			$table->char('password', 32)->comment('用户登录密码');
			$table->string('client_name', 50)->nullable()->comment('用户名');
			$table->char('pay_password', 32)->nullable()->comment('支付密码：账户余额支付的密码');
			$table->integer('is_no_password_pay')->default(0)->comment('是否免密支付：0 否；1 是；');
			$table->string('user_name', 50)->nullable()->comment('姓名');
			$table->string('open_id')->nullable()->comment('微信用户唯一标示：openid');
			$table->string('mini_open_id')->nullable()->comment('微信小程序用户唯一标示：openid');
			$table->string('wx_headimg_url', 500)->nullable()->comment('用户的微信头像');
			$table->integer('sex')->nullable()->default(0)->comment('性别 0 未设 1 男 2女');
			$table->string('head_img_url')->nullable()->comment('用户头像图片url');
			$table->integer('category_id')->nullable()->default(0)->comment('所属商圈');
			$table->string('category_code', 32)->nullable();
			$table->char('device_token', 64)->nullable()->comment('IOS推送token；Android不需要改字段');
			$table->string('business_name', 32)->nullable()->comment('商户名称：如：凯达油漆店');
			$table->string('business_type', 20)->nullable()->comment('商户类型：如：建材；水泥；油漆等；');
			$table->string('business_address', 64)->nullable()->comment('商户地址');
			$table->decimal('account_price', 10)->nullable()->default(0.00)->comment('账户余额：单位元；默认值为0；');
			$table->integer('os_type')->nullable()->comment('用户手机系统类型：1 Android；2 IOS；3 微信公众号；4：分享领券；5：微信小程序；6：好友二维码邀请；');
			$table->string('app_version')->nullable()->comment('程序版本：如4.0,5.1');
			$table->integer('reg_source')->nullable()->comment('注册来源：1 Android；2 IOS；3 微信公众号；4：分享领券；5：货主二维码邀请；6：司机二维码邀请；7：微信小程序；');
			$table->string('device_id', 64)->nullable()->comment('app设备ID');
			$table->string('imei', 64)->nullable()->comment('手机唯一标示码');
			$table->integer('status')->nullable()->default(1)->comment('APP状态：0 禁用；1：启用；');
			$table->string('my_invite_code', 32)->nullable()->comment('我的邀请码');
			$table->integer('invite_type')->nullable()->default(0)->comment('邀请者类型: 0 并没有人邀请; 1 用户邀请; 2 地推人员; 3 司机');
			$table->integer('invite_id')->nullable()->comment('邀请者(司机表/货主表/地推表)：用于表示该用户是谁邀请的,与invite_type找到对应的邀请人员');
			$table->dateTime('invite_convert_time')->nullable();
			$table->integer('is_converted_first_order')->nullable();
			$table->dateTime('converted_first_order_time')->nullable()->comment('兑换后首单完成时间（按订单支付时间）');
			$table->dateTime('first_order_pay_time')->nullable()->comment('首次订单支付时间');
			$table->dateTime('last_spending_time')->nullable();
			$table->dateTime('last_notice_time')->nullable()->comment('最后提醒时间');
			$table->dateTime('last_recharge_time')->nullable()->comment('最后充值时间');
			$table->decimal('last_recharge_price', 10)->nullable()->default(0.00)->comment('最后充值金额');
			$table->integer('last_pay_type')->default(0)->comment('最后一次支付方式：1 支付宝支付；2 微信支付；3 账户余额支付；');
			$table->decimal('total_spending_price', 10)->nullable()->default(0.00)->comment('累计消费金额');
			$table->decimal('last_any_spending_price', 10)->nullable()->default(0.00)->comment('最后任一方式消费金额');
			$table->dateTime('last_any_spending_time')->nullable()->comment('最后任一方式消费时间');
			$table->dateTime('last_op_no_password_pay_time')->nullable()->comment('最后操作免密支付时间');
			$table->integer('recharge_count')->default(0)->comment('充值次数');
			$table->integer('client_level')->default(1)->comment('会员等级：会员表(base_client_ruler)的主键ID');
			$table->integer('cumulate_growth')->default(0)->comment('累积成长值');
			$table->integer('carbon_coin')->default(0)->comment('累积总碳币');
			$table->integer('this_expire_carbon_coin')->default(0)->comment('当前预过期碳币 《2019年淘汰2017年数据》');
			$table->integer('next_expire_carbon_coin')->default(0)->comment('下次过期碳币《今年累积碳币-明年年底才过期》 ');
			$table->integer('accumulative_recharge')->default(0)->comment('累积充值赠送');
			$table->integer('order_count')->default(0)->comment('完成订单数量：已付款的订单计数一次');
			$table->decimal('driving_time', 10, 1)->default(0.0)->comment('行驶时长(小时)');
			$table->decimal('mileage_total', 10, 1)->default(0.0)->comment('总里程：单位公里');
			$table->decimal('carbon_total')->default(0.00)->comment('碳总量：单位千克');
			$table->decimal('trees', 10, 1)->default(0.0)->comment('减排的二氧化碳相对于种多少棵树：默认换算：10公里相当于3棵树');
			$table->dateTime('create_time')->comment('创建时间');
			$table->dateTime('modify_time')->nullable()->comment('修改时间：如禁用客户APP时间等');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_client_info');
	}

}
