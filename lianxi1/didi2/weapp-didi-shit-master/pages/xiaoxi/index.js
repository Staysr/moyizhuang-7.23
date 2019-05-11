// pages/xiaoxi/index.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    day:'2018-01-01   12:00',
    gear:'河北河道运输有限公司....',
    dingdan: '您有新的订单，请接收',
    qidian:'起点: 石家庄桥西区新胜利大街6号塔坛国际商贸城5号写字',
    zhongdian:'终点: 石家庄长安区谈南路63号睿和中心',
    banben:'新版来袭,积分好礼送不停',
  },
  dingdan:function(){
    wx.navigateTo({
        url: '../carxiangqing/index',
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