webpackJsonp([31],{

/***/ 1205:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(2329)
/* template */
var __vue_template__ = __webpack_require__(2330)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
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
Component.options.__file = "resources\\assets\\admin\\js\\views\\common\\Login.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-4bc13190", Component.options)
  } else {
    hotAPI.reload("data-v-4bc13190", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1457:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(1458)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(1461)
/* template */
var __vue_template__ = __webpack_require__(1462)
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
Component.options.__file = "resources\\assets\\admin\\js\\views\\common\\components\\lock\\login-lock.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-a1f6588a", Component.options)
  } else {
    hotAPI.reload("data-v-a1f6588a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1458:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(1459);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(4)("b4e6da90", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../../node_modules/style-loader/index.js!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-a1f6588a\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../../../node_modules/sass-loader/lib/loader.js!../../../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./login-lock.vue", function() {
     var newContent = require("!!../../../../../../../../node_modules/style-loader/index.js!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-a1f6588a\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../../../node_modules/sass-loader/lib/loader.js!../../../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./login-lock.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 1459:
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(1460);

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(3)(content, options);

if(content.locals) module.exports = content.locals;

if(false) {
	module.hot.accept("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-a1f6588a\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../../../node_modules/sass-loader/lib/loader.js!../../../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./login-lock.vue", function() {
		var newContent = require("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-a1f6588a\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../../../node_modules/sass-loader/lib/loader.js!../../../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./login-lock.vue");

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

/***/ 1460:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.login {\n  width: 100%;\n  height: 100%;\n  background-image: url(\"/images/admin/bg.jpg\");\n  background-size: cover;\n  background-position: 50%;\n  position: relative;\n}\n.login .login-con {\n  position: absolute;\n  right: 2.13333333rem;\n  top: 50%;\n  -webkit-transform: translateY(-60%);\n  transform: translateY(-60%);\n  width: 4rem;\n}\n.login .login-con .form-con {\n  padding: 0.13333333rem 0 0;\n}\n.login .login-con .login-tip {\n  font-size: 0.13333333rem;\n  text-align: center;\n  color: #c3c3c3;\n}", ""]);

// exports


/***/ }),

/***/ 1461:
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
//
//
//
//
//
//
//
//

exports.default = {
    name: 'login-lock',
    components: {},
    data: function data() {
        return {};
    },

    props: ['message'],
    methods: {
        go: function go(name) {
            this.$router.push({ name: name });
        }
    }
};

/***/ }),

/***/ 1462:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "login" }, [
    _c(
      "div",
      { staticClass: "login-con" },
      [
        _c("Card", { attrs: { bordered: false } }, [
          _c(
            "p",
            { attrs: { slot: "title" }, slot: "title" },
            [_vm._t("title")],
            2
          ),
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "form-con" },
            [
              _vm._t("form"),
              _vm._v(" "),
              _vm._l(_vm.message, function(item) {
                return _c("p", { staticClass: "login-tip" }, [
                  _c(
                    "a",
                    {
                      attrs: { slot: "extra" },
                      on: {
                        click: function($event) {
                          _vm.go(item.click)
                        }
                      },
                      slot: "extra"
                    },
                    [_vm._v(_vm._s(item.title))]
                  ),
                  _vm._v(" 舟到后台管理系统\n                ")
                ])
              })
            ],
            2
          )
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
    require("vue-hot-reload-api")      .rerender("data-v-a1f6588a", module.exports)
  }
}

/***/ }),

/***/ 2329:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _loginLock = __webpack_require__(1457);

var _loginLock2 = _interopRequireDefault(_loginLock);

var _http = __webpack_require__(217);

var _http2 = _interopRequireDefault(_http);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

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

exports.default = {
    name: 'login',
    mixins: [_http2.default],
    components: {
        loginLock: _loginLock2.default
    },
    data: function data() {
        return {
            form: {
                phone: '',
                password: ''
            },
            a: [{
                title: '找回密码？',
                click: 'common.forget'
            }]
        };
    },

    methods: {
        login: function login(name) {
            var _this = this;

            this.$refs[name].validate(function (valid) {
                if (valid) {
                    _this.$http.post('token', _this.form).then(function (res) {
                        _this.$cache.set('token', res.data.data.access_token, { exp: res.data.data.expires_in });
                        _this.$router.replace({ name: 'common.home' });
                    }).catch(function (res) {
                        _this.formatErrors(res);
                    });
                }
            });
        }
    }
};

/***/ }),

/***/ 2330:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "login-lock",
    { attrs: { message: _vm.a } },
    [
      _c(
        "p",
        { attrs: { slot: "title" }, slot: "title" },
        [
          _c("Icon", { attrs: { type: "log-in" } }),
          _vm._v("\n        欢迎登录\n    ")
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "Form",
        { ref: "form", attrs: { slot: "form", model: _vm.form }, slot: "form" },
        [
          _c(
            "FormItem",
            {
              attrs: {
                prop: "phone",
                rules: {
                  required: true,
                  message: "手机号必须填写！",
                  trigger: "blur"
                }
              }
            },
            [
              _c(
                "Input",
                {
                  attrs: {
                    type: "text",
                    autocomplete: "off",
                    placeholder: "Phone"
                  },
                  model: {
                    value: _vm.form.phone,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "phone", $$v)
                    },
                    expression: "form.phone"
                  }
                },
                [
                  _c("Icon", {
                    attrs: { slot: "prepend", type: "ios-phone-portrait" },
                    slot: "prepend"
                  })
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            {
              attrs: {
                prop: "password",
                rules: {
                  required: true,
                  message: "密码不能为空！",
                  min: 6,
                  max: 20,
                  trigger: "blur"
                }
              }
            },
            [
              _c(
                "Input",
                {
                  attrs: {
                    type: "password",
                    autocomplete: "off",
                    placeholder: "Password"
                  },
                  on: {
                    "on-enter": function($event) {
                      _vm.login("form")
                    }
                  },
                  model: {
                    value: _vm.form.password,
                    callback: function($$v) {
                      _vm.$set(_vm.form, "password", $$v)
                    },
                    expression: "form.password"
                  }
                },
                [
                  _c("Icon", {
                    attrs: { slot: "prepend", type: "ios-lock" },
                    slot: "prepend"
                  })
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            [
              _c(
                "Button",
                {
                  attrs: { type: "primary", long: "" },
                  on: {
                    click: function($event) {
                      _vm.login("form")
                    }
                  }
                },
                [_vm._v("登录")]
              )
            ],
            1
          )
        ],
        1
      )
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
    require("vue-hot-reload-api")      .rerender("data-v-4bc13190", module.exports)
  }
}

/***/ })

});