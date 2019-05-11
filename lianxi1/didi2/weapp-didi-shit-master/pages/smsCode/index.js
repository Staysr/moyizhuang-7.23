var util = require("../../utils/util.js");
Page({
  data: {
    loginBtnTxt: "登录",
    getSmsCodeBtnTxt:"获取验证码",
    loginBtnBgBgColor: "#ff9900",
    btnLoading: false,
    disabled: false,
    inputUserName: '16631150870',
    inputPassword: 'admin',
  },
  registersc: function () {
    wx.navigateTo({
      url: '../regist/index',
    })
  },
  success: function (res) {
    console.log(res);
  },
  forgotpassword: function () {
    wx.navigateTo({
      url: '../findpassword/index',
    })
  },
  // onLoad:function(options){
  //   // 页面初始化 options为页面跳转所带来的参数

  // },
  onReady: function () {
    // 页面渲染完成

  },
  onShow: function () {
    // 页面显示

  },
  onHide: function () {
    // 页面隐藏

  },
  onUnload: function () {
    // 页面关闭

  },

  // formSubmit:function(e){
  //   var param = e.detail.value;
  //   this.mysubmit(param);
  // },
  // mysubmit:function (param){
  //   var flag = this.checkUserName(param)&&this.checkPassword(param)
  //   if(flag){
  //       this.setLoginData1();
  //       this.checkUserInfo(param);
  //   } 
  // },
  // setLoginData1:function(){
  //   this.setData({
  //     loginBtnTxt:"登录中",
  //     disabled: !this.data.disabled,
  //     loginBtnBgBgColor:"#999",
  //     btnLoading:!this.data.btnLoading
  //   });
  // },
  // setLoginData2:function(){
  //   this.setData({
  //     loginBtnTxt:"登录",
  //     disabled: !this.data.disabled,
  //     loginBtnBgBgColor:"#ff9900",
  //     btnLoading:!this.data.btnLoading
  //   });
  // },
  // checkUserName:function(param){
  //   var email = util.regexConfig().email; 
  //   var phone = util.regexConfig().phone;
  //   var inputUserName = param.username.trim();
  //   if(email.test(inputUserName)||phone.test(inputUserName)){
  //     return true;
  //   }else{
  //     wx.showModal({
  //       title: '提示',
  //       showCancel:false,
  //       content: '请输入正确的邮箱或者手机号码'
  //     });
  //     return false;
  //   }
  // },
  // checkPassword:function(param){
  //   var userName = param.username.trim();
  //   var password = param.password.trim();
  //   if(password.length<=0){
  //     wx.showModal({
  //       title: '提示',
  //       showCancel:false,
  //       content: '请输入密码'
  //     });
  //     return false;
  //   }else{
  //     return true;
  //   }
  // },
  // checkUserInfo:function(param){
  //   var username = param.username.trim();
  //   var password = param.password.trim();
  //   var that = this;
  //   if((username=='admin@163.com'||username=='16631150870')&&password=='admin'){
  //       setTimeout(function(){
  //         wx.showToast({
  //           title: '成功',
  //           icon: 'success',
  //           duration: 1500,
  //         });
  //         that.setLoginData2();
  //         that.redirectTo(param);
  //       },2000);

  //   }else{
  //     wx.showModal({
  //       title: '提示',
  //       showCancel:false,
  //       content: '用户名或密码有误，请重新输入'
  //     });
  //     this.setLoginData2();
  //   }
  // },

  // redirectTo:function(param){
  //   //需要将param转换为字符串
  //   param = JSON.stringify(param);
  //   wx.redirectTo({
  //     url: '../personal/index?param='+ param//参数只能是字符串形式，不能为json对象
  //   })
  // }
  formSubmit: function (e) {
    let photo = /^1[345768]{1}\d{9}$/;
    let params = e.detail.value;
    if (params.phone == '') {
      showToast("手机号");
      this.setData({
        phfocus: true
      })
      return;
    }
    if (!photo.test(params.phone)) {
      wx.showToast({
        title: '手机号格式不正确！',
        duration: 2000,
        icon: "none"
      })
      this.setData({
        phfocus: true
      })
      return;
    }
    function showToast(val) {
      wx.showToast({
        title: val + '不能为空',
        duration: 2000,
        icon: "none"
      })
    }
    wx.request({
      url: 'https://g.hbyingluo.com/go.php', //仅为示例，并非真实的接口地址
      // http://kongdechang.com/
      method: "POST",
      data: {
        password: params.password,
        phone: params.phone,
      },
      header: {
        'content-type': 'application/x-www-form-urlencoded' // 默认值
      },

      success: function (res) {
        console.log(res.data.status)
        //getApp().globalData.header.Session = 'JSESSIONID=' + res.data.sessionId;  //这一句很重要。
        //getApp().globalData.Session = 'user_id'+res.data.sessionId;
        if (res.data.st == 3) {
          wx.navigateTo({
            url: '../personal/index',
          })
        }
        if (res.data.status == 1) {
          wx.navigateTo({
            url: '../car/index',
          })
        } else {
          // wx.navigateTo({
          //   url: '../advices/index',
          // })
          wx.showToast({
            title: '用户名或密码错误',
            duration: 2000,
            icon: "none"
          })
        }
      },

    })
  }
})