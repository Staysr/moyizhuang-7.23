webpackJsonp([25],{

/***/ 240:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(517)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(519)
/* template */
var __vue_template__ = __webpack_require__(521)
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
Component.options.__file = "resources/assets/admin/js/views/sysconfig/config/index.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-aa0ed290", Component.options)
  } else {
    hotAPI.reload("data-v-aa0ed290", Component.options)
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

/***/ 517:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(518);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("3f68d078", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-aa0ed290\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../../node_modules/_sass-loader@6.0.7@sass-loader/lib/loader.js!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./index.vue", function() {
     var newContent = require("!!../../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-aa0ed290\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../../node_modules/_sass-loader@6.0.7@sass-loader/lib/loader.js!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./index.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 518:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "", ""]);

// exports


/***/ }),

/***/ 519:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _update = __webpack_require__(520);

var _form = __webpack_require__(267);

var _form2 = _interopRequireDefault(_form);

var _http = __webpack_require__(144);

var _http2 = _interopRequireDefault(_http);

var _component = __webpack_require__(263);

var _component2 = _interopRequireDefault(_component);

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

exports.default = {
    name: 'index',
    mixins: [_form2.default, _http2.default, _component2.default],
    data: function data() {
        return {
            formUpdate: {
                driver_sign_before_time: 0,
                driver_sign_after_time: 0,
                driver_sign_radius: 0,
                driver_dispatch_after_warehouse: 0,
                master_driver_not_dispatch_before_warehouse: 0,
                temp_driver_not_dispatch_before_warehouse: 0,
                master_driver_task_free_driver_before_warehouse: 0,
                temp_driver_task_free_driver_before_warehouse: 0,
                master_driver_quote_latest_time: 0,
                master_driver_reach_earliest_time: 0,
                change_master_driver_latest_time_before_work: 0,
                master_driver_quote_lastest_time: 0,
                master_driver_quote_time_more_now: 0,
                master_driver_quote_time_add: 0,
                master_driver_quote_time_sub: 0,
                temp_driver_quote_earliest_time: 0,
                temp_driver_reach_earliest_time: 0,
                change_temp_driver_latest_time_before_work: 0,
                temp_driver_quote_lastest_time: 0,
                temp_driver_quote_time_more_now: 0,
                temp_driver_quote_time_more_add: 0,
                temp_driver_quote_time_more_sub: 0,
                task_conflict_time: 0,
                percentage: 0,
                update_offer_count: 0,
                cancel_offer_count: 0,
                cancel_offer_frozen_time: 0,
                is_send_leader: 0,
                sms_before_warehouse_time: 0
            },
            configUpdate: (0, _update.Validator)(this)
        };
    },
    mounted: function mounted() {
        this.$nextTick(function () {
            var _this = this;

            this.$http.get('config/index').then(function (res) {
                _this.formUpdate = Object.assign(_this.unObserver(_this.formUpdate), res.data.data);
            }).catch(function (err) {
                _this.formatErrors(err);
            });
        });
    }
};

/***/ }),

/***/ 520:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});
var Validator = exports.Validator = function Validator(data) {
    var rule = [{
        required: true,
        type: 'number',
        message: '不能为空',
        trigger: 'change'
    }];
    return {
        driver_sign_before_time: rule,
        driver_sign_after_time: rule,
        driver_sign_radius: rule,
        driver_dispatch_after_warehouse: rule,
        master_driver_not_dispatch_before_warehouse: rule,
        temp_driver_not_dispatch_before_warehouse: rule,
        master_driver_task_free_driver_before_warehouse: rule,
        temp_driver_task_free_driver_before_warehouse: rule,
        master_driver_quote_latest_time: rule,
        master_driver_reach_earliest_time: rule,
        change_master_driver_latest_time_before_work: rule,
        master_driver_quote_lastest_time: rule,
        master_driver_quote_time_more_now: rule,
        master_driver_quote_time_add: rule,
        master_driver_quote_time_sub: rule,
        temp_driver_quote_earliest_time: rule,
        temp_driver_reach_earliest_time: rule,
        change_temp_driver_latest_time_before_work: rule,
        temp_driver_quote_lastest_time: rule,
        temp_driver_quote_time_more_now: rule,
        temp_driver_quote_time_more_add: rule,
        temp_driver_quote_time_more_sub: rule,
        task_conflict_time: rule,
        percentage: rule,
        update_offer_count: rule,
        cancel_offer_count: rule,
        cancel_offer_frozen_time: rule,
        sms_before_warehouse_time: rule
    };
};

