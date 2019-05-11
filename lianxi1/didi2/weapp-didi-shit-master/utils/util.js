function formatTime(date) {
  var year = date.getFullYear()
  var month = date.getMonth() + 1
  var day = date.getDate()

  var hour = date.getHours()
  var minute = date.getMinutes()
  var second = date.getSeconds()


  return [year, month, day].map(formatNumber).join('/') + ' ' + [hour, minute, second].map(formatNumber).join(':')
}

function formatNumber(n) {
  n = n.toString()
  return n[1] ? n : '0' + n
}
var rootDocment = '';
var AppConf = { 'appid': 'wxbd8a9cc79072eec2', 'appsecret': 'e9807f291aec20e3c21a15a8c18584f5' };
function req(url, data, cb) {
  data.appid = AppConf.appid;
  data.appsecret = AppConf.appsecret;
  wx.request({
    url: rootDocment + url,
    data: data,
    method: 'post',
    header: { 'Content-Type': 'application/x-www-form-urlencoded' },
    success: function (res) {
      return typeof cb == "function" && cb(res.data)
    },
    fail: function () {
      return typeof cb == "function" && cb(false)
      console.log(res);
    }
  })
} 
function getReq(url, data, cb) {
  data.appid = AppConf.appid;
  data.appsecret = AppConf.appsecret;
  wx.request({
    url: rootDocment + url,
    data: data,
    method: 'get',
    header: { 'Content-Type': 'application/x-www-form-urlencoded' },
    success: function (res) {
      return typeof cb == "function" && cb(res.data)
    },
    fail: function () {
      return typeof cb == "function" && cb(false)
    }
  })
}   
module.exports = {
  formatTime: formatTime
}

function regexConfig() {
  var reg = {
    email: /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/,
    phone: /^1(3|4|5|7|8|6)\d{9}$/
  }
  return reg;
}

module.exports = {
  formatTime: formatTime,
  regexConfig: regexConfig,
 
}

