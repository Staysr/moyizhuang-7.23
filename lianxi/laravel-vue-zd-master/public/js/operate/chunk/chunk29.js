webpackJsonp([29],{

/***/ 1179:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(1893)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(1896)
/* template */
var __vue_template__ = __webpack_require__(1897)
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
Component.options.__file = "resources\\assets\\operate\\js\\views\\deliverdetail\\index.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-6cd5bda7", Component.options)
  } else {
    hotAPI.reload("data-v-6cd5bda7", Component.options)
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

/***/ 1893:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(1894);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(4)("82a69fc0", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-6cd5bda7\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/after-less-loader.js!../../../../../../node_modules/less-loader/dist/cjs.js!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue", function() {
     var newContent = require("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-6cd5bda7\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/after-less-loader.js!../../../../../../node_modules/less-loader/dist/cjs.js!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 1894:
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(1895);

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(3)(content, options);

if(content.locals) module.exports = content.locals;

if(false) {
	module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-6cd5bda7\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/after-less-loader.js!../../../../../../node_modules/less-loader/dist/cjs.js!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue", function() {
		var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-6cd5bda7\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/after-less-loader.js!../../../../../../node_modules/less-loader/dist/cjs.js!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue");

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

/***/ 1895:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.member_detail {\n  height: auto;\n  background: #fff;\n  -webkit-box-sizing: border-box;\n          box-sizing: border-box;\n}\n.member_detail .detail_box {\n  background: #fff;\n}\n.member_detail .detail_box .detail_label,\n.member_detail .detail_box .detail_info {\n  background: #fff;\n  width: 50%;\n  font-size: 0.42666667rem;\n  line-height: 1.30666667rem;\n  float: left;\n  -webkit-box-sizing: border-box;\n          box-sizing: border-box;\n  margin-bottom: 0.26666667rem;\n}\n.member_detail .detail_box .detail_label p,\n.member_detail .detail_box .detail_info p {\n  border-bottom: 0.01333333rem solid #eee;\n}\n.member_detail .detail_box .detail_label p::last-of-type,\n.member_detail .detail_box .detail_info p::last-of-type {\n  border-bottom: transparent;\n}\n.member_detail .detail_box .detail_label {\n  padding-left: 0.26666667rem;\n  color: #999;\n}\n.member_detail .detail_box .detail_info {\n  text-align: right;\n  padding-right: 0.26666667rem;\n}\n.member_detail .detail_box .deliver_detail {\n  background: #fff;\n  width: 100%;\n  font-size: 0.42666667rem;\n  line-height: 1.30666667rem;\n  float: left;\n  -webkit-box-sizing: border-box;\n          box-sizing: border-box;\n  margin-bottom: 0.26666667rem;\n  padding-left: 0.26666667rem;\n  color: #999;\n}\n.member_detail .detail_box .deliver_detail span {\n  font-size: 0.42666667rem;\n  color: #333;\n}\n.member_detail .detail_box .phone a {\n  color: #07Ca61;\n}", ""]);

// exports


/***/ }),

/***/ 1896:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _back = __webpack_require__(1390);

var _back2 = _interopRequireDefault(_back);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
    // name: 'detail',
    components: { Backheader: _back2.default },
    created: function created() {
        this.path = '/profile?id=' + this.$route.query.id;
        this.merchantId = this.$route.query.merchant;
        this.getdata(this.merchantId);
    },
    data: function data() {
        return {
            title: 'zhangsna ',
            path: '',
            merchantId: {},
            list: {}
        };
    },

    methods: {
        getdata: function getdata(e) {
            var _this = this;

            this.$http.get('task/' + e).then(function (res) {
                if (res.status == 200) {
                    _this.list = res.data.data;
                    _this.title = _this.list.driver.name + '出车单详情';
                }
            });
        },
        telphone: function telphone(e) {
            window.location.href = 'tel:' + e;
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

/***/ 1897:
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
      _c("div", { staticClass: "member_detail" }, [
        _c("div", { staticClass: "detail_box clearfix" }, [
          _vm._m(0),
          _vm._v(" "),
          _c("div", { staticClass: "detail_info" }, [
            _c("p", [_vm._v(_vm._s(_vm.list.driver.name))]),
            _vm._v(" "),
            _vm.list.task.type == 1 ? _c("p", [_vm._v("小队长")]) : _vm._e(),
            _vm._v(" "),
            _vm.list.task.type == 2 ? _c("p", [_vm._v("大队长")]) : _vm._e(),
            _vm._v(" "),
            _c(
              "p",
              {
                staticClass: "phone",
                staticStyle: { color: "#07CA61" },
                on: {
                  click: function($event) {
                    _vm.telphone(_vm.list.driver.phone)
                  }
                }
              },
              [
                _vm._v(
                  "\n                        " +
                    _vm._s(_vm.list.driver.phone) +
                    "\n                    "
                )
              ]
            ),
            _vm._v(" "),
            _vm.list.status == 0 ? _c("p", [_vm._v("未签到")]) : _vm._e(),
            _vm._v(" "),
            _vm.list.status == 1 ? _c("p", [_vm._v("已签到")]) : _vm._e(),
            _vm._v(" "),
            _vm.list.status == 2 ? _c("p", [_vm._v("配送中")]) : _vm._e(),
            _vm._v(" "),
            _vm.list.status == 3 ? _c("p", [_vm._v("配送完成")]) : _vm._e(),
            _vm._v(" "),
            _vm.list.status == 4 ? _c("p", [_vm._v("设置不配送")]) : _vm._e(),
            _vm._v(" "),
            _vm.list.status == 5 ? _c("p", [_vm._v("无责任解约")]) : _vm._e(),
            _vm._v(" "),
            _vm.list.status == 6 ? _c("p", [_vm._v("运营取消")]) : _vm._e()
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "detail_box" }, [
          _vm._m(1),
          _vm._v(" "),
          _c("div", { staticClass: "detail_info" }, [
            _c("p", [
              _vm._v(
                _vm._s(
                  _vm.list.car_type.name == null
                    ? "123123"
                    : _vm.list.car_type.name
                )
              )
            ]),
            _vm._v(" "),
            _c("p", [
              _vm._v(
                _vm._s(
                  _vm.list.driver.car_number == null
                    ? "123123"
                    : _vm.list.driver.car_number
                )
              )
            ]),
            _vm._v(" "),
            _c("p", [
              _vm._v(
                _vm._s(
                  _vm.list.merchant.short_name == null
                    ? "123123"
                    : _vm.list.merchant.short_name
                )
              )
            ])
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "detail_box" }, [
          _vm._m(2),
          _vm._v(" "),
          _c("div", { staticClass: "detail_info" }, [
            _c("p", [_vm._v(_vm._s(_vm.list.order_no))]),
            _vm._v(" "),
            _c("p", [_vm._v(_vm._s(_vm.list.arrival_warehouse_time))]),
            _vm._v(" "),
            _c("p", [_vm._v(_vm._s(_vm.list.name))]),
            _vm._v(" "),
            _c("p", [_vm._v(_vm._s(_vm.list.warehouse.title))])
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "detail_box" }, [
          _vm._m(3),
          _vm._v(" "),
          _c("div", { staticClass: "detail_info" }, [
            _c("p", [_vm._v("迟到时间")]),
            _vm._v(" "),
            _c("p", [
              _vm._v(
                _vm._s(_vm.list.punch_time == null ? " " : _vm.list.punch_time)
              )
            ]),
            _vm._v(" "),
            _c("p", [
              _vm._v(
                _vm._s(
                  _vm.list.leaves_warehouse_time == null
                    ? " "
                    : _vm.list.leaves_warehouse_time
                )
              )
            ]),
            _vm._v(" "),
            _c("p", [
              _vm._v(
                _vm._s(
                  _vm.list.finish_time == null ? " " : _vm.list.finish_time
                )
              )
            ])
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "detail_box" }, [
          _vm._m(4),
          _vm._v(" "),
          _c("div", { staticClass: "detail_info" }, [
            _c("p", [_vm._v(_vm._s(_vm.list.point_count))]),
            _vm._v(" "),
            _c("p", [_vm._v(_vm._s(_vm.list.unit_price))])
          ]),
          _vm._v(" "),
          _c("p", { staticClass: "deliver_detail" }, [
            _vm._v(
              "\n                备注                    \n                "
            ),
            _c("br"),
            _c("span", [_vm._v(_vm._s(_vm.list.delivery_point_remark))])
          ])
        ])
      ])
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
      _c("p", [_vm._v("司机姓名")]),
      _vm._v(" "),
      _c("p", [_vm._v("司机类型")]),
      _vm._v(" "),
      _c("p", [_vm._v("司机手机号")]),
      _vm._v(" "),
      _c("p", [_vm._v("出车单状态")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "detail_label" }, [
      _c("p", [_vm._v("车型")]),
      _vm._v(" "),
      _c("p", [_vm._v("车牌号")]),
      _vm._v(" "),
      _c("p", [_vm._v("商户简称")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "detail_label" }, [
      _c("p", [_vm._v("出车单号")]),
      _vm._v(" "),
      _c("p", [_vm._v("到仓时间")]),
      _vm._v(" "),
      _c("p", [_vm._v("线路名称")]),
      _vm._v(" "),
      _c("p", [_vm._v("仓名称")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "detail_label" }, [
      _c("p", [_vm._v("迟到时间")]),
      _vm._v(" "),
      _c("p", [_vm._v("签到时间")]),
      _vm._v(" "),
      _c("p", [_vm._v("离仓时间")]),
      _vm._v(" "),
      _c("p", [_vm._v("配送完成时间")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "detail_label" }, [
      _c("p", [_vm._v("配送点数量")]),
      _vm._v(" "),
      _c("p", [_vm._v("运费")])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-6cd5bda7", module.exports)
  }
}

/***/ })

});