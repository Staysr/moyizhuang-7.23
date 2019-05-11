webpackJsonp([27],{

/***/ 1174:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(1656)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(1659)
/* template */
var __vue_template__ = __webpack_require__(1660)
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
Component.options.__file = "resources\\assets\\operate\\js\\views\\home.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-b7f76f18", Component.options)
  } else {
    hotAPI.reload("data-v-b7f76f18", Component.options)
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

/***/ 1436:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(1477)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(1480)
/* template */
var __vue_template__ = __webpack_require__(1481)
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
Component.options.__file = "resources\\assets\\operate\\js\\views\\components\\memebrlist\\index.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-c23603d6", Component.options)
  } else {
    hotAPI.reload("data-v-c23603d6", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1477:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(1478);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(4)("0c0bad5f", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../node_modules/style-loader/index.js!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-c23603d6\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../../node_modules/vux-loader/src/after-less-loader.js!../../../../../../../node_modules/less-loader/dist/cjs.js!../../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue", function() {
     var newContent = require("!!../../../../../../../node_modules/style-loader/index.js!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-c23603d6\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../../node_modules/vux-loader/src/after-less-loader.js!../../../../../../../node_modules/less-loader/dist/cjs.js!../../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 1478:
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(1479);

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(3)(content, options);

if(content.locals) module.exports = content.locals;

if(false) {
	module.hot.accept("!!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-c23603d6\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../../node_modules/vux-loader/src/after-less-loader.js!../../../../../../../node_modules/less-loader/dist/cjs.js!../../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue", function() {
		var newContent = require("!!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-c23603d6\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../../node_modules/vux-loader/src/after-less-loader.js!../../../../../../../node_modules/less-loader/dist/cjs.js!../../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue");

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

/***/ 1479:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.layout .testmeber {\n  list-style: none;\n  padding: 0 0.26666667rem;\n  background: #fff;\n  text-align: left;\n}\n.layout .testmeber li {\n  width: 100%;\n  border-bottom: 0.01333333rem solid #D9D9D9;\n  position: relative;\n}\n.layout .testmeber li a {\n  display: inline-block;\n  width: 100%;\n  height: auto;\n}\n.layout .testmeber li::before {\n  height: 0.26666667rem;\n  width: 0.26666667rem;\n  display: inline-block;\n  border-radius: 50%;\n  background: #07CA61;\n  content: \"\";\n  position: absolute;\n  top: 50%;\n  -webkit-transform: translateY(-50%);\n          transform: translateY(-50%);\n}\n.layout .testmeber li p {\n  display: inline-block;\n  margin-left: 0.66666667rem;\n}\n.layout .testmeber li p span {\n  font-size: 0.42666667rem;\n  line-height: 1.49333333rem;\n  color: #333;\n}\n.layout .testmeber li p span:last-child {\n  color: #999;\n}\n.layout .testmeber li img {\n  width: 0.22rem;\n  height: 0.37333333rem;\n  position: absolute;\n  right: 0.13333333rem;\n  top: 50%;\n  -webkit-transform: translateY(-50%);\n          transform: translateY(-50%);\n}\n.layout .testmeber li:first-of-type {\n  border-right: none;\n}", ""]);

// exports


/***/ }),

/***/ 1480:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; }; //
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

var _vuex = __webpack_require__(126);

exports.default = {
    name: 'memberlist',
    props: ['list'],
    computed: _extends({}, (0, _vuex.mapState)(['cycleleader'])),
    methods: {
        goMemberMap: function goMemberMap(item) {
            var memid = item.small_id;
            if (memid == undefined) {
                this.$emit('leaderid', item);
            } else {
                if (item.small_id == this.cycleleader.small_id) {
                    this.$store.commit('getcycleleader', item);
                } else if (item.small_id != this.cycleleader) {
                    this.$store.commit('getcycleleader', item);
                }
            }
        }
    }
};

/***/ }),

/***/ 1481:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c("div", { staticClass: "layout testone" }, [
      _c(
        "ul",
        { staticClass: "testmeber" },
        _vm._l(_vm.list, function(item) {
          return _c(
            "li",
            {
              on: {
                click: function($event) {
                  _vm.goMemberMap(item)
                }
              }
            },
            [
              _c("p", { staticStyle: { display: "inline-block" } }, [
                _c("span", [_vm._v(_vm._s(item.name))]),
                _vm._v(" "),
                _c("span", [_vm._v("(大队长)")])
              ]),
              _vm._v(" "),
              _c("img", {
                attrs: {
                  src: __webpack_require__(1482),
                  alt: ""
                }
              })
            ]
          )
        })
      )
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-c23603d6", module.exports)
  }
}

/***/ }),

/***/ 1482:
/***/ (function(module, exports) {

module.exports = "/images/leftarrow.png?56cd5ac380af64f524192eeef9ce036d";

/***/ }),

/***/ 1656:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(1657);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(4)("1c16e46b", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/style-loader/index.js!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-b7f76f18\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../node_modules/vux-loader/src/after-less-loader.js!../../../../../node_modules/less-loader/dist/cjs.js!../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./home.vue", function() {
     var newContent = require("!!../../../../../node_modules/style-loader/index.js!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-b7f76f18\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../node_modules/vux-loader/src/after-less-loader.js!../../../../../node_modules/less-loader/dist/cjs.js!../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./home.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 1657:
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(1658);

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(3)(content, options);

if(content.locals) module.exports = content.locals;

if(false) {
	module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-b7f76f18\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../node_modules/vux-loader/src/after-less-loader.js!../../../../../node_modules/less-loader/dist/cjs.js!../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./home.vue", function() {
		var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-b7f76f18\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../node_modules/vux-loader/src/after-less-loader.js!../../../../../node_modules/less-loader/dist/cjs.js!../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./home.vue");

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

/***/ 1658:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "", ""]);

// exports


/***/ }),

/***/ 1659:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; }; //
//
//
//
//
//
//

var _back = __webpack_require__(1390);

var _back2 = _interopRequireDefault(_back);

var _index = __webpack_require__(1436);

var _index2 = _interopRequireDefault(_index);

var _vuex = __webpack_require__(126);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
    components: { Memberlist: _index2.default, Backheader: _back2.default },
    created: function created() {
        var _this = this;

        this.$http.get('driver/big').then(function (res) {
            if (res.status == 200) {
                _this.list = res.data.data;
            }
        });
    },
    data: function data() {
        return {
            title: '大队长列表',
            list: [],
            path: ''
        };
    },

    methods: {
        leaderid: function leaderid(id) {
            this.$cache.set('userInfo', id);
            this.$router.push({
                name: 'membermap'
            });
        }
    },
    computed: _extends({}, (0, _vuex.mapState)(['id', 'getcycleleader']))
};

/***/ }),

/***/ 1660:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { attrs: { id: "testone" } },
    [
      _c("Backheader", { attrs: { title: _vm.title, path: _vm.path } }),
      _vm._v(" "),
      _c("Memberlist", {
        attrs: { list: _vm.list },
        on: { leaderid: _vm.leaderid }
      })
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-b7f76f18", module.exports)
  }
}

/***/ })

});