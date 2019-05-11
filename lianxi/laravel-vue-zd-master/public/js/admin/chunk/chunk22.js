webpackJsonp([22],{

/***/ 259:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(832)
/* template */
var __vue_template__ = __webpack_require__(834)
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
Component.options.__file = "resources/assets/admin/js/views/common/forget.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-9c181da4", Component.options)
  } else {
    hotAPI.reload("data-v-9c181da4", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 263:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = {
    props: {
        data: {}
    },
    data: function data() {
        return {
            loading: false
        };
    },

    methods: {
        change: function change(visible) {
            if (visible === false) {
                this.$emit('on-change');
            }
        }
    }
};

/***/ }),

/***/ 267:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _http = __webpack_require__(144);

var _http2 = _interopRequireDefault(_http);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
    mixins: [_http2.default],
    methods: {
        unObserver: function unObserver(data) {
            return JSON.parse(JSON.stringify(data));
        },
        updateSubmit: function updateSubmit(name, url) {
            var _this = this;

            this.$refs[name].validate(function (valid) {

                if (valid) {
                    _this.loading = true;
                    _this.$http.put(url, _this.unObserver(_this._data[name])).then(function (res) {
                        _this.$Message.success('Success!');
                        _this.change(false);
                    }).catch(function (res) {
                        _this.formatErrors(res);
                    }).finally(function () {
                        _this.loading = false;
                    });
                } else {
                    _this.$Message.error('验证不通过!');
                }
            });
        },
        createSubmit: function createSubmit(name, url) {
            var _this2 = this;

            this.$refs[name].validate(function (valid) {
                if (valid) {
                    _this2.loading = true;
                    _this2.$http.post(url, _this2._data[name]).then(function (res) {
                        _this2.$Message.success('Success!');
                        _this2.change(false);
                    }).catch(function (res) {
                        _this2.formatErrors(res);
                    }).finally(function () {
                        _this2.loading = false;
                    });
                }
            });
        }
    }
};

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

/***/ 832:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _loginLock = __webpack_require__(350);

var _loginLock2 = _interopRequireDefault(_loginLock);

var _index = __webpack_require__(833);

var _component = __webpack_require__(263);

var _component2 = _interopRequireDefault(_component);

var _form = __webpack_require__(267);

var _form2 = _interopRequireDefault(_form);

var _http = __webpack_require__(144);

var _http2 = _interopRequireDefault(_http);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
    name: 'forget',
    mixins: [_component2.default, _form2.default, _http2.default],
    components: { loginLock: _loginLock2.default },
    data: function data() {
        return {
            seconds: 60,
            disabled: false,
            verifyName: '获取验证码',
            formForget: {
                phone: '',
                code: '',
                password: '',
                password_confirmation: ''
            },
            ruleForget: (0, _index.Validator)(this),
            a: [{
                title: '登录',
                click: 'common.login'
            }]
        };
    },

    methods: {
        verify: function verify(seconds) {
            var _this = this;

            if (this.validatPhone(this.formForget.phone)) {
                if (this.seconds >= seconds) {
                    this.loading = true;
                    this.$http.post('token/sms', { phone: this.formForget.phone }).then(function (res) {
                        _this.$Message.success(res.data.message);
                    }).catch(function (res) {
                        _this.formatErrors(res);
                    }).finally(function () {
                        _this.loading = false;
                    });
                }
                this.setCountdown(seconds);
            }
        },
        validatPhone: function validatPhone(value) {
            if (!value) {
                this.$Message.error('手机号码不能为空');
            } else {
                if (!/^1[34578]\d{9}$/.test(value)) {
                    this.$Message.error('手机号码格式不正确');
                } else {
                    return true;
                }
            }
            return false;
        },
        setCountdown: function setCountdown(seconds) {
            var _this2 = this;

            if (this.seconds === 0) {
                this.disabled = false;
                this.verifyName = '重新获取';
                this.seconds = seconds;
                return;
            } else {
                this.disabled = true;
                this.verifyName = '重新获取(' + this.seconds + 's)';
                this.seconds--;
            }
            setTimeout(function () {
                _this2.setCountdown(seconds);
            }, 1000);
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

/***/ }),

