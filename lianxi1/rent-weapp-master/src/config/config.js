const url = 'http://127.0.0.1:8361/api/';
// const url = 'https://www.dapingkeji.cn/rent-dev/api/';

module.exports = {
	urls: {
		Login: url + 'auth/login', //微信登录
		GetMobile: url + 'auth/getmobile', //获取手机号

		UploadIdCard: url + 'custom/idcard', //上传身份证
		UploadUserDetail: url + 'custom/update', //上传详细资料
		GetUserInfo: url + 'custom/getuserinfo',
		Recharge: url + 'custom/recharge',

		GoodDetail: url + 'goods/find',

		OrderStart: url + 'order/start', //生成订单
		OrderEnd: url + 'order/end', //结束订单
		OrderFirst: url + 'order/first', //拉取最新订单
		OrderList: url + 'order/match', //拉取最新订单

		ShopAll: url + 'shop/getshop', //拉取所有城市代码

		SettingGet: url + 'setting/index'
	},
	qqmap: {
		key: 'TCCBZ-XUICJ-A6PFE-KL5IQ-PV4E6-BXF6P'
	},
	common: {
		text_shop: '医院',
		
	}
};