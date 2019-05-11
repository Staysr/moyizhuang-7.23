'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});


var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _wepy = require('./npm/wepy/lib/wepy.js');

var _wepy2 = _interopRequireDefault(_wepy);

require('./npm/wepy-async-function/index.js');

var _wepyRedux = require('./npm/wepy-redux/lib/index.js');

var _store = require('./store/index.js');

var _store2 = _interopRequireDefault(_store);

var _user = require('./service/user.js');

var _user2 = _interopRequireDefault(_user);

var _util = require('./utils/util.js');

var _config = require('./config/config.js');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _asyncToGenerator(fn) { return function () { var gen = fn.apply(this, arguments); return new Promise(function (resolve, reject) { function step(key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { return Promise.resolve(value).then(function (value) { step("next", value); }, function (err) { step("throw", err); }); } } return step("next"); }); }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var store = (0, _store2.default)();
(0, _wepyRedux.setStore)(store);

var _default = function (_wepy$app) {
  _inherits(_default, _wepy$app);

  function _default() {
    _classCallCheck(this, _default);

    var _this2 = _possibleConstructorReturn(this, (_default.__proto__ || Object.getPrototypeOf(_default)).call(this));

    _this2.config = {
      'pages': ['pages/index', 'pages/check', 'pages/service', 'pages/shop', 'pages/order', 'pages/refund_result', 'pages/ucenter/index', 'pages/ucenter/detail', 'pages/ucenter/idcard'],
      'window': {
        backgroundTextStyle: 'light',
        navigationBarBackgroundColor: '#fff',
        navigationBarTitleText: 'WeChat',
        navigationBarTextStyle: 'black'
      },
      'tabBar': {
        'backgroundColor': '#fafafa',
        'borderStyle': 'white',
        'selectedColor': '#b4282d',
        'color': '#666',
        'list': [{
          'pagePath': 'pages/index',
          'text': '首页',
          'iconPath': './static/image/home.png',
          'selectedIconPath': './static/image/home.png'
        }, {
          'pagePath': 'pages/service',
          'text': '服务',
          'iconPath': './static/image/service.png',
          'selectedIconPath': './static/image/service.png'
        }, {
          'pagePath': 'pages/ucenter/index',
          'text': '我的',
          'iconPath': './static/image/ucenter.png',
          'selectedIconPath': './static/image/ucenter.png'
        }]
      },
      // 需要修改为Promise形式的wxAPI
      'promisify': ['scanCode', 'switchTab', 'navigateTo', 'showModal', 'uploadFile', 'chooseImage', 'getLocation']
    };
    _this2.globalData = {
      userInfo: null
    };

    _this2.Format = function (fmt) {
      var o = {
        'M+': this.getMonth() + 1,
        'd+': this.getDate(),
        'h+': this.getHours(),
        'm+': this.getMinutes(),
        's+': this.getSeconds(),
        'q+': Math.floor((this.getMonth() + 3) / 3),
        'S': this.getMilliseconds()
      };
      if (/(y+)/.test(fmt)) {
        fmt = fmt.replace(RegExp.$1, (this.getFullYear() + '').substr(4 - RegExp.$1.length));
      }
      for (var k in o) {
        if (new RegExp('(' + k + ')').test(fmt)) {
          fmt = fmt.replace(RegExp.$1, RegExp.$1.length === 1 ? o[k] : ('00' + o[k]).substr(('' + o[k]).length));
        }
      }
      return fmt;
    };

    _this2.LeftTimer = function (timestamp) {
      if (!timestamp || typeof timestamp !== 'number' || timestamp < 0) {
        this.string = '0分钟';
        return false;
      }
      this.time = {};
      // 将0-9的数字前面加上0，例1变为01
      this.checkTime = function (i) {
        if (i < 10) {
          i = '0' + i;
        } else {
          i = '' + i;
        }
        return i;
      };
      // 检测是否为 '00'
      this.isEmpty = function (x) {
        if (x === '00') {
          return true;
        }
      };
      // 如“00小时00分钟10秒”这种格式,将转换为“10秒”
      this.checkZero = function () {
        var _this = this;
        var haveFirstNotEmptyValue = false;

        Object.keys(_this.time).forEach(function (key) {
          if (_this.isEmpty(_this.time[key])) {
            _this[key + '_str'] = '';
            if (haveFirstNotEmptyValue) {
              _this[key + '_str'] = _this[key + '_str'];
            }
          } else {
            _this[key + '_str'] = _this[key + '_str'];
            haveFirstNotEmptyValue = true;
          }
        });
      };

      var _this = this;

      this.time.days = parseInt(timestamp / 1000 / 60 / 60 / 24, 10); // 计算剩余的天数
      this.time.hours = parseInt(timestamp / 1000 / 60 / 60 % 24, 10); // 计算剩余的小时
      this.time.minutes = parseInt(timestamp / 1000 / 60 % 60, 10); // 计算剩余的分钟
      this.time.seconds = parseInt(timestamp / 1000 % 60, 10); // 计算剩余的秒数

      Object.keys(_this.time).forEach(function (key) {
        _this.time[key] = _this.checkTime(_this.time[key]);
      });

      this['days_str'] = this.time['days'] + '天';
      this['hours_str'] = this.time['hours'] + '小时';
      this['minutes_str'] = this.time['minutes'] + '分钟';
      this['seconds_str'] = this.time['seconds'] + '秒';

      this.checkZero();
      this.string = '' + this['days_str'] + this['hours_str'] + this['minutes_str'] + this['seconds_str'];
    };

    _this2.use('requestfix');
    return _this2;
  }

  _createClass(_default, [{
    key: 'onLaunch',
    value: function () {
      var _ref = _asyncToGenerator( /*#__PURE__*/regeneratorRuntime.mark(function _callee() {
        var _this3 = this;

        var userInfo, result, setting, times, times_now, loginResult;
        return regeneratorRuntime.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                // 函数Promise化
                this.config['promisify'].forEach(function (item) {
                  wx[item + 'P'] = _this3.wxPromisify(wx[item]);
                });

                Object.assign(Date.prototype, { Format: this.Format });
                Object.assign(Date.prototype, { LeftTimer: this.LeftTimer });

                // 如果没有本地存储用户信息，说明不能通过登录功能获取setting，需要在此手动拉取
                userInfo = wx.getStorageSync('userInfo');

                if (userInfo) {
                  _context.next = 12;
                  break;
                }

                _context.next = 7;
                return (0, _util.request)(_config.urls.SettingGet, {}, 'GET');

              case 7:
                result = _context.sent;
                _context.next = 10;
                return (0, _util.xml2jsP)(result.data);

              case 10:
                setting = _context.sent;

                wx.setStorageSync('setting', setting);

              case 12:

                // 访问计数
                times = wx.getStorageSync('times');
                times_now = void 0;

                if (!times) {
                  times_now = 1;
                } else {
                  times_now = times + 1;
                }
                wx.setStorageSync('times', times_now);

                // 登录
                _context.next = 18;
                return _user2.default.login();

              case 18:
                loginResult = _context.sent;

                console.log('this', this);
                this.$pages['/pages/index'].onShow();
                console.log('loginResult', loginResult);

              case 22:
              case 'end':
                return _context.stop();
            }
          }
        }, _callee, this);
      }));

      function onLaunch() {
        return _ref.apply(this, arguments);
      }

      return onLaunch;
    }()

    // 日期格式化


    // 用时

  }, {
    key: 'wxPromisify',
    value: function wxPromisify(fn) {
      return function () {
        var obj = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

        return new Promise(function (resolve, reject) {
          obj.success = function (res) {
            console.log('Promise success 返回参数：', res);
            resolve(res);
          };
          obj.fail = function (res) {
            console.warn('Promise fail 返回参数：', res);
            reject(res);
          };
          fn(obj); // 执行函数，obj为传入函数的参数
        });
      };
    }
  }, {
    key: 'getUserInfo',
    value: function getUserInfo(cb) {
      var that = this;
      if (this.globalData.userInfo) {
        return this.globalData.userInfo;
      }
      _wepy2.default.getUserInfo({
        success: function success(res) {
          that.globalData.userInfo = res.userInfo;
          cb && cb(res.userInfo);
        }
      });
    }
  }]);

  return _default;
}(_wepy2.default.app);


