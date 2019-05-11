// pages/guanli/index.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    evalList: [{ tempFilePaths: [0], imgList: [] }],
    evalList: [{ tempFilePaths: [1], imgList: [] }],
    evalList: [{ tempFilePaths: [2], imgList: [] }],
    evalList: [{ tempFilePaths: [3], imgList: [] }],
    registBtnTxt:'保存',
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

  },
  // baocun:function(){
  //  wx.navigateTo({
  //    url: '../car/index',
  //  })
  // },
  joinPicture: function (e) {
    let photo = /^1[345768]{1}\d{9}$/;
    let params = e.detail.value;
    if (params.vehiclename == '') {
      showToast("车主姓名");
      this.setData({
        phfocus: true
      })
      return;
    }
    if (params.vehiclephone == '') {
      showToast("手机号");
      this.setData({
        phfocus: true
      })
      return;
    }
    if (params.vehiclebulk == '') {
      showToast("车厢体积");
      this.setData({
        phfocus: true
      })
      return;
    }
    if (params.vehiclecarrying == '') {
      showToast("车厢载重量");
      this.setData({
        phfocus: true
      })
      return;
    }
    if (!photo.test(params.vehiclephone)) {
      wx.showToast({
        title: '手机号格式不正确！',
        duration: 1000,
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
        duration: 1000,
        icon: "none"
      })
    }
    wx.request({
      url: 'https://g.hbyingluo.com/vehicle.php',
      method: "POST",
      data: {
        vehiclename: params.vehiclename,
        vehiclephone: params.vehiclephone,
        vehiclebulk: params.vehiclebulk,
        vehiclecarrying: params.vehiclecarrying,
      },
      header: {
        'content-type': 'application/x-www-form-urlencoded' // 默认值
      },
      success: function (res) {
        console.log(res.data)
        if (res.data.ve == 3) {
          wx.navigateTo({
            url: '../car/index',
          })
          wx.showToast({
            title: '提交成功',
            duration: 2000,
            icon: "none"
          })
        }
      }
    })
    // var index = e.currentTarget.dataset.index;
    // var evalList = this.data.evalList;
    // var that = this;
    // var imgNumber = evalList[index].tempFilePaths;
    // if (imgNumber.length >= 1) {
    //   wx.showModal({
    //     title: '',
    //     content: '最多上传1张图片',
    //     showCancel: false,
    //   })
    //   return;
    // }
  //   wx.showActionSheet({
  //     itemList: ["从相册中选择", "拍照"],
  //     itemColor: "#f7982a",
  //     success: function (res) {
  //       if (!res.cancel) {
  //         if (res.tapIndex == 0) {
  //           that.chooseWxImage("album", imgNumber);
  //         } else if (res.tapIndex == 1) {
  //           that.chooseWxImage("camera", imgNumber);
  //         }
  //       }
  //     }
  //   })
  // },
  // chooseWxImage: function (type, list) {
  //   var img = list;
  //   var len = img.length;
  //   var that = this;
  //   var evalList = this.data.evalList;
  //   wx.chooseImage({
  //     count: 3,
  //     sizeType: ["original", "compressed"],
  //     sourceType: [type],
  //     success: function (res) {
  //       var addImg = res.tempFilePaths;
  //       var addLen = addImg.length;
  //       if ((len + addLen) > 3) {
  //         for (var i = 0; i < (addLen - len); i++) {
  //           var str = {};
  //           str.pic = addImg[i];
  //           img.push(str);
  //         }
  //       } else {
  //         for (var j = 0; j < addLen; j++) {
  //           var str = {};
  //           str.pic = addImg[j];
  //           img.push(str);
  //         }
  //       }
  //       that.setData({
  //         evalList: evalList
  //       })
  //       that.upLoadImg(img);
  //     },
  //   })
  // },
  // upLoadImg: function (list) {
  //   var that = this;
  //   this.upload(that, list);
  // },
  // //多张图片上传
  // upload: function (page, path) {
  //   var that = this;
  //   var curImgList = [];
  //   for (var i = 0; i < path.length; i++) {
  //     wx.showToast({
  //       icon: "loading",
  //       title: "正在上传"
  //     }),
  //       wx.uploadFile({
  //         url: app.globalData.subDomain + '/API/AppletApi.aspx',//接口处理在下面有写
  //         filePath: path[i].pic,
  //         name: 'file',
  //         header: { "Content-Type": "multipart/form-data" },
  //         formData: {
  //           douploadpic: '1'
  //         },
  //         success: function (res) {
  //           curImgList.push(res.data);
  //           var evalList = that.data.evalList;
  //           evalList[0].imgList = curImgList;
  //           that.setData({
  //             evalList: evalList
  //           })
  //           if (res.statusCode != 200) {
  //             wx.showModal({
  //               title: '提示',
  //               content: '上传失败',
  //               showCancel: false
  //             })
  //             return;
  //           }
  //           var data = res.data
  //           page.setData({  //上传成功修改显示头像
  //             src: path[0]
  //           })
  //         },
  //         fail: function (e) {
  //           wx.showModal({
  //             title: '提示',
  //             content: '上传失败',
  //             showCancel: false
  //           })
  //         },
  //         complete: function () {
  //           wx.hideToast();  //隐藏Toast
  //         }
  //       })
  //   }
  // },
  // //删除图片
  // clearImg: function (e) {
  //   var index = e.currentTarget.dataset.index;
  //   var evalList = this.data.evalList;
  //   var img = evalList[0].tempFilePaths;
  //   img.splice(index, 1);
  //   this.setData({
  //     evalList: evalList
  //   })
  //   this.upLoadImg(img);
  },
})