/***/ }),

/***/ 521:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c("Card", [
        _c(
          "p",
          { attrs: { slot: "title" }, slot: "title" },
          [
            _c("Icon", { attrs: { type: "ios-settings-strong" } }),
            _vm._v("\n            系统配置\n        ")
          ],
          1
        ),
        _vm._v(" "),
        _c(
          "div",
          [
            _c(
              "Form",
              {
                ref: "formUpdate",
                attrs: {
                  model: _vm.formUpdate,
                  "label-width": 335,
                  rules: _vm.configUpdate
                }
              },
              [
                _c(
                  "Card",
                  [
                    _c(
                      "p",
                      [
                        _c("Icon", { attrs: { type: "ios-list-outline" } }),
                        _vm._v(
                          "\n                        基本设置\n                    "
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "FormItem",
                      { attrs: { label: "允许司机签到时间为到仓前：" } },
                      [
                        _c(
                          "Row",
                          [
                            _c(
                              "Col",
                              { attrs: { span: "3" } },
                              [
                                _c(
                                  "FormItem",
                                  {
                                    attrs: { prop: "driver_sign_before_time" }
                                  },
                                  [
                                    _c("InputNumber", {
                                      attrs: { min: 0, max: 999, step: 0.1 },
                                      model: {
                                        value:
                                          _vm.formUpdate
                                            .driver_sign_before_time,
                                        callback: function($$v) {
                                          _vm.$set(
                                            _vm.formUpdate,
                                            "driver_sign_before_time",
                                            $$v
                                          )
                                        },
                                        expression:
                                          "formUpdate.driver_sign_before_time"
                                      }
                                    }),
                                    _vm._v(
                                      "\n                                小时， 到仓后\n                            "
                                    )
                                  ],
                                  1
                                )
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "Col",
                              { attrs: { span: "3" } },
                              [
                                _c(
                                  "FormItem",
                                  { attrs: { prop: "driver_sign_after_time" } },
                                  [
                                    _c("InputNumber", {
                                      attrs: { min: 0, max: 999, step: 0.1 },
                                      model: {
                                        value:
                                          _vm.formUpdate.driver_sign_after_time,
                                        callback: function($$v) {
                                          _vm.$set(
                                            _vm.formUpdate,
                                            "driver_sign_after_time",
                                            $$v
                                          )
                                        },
                                        expression:
                                          "formUpdate.driver_sign_after_time"
                                      }
                                    }),
                                    _vm._v(
                                      "\n                                小时\n                            "
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
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "FormItem",
                      {
                        attrs: {
                          label: "允许司机签到范围为仓库半径：",
                          prop: "driver_sign_radius"
                        }
                      },
                      [
                        _c("InputNumber", {
                          attrs: { min: 0, max: 999, step: 0.1 },
                          model: {
                            value: _vm.formUpdate.driver_sign_radius,
                            callback: function($$v) {
                              _vm.$set(
                                _vm.formUpdate,
                                "driver_sign_radius",
                                $$v
                              )
                            },
                            expression: "formUpdate.driver_sign_radius"
                          }
                        }),
                        _vm._v(
                          "\n                        公里\n                    "
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "FormItem",
                      {
                        attrs: {
                          label: "允许司机操作配送完成为离仓后：",
                          prop: "driver_dispatch_after_warehouse"
                        }
                      },
                      [
                        _c("InputNumber", {
                          attrs: { min: 0, max: 999, step: 0.1 },
                          model: {
                            value:
                              _vm.formUpdate.driver_dispatch_after_warehouse,
                            callback: function($$v) {
                              _vm.$set(
                                _vm.formUpdate,
                                "driver_dispatch_after_warehouse",
                                $$v
                              )
                            },
                            expression:
                              "formUpdate.driver_dispatch_after_warehouse"
                          }
                        }),
                        _vm._v(
                          "\n                        小时\n                    "
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "FormItem",
                      {
                        attrs: {
                          label: "主司机设置不配送需要在到仓前：",
                          prop: "master_driver_not_dispatch_before_warehouse"
                        }
                      },
                      [
                        _c("InputNumber", {
                          attrs: { min: 0, max: 999, step: 0.1 },
                          model: {
                            value:
                              _vm.formUpdate
                                .master_driver_not_dispatch_before_warehouse,
                            callback: function($$v) {
                              _vm.$set(
                                _vm.formUpdate,
                                "master_driver_not_dispatch_before_warehouse",
                                $$v
                              )
                            },
                            expression:
                              "formUpdate.master_driver_not_dispatch_before_warehouse"
                          }
                        }),
                        _vm._v(
                          "\n                        小时\n                    "
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "FormItem",
                      {
                        attrs: {
                          label: "临时司机设置不配送需要在到仓前：",
                          prop: "temp_driver_not_dispatch_before_warehouse"
                        }
                      },
                      [
                        _c("InputNumber", {
                          attrs: { min: 0, max: 999, step: 0.1 },
                          model: {
                            value:
                              _vm.formUpdate
                                .temp_driver_not_dispatch_before_warehouse,
                            callback: function($$v) {
                              _vm.$set(
                                _vm.formUpdate,
                                "temp_driver_not_dispatch_before_warehouse",
                                $$v
                              )
                            },
                            expression:
                              "formUpdate.temp_driver_not_dispatch_before_warehouse"
                          }
                        }),
                        _vm._v(
                          "\n                        小时\n                    "
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "FormItem",
                      {
                        attrs: {
                          label: "主司机任务无责任解约司机需要在到仓前：",
                          prop:
                            "master_driver_task_free_driver_before_warehouse"
                        }
                      },
                      [
                        _c("InputNumber", {
                          attrs: { min: 0, max: 999, step: 0.1 },
                          model: {
                            value:
                              _vm.formUpdate
                                .master_driver_task_free_driver_before_warehouse,
                            callback: function($$v) {
                              _vm.$set(
                                _vm.formUpdate,
                                "master_driver_task_free_driver_before_warehouse",
                                $$v
                              )
                            },
                            expression:
                              "formUpdate.master_driver_task_free_driver_before_warehouse"
                          }
                        }),
                        _vm._v(
                          "\n                        小时\n                    "
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "FormItem",
                      {
                        attrs: {
                          label: "临时司机任务无责任解约司机需要在到仓前：",
                          prop: "temp_driver_task_free_driver_before_warehouse"
                        }
                      },
                      [
                        _c("InputNumber", {
                          attrs: { min: 0, max: 999, step: 0.1 },
                          model: {
                            value:
                              _vm.formUpdate
                                .temp_driver_task_free_driver_before_warehouse,
                            callback: function($$v) {
                              _vm.$set(
                                _vm.formUpdate,
                                "temp_driver_task_free_driver_before_warehouse",
                                $$v
                              )
                            },
                            expression:
                              "formUpdate.temp_driver_task_free_driver_before_warehouse"
                          }
                        }),
                        _vm._v(
                          "\n                        小时\n                    "
                        )
                      ],
                      1
                    )
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "Card",
                  [
                    _c(
                      "p",
                      [
                        _c("Icon", { attrs: { type: "ios-list-outline" } }),
                        _vm._v(
                          "\n                        主司机（任务）时间设置\n                    "
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "FormItem",
                      {
                        attrs: {
                          label: "最早报价截止时间：",
                          prop: "master_driver_quote_latest_time"
                        }
                      },
                      [
                        _c("InputNumber", {
                          attrs: { min: 0, max: 999, step: 0.1 },
                          model: {
                            value:
                              _vm.formUpdate.master_driver_quote_latest_time,
                            callback: function($$v) {
                              _vm.$set(
                                _vm.formUpdate,
                                "master_driver_quote_latest_time",
                                $$v
                              )
                            },
                            expression:
                              "formUpdate.master_driver_quote_latest_time"
                          }
                        }),
                        _vm._v(
                          "\n                        小时\n                    "
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "FormItem",
                      {
                        attrs: {
                          label: "最早到仓时间：",
                          prop: "master_driver_reach_earliest_time"
                        }
                      },
                      [
                        _c("InputNumber", {
                          attrs: { min: 0, max: 999, step: 0.1 },
                          model: {
                            value:
                              _vm.formUpdate.master_driver_reach_earliest_time,
                            callback: function($$v) {
                              _vm.$set(
                                _vm.formUpdate,
                                "master_driver_reach_earliest_time",
                                $$v
                              )
                            },
                            expression:
                              "formUpdate.master_driver_reach_earliest_time"
                          }
                        }),
                        _vm._v(
                          "\n                        小时\n                    "
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "FormItem",
                      {
                        attrs: {
                          label: "选司机截止时间为上岗前：",
                          prop: "change_master_driver_latest_time_before_work"
                        }
                      },
                      [
                        _c("InputNumber", {
                          attrs: { min: 0, max: 999, step: 0.1 },
                          model: {
                            value:
                              _vm.formUpdate
                                .change_master_driver_latest_time_before_work,
                            callback: function($$v) {
                              _vm.$set(
                                _vm.formUpdate,
                                "change_master_driver_latest_time_before_work",
                                $$v
                              )
                            },
                            expression:
                              "formUpdate.change_master_driver_latest_time_before_work"
                          }
                        }),
                        _vm._v(
                          "\n                        小时\n                    "
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "FormItem",
                      {
                        attrs: {
                          label: "司机报价最晚截止时间：",
                          prop: "master_driver_quote_lastest_time"
                        }
                      },
                      [
                        _c("InputNumber", {
                          attrs: { min: 0, max: 999, step: 0.1 },
                          model: {
                            value:
                              _vm.formUpdate.master_driver_quote_lastest_time,
                            callback: function($$v) {
                              _vm.$set(
                                _vm.formUpdate,
                                "master_driver_quote_lastest_time",
                                $$v
                              )
                            },
                            expression:
                              "formUpdate.master_driver_quote_lastest_time"
                          }
                        }),
                        _vm._v(
                          "\n                        小时\n                    "
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "FormItem",
                      {
                        attrs: {
                          label:
                            "默认司机报价截止时间，如果到仓时间距离现在时间大于："
                        }
                      },
                      [
                        _c(
                          "Row",
                          [
                            _c(
                              "Col",
                              { attrs: { span: "4" } },
                              [
                                _c(
                                  "FormItem",
                                  {
                                    attrs: {
                                      prop: "master_driver_quote_time_more_now"
                                    }
                                  },
                                  [
                                    _c("InputNumber", {
                                      attrs: { min: 0, max: 999, step: 0.1 },
                                      model: {
                                        value:
                                          _vm.formUpdate
                                            .master_driver_quote_time_more_now,
                                        callback: function($$v) {
                                          _vm.$set(
                                            _vm.formUpdate,
                                            "master_driver_quote_time_more_now",
                                            $$v
                                          )
                                        },
                                        expression:
                                          "formUpdate.master_driver_quote_time_more_now"
                                      }
                                    }),
                                    _vm._v(
                                      "\n                                小时， 则现在时间加\n                            "
                                    )
                                  ],
                                  1
                                )
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "Col",
                              { attrs: { span: "5" } },
                              [
                                _c(
                                  "FormItem",
                                  {
                                    attrs: {
                                      prop: "master_driver_quote_time_add"
                                    }
                                  },
                                  [
                                    _c("InputNumber", {
                                      attrs: { min: 0, max: 999, step: 0.1 },
                                      model: {
                                        value:
                                          _vm.formUpdate
                                            .master_driver_quote_time_add,
                                        callback: function($$v) {
                                          _vm.$set(
                                            _vm.formUpdate,
                                            "master_driver_quote_time_add",
                                            $$v
                                          )
                                        },
                                        expression:
                                          "formUpdate.master_driver_quote_time_add"
                                      }
                                    }),
                                    _vm._v(
                                      "\n                                小时； 如果小于，则到仓时间减\n                            "
                                    )
                                  ],
                                  1
                                )
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "Col",
                              { attrs: { span: "3" } },
                              [
                                _c(
                                  "FormItem",
                                  {
                                    attrs: {
                                      prop: "master_driver_quote_time_sub"
                                    }
                                  },
                                  [
                                    _c("InputNumber", {
                                      attrs: { min: 0, max: 999, step: 0.1 },
                                      model: {
                                        value:
                                          _vm.formUpdate
                                            .master_driver_quote_time_sub,
                                        callback: function($$v) {
                                          _vm.$set(
                                            _vm.formUpdate,
                                            "master_driver_quote_time_sub",
                                            $$v
                                          )
                                        },
                                        expression:
                                          "formUpdate.master_driver_quote_time_sub"
                                      }
                                    }),
                                    _vm._v(
                                      "\n                                小时\n                            "
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
                      ],
                      1
                    )
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "Card",
                  [
                    _c(
                      "p",
                      [
                        _c("Icon", { attrs: { type: "ios-list-outline" } }),
                        _vm._v(
                          "\n                        临时司机（任务）时间设置\n                    "
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "FormItem",
                      {
                        attrs: {
                          label: "最早报价截止时间：",
                          prop: "temp_driver_quote_earliest_time"
                        }
                      },
                      [
                        _c("InputNumber", {
                          attrs: { min: 0, max: 999, step: 0.1 },
                          model: {
                            value:
                              _vm.formUpdate.temp_driver_quote_earliest_time,
                            callback: function($$v) {
                              _vm.$set(
                                _vm.formUpdate,
                                "temp_driver_quote_earliest_time",
                                $$v
                              )
                            },
                            expression:
                              "formUpdate.temp_driver_quote_earliest_time"
                          }
                        }),
                        _vm._v(
                          "\n                        小时\n                    "
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "FormItem",
                      {
                        attrs: {
                          label: "最早到仓时间：",
                          prop: "temp_driver_reach_earliest_time"
                        }
                      },
                      [
                        _c("InputNumber", {
                          attrs: { min: 0, max: 999, step: 0.1 },
                          model: {
                            value:
                              _vm.formUpdate.temp_driver_reach_earliest_time,
                            callback: function($$v) {
                              _vm.$set(
                                _vm.formUpdate,
                                "temp_driver_reach_earliest_time",
                                $$v
                              )
                            },
                            expression:
                              "formUpdate.temp_driver_reach_earliest_time"
                          }
                        }),
                        _vm._v(
                          "\n                        小时\n                    "
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "FormItem",
                      {
                        attrs: {
                          label: "选司机截止时间为司机报价截止后：",
                          prop: "change_temp_driver_latest_time_before_work"
                        }
                      },
                      [
                        _c("InputNumber", {
                          attrs: { min: 0, max: 999, step: 0.1 },
                          model: {
                            value:
                              _vm.formUpdate
                                .change_temp_driver_latest_time_before_work,
                            callback: function($$v) {
                              _vm.$set(
                                _vm.formUpdate,
                                "change_temp_driver_latest_time_before_work",
                                $$v
                              )
                            },
                            expression:
                              "formUpdate.change_temp_driver_latest_time_before_work"
                          }
                        }),
                        _vm._v(
                          "\n                        小时\n                    "
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "FormItem",
                      {
                        attrs: {
                          label: "司机报价最晚截止时间：",
                          prop: "temp_driver_quote_lastest_time"
                        }
                      },
                      [
                        _c("InputNumber", {
                          attrs: { min: 0, max: 999, step: 0.1 },
                          model: {
                            value:
                              _vm.formUpdate.temp_driver_quote_lastest_time,
                            callback: function($$v) {
                              _vm.$set(
                                _vm.formUpdate,
                                "temp_driver_quote_lastest_time",
                                $$v
                              )
                            },
                            expression:
                              "formUpdate.temp_driver_quote_lastest_time"
                          }
                        }),
                        _vm._v(
                          "\n                        小时\n                    "
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "FormItem",
                      {
                        attrs: {
                          label:
                            "默认司机报价截止时间，如果到仓时间距离现在时间大于："
                        }
                      },
                      [
                        _c(
                          "Row",
                          [
                            _c(
                              "Col",
                              { attrs: { span: "4" } },
                              [
                                _c(
                                  "FormItem",
                                  {
                                    attrs: {
                                      prop: "temp_driver_quote_time_more_now"
                                    }
                                  },
                                  [
                                    _c("InputNumber", {
                                      attrs: { min: 0, max: 999, step: 0.1 },
                                      model: {
                                        value:
                                          _vm.formUpdate
                                            .temp_driver_quote_time_more_now,
                                        callback: function($$v) {
                                          _vm.$set(
                                            _vm.formUpdate,
                                            "temp_driver_quote_time_more_now",
                                            $$v
                                          )
                                        },
                                        expression:
                                          "formUpdate.temp_driver_quote_time_more_now"
                                      }
                                    }),
                                    _vm._v(
                                      "\n                                小时， 则现在时间加\n                            "
                                    )
                                  ],
                                  1
                                )
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "Col",
                              { attrs: { span: "5" } },
                              [
                                _c(
                                  "FormItem",
                                  {
                                    attrs: {
                                      prop: "temp_driver_quote_time_more_add"
                                    }
                                  },
                                  [
                                    _c("InputNumber", {
                                      attrs: { min: 0, max: 999, step: 0.1 },
                                      model: {
                                        value:
                                          _vm.formUpdate
                                            .temp_driver_quote_time_more_add,
                                        callback: function($$v) {
                                          _vm.$set(
                                            _vm.formUpdate,
                                            "temp_driver_quote_time_more_add",
                                            $$v
                                          )
                                        },
                                        expression:
                                          "formUpdate.temp_driver_quote_time_more_add"
                                      }
                                    }),
                                    _vm._v(
                                      "\n                                小时； 如果小于，则到仓时间减\n                            "
                                    )
                                  ],
                                  1
                                )
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "Col",
                              { attrs: { span: "3" } },
                              [
                                _c(
                                  "FormItem",
                                  {
                                    attrs: {
                                      prop: "temp_driver_quote_time_more_sub"
                                    }
                                  },
                                  [
                                    _c("InputNumber", {
                                      attrs: { min: 0, max: 999, step: 0.1 },
                                      model: {
                                        value:
                                          _vm.formUpdate
                                            .temp_driver_quote_time_more_sub,
                                        callback: function($$v) {
                                          _vm.$set(
                                            _vm.formUpdate,
                                            "temp_driver_quote_time_more_sub",
                                            $$v
                                          )
                                        },
                                        expression:
                                          "formUpdate.temp_driver_quote_time_more_sub"
                                      }
                                    }),
                                    _vm._v(
                                      "\n                                小时\n                            "
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
                      ],
                      1
                    )
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "Card",
                  [
                    _c(
                      "p",
                      [
                        _c("Icon", { attrs: { type: "ios-list-outline" } }),
                        _vm._v(
                          "\n                        其他项\n                    "
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "FormItem",
                      {
                        attrs: {
                          label: "任务冲突时间：",
                          prop: "task_conflict_time"
                        }
                      },
                      [
                        _c("InputNumber", {
                          attrs: { min: 0, max: 999, step: 0.1 },
                          model: {
                            value: _vm.formUpdate.task_conflict_time,
                            callback: function($$v) {
                              _vm.$set(
                                _vm.formUpdate,
                                "task_conflict_time",
                                $$v
                              )
                            },
                            expression: "formUpdate.task_conflict_time"
                          }
                        }),
                        _vm._v(
                          "\n                        小时\n                    "
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "FormItem",
                      {
                        attrs: {
                          label: "管理费提成比率(报价的X%)：",
                          prop: "percentage"
                        }
                      },
                      [
                        _c("InputNumber", {
                          attrs: { min: 0, max: 999, step: 0.1 },
                          model: {
                            value: _vm.formUpdate.percentage,
                            callback: function($$v) {
                              _vm.$set(_vm.formUpdate, "percentage", $$v)
                            },
                            expression: "formUpdate.percentage"
                          }
                        }),
                        _vm._v(
                          "\n                        %\n                    "
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "FormItem",
                      {
                        attrs: {
                          label: "司机报价可修改次数：",
                          prop: "update_offer_count"
                        }
                      },
                      [
                        _c("InputNumber", {
                          attrs: { min: 0, max: 999, step: 1 },
                          model: {
                            value: _vm.formUpdate.update_offer_count,
                            callback: function($$v) {
                              _vm.$set(
                                _vm.formUpdate,
                                "update_offer_count",
                                $$v
                              )
                            },
                            expression: "formUpdate.update_offer_count"
                          }
                        }),
                        _vm._v(
                          "\n                        次\n                    "
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "FormItem",
                      { attrs: { label: "司机第：" } },
                      [
                        _c(
                          "Row",
                          [
                            _c(
                              "Col",
                              { attrs: { span: "5" } },
                              [
                                _c(
                                  "FormItem",
                                  { attrs: { prop: "cancel_offer_count" } },
                                  [
                                    _c("InputNumber", {
                                      attrs: { min: 0, max: 999, step: 1 },
                                      model: {
                                        value:
                                          _vm.formUpdate.cancel_offer_count,
                                        callback: function($$v) {
                                          _vm.$set(
                                            _vm.formUpdate,
                                            "cancel_offer_count",
                                            $$v
                                          )
                                        },
                                        expression:
                                          "formUpdate.cancel_offer_count"
                                      }
                                    }),
                                    _vm._v(
                                      "\n                                次取消后，会被加入黑名单\n                            "
                                    )
                                  ],
                                  1
                                )
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c(
                              "Col",
                              { attrs: { span: "4" } },
                              [
                                _c(
                                  "FormItem",
                                  {
                                    attrs: { prop: "cancel_offer_frozen_time" }
                                  },
                                  [
                                    _c("InputNumber", {
                                      attrs: { min: 0, max: 999, step: 1 },
                                      model: {
                                        value:
                                          _vm.formUpdate
                                            .cancel_offer_frozen_time,
                                        callback: function($$v) {
                                          _vm.$set(
                                            _vm.formUpdate,
                                            "cancel_offer_frozen_time",
                                            $$v
                                          )
                                        },
                                        expression:
                                          "formUpdate.cancel_offer_frozen_time"
                                      }
                                    }),
                                    _vm._v(
                                      "\n                                天内不能报价\n                            "
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
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "FormItem",
                      {
                        attrs: {
                          label: "给所属队长发送未签到短信：",
                          prop: "is_send_leader"
                        }
                      },
                      [
                        _c(
                          "i-switch",
                          {
                            attrs: {
                              "true-value": 1,
                              "false-value": 0,
                              size: "large"
                            },
                            model: {
                              value: _vm.formUpdate.is_send_leader,
                              callback: function($$v) {
                                _vm.$set(_vm.formUpdate, "is_send_leader", $$v)
                              },
                              expression: "formUpdate.is_send_leader"
                            }
                          },
                          [
                            _c(
                              "span",
                              { attrs: { slot: "open" }, slot: "open" },
                              [_vm._v("是")]
                            ),
                            _vm._v(" "),
                            _c(
                              "span",
                              { attrs: { slot: "close" }, slot: "close" },
                              [_vm._v("否")]
                            )
                          ]
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "FormItem",
                      {
                        attrs: {
                          label: "司机在到仓时间前(负数为后)：",
                          prop: "sms_before_warehouse_time"
                        }
                      },
                      [
                        _c("InputNumber", {
                          attrs: { min: 0, max: 999, step: 1 },
                          model: {
                            value: _vm.formUpdate.sms_before_warehouse_time,
                            callback: function($$v) {
                              _vm.$set(
                                _vm.formUpdate,
                                "sms_before_warehouse_time",
                                $$v
                              )
                            },
                            expression: "formUpdate.sms_before_warehouse_time"
                          }
                        }),
                        _vm._v(
                          "\n                        分钟未签到发送短信提醒\n                    "
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
                            attrs: { type: "primary", loading: _vm.loading },
                            on: {
                              click: function($event) {
                                _vm.updateSubmit("formUpdate", "config/update")
                              }
                            }
                          },
                          [_vm._v("保存\n                        ")]
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
          ],
          1
        )
      ])
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-aa0ed290", module.exports)
  }
}

/***/ })

});