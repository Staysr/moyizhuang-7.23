// pages/huiyuan/index.js
var util = require("../../utils/util.js");
Page({
  data: {
    items: [
      { name: 'CHN', value: '       ⟪河道运输用户服务协议⟫', checked: true },
    ],
    aa: 'CHN',
    registBtnTxt: "注册",
    registBtnBgBgColor: "#ff9900",
    getSmsCodeBtnTxt: "获取验证码",
    getSmsCodeBtnColor: "#ff9900",
    // getSmsCodeBtnTime:60,
    btnLoading: false,
    registDisabled: false,
    smsCodeDisabled: false,
    inputUserName: '',
    inputPassword: '',
    phoneNum: ''
  },
  radio: function () {
    wx.navigateTo({
      url: '../radio/index',
    })
  },
  huiyuan: function () {
    wx.navigateTo({
      url: '../huiyuan/index',
    })
  },
  forgotpassword: function () {
    wx.navigateTo({
      url: '../findpassword/index',
    })
  },
  getSmsCode: function (e) {
    let param = e.detail.value;
    var flag = this.checkphone(param.phone) && this.checkPassword(param) && this.checkSmsCode(param);
    var phoneNum = this.data.phoneNum;
    //   var that = this;
    //   var count = 60;
    //   if (this.checkUserName(phoneNum)) {
    //     var si = setInterval(function () {
    //       if (count > 0) {
    //         count--;
    //         that.setData({
    //           getSmsCodeBtnTxt: count + ' s',
    //           getSmsCodeBtnColor: "#999",
    //           smsCodeDisabled: true
    //         });
    //       } else {
    //         that.setData({
    //           getSmsCodeBtnTxt: "获取验证码",
    //           getSmsCodeBtnColor: "#ff9900",
    //           smsCodeDisabled: false
    //         });
    //         count = 60;
    //         clearInterval(si);
    //       }
    //     }, 1000);
    //   }

  },
  checkSmsCode: function () {
    //var smsCode = param.smsCode.trim();
    //var tempSmsCode = '000000';//演示效果临时变量，正式开发需要通过wx.request获取
    // if (smsCode != tempSmsCode) {
    //   wx.showModal({
    //     title: '提示',
    //     showCancel: false,
    //     content: '请输入正确的短信验证码'
    //   });
    //   return false;
    // } else {
    //   return true;
    // }
  },
  // getSmsCode:function(e){
  //   let params = e.detail.value;
  //   if (params.sms == '') {
  //     showToast("验证码");
  //     this.setData({
  //       phfocus: true
  //     })
  //     return;
  //   }
  //   function showToast(val) {
  //     wx.showToast({
  //       title: val + '不能为空',
  //       duration: 2000,
  //       icon: "none"
  //     })
  //   }
  //   wx.request({
  //     url: 'https://g.hbyingluo.com/api/api_demo',
  //     method: "POST",
  //     data: {
  //       sms: params.sms,
  //     },
  //     header: {
  //       'content-type': 'application/x-www-form-urlencoded' // 默认值
  //     },
  //     success: function (res) {
  //       console.log(res.data);
  //       // if (res.data == 1) {
  //       //   wx.showToast({
  //       //     title: '注册成功',
  //       //     icon: 'success',
  //       //     duration: 2000
  //     //}
  //        }
  //     })
  // },
  onLoad: function (options) {
    // 页面初始化 options为页面跳转所带来的参数

  },
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
  formSubmit: function (e) {
    //   var param = e.detail.value;
    //   this.mysubmit(param);
    // },
    // mysubmit: function (param) {
    //   var flag = this.checkUserName(param.username) && this.checkPassword(param) && this.checkSmsCode(param)
    //   var that = this;
    //   if (flag) {
    //     this.setregistData1();
    //     setTimeout(function () {
    //       wx.showToast({
    //         title: '成功',
    //         icon: 'success',
    //         duration: 1500
    //       });
    //       that.setregistData2();
    //       that.redirectTo(param);
    //     }, 2000);
    //   }
    // },
    // getPhoneNum: function (e) {
    //   var value = e.detail.value;
    //   this.setData({
    //     phoneNum: value
    //   });
    // },
    // setregistData1: function () {
    //   this.setData({
    //     registBtnTxt: "注册中",
    //     registDisabled: !this.data.registDisabled,
    //     registBtnBgBgColor: "#999",
    //     btnLoading: !this.data.btnLoading
    //   });
    // },
    // setregistData2: function () {
    //   this.setData({ 
    //                     registBtnTxt: "注册",
    //     registDisabled: !this.data.registDisabled,
    //     registBtnBgBgColor: "#ff9900",
    //     btnLoading: !this.data.btnLoading
    //   });
    // },
    // checkUserName: function (param) {
    //   var phone = util.regexConfig().phone;
    //   var inputUserName = param.trim();
    //   if (phone.test(inputUserName)) {
    //     return true;
    //   } else {
    //     wx.showModal({
    //       title: '提示',
    //       showCancel: false,
    //       content: '请输入正确的手机号码'
    //     });
    //     return false;
    //   }
    // },
    // checkPassword: function (param) {
    //   var userName = param.username.trim();
    //   var password = param.password.trim();
    //   if (password.length <= 0) {
    //     wx.showModal({
    //       title: '提示',
    //       showCancel: false,
    //       content: '请设置密码'
    //     });
    //     return false;
    //   } else if (password.length < 6 || password.length > 20) {
    //     wx.showModal({
    //       title: '提示',
    //       showCancel: false,
    //       content: '密码长度为6-20位字符'
    //     });
    //     return false;
    //   } else {
    //     return true;
    //   }
    //  },
    // getSmsCode: function () {
    //   // var phoneNum = this.data.phoneNum;
    //   var that = this;
    //   var count = 60;
    //   if (this.checkUserName(phoneNum)) {
    //     var si = setInterval(function () {
    //       if (count > 0) {
    //         count--;
    //         that.setData({
    //           getSmsCodeBtnTxt: count + ' s',
    //           getSmsCodeBtnColor: "#999",
    //           smsCodeDisabled: true
    //         });
    //       } else {
    //         that.setData({
    //           getSmsCodeBtnTxt: "获取验证码",
    //           getSmsCodeBtnColor: "#ff9900",
    //           smsCodeDisabled: false
    //         });
    //         count = 60;
    //         clearInterval(si);
    //       }
    //     }, 1000);
    //   }

    // checkSmsCode: function (param) {
    //   var smsCode = param.smsCode.trim();
    //   var tempSmsCode = '000000';//演示效果临时变量，正式开发需要通过wx.request获取
    //   if (smsCode != tempSmsCode) {
    //     wx.showModal({
    //       title: '提示',
    //       showCancel: false,
    //       content: '请输入正确的短信验证码'
    //     });
    //     return false;
    //   } else {
    //     return true;
    //   }
    // },
    // redirectTo: function (param) {
    //   //需要将param转换为字符串
    //   param = JSON.stringify(param);
    //   wx.redirectTo({
    //     url: '../login/index?param=' + param//参数只能是字符串形式，不能为json对象
    //   })
    let photo = /^1[345768]{1}\d{9}$/; //验证130-139,150-159,180-189号码段的手机号码
    let params = e.detail.value;
    // console.log(params);
    // if (params.username == '') {
    //   showToast("用户名");
    //   this.setData({
    //     usfocus: true
    //   })
    //   return;
    // }
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
    // if (params.password >) {
    //   showToast("密码");
    //   this.setData({
    //     titfocus: true
    //   })
    //   return;
    // }
    // if (!photo.test(params.password)) {
    //   wx.showToast({
    //     title: '密码格式不正确！6-8',
    //     duration: 2000,
    //     icon: "none"
    //   })
    //   this.setData({
    //     phfocus: true
    //   })
    //   return;
    // }
    if (params.smsCode == '') {
      showToast("验证码");
      this.setData({
        adfocus: true
      })
      return;
    }
    // if (params.content == '') {
    //   showToast("备注");
    //   this.setData({
    //     confocus: true
    //   })
    //   return;
    // }
    function showToast(val) {
      wx.showToast({
        title: val + '不能为空',
        duration: 2000,
        icon: "none"
      })
    }
    wx.request({
      url: 'https://g.hbyingluo.com/huiyuan.php',
      method: "POST",
      data: {
        password: params.password,
        phone: params.phone,
        //smsCode: params.smsCode,
      },
      header: {
        'content-type': 'application/x-www-form-urlencoded' // 默认值
      },
      success: function (res) {
        console.log(res.data)
        if (res.data == 1) {
          wx.showToast({
            title: '注册成功',
            icon: 'success',
            duration: 2000
          })
        } else if (res.data == 9) {
          wx.showToast({
            title: '失败：你的手机号已经申请过了!',
            icon: 'none',
            duration: 2000
          })
        } else {
          wx.showToast({
            title: '注册成功',
            icon: 'none',
            duration: 5000
          })

        }

      }
    })
  },
  bindtap1: function (e) {
    var items = this.data.items;
    for (var i = 0; i < items.length; i++) {
      if (items[i].name == this.data.aa) {
        for (var j = 0; j < items.length; j++) {
          // console.log("items[j].checked = ", items[j].checked);
          if (items[j].checked && j != i) {
            items[j].checked = false;
          }
        }
        items[i].checked = !(items[i].checked);
        // console.log("-----:", items);
        // this.setData(this.data.items[i]);

      }
    }
    this.setData({
      items: items
    });
  },

  radioChange: function (e) {
    // for(var i = 0;i<this.data.items.length;i++){
    //   if (this.data.items[i].checked){
    //     // console.log('radio发生change事件，携带value值为：', this.data.items[i].name)
    //   }
    // }
    this.data.aa = e.detail.value;
    //console.log(this.data.aa);
  },
  redirectTo: function (param) {
    //需要将param转换为字符串
    //param = JSON.stringify(param);
    wx.redirectTo({
      url: '../login/index',
    })
  }
})