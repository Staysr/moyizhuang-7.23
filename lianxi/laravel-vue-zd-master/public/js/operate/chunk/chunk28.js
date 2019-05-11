webpackJsonp([28],{

/***/ 1180:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(1898)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(1901)
/* template */
var __vue_template__ = __webpack_require__(1902)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources\\assets\\operate\\js\\views\\memberdetail\\index.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-86b4de14", Component.options)
  } else {
    hotAPI.reload("data-v-86b4de14", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1390:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(1391)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(1394)
/* template */
var __vue_template__ = __webpack_require__(1395)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources\\assets\\operate\\js\\views\\components\\header\\back.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-c3ec9a36", Component.options)
  } else {
    hotAPI.reload("data-v-c3ec9a36", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1391:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(1392);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(4)("658bd8d0", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../node_modules/style-loader/index.js!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-c3ec9a36\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../../node_modules/vux-loader/src/after-less-loader.js!../../../../../../../node_modules/less-loader/dist/cjs.js!../../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./back.vue", function() {
     var newContent = require("!!../../../../../../../node_modules/style-loader/index.js!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-c3ec9a36\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../../node_modules/vux-loader/src/after-less-loader.js!../../../../../../../node_modules/less-loader/dist/cjs.js!../../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./back.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 1392:
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(1393);

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(3)(content, options);

if(content.locals) module.exports = content.locals;

if(false) {
	module.hot.accept("!!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-c3ec9a36\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../../node_modules/vux-loader/src/after-less-loader.js!../../../../../../../node_modules/less-loader/dist/cjs.js!../../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./back.vue", function() {
		var newContent = require("!!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-c3ec9a36\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../../node_modules/vux-loader/src/after-less-loader.js!../../../../../../../node_modules/less-loader/dist/cjs.js!../../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./back.vue");

		if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];

		var locals = (function(a, b) {
			var key, idx = 0;

			for(key in a) {
				if(!b || a[key] !== b[key]) return false;
				idx++;
			}

			for(key in b) idx--;

			return idx === 0;
		}(content.locals, newContent.locals));

		if(!locals) throw new Error('Aborting CSS HMR due to changed css-modules locals.');

		update(newContent);
	});

	module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 1393:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.back {\n  width: 100%;\n  text-align: center;\n}\n.back .title {\n  line-height: 1.2rem;\n  font-size: 0.48rem;\n  color: #333;\n  position: relative;\n}\n.back .title::after {\n  display: inline-block;\n  content: \" \";\n  height: 0.33333333rem;\n  width: 0.33333333rem;\n  border-width: 0.05333333rem 0.05333333rem 0 0;\n  border-color: #c7c7cc;\n  border-style: solid;\n  -webkit-transform: rotate(222deg);\n          transform: rotate(222deg);\n  position: absolute;\n  left: 0.4rem;\n  top: 38%;\n}", ""]);

// exports


/***/ }),

/***/ 1394:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});
//
//
//
//
//
//
//
//
//
//

exports.default = {
    name: 'back',
    props: {
        title: {
            type: String
        },
        path: {
            type: String
        }
    },
    data: function data() {
        return {};
    }
};

/***/ }),

/***/ 1395:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c(
      "header",
      { staticClass: "back" },
      [
        _c("router-link", { attrs: { to: _vm.path } }, [
          _c("div", { staticClass: "title" }, [_vm._v(_vm._s(_vm.title))])
        ])
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-c3ec9a36", module.exports)
  }
}

/***/ }),