/***/ 833:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});
var Validator = exports.Validator = function Validator(data) {
    var validateConfirm = function validateConfirm(rule, value, callback) {
        if (data.formForget.password !== value) {
            callback(new Error('两次密码不相同'));
        } else {
            callback();
        }
    };

    return {
        phone: [{ required: true, message: '手机号码不能为空', trigger: 'blur' }, { pattern: /^1[34578]\d{9}$/, message: '手机号码格式不正确', trigger: 'blur' }],
        code: [{
            required: true,
            message: '验证码不能为空',
            trigger: 'blur'
        }],
        password: [{
            required: true,
            message: '密码不能为空',
            trigger: 'blur'
        }, {
            min: 6,
            max: 20,
            type: 'string',
            message: '密码必须在 6 到 20 个字符之间',
            trigger: 'blur'
        }],
        password_confirmation: [{ required: true, message: '确认密码不能为空', trigger: 'blur' }, { validator: validateConfirm, trigger: 'blur' }]
    };
};

/***/ }),

/***/ 834:
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
          _vm._v("\n        找回密码\n    ")
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "Form",
        {
          ref: "formForget",
          attrs: { slot: "form", model: _vm.formForget, rules: _vm.ruleForget },
          slot: "form"
        },
        [
          _c(
            "FormItem",
            { attrs: { prop: "phone" } },
            [
              _c(
                "Input",
                {
                  attrs: {
                    type: "text",
                    autocomplete: "off",
                    placeholder: "手机号码"
                  },
                  model: {
                    value: _vm.formForget.phone,
                    callback: function($$v) {
                      _vm.$set(
                        _vm.formForget,
                        "phone",
                        typeof $$v === "string" ? $$v.trim() : $$v
                      )
                    },
                    expression: "formForget.phone"
                  }
                },
                [
                  _c("Icon", {
                    attrs: { slot: "prepend", type: "ios-phone-portrait" },
                    slot: "prepend"
                  }),
                  _vm._v(" "),
                  _c(
                    "a",
                    {
                      attrs: {
                        slot: "append",
                        loading: _vm.loading,
                        disabled: _vm.disabled
                      },
                      on: {
                        click: function($event) {
                          _vm.verify(_vm.seconds)
                        }
                      },
                      slot: "append"
                    },
                    [_vm._v(_vm._s(_vm.verifyName))]
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { prop: "code" } },
            [
              _c(
                "Input",
                {
                  attrs: {
                    type: "text",
                    autocomplete: "off",
                    placeholder: "验证码"
                  },
                  model: {
                    value: _vm.formForget.code,
                    callback: function($$v) {
                      _vm.$set(
                        _vm.formForget,
                        "code",
                        typeof $$v === "string" ? $$v.trim() : $$v
                      )
                    },
                    expression: "formForget.code"
                  }
                },
                [
                  _c("Icon", {
                    attrs: { slot: "prepend", type: "ios-key" },
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
            { attrs: { prop: "password" } },
            [
              _c(
                "Input",
                {
                  attrs: {
                    type: "password",
                    autocomplete: "off",
                    placeholder: "密码"
                  },
                  model: {
                    value: _vm.formForget.password,
                    callback: function($$v) {
                      _vm.$set(
                        _vm.formForget,
                        "password",
                        typeof $$v === "string" ? $$v.trim() : $$v
                      )
                    },
                    expression: "formForget.password"
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
            { attrs: { prop: "password_confirmation" } },
            [
              _c(
                "Input",
                {
                  attrs: {
                    type: "password",
                    autocomplete: "off",
                    placeholder: "确认密码"
                  },
                  model: {
                    value: _vm.formForget.password_confirmation,
                    callback: function($$v) {
                      _vm.$set(
                        _vm.formForget,
                        "password_confirmation",
                        typeof $$v === "string" ? $$v.trim() : $$v
                      )
                    },
                    expression: "formForget.password_confirmation"
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
                      _vm.updateSubmit("formForget", "token/forget")
                    }
                  }
                },
                [_vm._v("确定")]
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-9c181da4", module.exports)
  }
}

/***/ })

});