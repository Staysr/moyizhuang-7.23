// pages/car/index.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    switchChange(e) {
      //console.log('switchChange 事件，值:', e.detail.value)
      wx.showToast({

        title: '这里面可以写很多的文字，比其他的弹窗都要多！',

        icon: 'none',

        duration: 2000//持续的时间

      })
    }
  },
  shezhi:function(){
    wx.navigateTo({
      url: '../shezi/index',
    })
  },
  kefu: function () {
    wx.navigateTo({
      url: '../kefu/index',
    })
  },
   xiaoxi: function () {
    wx.navigateTo({
      url: '../xiaoxi/index',
    })
  },
  cardingdan: function () {
    wx.navigateTo({
      url: '../carquanbu/index',
    })
  },
  xiaoxi: function () {
    wx.navigateTo({
      url: '../xiaoxi/index',
    })
  },
  guanli: function () {
    wx.navigateTo({
      url: '../guanli/index',
    })
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {

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