/***/ 1898:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(1899);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(4)("eb8be2ca", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-86b4de14\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/after-less-loader.js!../../../../../../node_modules/less-loader/dist/cjs.js!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue", function() {
     var newContent = require("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-86b4de14\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/after-less-loader.js!../../../../../../node_modules/less-loader/dist/cjs.js!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 1899:
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(1900);

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(3)(content, options);

if(content.locals) module.exports = content.locals;

if(false) {
	module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-86b4de14\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/after-less-loader.js!../../../../../../node_modules/less-loader/dist/cjs.js!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue", function() {
		var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-86b4de14\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/after-less-loader.js!../../../../../../node_modules/less-loader/dist/cjs.js!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue");

		if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];

		var locals = (function(a, b) {
			var key, idx = 0;

			for(key in a) {
				if(!b || a[key] !== b[key]) return false;
				idx++;
			}

			for(key in b) idx--;

			return idx === 0;
		}(content.locals, newContent.locals));

		if(!locals) throw new Error('Aborting CSS HMR due to changed css-modules locals.');

		update(newContent);
	});

	module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 1900:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.member_detail {\n  height: auto;\n  -webkit-box-sizing: border-box;\n          box-sizing: border-box;\n}\n.member_detail .detail_title {\n  background: #fff;\n  font-size: 0.42666667rem;\n  color: #333;\n  padding-left: 0.26666667rem;\n  line-height: 1.32rem;\n  border-bottom: 0.01333333rem solid #eee;\n  padding-top: 0.26666667rem;\n}\n.member_detail .detail_title::after {\n  content: '';\n  height: 0.26666667rem;\n  width: 100%;\n  background: #eee;\n  position: absolute;\n  top: 10.4rem;\n  left: 0;\n}\n.member_detail .small_detail_box {\n  background: #fff;\n}\n.member_detail .small_detail_box .detail_label,\n.member_detail .small_detail_box .detail_info {\n  background: #fff;\n  /*width: 50%;*/\n  font-size: 0.37333333rem;\n  line-height: 0.90666667rem;\n  float: left;\n  -webkit-box-sizing: border-box;\n          box-sizing: border-box;\n  margin-bottom: 0.26666667rem;\n}\n.member_detail .small_detail_box .detail_label {\n  width: 30%;\n  color: #999;\n  padding-left: 0.26666667rem;\n}\n.member_detail .small_detail_box .detail_info {\n  width: 70%;\n  color: #666;\n  text-align: right;\n  padding-right: 0.26666667rem;\n}\n.member_detail .small_detail_box .detail_info p {\n  white-space: nowrap;\n  overflow: hidden;\n}\n.member_detail .detail_box {\n  background: #fff;\n}\n.member_detail .detail_box .detail_title {\n  font-size: 0.42666667rem;\n  color: #333;\n  line-height: 1.32rem;\n  border-bottom: 0.01333333rem solid #eee;\n  padding-left: 0.26666667rem;\n  margin-bottom: 0.26666667rem;\n}\n.member_detail .detail_box .detail_label,\n.member_detail .detail_box .detail_info {\n  background: #fff;\n  width: 50%;\n  font-size: 0.42666667rem;\n  line-height: 1.30666667rem;\n  float: left;\n  -webkit-box-sizing: border-box;\n          box-sizing: border-box;\n  margin-bottom: 0.26666667rem;\n}\n.member_detail .detail_box .detail_label p,\n.member_detail .detail_box .detail_info p {\n  width: 100%;\n  height: 1.30666667rem;\n  border-bottom: 0.01333333rem solid #eee;\n  overflow: hidden;\n}\n.member_detail .detail_box .detail_label p::last-of-type,\n.member_detail .detail_box .detail_info p::last-of-type {\n  border-bottom: transparent;\n}\n.member_detail .detail_box .detail_label {\n  padding-left: 0.26666667rem;\n  color: #999;\n}\n.member_detail .detail_box .detail_info {\n  text-align: right;\n  padding-right: 0.26666667rem;\n}\n.member_detail .detail_box .detail_info p {\n  overflow: hidden;\n}\n.member_detail .detail_box .phone a {\n  color: #07Ca61;\n}", ""]);

// exports


/***/ }),

/***/ 1901:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _back = __webpack_require__(1390);

var _back2 = _interopRequireDefault(_back);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
    name: 'detail',
    components: { Backheader: _back2.default },
    created: function created() {
        this.path = '/membermap?id=' + this.$route.query.id;
        this.getdata(this.$route.query.memberid);
    },
    data: function data() {
        return {
            title: '',
            path: '',
            list: {}
        };
    },

    computed: {
        taskOrders: function taskOrders() {
            return this.list.task_orders || [];
        },
        orderslist: function orderslist() {
            return this.list.orders || [];
        }
    },
    methods: {
        getdata: function getdata(e) {
            var _this = this;

            this.$http.get('map/' + e).then(function (res) {
                if (res.status == 200) {
                    _this.list = res.data.data;
                    _this.title = '出车单详情-' + _this.list.name;
                }
            });
        }
    }
}; //
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/***/ }),

