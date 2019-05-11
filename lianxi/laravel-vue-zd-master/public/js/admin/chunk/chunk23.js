webpackJsonp([23],{

/***/ 258:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(830)
/* template */
var __vue_template__ = __webpack_require__(831)
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
Component.options.__file = "resources/assets/admin/js/views/common/Login.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-17c84118", Component.options)
  } else {
    hotAPI.reload("data-v-17c84118", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 350:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(351)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(353)
/* template */
var __vue_template__ = __webpack_require__(354)
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
Component.options.__file = "resources/assets/admin/js/views/common/components/lock/login-lock.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-d0e6ec8a", Component.options)
  } else {
    hotAPI.reload("data-v-d0e6ec8a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 351:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(352);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("6e256a4a", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-d0e6ec8a\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../../../node_modules/_sass-loader@6.0.7@sass-loader/lib/loader.js!../../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./login-lock.vue", function() {
     var newContent = require("!!../../../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-d0e6ec8a\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../../../node_modules/_sass-loader@6.0.7@sass-loader/lib/loader.js!../../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./login-lock.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 352:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.login {\n  width: 100%;\n  height: 100%;\n  background-image: url(\"/images/admin/bg.jpg\");\n  background-size: cover;\n  background-position: 50%;\n  position: relative;\n}\n.login .login-con {\n    position: absolute;\n    right: 160px;\n    top: 50%;\n    -webkit-transform: translateY(-60%);\n    transform: translateY(-60%);\n    width: 300px;\n}\n.login .login-con .form-con {\n      padding: 10px 0 0;\n}\n.login .login-con .login-tip {\n      font-size: 10px;\n      text-align: center;\n      color: #c3c3c3;\n}\n", ""]);

// exports


/***/ }),

/***/ 353:
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

/***/ 354:
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-d0e6ec8a", module.exports)
  }
}

/***/ }),

/***/ 830:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _loginLock = __webpack_require__(350);

var _loginLock2 = _interopRequireDefault(_loginLock);

var _http = __webpack_require__(144);

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

/***/ 831:
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-17c84118", module.exports)
  }
}

/***/ })

});