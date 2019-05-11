// pages/need/index.js
Page({
  // formSubmit: function (e) {
  //   console.log('form发生了submit事件，携带数据为：', e.detail.value)
  // },
  // formReset: function () {
  //   console.log('form发生了reset事件')
  // },
  /**
   * 页面的初始数据
   */
  data: {
    selected: true,
    selected1: false,
    selected2: false,
    departure: '出发地',
    destination: '目的地',
    fomttoe:'确定',
    registDisabled: false,
    btnLoading: false,

  },
  selected: function (e) {
    this.setData({
      selected: true,
      selected1: false,
      selected2: false
    })
  },
  selected1: function (e) {
    this.setData({
      selected1: true,
      selected: false,
      selected2: false
    })
  },
  selected2: function (e) {
    this.setData({
      selected2: true,
      selected: false,
      selected1: false
    })
  },
  sexDeparture: function () {
    var that = this;
    wx.chooseLocation({
      success: function (res) {
        that.setData({
          departure: res.address
        })
      }
    })
  },
  sexDestination: function () {
    var that = this;
    wx.chooseLocation({
      success: function (res) {
        that.setData({
          destination: res.address
        })
      }
    })
  },
  onLoad: function (options) {
    this.setData({
      gender: app.globalData.userInfo.gender,
      name: (app.globalData.userInfo.name == '') ? app.globalData.userInfo.nickName : app.globalData.userInfo.name,
      phone: app.globalData.userInfo.phone,
      vehicle: app.globalData.userInfo.vehicle
    })
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (option) {
  },
  formSubmit:function(e){
    let photo = /^1[345768]{1}\d{9}$/;
    let photo1 = /^1[345768]{1}\d{9}$/;
    let params = e.detail.value;
    if(params.phone == '') {
  showToast("手机号");
  this.setData({
    phfocus: true
  })
  return;
}
    if (params.leixing== '') {
      showToast("运送类型");
      this.setData({
        phfocus: true
      })
      return;
    }
  if (params.user == '') {
      showToast("发货姓名");
      this.setData({
        phfocus: true
      })
      return;
    }
    if (params.shu == '') {
      showToast("数量");
      this.setData({
        phfocus: true
      })
      return;
    }
    if (params.qidian == '') {
      showToast("出发地");
      this.setData({
        phfocus: true
      })
      return;
    }
    if (params.zhongdian == '') {
      showToast("终点");
      this.setData({
        phfocus: true
      })
      return;
    }
    if (params.tiji == '') {
      showToast("体积");
      this.setData({
        phfocus: true
      })
      return;
    }
    if (params.zhongliang == '') {
      showToast("重量");
      this.setData({
        phfocus: true
      })
      return;
    }
    if (params.phone1 == '') {
      showToast("收货人的电话");
      this.setData({
        phfocus: true
      })
      return;
    }
    if (params.consignee == '') {
      showToast("收货人的姓名");
      this.setData({
        phfocus: true
      })
      return;
    }
    if (params.beizhu == '') {
      showToast("备注");
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
    if (!photo1.test(params.phone1)) {
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
  url: 'https://g.hbyingluo.com/details.php', //仅为示例，并非真实的接口地址
  method: "POST",
  data: {
    phone: params.phone,
    leixing: params.leixing,
    user: params.user,
    qidian: params.qidian,
    zhongdian: params.zhongdian,
    shu: params.shu,
    tiji: params.tiji,
    zhongliang: params.zhongliang,
    beizhu:params.beizhu,
    phone1: params.phone1,
    consignee: params.consignee
  },
  header: {
    'content-type': 'application/x-www-form-urlencoded' // 默认值
  },

  success: function (res) {
    console.log(res.data)
    //getApp().globalData.header.Session = 'JSESSIONID=' + res.data.sessionId;  //这一句很重要。
    // getApp().globalData.Session = res.data.sessionId;
    // if (res.data.status == 1) {
    //   wx.navigateTo({
    //     url: '../index/index',
    //   })
    // }
    if (res.data.van == 3) {
      wx.navigateTo({
        url: '../advices/advices',
      })
      wx.showToast({
        title: '发布成功',
        duration: 2000,
        icon: "none"
      })
    }else{
      wx.showToast({
        title: '发布失败....',
        duration: 2000,
        icon: "none"
      })
    }
  },

})
  },
  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})