/***/ 1902:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c("Backheader", { attrs: { title: _vm.title, path: _vm.path } }),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "member_detail" },
        [
          _c("div", { staticClass: "detail_box clearfix" }, [
            _vm._m(0),
            _vm._v(" "),
            _c("div", { staticClass: "detail_info" }, [
              _c("p", [_vm._v(_vm._s(_vm.list.name))]),
              _vm._v(" "),
              _c("p", [_vm._v(_vm._s(_vm.list.car_number))]),
              _vm._v(" "),
              _vm.list.is_work == 0 ? _c("p", [_vm._v(" 未出车")]) : _vm._e(),
              _vm._v(" "),
              _vm.list.is_work == 1 ? _c("p", [_vm._v(" 已出车")]) : _vm._e(),
              _vm._v(" "),
              _vm.list.is_work == 0 && _vm.list.is_big_work == 0
                ? _c("p", [_vm._v("空闲")])
                : _vm._e(),
              _vm._v(" "),
              _vm.list.is_work == 1 && _vm.list.is_big_work == 0
                ? _c("p", [_vm._v("小B业务运单中")])
                : _vm._e(),
              _vm._v(" "),
              _vm.list.is_work == 1 && _vm.list.is_big_work == 1
                ? _c("p", [_vm._v("大B业务运单中")])
                : _vm._e(),
              _vm._v(" "),
              _vm.taskOrders.length > 0
                ? _c("p", [
                    _vm._v("有(" + _vm._s(_vm.taskOrders.length) + ")单")
                  ])
                : _c("p", [_vm._v("无")]),
              _vm._v(" "),
              _c("p", [
                _vm._v(
                  _vm._s(
                    _vm.list.position ? _vm.list.position.createTime : "  "
                  )
                )
              ]),
              _vm._v(" "),
              _c("p", [
                _vm._v(
                  _vm._s(_vm.list.position ? _vm.list.position.address : "  ")
                )
              ])
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "detail_title" }, [
            _vm._v(
              "\n                今日共" +
                _vm._s(_vm.orderslist.length) +
                "个订单\n            "
            )
          ]),
          _vm._v(" "),
          _vm._l(_vm.orderslist, function(item) {
            return _c("div", { staticClass: "small_detail_box" }, [
              _vm._m(1, true),
              _vm._v(" "),
              _c("div", { staticClass: "detail_info" }, [
                _c("p", [_vm._v(_vm._s(item.order_no ? item.order_no : "  "))]),
                _vm._v(" "),
                _c("p", [
                  _vm._v(
                    _vm._s(item.appointment_time ? item.appointment_time : "  ")
                  )
                ]),
                _vm._v(" "),
                _c("p", [
                  _vm._v(_vm._s(item.reach_time ? item.reach_time : "2323232"))
                ]),
                _vm._v(" "),
                _c("p", [
                  _vm._v(_vm._s(item.start_time ? item.start_time : "232323"))
                ]),
                _vm._v(" "),
                _c("p", [
                  _vm._v(_vm._s(item.start_address ? item.start_address : "  "))
                ]),
                _vm._v(" "),
                _c("p", [
                  _vm._v(_vm._s(item.end_address ? item.end_address : "  "))
                ]),
                _vm._v(" "),
                _c("p", [
                  _vm._v(_vm._s(item.total_fee ? item.total_fee : " "))
                ]),
                _vm._v(" "),
                _c("p", [
                  _vm._v(
                    _vm._s(
                      item.estimate_distance ? item.estimate_distance : "  "
                    )
                  )
                ]),
                _vm._v(" "),
                item.order_status == 0
                  ? _c("p", [_vm._v("等待分配司机")])
                  : _vm._e(),
                _vm._v(" "),
                item.order_status == 1
                  ? _c("p", [_vm._v("司机已分配")])
                  : _vm._e(),
                _vm._v(" "),
                item.order_status == 2
                  ? _c("p", [_vm._v("司机到达发货地")])
                  : _vm._e(),
                _vm._v(" "),
                item.order_status == 3
                  ? _c("p", [_vm._v("订单进行中")])
                  : _vm._e(),
                _vm._v(" "),
                item.order_status == 4
                  ? _c("p", [_vm._v("用户取消订单")])
                  : _vm._e(),
                _vm._v(" "),
                item.order_status == 5
                  ? _c("p", [_vm._v("运营取消订单")])
                  : _vm._e(),
                _vm._v(" "),
                item.order_status == 6
                  ? _c("p", [_vm._v("行程结束待支付")])
                  : _vm._e(),
                _vm._v(" "),
                item.order_status == 7
                  ? _c("p", [_vm._v("行程结束已支付")])
                  : _vm._e(),
                _vm._v(" "),
                item.order_status == 8
                  ? _c("p", [_vm._v("订单已评价")])
                  : _vm._e(),
                _vm._v(" "),
                item.order_status == 9
                  ? _c("p", [_vm._v("订单超时自动关闭")])
                  : _vm._e(),
                _vm._v(" "),
                item.order_status == 10
                  ? _c("p", [_vm._v("用户有责取消未支付")])
                  : _vm._e(),
                _vm._v(" "),
                item.order_status == 11
                  ? _c("p", [_vm._v("用户有责取消已支付")])
                  : _vm._e()
              ])
            ])
          })
        ],
        2
      )
    ],
    1
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "detail_label" }, [
      _c("p", [_vm._v("姓名")]),
      _vm._v(" "),
      _c("p", [_vm._v("车牌号")]),
      _vm._v(" "),
      _c("p", [_vm._v("出车状态")]),
      _vm._v(" "),
      _c("p", [_vm._v("空闲状态")]),
      _vm._v(" "),
      _c("p", [_vm._v("是否有大B单")]),
      _vm._v(" "),
      _c("p", [_vm._v("定位时间")]),
      _vm._v(" "),
      _c("p", [_vm._v("当前位置")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "detail_label" }, [
      _c("p", [_vm._v("订单编号")]),
      _vm._v(" "),
      _c("p", [_vm._v("预约时间")]),
      _vm._v(" "),
      _c("p", [_vm._v("到达时间")]),
      _vm._v(" "),
      _c("p", [_vm._v("开始时间")]),
      _vm._v(" "),
      _c("p", [_vm._v("起始地点")]),
      _vm._v(" "),
      _c("p", [_vm._v("结束地点")]),
      _vm._v(" "),
      _c("p", [_vm._v("订单金额")]),
      _vm._v(" "),
      _c("p", [_vm._v("订单里程")]),
      _vm._v(" "),
      _c("p", [_vm._v("订单状态")])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-86b4de14", module.exports)
  }
}

/***/ })

});