App(require('./npm/wepy/lib/wepy.js').default.$createApp(_default, {"noPromiseAPI":["createSelectorQuery"]}));
require('./_wepylogs.js')

//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbImFwcC5qcyJdLCJuYW1lcyI6WyJzdG9yZSIsImNvbmZpZyIsImJhY2tncm91bmRUZXh0U3R5bGUiLCJuYXZpZ2F0aW9uQmFyQmFja2dyb3VuZENvbG9yIiwibmF2aWdhdGlvbkJhclRpdGxlVGV4dCIsIm5hdmlnYXRpb25CYXJUZXh0U3R5bGUiLCJnbG9iYWxEYXRhIiwidXNlckluZm8iLCJGb3JtYXQiLCJmbXQiLCJvIiwiZ2V0TW9udGgiLCJnZXREYXRlIiwiZ2V0SG91cnMiLCJnZXRNaW51dGVzIiwiZ2V0U2Vjb25kcyIsIk1hdGgiLCJmbG9vciIsImdldE1pbGxpc2Vjb25kcyIsInRlc3QiLCJyZXBsYWNlIiwiUmVnRXhwIiwiJDEiLCJnZXRGdWxsWWVhciIsInN1YnN0ciIsImxlbmd0aCIsImsiLCJMZWZ0VGltZXIiLCJ0aW1lc3RhbXAiLCJzdHJpbmciLCJ0aW1lIiwiY2hlY2tUaW1lIiwiaSIsImlzRW1wdHkiLCJ4IiwiY2hlY2taZXJvIiwiX3RoaXMiLCJoYXZlRmlyc3ROb3RFbXB0eVZhbHVlIiwiT2JqZWN0Iiwia2V5cyIsImZvckVhY2giLCJrZXkiLCJkYXlzIiwicGFyc2VJbnQiLCJob3VycyIsIm1pbnV0ZXMiLCJzZWNvbmRzIiwidXNlIiwid3giLCJpdGVtIiwid3hQcm9taXNpZnkiLCJhc3NpZ24iLCJEYXRlIiwicHJvdG90eXBlIiwiZ2V0U3RvcmFnZVN5bmMiLCJ1cmxzIiwiU2V0dGluZ0dldCIsInJlc3VsdCIsImRhdGEiLCJzZXR0aW5nIiwic2V0U3RvcmFnZVN5bmMiLCJ0aW1lcyIsInRpbWVzX25vdyIsInVzZXJTZXJ2aWNlIiwibG9naW4iLCJsb2dpblJlc3VsdCIsImNvbnNvbGUiLCJsb2ciLCIkcGFnZXMiLCJvblNob3ciLCJmbiIsIm9iaiIsIlByb21pc2UiLCJyZXNvbHZlIiwicmVqZWN0Iiwic3VjY2VzcyIsInJlcyIsImZhaWwiLCJ3YXJuIiwiY2IiLCJ0aGF0Iiwid2VweSIsImdldFVzZXJJbmZvIiwiYXBwIl0sIm1h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QUNkLGFBQU8sWUFBb0I7QUFBQSxZQUFWQyxHQUFVLHVFQUFKLEVBQUk7O0FBQ3pCLGVBQU8sSUFBSUMsT0FBSixDQUFZLFVBQUNDLE9BQUQsRUFBVUMsTUFBVixFQUFxQjtBQUN0Q0gsY0FBSUksT0FBSixHQUFjLFVBQVVDLEdBQVYsRUFBZTtBQUMzQlYsb0JBQVFDLEdBQVIsQ0FBWSx1QkFBWixFQUFxQ1MsR0FBckM7QUFDQUgsb0JBQVFHLEdBQVI7QUFDRCxXQUhEO0FBSUFMLGNBQUlNLElBQUosR0FBVyxVQUFVRCxHQUFWLEVBQWU7QUFDeEJWLG9CQUFRWSxJQUFSLENBQWEsb0JBQWIsRUFBbUNGLEdBQW5DO0FBQ0FGLG1CQUFPRSxHQUFQO0FBQ0QsV0FIRDtBQUlBTixhQUFHQyxHQUFILEVBVHNDLENBUzlCO0FBQ1QsU0FWTSxDQUFQO0FBV0QsT0FaRDtBQWFEOzs7Z0NBRVdRLEUsRUFBSTtBQUNkLFVBQU1DLE9BQU8sSUFBYjtBQUNBLFVBQUksS0FBSzFFLFVBQUwsQ0FBZ0JDLFFBQXBCLEVBQThCO0FBQzVCLGVBQU8sS0FBS0QsVUFBTCxDQUFnQkMsUUFBdkI7QUFDRDtBQUNEMEUscUJBQUtDLFdBQUwsQ0FBaUI7QUFDZlAsZUFEZSxtQkFDTkMsR0FETSxFQUNEO0FBQ1pJLGVBQUsxRSxVQUFMLENBQWdCQyxRQUFoQixHQUEyQnFFLElBQUlyRSxRQUEvQjtBQUNBd0UsZ0JBQU1BLEdBQUdILElBQUlyRSxRQUFQLENBQU47QUFDRDtBQUpjLE9BQWpCO0FBTUQ7Ozs7RUFqTjBCMEUsZUFBS0UsRyIsImZpbGUiOiJhcHAuanMiLCJzb3VyY2VzQ29udGVudCI6WyJcclxuaW1wb3J0IHdlcHkgZnJvbSAnd2VweSdcclxuaW1wb3J0ICd3ZXB5LWFzeW5jLWZ1bmN0aW9uJ1xyXG5cclxuaW1wb3J0IHsgc2V0U3RvcmUgfSBmcm9tICd3ZXB5LXJlZHV4J1xyXG5pbXBvcnQgY29uZmlnU3RvcmUgZnJvbSAnLi9zdG9yZSdcclxuaW1wb3J0IHVzZXJTZXJ2aWNlIGZyb20gJy4vc2VydmljZS91c2VyJ1xyXG5pbXBvcnQgeyByZXF1ZXN0LCB4bWwyanNQIH0gZnJvbSAnLi91dGlscy91dGlsJ1xyXG5pbXBvcnQgeyB1cmxzIH0gZnJvbSAnLi9jb25maWcvY29uZmlnJ1xyXG5cclxuY29uc3Qgc3RvcmUgPSBjb25maWdTdG9yZSgpXHJcbnNldFN0b3JlKHN0b3JlKVxyXG5cclxuZXhwb3J0IGRlZmF1bHQgY2xhc3MgZXh0ZW5kcyB3ZXB5LmFwcCB7XHJcbiAgY29uZmlnID0ge1xyXG4gICAgJ3BhZ2VzJzogW1xyXG4gICAgICAncGFnZXMvaW5kZXgnLFxyXG4gICAgICAncGFnZXMvY2hlY2snLFxyXG4gICAgICAncGFnZXMvc2VydmljZScsXHJcbiAgICAgICdwYWdlcy9zaG9wJyxcclxuICAgICAgJ3BhZ2VzL29yZGVyJyxcclxuICAgICAgJ3BhZ2VzL3JlZnVuZF9yZXN1bHQnLFxyXG4gICAgICAncGFnZXMvdWNlbnRlci9pbmRleCcsXHJcbiAgICAgICdwYWdlcy91Y2VudGVyL2RldGFpbCcsXHJcbiAgICAgICdwYWdlcy91Y2VudGVyL2lkY2FyZCdcclxuICAgIF0sXHJcbiAgICAnd2luZG93Jzoge1xyXG4gICAgICBiYWNrZ3JvdW5kVGV4dFN0eWxlOiAnbGlnaHQnLFxyXG4gICAgICBuYXZpZ2F0aW9uQmFyQmFja2dyb3VuZENvbG9yOiAnI2ZmZicsXHJcbiAgICAgIG5hdmlnYXRpb25CYXJUaXRsZVRleHQ6ICdXZUNoYXQnLFxyXG4gICAgICBuYXZpZ2F0aW9uQmFyVGV4dFN0eWxlOiAnYmxhY2snXHJcbiAgICB9LFxyXG4gICAgJ3RhYkJhcic6IHtcclxuICAgICAgJ2JhY2tncm91bmRDb2xvcic6ICcjZmFmYWZhJyxcclxuICAgICAgJ2JvcmRlclN0eWxlJzogJ3doaXRlJyxcclxuICAgICAgJ3NlbGVjdGVkQ29sb3InOiAnI2I0MjgyZCcsXHJcbiAgICAgICdjb2xvcic6ICcjNjY2JyxcclxuICAgICAgJ2xpc3QnOiBbXHJcbiAgICAgICAge1xyXG4gICAgICAgICAgJ3BhZ2VQYXRoJzogJ3BhZ2VzL2luZGV4JyxcclxuICAgICAgICAgICd0ZXh0JzogJ+mmlumhtScsXHJcbiAgICAgICAgICAnaWNvblBhdGgnOiAnLi9zdGF0aWMvaW1hZ2UvaG9tZS5wbmcnLFxyXG4gICAgICAgICAgJ3NlbGVjdGVkSWNvblBhdGgnOiAnLi9zdGF0aWMvaW1hZ2UvaG9tZS5wbmcnXHJcbiAgICAgICAgfSxcclxuICAgICAgICB7XHJcbiAgICAgICAgICAncGFnZVBhdGgnOiAncGFnZXMvc2VydmljZScsXHJcbiAgICAgICAgICAndGV4dCc6ICfmnI3liqEnLFxyXG4gICAgICAgICAgJ2ljb25QYXRoJzogJy4vc3RhdGljL2ltYWdlL3NlcnZpY2UucG5nJyxcclxuICAgICAgICAgICdzZWxlY3RlZEljb25QYXRoJzogJy4vc3RhdGljL2ltYWdlL3NlcnZpY2UucG5nJ1xyXG4gICAgICAgIH0sXHJcbiAgICAgICAge1xyXG4gICAgICAgICAgJ3BhZ2VQYXRoJzogJ3BhZ2VzL3VjZW50ZXIvaW5kZXgnLFxyXG4gICAgICAgICAgJ3RleHQnOiAn5oiR55qEJyxcclxuICAgICAgICAgICdpY29uUGF0aCc6ICcuL3N0YXRpYy9pbWFnZS91Y2VudGVyLnBuZycsXHJcbiAgICAgICAgICAnc2VsZWN0ZWRJY29uUGF0aCc6ICcuL3N0YXRpYy9pbWFnZS91Y2VudGVyLnBuZydcclxuICAgICAgICB9XHJcbiAgICAgIF1cclxuICAgIH0sXHJcbiAgICAvLyDpnIDopoHkv67mlLnkuLpQcm9taXNl5b2i5byP55qEd3hBUElcclxuICAgICdwcm9taXNpZnknOiBbXHJcbiAgICAgICdzY2FuQ29kZScsXHJcbiAgICAgICdzd2l0Y2hUYWInLFxyXG4gICAgICAnbmF2aWdhdGVUbycsXHJcbiAgICAgICdzaG93TW9kYWwnLFxyXG4gICAgICAndXBsb2FkRmlsZScsXHJcbiAgICAgICdjaG9vc2VJbWFnZScsXHJcbiAgICAgICdnZXRMb2NhdGlvbidcclxuICAgIF1cclxuICB9XHJcblxyXG4gIGdsb2JhbERhdGEgPSB7XHJcbiAgICB1c2VySW5mbzogbnVsbFxyXG4gIH1cclxuXHJcbiAgY29uc3RydWN0b3IgKCkge1xyXG4gICAgc3VwZXIoKVxyXG4gICAgdGhpcy51c2UoJ3JlcXVlc3RmaXgnKVxyXG4gIH1cclxuXHJcbiAgYXN5bmMgb25MYXVuY2goKSB7XHJcbiAgICAvLyDlh73mlbBQcm9taXNl5YyWXHJcbiAgICB0aGlzLmNvbmZpZ1sncHJvbWlzaWZ5J10uZm9yRWFjaChpdGVtID0+IHtcclxuICAgICAgd3hbaXRlbSArICdQJ10gPSB0aGlzLnd4UHJvbWlzaWZ5KHd4W2l0ZW1dKVxyXG4gICAgfSlcclxuICAgIFxyXG4gICAgT2JqZWN0LmFzc2lnbihEYXRlLnByb3RvdHlwZSwgeyBGb3JtYXQ6IHRoaXMuRm9ybWF0IH0pXHJcbiAgICBPYmplY3QuYXNzaWduKERhdGUucHJvdG90eXBlLCB7IExlZnRUaW1lcjogdGhpcy5MZWZ0VGltZXIgfSlcclxuXHJcbiAgICAvLyDlpoLmnpzmsqHmnInmnKzlnLDlrZjlgqjnlKjmiLfkv6Hmga/vvIzor7TmmI7kuI3og73pgJrov4fnmbvlvZXlip/og73ojrflj5ZzZXR0aW5n77yM6ZyA6KaB5Zyo5q2k5omL5Yqo5ouJ5Y+WXHJcbiAgICBsZXQgdXNlckluZm8gPSB3eC5nZXRTdG9yYWdlU3luYygndXNlckluZm8nKVxyXG4gICAgaWYgKCF1c2VySW5mbykge1xyXG4gICAgICBjb25zdCByZXN1bHQgPSBhd2FpdCByZXF1ZXN0KHVybHMuU2V0dGluZ0dldCwge30sICdHRVQnKVxyXG4gICAgICBjb25zdCBzZXR0aW5nID0gYXdhaXQgeG1sMmpzUChyZXN1bHQuZGF0YSlcclxuICAgICAgd3guc2V0U3RvcmFnZVN5bmMoJ3NldHRpbmcnLCBzZXR0aW5nKVxyXG4gICAgfVxyXG5cclxuICAgIC8vIOiuv+mXruiuoeaVsFxyXG4gICAgY29uc3QgdGltZXMgPSB3eC5nZXRTdG9yYWdlU3luYygndGltZXMnKVxyXG4gICAgbGV0IHRpbWVzX25vdztcclxuICAgIGlmICghdGltZXMpIHtcclxuICAgICAgdGltZXNfbm93ID0gMVxyXG4gICAgfSBlbHNlIHtcclxuICAgICAgdGltZXNfbm93ID0gdGltZXMgKyAxXHJcbiAgICB9XHJcbiAgICB3eC5zZXRTdG9yYWdlU3luYygndGltZXMnLCB0aW1lc19ub3cpXHJcbiAgICBcclxuICAgIC8vIOeZu+W9lVxyXG4gICAgY29uc3QgbG9naW5SZXN1bHQgPSBhd2FpdCB1c2VyU2VydmljZS5sb2dpbigpXHJcbiAgICBjb25zb2xlLmxvZygndGhpcycsIHRoaXMpXHJcbiAgICB0aGlzLiRwYWdlc1snL3BhZ2VzL2luZGV4J10ub25TaG93KClcclxuICAgIGNvbnNvbGUubG9nKCdsb2dpblJlc3VsdCcsIGxvZ2luUmVzdWx0KVxyXG4gIH1cclxuXHJcbiAgLy8g5pel5pyf5qC85byP5YyWXHJcbiAgRm9ybWF0ID0gZnVuY3Rpb24oZm10KSB7XHJcbiAgICBjb25zdCBvID0ge1xyXG4gICAgICAnTSsnOiB0aGlzLmdldE1vbnRoKCkgKyAxLFxyXG4gICAgICAnZCsnOiB0aGlzLmdldERhdGUoKSxcclxuICAgICAgJ2grJzogdGhpcy5nZXRIb3VycygpLFxyXG4gICAgICAnbSsnOiB0aGlzLmdldE1pbnV0ZXMoKSxcclxuICAgICAgJ3MrJzogdGhpcy5nZXRTZWNvbmRzKCksXHJcbiAgICAgICdxKyc6IE1hdGguZmxvb3IoKHRoaXMuZ2V0TW9udGgoKSArIDMpIC8gMyksXHJcbiAgICAgICdTJzogdGhpcy5nZXRNaWxsaXNlY29uZHMoKVxyXG4gICAgfVxyXG4gICAgaWYgKC8oeSspLy50ZXN0KGZtdCkpIHtcclxuICAgICAgZm10ID0gZm10LnJlcGxhY2UoUmVnRXhwLiQxLCAodGhpcy5nZXRGdWxsWWVhcigpICsgJycpLnN1YnN0cig0IC0gUmVnRXhwLiQxLmxlbmd0aCkpXHJcbiAgICB9XHJcbiAgICBmb3IgKHZhciBrIGluIG8pIHtcclxuICAgICAgaWYgKG5ldyBSZWdFeHAoJygnICsgayArICcpJykudGVzdChmbXQpKSB7XHJcbiAgICAgICAgZm10ID0gZm10LnJlcGxhY2UoUmVnRXhwLiQxLCAoUmVnRXhwLiQxLmxlbmd0aCA9PT0gMSkgPyAob1trXSkgOiAoKCcwMCcgKyBvW2tdKS5zdWJzdHIoKCcnICsgb1trXSkubGVuZ3RoKSkpXHJcbiAgICAgIH1cclxuICAgIH1cclxuICAgIHJldHVybiBmbXRcclxuICB9XHJcblxyXG4gIC8vIOeUqOaXtlxyXG4gIExlZnRUaW1lciA9IGZ1bmN0aW9uKHRpbWVzdGFtcCkge1xyXG4gICAgaWYgKCF0aW1lc3RhbXAgfHwgdHlwZW9mIHRpbWVzdGFtcCAhPT0gJ251bWJlcicgfHwgdGltZXN0YW1wIDwgMCkge1xyXG4gICAgICB0aGlzLnN0cmluZyA9ICcw5YiG6ZKfJ1xyXG4gICAgICByZXR1cm4gZmFsc2VcclxuICAgIH1cclxuICAgIHRoaXMudGltZSA9IHt9XHJcbiAgICAvLyDlsIYwLTnnmoTmlbDlrZfliY3pnaLliqDkuIow77yM5L6LMeWPmOS4ujAxXHJcbiAgICB0aGlzLmNoZWNrVGltZSA9IGZ1bmN0aW9uKGkpIHtcclxuICAgICAgaWYgKGkgPCAxMCkge1xyXG4gICAgICAgIGkgPSAnMCcgKyBpXHJcbiAgICAgIH0gZWxzZSB7XHJcbiAgICAgICAgaSA9ICcnICsgaVxyXG4gICAgICB9XHJcbiAgICAgIHJldHVybiBpXHJcbiAgICB9XHJcbiAgICAvLyDmo4DmtYvmmK/lkKbkuLogJzAwJ1xyXG4gICAgdGhpcy5pc0VtcHR5ID0gZnVuY3Rpb24oeCkge1xyXG4gICAgICBpZiAoeCA9PT0gJzAwJykge1xyXG4gICAgICAgIHJldHVybiB0cnVlXHJcbiAgICAgIH1cclxuICAgIH1cclxuICAgIC8vIOWmguKAnDAw5bCP5pe2MDDliIbpkp8xMOenkuKAnei/meenjeagvOW8jyzlsIbovazmjaLkuLrigJwxMOenkuKAnVxyXG4gICAgdGhpcy5jaGVja1plcm8gPSBmdW5jdGlvbigpIHtcclxuICAgICAgY29uc3QgX3RoaXMgPSB0aGlzXHJcbiAgICAgIGxldCBoYXZlRmlyc3ROb3RFbXB0eVZhbHVlID0gZmFsc2VcclxuXHJcbiAgICAgIE9iamVjdC5rZXlzKF90aGlzLnRpbWUpLmZvckVhY2goa2V5ID0+IHtcclxuICAgICAgICBpZiAoX3RoaXMuaXNFbXB0eShfdGhpcy50aW1lW2tleV0pKSB7XHJcbiAgICAgICAgICBfdGhpc1trZXkgKyAnX3N0ciddID0gJydcclxuICAgICAgICAgIGlmIChoYXZlRmlyc3ROb3RFbXB0eVZhbHVlKSB7XHJcbiAgICAgICAgICAgIF90aGlzW2tleSArICdfc3RyJ10gPSBfdGhpc1trZXkgKyAnX3N0ciddXHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgIF90aGlzW2tleSArICdfc3RyJ10gPSBfdGhpc1trZXkgKyAnX3N0ciddXHJcbiAgICAgICAgICBoYXZlRmlyc3ROb3RFbXB0eVZhbHVlID0gdHJ1ZVxyXG4gICAgICAgIH1cclxuICAgICAgfSlcclxuICAgIH1cclxuXHJcbiAgICBjb25zdCBfdGhpcyA9IHRoaXNcclxuXHJcbiAgICB0aGlzLnRpbWUuZGF5cyA9IHBhcnNlSW50KHRpbWVzdGFtcCAvIDEwMDAgLyA2MCAvIDYwIC8gMjQsIDEwKSAvLyDorqHnrpfliankvZnnmoTlpKnmlbBcclxuICAgIHRoaXMudGltZS5ob3VycyA9IHBhcnNlSW50KHRpbWVzdGFtcCAvIDEwMDAgLyA2MCAvIDYwICUgMjQsIDEwKSAvLyDorqHnrpfliankvZnnmoTlsI/ml7ZcclxuICAgIHRoaXMudGltZS5taW51dGVzID0gcGFyc2VJbnQodGltZXN0YW1wIC8gMTAwMCAvIDYwICUgNjAsIDEwKSAvLyDorqHnrpfliankvZnnmoTliIbpkp9cclxuICAgIHRoaXMudGltZS5zZWNvbmRzID0gcGFyc2VJbnQodGltZXN0YW1wIC8gMTAwMCAlIDYwLCAxMCkgLy8g6K6h566X5Ymp5L2Z55qE56eS5pWwXHJcblxyXG4gICAgT2JqZWN0LmtleXMoX3RoaXMudGltZSkuZm9yRWFjaChrZXkgPT4ge1xyXG4gICAgICBfdGhpcy50aW1lW2tleV0gPSBfdGhpcy5jaGVja1RpbWUoX3RoaXMudGltZVtrZXldKVxyXG4gICAgfSlcclxuXHJcbiAgICB0aGlzWydkYXlzX3N0ciddID0gdGhpcy50aW1lWydkYXlzJ10gKyAn5aSpJ1xyXG4gICAgdGhpc1snaG91cnNfc3RyJ10gPSB0aGlzLnRpbWVbJ2hvdXJzJ10gKyAn5bCP5pe2J1xyXG4gICAgdGhpc1snbWludXRlc19zdHInXSA9IHRoaXMudGltZVsnbWludXRlcyddICsgJ+WIhumSnydcclxuICAgIHRoaXNbJ3NlY29uZHNfc3RyJ10gPSB0aGlzLnRpbWVbJ3NlY29uZHMnXSArICfnp5InXHJcblxyXG4gICAgdGhpcy5jaGVja1plcm8oKVxyXG4gICAgdGhpcy5zdHJpbmcgPSBgJHt0aGlzWydkYXlzX3N0ciddfSR7dGhpc1snaG91cnNfc3RyJ119JHt0aGlzWydtaW51dGVzX3N0ciddfSR7dGhpc1snc2Vjb25kc19zdHInXX1gXHJcbiAgfVxyXG5cclxuICB3eFByb21pc2lmeShmbikge1xyXG4gICAgcmV0dXJuIGZ1bmN0aW9uIChvYmogPSB7fSkge1xyXG4gICAgICByZXR1cm4gbmV3IFByb21pc2UoKHJlc29sdmUsIHJlamVjdCkgPT4ge1xyXG4gICAgICAgIG9iai5zdWNjZXNzID0gZnVuY3Rpb24gKHJlcykge1xyXG4gICAgICAgICAgY29uc29sZS5sb2coJ1Byb21pc2Ugc3VjY2VzcyDov5Tlm57lj4LmlbDvvJonLCByZXMpXHJcbiAgICAgICAgICByZXNvbHZlKHJlcylcclxuICAgICAgICB9XHJcbiAgICAgICAgb2JqLmZhaWwgPSBmdW5jdGlvbiAocmVzKSB7XHJcbiAgICAgICAgICBjb25zb2xlLndhcm4oJ1Byb21pc2UgZmFpbCDov5Tlm57lj4LmlbDvvJonLCByZXMpXHJcbiAgICAgICAgICByZWplY3QocmVzKVxyXG4gICAgICAgIH1cclxuICAgICAgICBmbihvYmopIC8vIOaJp+ihjOWHveaVsO+8jG9iauS4uuS8oOWFpeWHveaVsOeahOWPguaVsFxyXG4gICAgICB9KVxyXG4gICAgfVxyXG4gIH1cclxuXHJcbiAgZ2V0VXNlckluZm8oY2IpIHtcclxuICAgIGNvbnN0IHRoYXQgPSB0aGlzXHJcbiAgICBpZiAodGhpcy5nbG9iYWxEYXRhLnVzZXJJbmZvKSB7XHJcbiAgICAgIHJldHVybiB0aGlzLmdsb2JhbERhdGEudXNlckluZm9cclxuICAgIH1cclxuICAgIHdlcHkuZ2V0VXNlckluZm8oe1xyXG4gICAgICBzdWNjZXNzIChyZXMpIHtcclxuICAgICAgICB0aGF0Lmdsb2JhbERhdGEudXNlckluZm8gPSByZXMudXNlckluZm9cclxuICAgICAgICBjYiAmJiBjYihyZXMudXNlckluZm8pXHJcbiAgICAgIH1cclxuICAgIH0pXHJcbiAgfVxyXG59XHJcbiJdfQ==