webpackJsonp([12],{

/***/ 235:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(444)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(446)
/* template */
var __vue_template__ = __webpack_require__(449)
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
Component.options.__file = "resources/assets/admin/js/views/common/home.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-39a61d40", Component.options)
  } else {
    hotAPI.reload("data-v-39a61d40", Component.options)
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

/***/ 264:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(272)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(274)
/* template */
var __vue_template__ = __webpack_require__(275)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-211f09b4"
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
Component.options.__file = "resources/assets/admin/js/components/modal/component-modal.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-211f09b4", Component.options)
  } else {
    hotAPI.reload("data-v-211f09b4", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 265:
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
    data: function data() {
        return {
            searchForm: {},
            lists: {
                data: {
                    data: [],
                    page: {
                        total: 0,
                        current: 1,
                        page_size: 20
                    }
                }
            },
            component: {
                current: '',
                data: {}
            }
        };
    },
    mounted: function mounted() {
        this.search();
    },

    methods: {
        search: function search() {
            var page = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;
        },
        assignmentData: function assignmentData(data) {
            this.lists.data.data = data.data;
            this.lists.data.page.total = data.total;
            this.lists.data.page.current = data.current_page;
            this.lists.data.page.page_size = data.per_page;
        },
        showComponent: function showComponent(type, data) {
            this.component.current = type;
            this.component.data = data;
        },
        hideComponent: function hideComponent() {
            this.component.current = '';
            this.component.data = {};
            this.search();
        },
        destroyItem: function destroyItem(row, url) {
            var _this = this;

            this.loading = true;
            this.$http.delete(url).then(function (res) {
                _this.search();
            }).catch(function (res) {
                _this.formatErrors(res);
            }).finally(function () {
                _this.loading = false;
            });
        },
        request: function request(page) {
            var searchForm = JSON.parse(JSON.stringify(this.searchForm));
            searchForm.page = page;
            return searchForm;
        }
    }
};

/***/ }),

/***/ 266:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(285)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(287)
/* template */
var __vue_template__ = __webpack_require__(288)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-08f9741c"
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
Component.options.__file = "resources/assets/admin/js/components/select/remote.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-08f9741c", Component.options)
  } else {
    hotAPI.reload("data-v-08f9741c", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


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

/***/ 268:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(289)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(291)
/* template */
var __vue_template__ = __webpack_require__(292)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-1d543a72"
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
Component.options.__file = "resources/assets/admin/js/components/box/index.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-1d543a72", Component.options)
  } else {
    hotAPI.reload("data-v-1d543a72", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 272:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(273);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("6bef0092", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-211f09b4\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./component-modal.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-211f09b4\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./component-modal.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 273:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.modal-body[data-v-211f09b4] {\n    max-height: 650px;\n    overflow-y: auto;\n}\n", ""]);

// exports


/***/ }),

/***/ 274:
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

exports.default = {
    name: "component-modal",
    props: {
        title: {
            type: String,
            default: '弹窗'
        },
        width: {
            type: Number,
            default: 650
        },
        loading: {
            type: Boolean,
            default: false
        }
    },
    methods: {
        change: function change(v) {
            this.$parent.$emit('on-change');
        }
    }
};

/***/ }),

/***/ 275:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "Modal",
    {
      staticStyle: { position: "relative" },
      attrs: {
        title: _vm.title,
        value: true,
        transfer: false,
        "mask-closable": false,
        width: _vm.width
      },
      on: { "on-visible-change": _vm.change }
    },
    [
      _vm.loading
        ? _c("Spin", { attrs: { size: "large", fix: "" } })
        : _vm._e(),
      _vm._v(" "),
      _c("div", { staticClass: "modal-body" }, [_vm._t("default")], 2),
      _vm._v(" "),
      _c(
        "div",
        { attrs: { slot: "footer" }, slot: "footer" },
        [_vm._t("footer")],
        2
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-211f09b4", module.exports)
  }
}

/***/ }),

/***/ 285:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(286);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("dbc99f42", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-08f9741c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./remote.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-08f9741c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./remote.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 286:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.remote-select[data-v-08f9741c] {\n    width: 150px;\n}\n", ""]);

// exports


/***/ }),

/***/ 287:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _http = __webpack_require__(144);

var _http2 = _interopRequireDefault(_http);

var _uuid = __webpack_require__(145);

var _uuid2 = _interopRequireDefault(_uuid);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

/**
 * 使用方法
 * <remote remote-url="company/select"></remote>
 * 请求url remoteUrl
 * 是否开启远程搜索 remote
 * 是否开启缓存 cache
 * 是否加载初始数据 ready
 * 请求参数 params
 * 搜索key searchKey
 *
 * 后台程序尽量用 getWhere 或者 limit
 */
//
//
//
//
//
//
//
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
    name: "remote",
    mixins: [_http2.default, _uuid2.default],
    props: {
        remoteUrl: {
            type: String,
            default: '',
            required: true
        },
        remote: {
            type: Boolean,
            default: true
        },
        cache: {
            type: Boolean,
            default: true
        },
        ready: {
            type: Boolean,
            default: false
        },
        params: {
            type: Object,
            default: function _default() {}
        },
        searchKey: {
            type: String,
            default: 'name'
        },
        value: {
            type: [String, Number]
        }
    },
    data: function data() {
        return {
            publicValue: '',
            publicOptions: [],
            publicParams: {},
            options: this.defaultOption()
        };
    },
    mounted: function mounted() {
        if (this.ready) {
            this.request();
        }
    },

    methods: {
        setValue: function setValue(val) {
            this.$emit('input', val);
            this.$emit('on-change', this.options.find(function (item) {
                return item.id === val;
            }));
        },
        remoteMethod: function remoteMethod(query) {
            var _this = this;

            if (this.value == query) {
                return;
            }

            if (this.options.find(function (item) {
                return item.id === _this.$refs[_this.uuid].publicValue;
            }) && this.options.find(function (item) {
                return item.id === _this.$refs[_this.uuid].publicValue;
            }).name === query) {
                return;
            }

            if (this.remote) {
                this.publicParams[this.searchKey] = query;
                this.request();
            }
        },
        request: function request() {
            var _this2 = this;

            if (this.$store.getters.cache(this.key()).length === 0) {
                if (this.$store.getters.cacheLock(this.key())) {
                    this.loading = true;
                    setTimeout(function () {
                        _this2.refresh();
                        _this2.loading = false;
                    }, 4000);
                } else {
                    this.search();
                }
            } else {
                this.refresh();
            }
        },
        search: function search() {
            var _this3 = this;

            this.loading = true;
            this.$store.commit('setCacheLock', this.key());
            this.$http.get(this.remoteUrl, {
                params: this.getParams()
            }).then(function (res) {
                if (_this3.cache) {
                    _this3.$store.commit('setCacheData', {
                        key: _this3.key(),
                        data: res.data.data
                    });
                } else {
                    _this3.publicOptions = res.data.data;
                }
            }).finally(function () {
                _this3.refresh();
                _this3.loading = false;
            });
        },
        defaultOption: function defaultOption() {
            return this.cache ? this.$store.getters.cache(this.key()) : this.publicOptions;
        },
        key: function key() {
            return this.remoteUrl + JSON.stringify(this.getParams());
        },
        refresh: function refresh() {
            this.options = this.cache ? this.$store.getters.cache(this.key()) : this.publicOptions;
        },
        getParams: function getParams() {
            return Object.assign({}, this.params, this.publicParams);
        },
        unObserver: function unObserver(data) {
            return JSON.parse(JSON.stringify(data));
        }
    },
    watch: {
        params: {
            handler: function handler(val, old) {
                if (JSON.stringify(val) !== JSON.stringify(old)) {
                    this.$refs[this.uuid].clearSingleSelect();
                    this.request();
                }
            },

            deep: true
        },
        value: {
            handler: function handler(val) {
                this.publicValue = val;
            },

            immediate: true
        }
    }
};

/***/ }),

/***/ 288:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "i-select",
    {
      ref: _vm.uuid,
      staticClass: "remote-select",
      attrs: {
        filterable: _vm.remote,
        remote: _vm.remote,
        "remote-method": _vm.remoteMethod,
        clearable: "",
        loading: _vm.loading
      },
      on: { "on-change": _vm.setValue },
      model: {
        value: _vm.publicValue,
        callback: function($$v) {
          _vm.publicValue = $$v
        },
        expression: "publicValue"
      }
    },
    _vm._l(_vm.options, function(option, index) {
      return _c("i-option", { key: option.id, attrs: { value: option.id } }, [
        _vm._v(_vm._s(option.name))
      ])
    })
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-08f9741c", module.exports)
  }
}

/***/ }),

/***/ 289:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(290);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("024e10a1", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-1d543a72\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./index.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-1d543a72\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./index.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 290:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.box[data-v-1d543a72] {\n    margin-bottom: 10px;\n    border: 1px solid #dddee1;\n    border-radius: 5px;\n}\n.box[data-v-1d543a72]:last-child {\n    margin-bottom: 0px;\n}\n.box-header[data-v-1d543a72] {\n    padding: 8px 48px 8px 16px;\n    color: #495060;\n    font-size: 12px;\n    line-height: 16px;\n    border-bottom: 1px solid #dddee1;\n}\n.box-detail[data-v-1d543a72] {\n    padding: 10px;\n}\n", ""]);

// exports


/***/ }),

/***/ 291:
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

exports.default = {
    name: "box",
    props: {
        title: {
            type: String,
            default: '标题'
        },
        form: [Boolean]
    }
};

/***/ }),

/***/ 292:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "box", class: { "box-form": _vm.form } },
    [
      _c("div", { staticClass: "box-header" }, [_vm._v(_vm._s(_vm.title))]),
      _vm._v(" "),
      _c("Row", { staticClass: "box-detail" }, [_vm._t("default")], 2)
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-1d543a72", module.exports)
  }
}

/***/ }),

/***/ 294:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(299)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(301)
/* template */
var __vue_template__ = __webpack_require__(302)
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
Component.options.__file = "resources/assets/admin/js/components/detail/index.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-593c5eeb", Component.options)
  } else {
    hotAPI.reload("data-v-593c5eeb", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 299:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(300);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("47d21996", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-593c5eeb\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./index.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-593c5eeb\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./index.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 300:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.box-detail{\n    line-height: 26px;\n}\n.box-form .box-detail {\n    margin-bottom: 20px;\n    line-height: 33px;\n}\n.box-detail > .ivu-form-item {\n    margin-bottom: 0px;\n    display: inline-block;\n}\n.box-detail .box-detail-title {\n    text-align: right;\n    display: inline-block;\n    overflow:hidden;\n    text-overflow:ellipsis;\n    white-space:nowrap;\n    vertical-align: middle;\n}\n", ""]);

// exports


/***/ }),

/***/ 301:
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

exports.default = {
    name: "detail",
    props: {
        title: {
            type: String,
            default: ''
        },
        span: {
            type: Number,
            default: 8
        },
        offset: {
            type: Number,
            default: 0
        },
        titleWidth: {
            type: Number,
            default: 80
        }
    }
};

/***/ }),

/***/ 302:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "Col",
    {
      staticClass: "box-detail",
      attrs: { span: _vm.span, offset: _vm.offset }
    },
    [
      _vm.title !== ""
        ? _c(
            "div",
            {
              staticClass: "box-detail-title",
              style: { width: _vm.titleWidth + "px" }
            },
            [_vm._v(_vm._s(_vm.title) + "：")]
          )
        : _vm._e(),
      _vm._v(" "),
      _vm._t("default")
    ],
    2
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-593c5eeb", module.exports)
  }
}

/***/ }),

/***/ 303:
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(global) {/*!
{
  "copywrite": "Copyright (c) 2018-present",
  "date": "2018-10-11T11:34:36.837Z",
  "describe": "",
  "description": "Vue directive to react on clicks outside an element.",
  "file": "v-click-outside-x.min.js",
  "hash": "6b8e903915d7141045b4",
  "license": "MIT",
  "version": "3.4.0"
}
*/
!function(e,t){ true?module.exports=t():"function"==typeof define&&define.amd?define([],t):"object"==typeof exports?exports.vClickOutside=t():e.vClickOutside=t()}(function(){"use strict";return"undefined"!=typeof self?self:"undefined"!=typeof window?window:"undefined"!=typeof global?global:Function("return this")()}(),function(){return function(e){var t={};function n(r){if(t[r])return t[r].exports;var o=t[r]={i:r,l:!1,exports:{}};return e[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}return n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)n.d(r,o,function(t){return e[t]}.bind(null,o));return r},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=0)}([function(e,t,n){"use strict";function r(e){return(r="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function o(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{},r=Object.keys(n);"function"==typeof Object.getOwnPropertySymbols&&(r=r.concat(Object.getOwnPropertySymbols(n).filter(function(e){return Object.getOwnPropertyDescriptor(n,e).enumerable}))),r.forEach(function(t){u(e,t,n[t])})}return e}function u(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}Object.defineProperty(t,"__esModule",{value:!0}),t.install=function(e){e.directive("click-outside",s)},t.directive=void 0;var i=Object.create(null),c=Object.create(null),f=[i,c],l=function(e,t,n){var r=n.target,o=function(t){var o=t.el;if(o!==r&&!o.contains(r)){var u=t.binding;u.modifiers.stop&&n.stopPropagation(),u.modifiers.prevent&&n.preventDefault(),u.value.call(e,n)}};Object.keys(t).forEach(function(e){return t[e].forEach(o)})},a=function(e){l(this,i,e)},d=function(e){l(this,c,e)},p=function(e){return e?a:d},s=Object.defineProperties({},{$_captureInstances:{value:i},$_nonCaptureInstances:{value:c},$_onCaptureEvent:{value:a},$_onNonCaptureEvent:{value:d},bind:{value:function(e,t){if("function"!=typeof t.value)throw new TypeError("Binding value must be a function.");var n=t.arg||"click",u=o({},t,{arg:n,modifiers:o({},{capture:!1,prevent:!1,stop:!1},t.modifiers)}),f=u.modifiers.capture,l=f?i:c;Array.isArray(l[n])||(l[n]=[]),1===l[n].push({el:e,binding:u})&&"object"===("undefined"==typeof document?"undefined":r(document))&&document&&document.addEventListener(n,p(f),f)}},unbind:{value:function(e){var t=function(t){return t.el!==e};f.forEach(function(e){var n=Object.keys(e);if(n.length){var o=e===i;n.forEach(function(n){var u=e[n].filter(t);u.length?e[n]=u:("object"===("undefined"==typeof document?"undefined":r(document))&&document&&document.removeEventListener(n,p(o),o),delete e[n])})}})}},version:{enumerable:!0,value:"3.4.0"}});t.directive=s}])});
//# sourceMappingURL=v-click-outside-x.min.js.map
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(8)))

/***/ }),

/***/ 305:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(307)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(309)
/* template */
var __vue_template__ = __webpack_require__(310)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-f2dacc7e"
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
Component.options.__file = "resources/assets/admin/js/components/map/place-search-select.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-f2dacc7e", Component.options)
  } else {
    hotAPI.reload("data-v-f2dacc7e", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 306:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
// Thanks to: https://github.com/airyland/vux/blob/v2/src/directives/transfer-dom/index.js
// Thanks to: https://github.com/calebroseland/vue-dom-portal

/**
 * Get target DOM Node
 * @param {(Node|string|Boolean)} [node=document.body] DOM Node, CSS selector, or Boolean
 * @return {Node} The target that the el will be appended to
 */
function getTarget (node) {
    if (node === void 0) {
        node = document.body
    }
    if (node === true) { return document.body }
    return node instanceof window.Node ? node : document.querySelector(node)
}

const directive = {
    inserted (el, { value }, vnode) {
        if ( el.dataset && el.dataset.transfer !== 'true') return false;
        el.className = el.className ? el.className + ' v-transfer-dom' : 'v-transfer-dom';
        const parentNode = el.parentNode;
        if (!parentNode) return;
        const home = document.createComment('');
        let hasMovedOut = false;

        if (value !== false) {
            parentNode.replaceChild(home, el); // moving out, el is no longer in the document
            getTarget(value).appendChild(el); // moving into new place
            hasMovedOut = true
        }
        if (!el.__transferDomData) {
            el.__transferDomData = {
                parentNode: parentNode,
                home: home,
                target: getTarget(value),
                hasMovedOut: hasMovedOut
            }
        }
    },
    componentUpdated (el, { value }) {
        if ( el.dataset && el.dataset.transfer !== 'true') return false;
        // need to make sure children are done updating (vs. `update`)
        const ref$1 = el.__transferDomData;
        if (!ref$1) return;
        // homes.get(el)
        const parentNode = ref$1.parentNode;
        const home = ref$1.home;
        const hasMovedOut = ref$1.hasMovedOut; // recall where home is

        if (!hasMovedOut && value) {
            // remove from document and leave placeholder
            parentNode.replaceChild(home, el);
            // append to target
            getTarget(value).appendChild(el);
            el.__transferDomData = Object.assign({}, el.__transferDomData, { hasMovedOut: true, target: getTarget(value) });
        } else if (hasMovedOut && value === false) {
            // previously moved, coming back home
            parentNode.replaceChild(el, home);
            el.__transferDomData = Object.assign({}, el.__transferDomData, { hasMovedOut: false, target: getTarget(value) });
        } else if (value) {
            // already moved, going somewhere else
            getTarget(value).appendChild(el);
        }
    },
    unbind (el) {
        if (el.dataset && el.dataset.transfer !== 'true') return false;
        el.className = el.className.replace('v-transfer-dom', '');
        const ref$1 = el.__transferDomData;
        if (!ref$1) return;
        if (el.__transferDomData.hasMovedOut === true) {
            el.__transferDomData.parentNode && el.__transferDomData.parentNode.appendChild(el)
        }
        el.__transferDomData = null
    }
};

/* harmony default export */ __webpack_exports__["default"] = (directive);

/***/ }),

/***/ 307:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(308);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("54116fa4", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-f2dacc7e\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./place-search-select.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-f2dacc7e\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./place-search-select.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 308:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 309:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _vueAmap = __webpack_require__(146);

var _transferDom = __webpack_require__(306);

var _transferDom2 = _interopRequireDefault(_transferDom);

var _vClickOutsideX = __webpack_require__(303);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var amapManager = new _vueAmap.AMapManager(); //
//
//
//
//
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
    name: 'place-search-select',
    directives: { clickOutside: _vClickOutsideX.directive, TransferDom: _transferDom2.default },
    props: ['searchOption', 'value'],
    data: function data() {
        return {
            loading: false,
            places: [],
            model: this.value,
            dropVisible: false,
            city: '深圳市',
            category: []
        };
    },

    mounted: function mounted() {
        var _this = this;

        this.loading = true;
        this.$nextTick(function () {
            if (_this.$store.getters.cache('category').length === 0) {
                if (!_this.$store.getters.cacheLock('category')) {
                    _this.$store.commit('setCacheLock', 'category');
                    _this.$http.get('category/checkbox').then(function (res) {
                        _this.$store.commit('setCacheData', {
                            key: 'category',
                            data: res.data.data
                        });
                        _this.refresh();
                    });
                } else {
                    setTimeout(function () {
                        _this.refresh();
                    }, 4000);
                }
            } else {
                _this.refresh();
            }
        });
    },
    computed: {
        _placeSearch: function _placeSearch() {
            return new AMap.PlaceSearch(this.searchOption || {
                city: this.city,
                citylimit: true,
                extensions: 'all'
            });
        }
    },
    methods: {
        initSearch: function initSearch(event) {
            this.setDefaultValue();
            this.initFocus(event);
        },
        initFocus: function initFocus(event) {
            var _this2 = this;

            this.model = event.target.value;
            this._placeSearch.search(event.target.value, function (status, result) {
                if (result && result.poiList && result.poiList.count) {
                    _this2.places = result.poiList.pois;
                    _this2.dropVisible = true;
                }
            });
        },
        setValue: function setValue(index) {
            this.dropVisible = false;
            this.$emit('input', this.places[index].name);
            this.$emit('pois', this.places[index]);
            this.$emit('on-change', this.places[index]);
            this.$emit('city', this.city);
        },
        setDefaultValue: function setDefaultValue() {
            this.$emit('input', '');
            this.$emit('city', '');
            this.$emit('pois', {});
        },
        onClickOutside: function onClickOutside() {
            this.dropVisible = false;
        },
        refresh: function refresh() {
            this.category = this.$store.getters.cache('category');
            this.loading = false;
        }
    },
    watch: {
        value: function value(val) {
            if (val !== '') this.model = val;
        }
    }
};

/***/ }),

/***/ 310:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "Dropdown",
    {
      directives: [
        {
          name: "click-outside",
          rawName: "v-click-outside.capture",
          value: _vm.onClickOutside,
          expression: "onClickOutside",
          modifiers: { capture: true }
        },
        {
          name: "click-outside",
          rawName: "v-click-outside:mousedown.capture",
          value: _vm.onClickOutside,
          expression: "onClickOutside",
          arg: "mousedown",
          modifiers: { capture: true }
        }
      ],
      staticStyle: { "vertical-align": "top" },
      attrs: { visible: _vm.dropVisible, trigger: "custom" },
      on: { "on-click": _vm.setValue }
    },
    [
      _c(
        "Input",
        {
          attrs: { value: _vm.model, placeholder: "Enter something..." },
          on: { "on-change": _vm.initSearch, "on-focus": _vm.initFocus }
        },
        [
          _c(
            "Select",
            {
              staticStyle: { width: "80px" },
              attrs: { slot: "prepend", loading: _vm.loading },
              on: { "on-change": _vm.setDefaultValue },
              slot: "prepend",
              model: {
                value: _vm.city,
                callback: function($$v) {
                  _vm.city = $$v
                },
                expression: "city"
              }
            },
            _vm._l(_vm.category, function(item, index) {
              return _c("Option", { key: index, attrs: { value: item.name } }, [
                _vm._v(_vm._s(item.name))
              ])
            })
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "DropdownMenu",
        { attrs: { slot: "list" }, slot: "list" },
        _vm._l(_vm.places, function(item, index) {
          return _c("DropdownItem", { key: index, attrs: { name: index } }, [
            _vm._v(_vm._s(item.name))
          ])
        })
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-f2dacc7e", module.exports)
  }
}

/***/ }),

/***/ 324:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(374)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(376)
/* template */
var __vue_template__ = __webpack_require__(377)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-3c0bf476"
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
Component.options.__file = "resources/assets/admin/js/views/components/task/status.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-3c0bf476", Component.options)
  } else {
    hotAPI.reload("data-v-3c0bf476", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 357:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(358)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(360)
/* template */
var __vue_template__ = __webpack_require__(369)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-2ae3055e"
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
Component.options.__file = "resources/assets/admin/js/views/taskOrder/view.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-2ae3055e", Component.options)
  } else {
    hotAPI.reload("data-v-2ae3055e", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 358:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(359);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("4f2bdec4", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2ae3055e\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./view.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2ae3055e\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./view.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 359:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.order-step[data-v-2ae3055e] {\n    margin-bottom: 10px;\n}\n", ""]);

// exports


/***/ }),

/***/ 360:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _componentModal = __webpack_require__(264);

var _componentModal2 = _interopRequireDefault(_componentModal);

var _component = __webpack_require__(263);

var _component2 = _interopRequireDefault(_component);

var _index = __webpack_require__(268);

var _index2 = _interopRequireDefault(_index);

var _index3 = __webpack_require__(294);

var _index4 = _interopRequireDefault(_index3);

var _remote = __webpack_require__(266);

var _remote2 = _interopRequireDefault(_remote);

var _point = __webpack_require__(361);

var _point2 = _interopRequireDefault(_point);

var _lists = __webpack_require__(265);

var _lists2 = _interopRequireDefault(_lists);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
    name: "o-view",
    components: { Detail: _index4.default, Box: _index2.default, ComponentModal: _componentModal2.default, Remote: _remote2.default, Point: _point2.default },
    mixins: [_component2.default, _lists2.default],
    mounted: function mounted() {
        var _this = this;

        this.$nextTick(function () {
            _this.getView();
        });
    },
    data: function data() {
        var _this2 = this;

        return {
            orders: {
                delivery: []
            },
            columns: [{
                title: '序号',
                render: function render(h, _ref) {
                    var index = _ref.index;

                    return h(
                        "span",
                        null,
                        [index + 1]
                    );
                }
            }, {
                title: '联系人',
                key: 'contacts'
            }, {
                title: '联系方式',
                key: 'contact_way'
            }, {
                title: '交付地址',
                key: 'name'
            }, {
                title: '实际地址',
                key: 'put_address'
            }, {
                title: '妥投状态',
                render: function render(h, _ref2) {
                    var row = _ref2.row;

                    return h(
                        "span",
                        null,
                        [row.status === 0 ? '未操作' : row.status === 1 ? '已妥投' : '未妥投']
                    );
                }
            }, {
                title: '原因',
                key: 'reason'
            }, {
                title: '签收照片',
                key: 'img_one'
            }, {
                title: '妥投时间',
                key: 'finish_time'
            }, {
                title: '操作',
                render: function render(h, _ref3) {
                    var row = _ref3.row;

                    return h(
                        "button-group",
                        null,
                        [h(
                            "poptip",
                            {
                                attrs: { confirm: true, transfer: true, title: "\u786E\u5B9A\u8981\u5220\u9664\u5417\uFF1F" },
                                on: {
                                    "on-ok": function onOk() {
                                        return _this2.destroyItem(row, "order/point/" + row.id);
                                    }
                                }
                            },
                            [h(
                                "i-button",
                                {
                                    attrs: { size: "small" }
                                },
                                ["\u5220\u9664"]
                            )]
                        )]
                    );
                }
            }]
        };
    },

    methods: {
        notify: function notify(item) {
            var _this3 = this;

            this.$http.post("order/notify/" + item.id).then(function (res) {}).finally(function () {
                _this3.$Message.success('已推送通知');
            });
        },
        getView: function getView() {
            var _this4 = this;

            this.loading = true;
            this.$http.get("order/" + this.data.id).then(function (res) {
                _this4.orders = res.data.data;
            }).finally(function () {
                _this4.loading = false;
            });
        },
        destroyItem: function destroyItem(row, url) {
            var _this5 = this;

            this.loading = true;
            this.$http.delete(url).then(function (res) {
                _this5.getView();
            }).catch(function (res) {
                _this5.formatErrors(res);
            }).finally(function () {
                _this5.loading = false;
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

/***/ }),

/***/ 361:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(362)
  __webpack_require__(364)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(366)
/* template */
var __vue_template__ = __webpack_require__(368)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-21bdbcb2"
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
Component.options.__file = "resources/assets/admin/js/views/taskOrder/point.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-21bdbcb2", Component.options)
  } else {
    hotAPI.reload("data-v-21bdbcb2", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 362:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(363);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("14236e07", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-21bdbcb2\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./point.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-21bdbcb2\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./point.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 363:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.amap-page-container {\n    height: 400px;\n    position: relative;\n}\n.long-lat-text {\n    background-color: #ffffff;\n    border: 1px #c0c0c0 solid;\n    padding: 2px;\n    position: absolute;\n    top: 10px;\n    right: 10px;\n    border-radius: 6px;\n}\n", ""]);

// exports


/***/ }),

/***/ 364:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(365);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("5a0d007e", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-21bdbcb2\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=1!./point.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-21bdbcb2\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=1!./point.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 365:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 366:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _component = __webpack_require__(263);

var _component2 = _interopRequireDefault(_component);

var _componentModal = __webpack_require__(264);

var _componentModal2 = _interopRequireDefault(_componentModal);

var _index = __webpack_require__(268);

var _index2 = _interopRequireDefault(_index);

var _create = __webpack_require__(367);

var _form = __webpack_require__(267);

var _form2 = _interopRequireDefault(_form);

var _remote = __webpack_require__(266);

var _remote2 = _interopRequireDefault(_remote);

var _lists = __webpack_require__(265);

var _lists2 = _interopRequireDefault(_lists);

var _placeSearchSelect = __webpack_require__(305);

var _placeSearchSelect2 = _interopRequireDefault(_placeSearchSelect);

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


exports.default = {
    name: 'Create',
    components: { Remote: _remote2.default, ComponentModal: _componentModal2.default, Box: _index2.default, Validator: _create.Validator, PlaceSearchSelect: _placeSearchSelect2.default },
    mixins: [_lists2.default, _component2.default, _form2.default],
    data: function data() {
        return {
            formCreate: {
                contacts: '',
                contact_way: '',
                lng: 0,
                lat: 0
            },
            ruleCreate: (0, _create.Validator)(this)
        };
    },

    computed: {
        lng: function lng() {
            return this.formCreate.lng;
        },
        lat: function lat() {
            return this.formCreate.lat;
        }
    },
    methods: {
        pois: function pois(item) {
            this.formCreate.lat = item.location ? item.location.lat : 0;
            this.formCreate.lng = item.location ? item.location.lng : 0;
        },
        createSubmit: function createSubmit(name, url) {
            var _this = this;

            this.$refs[name].validate(function (valid) {
                if (valid) {
                    _this.loading = true;
                    _this.$http.post(url, _this._data[name]).then(function (res) {
                        _this.$Message.success('Success!');
                        _this.change(false);
                        _this.$emit('on-ok');
                    }).catch(function (res) {
                        _this.formatErrors(res);
                    }).finally(function () {
                        _this.loading = false;
                    });
                }
            });
        }
    }
};

/***/ }),

/***/ 367:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});
var Validator = exports.Validator = function Validator(data) {
    return {
        name: [{
            required: true,
            type: 'string',
            message: '地址必须填写',
            trigger: 'blur'
        }],
        contacts: [{
            required: true,
            message: '联系人必须填写',
            type: 'string',
            trigger: 'blur'
        }],
        contact_way: [{
            required: true,
            message: '联系方式必须填写',
            type: 'string',
            trigger: 'blur'
        }]
    };
};

/***/ }),

/***/ 368:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "component-modal",
    { attrs: { title: "创建配送点", loading: _vm.loading, width: 850 } },
    [
      _c(
        "Form",
        {
          ref: "formCreate",
          attrs: {
            model: _vm.formCreate,
            "label-width": 100,
            rules: _vm.ruleCreate
          }
        },
        [
          _c(
            "FormItem",
            { attrs: { label: "联系人：", prop: "contacts" } },
            [
              _c("Input", {
                attrs: { placeholder: "联系人" },
                model: {
                  value: _vm.formCreate.contacts,
                  callback: function($$v) {
                    _vm.$set(_vm.formCreate, "contacts", $$v)
                  },
                  expression: "formCreate.contacts"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "联系电话：", prop: "contact_way" } },
            [
              _c("Input", {
                attrs: { placeholder: "联系电话" },
                model: {
                  value: _vm.formCreate.contact_way,
                  callback: function($$v) {
                    _vm.$set(_vm.formCreate, "contact_way", $$v)
                  },
                  expression: "formCreate.contact_way"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "地址：", prop: "name" } },
            [
              _c("place-search-select", {
                staticStyle: { width: "500px" },
                on: { pois: _vm.pois },
                model: {
                  value: _vm.formCreate.name,
                  callback: function($$v) {
                    _vm.$set(_vm.formCreate, "name", $$v)
                  },
                  expression: "formCreate.name"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "地图页面：" } },
            [
              _c("box", { attrs: { title: "地图页面" } }, [
                _c(
                  "div",
                  { staticClass: "amap-page-container" },
                  [
                    _c(
                      "el-amap",
                      { attrs: { center: [_vm.lng, _vm.lat] } },
                      [
                        _c("el-amap-marker", {
                          attrs: {
                            vid: "component-marker",
                            position: [_vm.lng, _vm.lat]
                          }
                        }),
                        _vm._v(" "),
                        _c("div", { staticClass: "long-lat-text" }, [
                          _vm._v(
                            "经度：" +
                              _vm._s(_vm.lng) +
                              " ， 维度：" +
                              _vm._s(_vm.lat)
                          )
                        ])
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
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "div",
        { attrs: { slot: "footer" }, slot: "footer" },
        [
          _c(
            "Button",
            {
              attrs: { type: "primary", loading: _vm.loading },
              on: {
                click: function($event) {
                  _vm.createSubmit("formCreate", "order/point/" + _vm.data.id)
                }
              }
            },
            [_vm._v("创建")]
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(_vm.component.current, {
        tag: "components",
        attrs: { data: _vm.component.data },
        on: { "on-change": _vm.hideComponent }
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-21bdbcb2", module.exports)
  }
}

/***/ }),

/***/ 369:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var this$1 = this
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "component-modal",
    { attrs: { title: "查看出车单", width: 1000, loading: _vm.loading } },
    [
      _c(
        "div",
        { staticClass: "order-step" },
        [
          _vm.orders.status === 0 ||
          _vm.orders.status === 1 ||
          _vm.orders.status === 2 ||
          _vm.orders.status === 3
            ? _c(
                "Steps",
                { attrs: { current: _vm.orders.status } },
                [
                  _c("Step", { attrs: { title: "未签到", content: "" } }),
                  _vm._v(" "),
                  _c("Step", { attrs: { title: "已签到", content: "" } }),
                  _vm._v(" "),
                  _c("Step", { attrs: { title: "配送中", content: "" } }),
                  _vm._v(" "),
                  _c("Step", { attrs: { title: "配送完成", content: "" } })
                ],
                1
              )
            : _vm._e()
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "box",
        { attrs: { title: "任务信息" } },
        [
          _c("detail", { attrs: { title: "任务编号" } }, [
            _vm._v(_vm._s(_vm.orders.task_id))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "任务类型" } }, [
            _vm.orders.task && _vm.orders.task.type === 1
              ? _c("span", [_vm._v("主任务")])
              : _c("span", [_vm._v("临时任务")])
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "线路名称" } }, [
            _vm._v(_vm._s(_vm.orders.name))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "配送信息" } }, [
            _vm._v(_vm._s(_vm.orders.point_count) + " 个 (非固定配送点)")
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "区域描述", span: 16 } }, [
            _vm._v(_vm._s(_vm.orders.delivery_point_remark))
          ])
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "box",
        { attrs: { title: "仓库信息" } },
        [
          _c("detail", { attrs: { title: "仓库名称" } }, [
            _vm._v(
              _vm._s(_vm.orders.warehouse ? _vm.orders.warehouse.title : "")
            )
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "联系人" } }, [
            _vm._v(
              _vm._s(_vm.orders.warehouse ? _vm.orders.warehouse.contacts : "")
            )
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "联系电话" } }, [
            _vm._v(
              _vm._s(
                _vm.orders.warehouse ? _vm.orders.warehouse.contacts_phone : ""
              )
            )
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "到仓时间" } }, [
            _vm._v(_vm._s(_vm.orders.arrival_warehouse_time))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "仓库地址" } }, [
            _vm._v(
              _vm._s(_vm.orders.warehouse ? _vm.orders.warehouse.address : "")
            )
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "仓库备注" } }, [
            _vm._v(
              _vm._s(_vm.orders.warehouse ? _vm.orders.warehouse.remark : "")
            )
          ])
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "box",
        { attrs: { title: "司机信息" } },
        [
          _c("detail", { attrs: { title: "司机姓名" } }, [
            _vm._v(_vm._s(_vm.orders.driver ? _vm.orders.driver.name : ""))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "司机类型" } }, [
            _vm.orders.driver && _vm.orders.driver.driver_type === 0
              ? _c("span", [_vm._v("自营司机")])
              : _vm._e(),
            _vm._v(" "),
            _vm.orders.driver && _vm.orders.driver.driver_type === 1
              ? _c("span", [_vm._v("合作司机")])
              : _vm._e(),
            _vm._v(" "),
            _vm.orders.driver && _vm.orders.driver.driver_type === 2
              ? _c("span", [_vm._v("社会司机")])
              : _vm._e()
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "联系电话" } }, [
            _vm._v(_vm._s(_vm.orders.driver ? _vm.orders.driver.phone : ""))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "车牌号码" } }, [
            _vm._v(
              _vm._s(_vm.orders.driver ? _vm.orders.driver.car_number : "")
            )
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "司机头像" } }, [
            _c("img", {
              attrs: {
                src: _vm.orders.driver ? _vm.orders.driver.head_img_url : "",
                height: "30",
                width: "30"
              }
            })
          ])
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "box",
        { attrs: { title: "途径点" } },
        [
          _c(
            "i-button",
            {
              attrs: { size: "small", type: "primary" },
              on: {
                click: function($event) {
                  _vm.showComponent("Point", _vm.orders)
                }
              }
            },
            [_vm._v("添加")]
          ),
          _vm._v(" "),
          _c(
            "i-button",
            {
              attrs: { size: "small", type: "primary" },
              on: {
                click: function($event) {
                  _vm.notify(_vm.orders)
                }
              }
            },
            [_vm._v("通知")]
          ),
          _vm._v(" "),
          _c("Table", {
            staticStyle: { "margin-top": "10px" },
            attrs: { columns: _vm.columns, data: _vm.orders.delivery }
          })
        ],
        1
      ),
      _vm._v(" "),
      _c(_vm.component.current, {
        tag: "components",
        attrs: { data: _vm.component.data },
        on: {
          "on-change": _vm.hideComponent,
          "on-ok": function() {
            this$1.getView()
          }
        }
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-2ae3055e", module.exports)
  }
}

/***/ }),

/***/ 370:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(371)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(373)
/* template */
var __vue_template__ = __webpack_require__(378)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-0d7eb138"
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
Component.options.__file = "resources/assets/admin/js/views/task/show.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-0d7eb138", Component.options)
  } else {
    hotAPI.reload("data-v-0d7eb138", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 371:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(372);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("cc3bba8c", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0d7eb138\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./show.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0d7eb138\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./show.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 372:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 373:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _componentModal = __webpack_require__(264);

var _componentModal2 = _interopRequireDefault(_componentModal);

var _component = __webpack_require__(263);

var _component2 = _interopRequireDefault(_component);

var _index = __webpack_require__(294);

var _index2 = _interopRequireDefault(_index);

var _index3 = __webpack_require__(268);

var _index4 = _interopRequireDefault(_index3);

var _status = __webpack_require__(324);

var _status2 = _interopRequireDefault(_status);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
    name: "show",
    components: { TaskStatus: _status2.default, Box: _index4.default, Detail: _index2.default, ComponentModal: _componentModal2.default },
    mixins: [_component2.default],
    data: function data() {
        return {
            tableCol: [{
                title: '序号',
                render: function render(h, _ref) {
                    var index = _ref.index;

                    return h(
                        "span",
                        null,
                        [++index]
                    );
                } }, {
                title: '地址',
                key: "name"
            }, {
                title: '联系人',
                key: "contacts"
            }, {
                title: '联系方式',
                key: "contact_way"
            }],
            task: {
                send_time: [],
                warehouse: {
                    id: 0,
                    title: ''
                },
                distance_json: '',
                goods_volume: '',
                goods_weight: '',
                goods_num: '',
                unit_price: '',
                merchant_safe: {
                    is_per: 0,
                    safe_fee: 0
                },
                extra: {
                    carry: {
                        is_worker: 0,
                        is_loading: 0,
                        is_unloading: 0,
                        textarea: ''
                    },
                    other: {
                        is_remove_seat: 0,
                        is_trolley: 0,
                        is_tail_plate: 0,
                        is_extinguisher: 0,
                        is_lock: 0,
                        other_require: ""
                    }
                }
            }
        };
    },
    mounted: function mounted() {
        this.search();
    },

    methods: {
        search: function search() {
            var _this = this;

            var page = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;

            this.loading = true;
            this.$http.get("task/" + this.data.id).then(function (res) {
                _this.task = JSON.parse(JSON.stringify(res.data.data));
                _this.loading = false;
            });
        }
    },
    filters: {
        formatArray: function formatArray(arr) {
            return (arr || []).join(',');
        },
        formatWeek: function formatWeek(arr) {
            var result = '';
            var weekday = ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六", "星期日"];
            if (arr !== undefined && arr instanceof Array) {
                arr.forEach(function (item, key) {
                    result += weekday[key] + " ";
                });
                return result;
            } else {
                return arr;
            }
        },
        valueOfSingle: function valueOfSingle(arr) {
            var result = '';

            if (arr !== undefined && arr instanceof Array) {
                arr.forEach(function (item, key) {
                    result += item['value'] + " ";
                });
                return result;
            } else {
                return "";
            }
        },
        formatCarry: function formatCarry(value) {
            switch (value) {
                case 0:
                    return '无需搬运';
                case 1:
                    return '轻度搬运';
                case 2:
                    return '中度搬运';
                case 3:
                    return '重度搬运';
            }
        },
        formatNumber: function formatNumber(obj) {
            if (!obj) {
                return '';
            } else {
                return obj.min + '-' + obj.max;
            }
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

/***/ }),

/***/ 374:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(375);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("432d6c6e", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3c0bf476\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./status.vue", function() {
     var newContent = require("!!../../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3c0bf476\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./status.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 375:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 376:
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
    name: "task-status",
    props: {
        status: {
            required: true
        }
    }
};

/***/ }),

/***/ 377:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _vm.status === 0
    ? _c("tag", { attrs: { color: "lime" } }, [_vm._v("司机报价中")])
    : _vm.status === 1
      ? _c("tag", { attrs: { color: "green" } }, [_vm._v("选司机中")])
      : _vm.status === 2
        ? _c("tag", { attrs: { color: "blue" } }, [_vm._v("选到可用司机")])
        : _vm.status === 3
          ? _c("tag", { attrs: { color: "cyan" } }, [_vm._v("客户不选司机")])
          : _vm.status === 4
            ? _c("tag", { attrs: { color: "volcano" } }, [
                _vm._v("过期不选司机")
              ])
            : _vm.status === 5
              ? _c("tag", { attrs: { color: "gold" } }, [_vm._v("无司机报价")])
              : _vm.status === 6
                ? _c("tag", { attrs: { color: "red" } }, [_vm._v("任务作废")])
                : _vm._e()
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-3c0bf476", module.exports)
  }
}

/***/ }),

/***/ 378:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "component-modal",
    { attrs: { title: "查看任务详情", width: 950, loading: _vm.loading } },
    [
      _c(
        "box",
        { attrs: { title: "任务信息" } },
        [
          _c("detail", { attrs: { title: "任务编号" } }, [
            _vm._v(_vm._s(_vm.task.id))
          ]),
          _vm._v(" "),
          _c(
            "detail",
            { attrs: { title: "任务状态" } },
            [_c("task-status", { attrs: { status: _vm.task.status } })],
            1
          ),
          _vm._v(" "),
          _c("detail", { attrs: { title: "任务创建时间" } }, [
            _vm._v(_vm._s(_vm.task.create_time))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "任务类型" } }, [
            _vm._v(_vm._s(_vm.task.type === 1 ? "主任务" : "临时任务"))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "仓库名称" } }, [
            _vm._v(_vm._s(_vm.task.warehouse.title))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "线路名称" } }, [
            _vm._v(_vm._s(_vm.task.name))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "是否固定点" } }, [
            _vm._v(
              _vm._s(_vm.task.is_fixed_point === 1 ? "固定点" : "非固定点")
            )
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "是否返仓" } }, [
            _vm._v(_vm._s(_vm.task.is_back === 1 ? "是" : "否"))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "非固定点配送点" } }, [
            _vm._v(
              _vm._s(_vm._f("formatNumber")(_vm.task.unfixed_json)) + "个 "
            )
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "配送总里程" } }, [
            _vm._v(
              _vm._s(_vm._f("formatNumber")(_vm.task.distance_json)) + " 公里"
            )
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "配送区域描述" } }, [
            _vm._v(_vm._s(_vm.task.delivery_point_remark))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "保险" } }, [
            _vm._v(
              _vm._s(
                _vm.task.merchant_safe_id === 0
                  ? "未购买"
                  : _vm.task.merchant_safe.is_per === 1
                    ? "运费的" + _vm.task.merchant_safe.is_per + "%"
                    : _vm.task.merchant_safe.safe_fee
              ) + "\n        "
            )
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "车型", span: 12 } }, [
            _vm._v(_vm._s(_vm._f("formatArray")(_vm.task.car_type_name)))
          ])
        ],
        1
      ),
      _vm._v(" "),
      _vm.task.delivery
        ? _c(
            "box",
            { attrs: { title: "固定配送点信息" } },
            [
              _c("Table", {
                ref: "table",
                attrs: {
                  columns: _vm.tableCol,
                  data: _vm.task.delivery,
                  size: "small",
                  loading: _vm.loading
                }
              })
            ],
            1
          )
        : _vm._e(),
      _vm._v(" "),
      _c(
        "box",
        { attrs: { title: "任务时间" } },
        [
          _c("detail", { attrs: { title: "司机上岗日期" } }, [
            _vm._v(
              _vm._s(
                _vm.task.type === 1
                  ? _vm.task.arrival_date
                  : _vm.task.temp_start_date
              )
            )
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "配送时间" } }, [
            _vm._v(
              "\n            " +
                _vm._s(
                  _vm._f("formatWeek")(
                    _vm.task.type === 2
                      ? _vm.task.temp_start_date
                      : _vm.task.send_time
                  )
                ) +
                "\n        "
            )
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "到仓时间" } }, [
            _vm._v(_vm._s(_vm.task.arrival_warehouse_time))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "预计完成时间" } }, [
            _vm._v(_vm._s(_vm.task.estimate_time))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "报价截止时间", span: 8 } }, [
            _vm._v(_vm._s(_vm.task.offer_end_time))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "选司机截止时间", span: 8 } }, [
            _vm._v(_vm._s(_vm.task.choose_driver_end_time))
          ])
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "box",
        { attrs: { title: "任务描述" } },
        [
          _c("detail", { attrs: { title: "货物类型" } }, [
            _vm._v(_vm._s(_vm.task.goods_remark))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "货物总体积" } }, [
            _vm._v(
              _vm._s(_vm._f("formatNumber")(_vm.task.goods_volume)) + "立方米"
            )
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "货物件数" } }, [
            _vm._v(_vm._s(_vm._f("formatNumber")(_vm.task.goods_num)) + "件")
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "货物总重量" } }, [
            _vm._v(_vm._s(_vm._f("formatNumber")(_vm.task.goods_weight)) + "吨")
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "是否回单" } }, [
            _vm._v(_vm._s(_vm.task.back_bill === 1 ? "是" : "否"))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "预计每趟价格" } }, [
            _vm._v(_vm._s(_vm._f("formatNumber")(_vm.task.unit_price)) + "元")
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "报价说明" } }, [
            _vm._v(_vm._s(_vm.task.price_remark))
          ])
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "box",
        { attrs: { title: "搬运说明" } },
        [
          _c("detail", { attrs: { title: "货物类型" } }, [
            _vm._v(_vm._s(_vm._f("formatCarry")(_vm.task.carry_type)))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "自带小工" } }, [
            _vm._v(_vm._s(_vm.task.extra.carry.is_worker === 1 ? "是" : "否"))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "帮忙装货" } }, [
            _vm._v(_vm._s(_vm.task.extra.carry.is_loading === 1 ? "是" : "否"))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "帮忙卸货" } }, [
            _vm._v(
              _vm._s(_vm.task.extra.carry.is_unloading === 1 ? "是" : "否")
            )
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "搬运说明" } }, [
            _vm._v(
              _vm._s(
                _vm.task.carry_type === 0
                  ? "无需搬运"
                  : _vm.task.extra.carry.textarea
              )
            )
          ])
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "box",
        { attrs: { title: "上岗要求" } },
        [
          _c("detail", { attrs: { title: "需要拆后座" } }, [
            _vm._v(
              _vm._s(_vm.task.extra.other.is_remove_seat === 1 ? "是" : "否")
            )
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "需要小推车" } }, [
            _vm._v(_vm._s(_vm.task.extra.other.is_trolley === 1 ? "是" : "否"))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "需要带尾板" } }, [
            _vm._v(
              _vm._s(_vm.task.extra.other.is_tail_plate === 1 ? "是" : "否")
            )
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "需要配备双灭火器" } }, [
            _vm._v(
              _vm._s(_vm.task.extra.other.is_extinguisher === 1 ? "是" : "否")
            )
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "需要配备明锁/暗锁" } }, [
            _vm._v(_vm._s(_vm.task.extra.other.is_lock === 1 ? "是" : "否"))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "其他上岗要求" } }, [
            _vm._v(_vm._s(_vm.task.extra.other.other_require))
          ])
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "box",
        { attrs: { title: "其他说明" } },
        [
          _c("detail", { attrs: { title: "任务补充说明", span: 25 } }, [
            _vm._v(_vm._s(_vm._f("valueOfSingle")(_vm.task.extra.supply)))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "配送经验要求", span: 25 } }, [
            _vm._v(_vm._s(_vm._f("valueOfSingle")(_vm.task.extra.dispatching)))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "司机福利/补贴/奖励", span: 25 } }, [
            _vm._v(_vm._s(_vm._f("valueOfSingle")(_vm.task.extra.welfare)))
          ])
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-0d7eb138", module.exports)
  }
}

/***/ }),

/***/ 444:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(445);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("23288e0a", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-39a61d40\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/_sass-loader@6.0.7@sass-loader/lib/loader.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./home.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-39a61d40\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/_sass-loader@6.0.7@sass-loader/lib/loader.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./home.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 445:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.amap-demo,\n.amap-page-container {\n  height: 100%;\n}\n.btn {\n  float: left;\n  height: 2.2rem;\n  display: inline-block;\n  border: 1px solid #dcdee2;\n  background-color: #fff;\n  text-align: center;\n  line-height: 2.2rem;\n  padding: 0 1rem;\n  color: #000;\n}\n.btn:nth-child(2) {\n    border-left: none;\n    border-right: none;\n}\n.btn.pointer {\n    cursor: pointer;\n}\n.btn.pointer:hover {\n      color: #2d8cf0;\n}\n.btn.btn-radius-left {\n    border-radius: 4px 0 0 4px;\n}\n.btn.btn-radius-right {\n    border-radius: 0 4px 4px 0;\n}\n.btn .icon-green {\n    color: #34ccb6;\n}\n.btn .icon-yellow {\n    color: #fab308;\n}\n.btn .icon-red {\n    color: #da0000;\n}\n.top {\n  position: fixed;\n  z-index: 99;\n  top: 7.5rem;\n  left: 13.75rem;\n  width: 100%;\n  display: -webkit-box;\n  display: -ms-flexbox;\n  display: flex;\n}\n.top .tip {\n    float: right;\n    height: 2.2rem;\n    line-height: 2rem;\n    border-radius: 5px 0 0 5px;\n    background-color: #fff;\n    display: inline-block;\n    -webkit-box-shadow: 0px 2px 2px #d0cfcc;\n    box-shadow: 0px 2px 2px #d0cfcc;\n    margin-left: 3rem;\n    -webkit-box-sizing: border-box;\n    box-sizing: border-box;\n    padding: 0.31rem 0;\n}\n.top .tip ul {\n      list-style: none;\n      margin: 0px;\n      padding: 0 20px;\n      float: left;\n}\n.top .tip ul li {\n        float: left;\n        list-style: none;\n        border: 1px #dadada solid;\n        height: 24px;\n        line-height: 23px;\n        -webkit-box-sizing: border-box;\n        box-sizing: border-box;\n        padding: 0 12px;\n        cursor: pointer;\n        color: #000;\n}\n.top .tip ul li:hover {\n          color: #2d8cf0;\n}\n.top .time_box {\n    -webkit-box-shadow: 0px 2px 2px #d0cfcc;\n    box-shadow: 0px 2px 2px #d0cfcc;\n    border-left: none;\n    height: 2.2rem;\n}\n.top .time_box .time_temp {\n      height: 2.2rem;\n      width: 10rem;\n      line-height: 2.2rem;\n      text-align: center;\n      font-size: 14px;\n      background-color: #fff;\n      float: left;\n}\n.top .time_box .time_icon {\n      display: inline-block;\n      width: 2.2rem;\n      height: 2.2rem;\n      background-color: #fff;\n      color: #414141;\n      font-size: 1rem;\n      text-align: center;\n      line-height: 2.2rem;\n      border-left: 1px #dadada solid;\n      border-radius: 0 5px 5px 0;\n}\n.ivu-input-group {\n  width: 25%;\n}\n.ivu-input-group-append .ivu-btn {\n  background-color: #2d8cf0;\n  color: #fff;\n}\n.ivu-card-head p {\n  font-weight: 400;\n  padding-left: 0.8rem;\n}\n.card_table {\n  border-collapse: collapse;\n  border: 1px #dadada solid;\n  margin-bottom: 0.5rem;\n}\n.card_table td {\n    padding: 6px 18px;\n    text-align: center;\n    border: 1px #dadada solid;\n    cursor: pointer;\n}\n.cardmin {\n  position: absolute;\n  display: inline-block;\n  width: 28px;\n  height: 55px;\n  padding: 8px;\n  background-color: #fff;\n  border-top-right-radius: 5px;\n  border-bottom-right-radius: 5px;\n  border: 1px solid #dadada;\n  border-left: none;\n  top: 1.2rem;\n  right: -5px;\n  color: #414141;\n  cursor: pointer;\n}\n.amap-window {\n  width: 11rem;\n}\n.amap-window dd {\n    margin-left: 0;\n    color: #666666;\n    line-height: 25px;\n    display: -webkit-box;\n    display: -ms-flexbox;\n    display: flex;\n}\n.amap-window dd strong {\n      font-weight: normal;\n      -ms-flex-preferred-size: 60px;\n      flex-basis: 60px;\n      text-align: right;\n}\n.amap-window dd span {\n      margin-left: 0.3rem;\n      color: #010101;\n      -webkit-box-flex: 1;\n      -ms-flex: 1;\n      flex: 1;\n}\n.prompt {\n  width: 12rem;\n  background-color: #fff;\n  height: 3rem;\n  line-height: 3rem;\n  position: relative;\n  bottom: 8rem;\n  right: -88rem;\n  padding-left: 0.6rem;\n  border-radius: 10px;\n}\n.prompt .tools {\n    color: #000;\n}\n.prompt .tools i {\n      display: inline-block;\n      height: 16px;\n      width: 16px;\n      vertical-align: middle;\n}\n.layout > .ivu-layout .layout-footer-center {\n  display: none;\n}\n.layout > .ivu-layout .layout-content-main > div {\n  display: -webkit-box;\n}\n.marker-car,\n.marker-warehouse,\n.marker-delivery {\n  display: block;\n  height: 28px;\n  width: 28px;\n  border: 3px solid #fff;\n  text-align: center;\n  border-radius: 50%;\n  color: #fff;\n  font-size: 16px;\n}\n.marker-car {\n  background-color: #c300d5;\n}\n.marker-warehouse {\n  background-color: #414141;\n}\n.yellow {\n  background-color: #fab308;\n}\n.green {\n  background-color: #34ccb6;\n}\n.red {\n  background-color: #da0000;\n}\n", ""]);

// exports


/***/ }),

/***/ 446:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _vueAmap = __webpack_require__(146);

var _lists = __webpack_require__(265);

var _lists2 = _interopRequireDefault(_lists);

var _moment = __webpack_require__(0);

var _moment2 = _interopRequireDefault(_moment);

var _view = __webpack_require__(357);

var _view2 = _interopRequireDefault(_view);

var _show = __webpack_require__(370);

var _show2 = _interopRequireDefault(_show);

var _information = __webpack_require__(447);

var _information2 = _interopRequireDefault(_information);

var _markers = __webpack_require__(448);

var _markers2 = _interopRequireDefault(_markers);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
    mixins: [_lists2.default, _information2.default, _markers2.default],
    data: function data() {
        var _this = this;

        return {
            amapManager: _vueAmap.amapManager,
            buttonSize: "large",
            cardflag: true,
            pack: "收起",
            zoom: 12,
            center: [113.933665, 22.517327],
            ceju: false,
            ranging: null,
            driving: null,
            time: "",
            list: [],
            status: [],
            point: [],
            page: "",
            marker_visi: true,
            search_val: "",
            search_sel: "",
            status_type: {
                0: "未签到",
                1: "签到",
                2: "配送中",
                3: "已完成",
                4: "不配送",
                5: "取消"
            },
            open: false,
            events: {
                init: function init(o) {
                    AMap.plugin(["AMap.RangingTool", "AMap.TruckDriving"], function () {
                        _this.ranging = new AMap.RangingTool(o);
                    });
                }
            },
            makerEvents: {
                click: function click(e) {
                    _this.information(e.target.F);
                }
            }
        };
    },
    created: function created() {
        this.getTime();
    },

    methods: {
        handleClick: function handleClick() {
            this.open = !this.open;
        },
        handleChange: function handleChange(date) {
            this.time = date;
            this.settime();
        },
        handleClear: function handleClear() {
            this.open = false;
        },
        handleOk: function handleOk() {
            this.open = false;
        },
        cejuf: function cejuf() {
            if (this.ranging !== null) {
                if (this.ceju) {
                    this.ceju = false;
                    this.ranging.turnOff();
                } else {
                    this.ceju = true;
                    this.ranging.turnOn();
                }
            }
        },
        marker_isvisi: function marker_isvisi() {
            if (this.marker_visi) {
                this.marker_visi = false;
            } else {
                this.marker_visi = true;
            }
        },
        getTime: function getTime() {
            this.time = new Date();
            this.settime();
        },
        last: function last() {
            this.time = new Date();
            this.time = new Date(this.time.getTime() - 24 * 60 * 60 * 1000);
            this.settime();
        },
        next: function next() {
            this.time = new Date();
            this.time = new Date(this.time.getTime() + 24 * 60 * 60 * 1000);
            this.settime();
        },
        req: function req(url, pages) {
            var _this2 = this;

            this.$http.get(url, {
                params: {
                    page: pages,
                    arrival_warehouse_time: (0, _moment2.default)(this.time).format("YYYY-MM-DD")
                }
            }).then(function (res) {
                _this2.list = res.data.data.data;
                _this2.status = res.data.data.status;
                _this2.point = res.data.data.point;
                _this2.page = _this2.list.current_page;
                _this2.markers.data = JSON.parse(JSON.stringify(res.data.data.data.data));
            });
        },
        settime: function settime() {
            this.req("index/index", 1);
            if (this.driving) {
                this.driving.clear();
            }
            this.position = "";
            this.content = "";
        },
        last_page: function last_page() {
            this.req("index/index", this.page + 1);
        },
        prev_page: function prev_page() {
            this.req("index/index", this.page - 1);
        },
        cardmin: function cardmin() {
            if (this.cardflag) {
                this.pack = "展开";
            } else {
                this.pack = "收起";
            }
            this.cardflag = !this.cardflag;
        },
        search: function search() {
            if (this.search_sel === "merchants") {
                this.req("index/index?merchant=" + this.search_val);
            } else if (this.search_sel === "task") {
                this.req("index/index?task=" + this.search_val);
            } else if (this.search_sel === "driver") {
                this.req("index/index?driver=" + this.search_val);
            }
        },
        tab: function tab(sta) {
            this.req("index/index?status=" + sta);
        },
        car_close: function car_close(row) {
            this.showComponent("mView", row);
        },
        task: function task(row) {
            row.id = row.task_id;
            this.showComponent("show", row);
        },
        card_coor: function card_coor(item) {
            this.markers.data = [item];
            var truck = [{
                lnglat: item.warehouse.location
            }];
            item.delivery.forEach(function (delivery) {
                truck.push({
                    lnglat: [delivery.lng, delivery.lat]
                });
            });
            this.setTruckDriving(truck);
        },
        setTruckDriving: function setTruckDriving(paths) {
            if (this.driving) {
                this.driving.clear();
            }
            this.driving = new AMap.TruckDriving({
                map: this.$refs["amap"].$amap,
                policy: 0,
                size: 1,
                hideMarkers: true,
                autoFitView: true
            });
            this.driving.search(paths);
        }
    },
    components: {
        mView: _view2.default,
        show: _show2.default
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
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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

/***/ 447:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = {
    props: {},
    data: function data() {
        var _this = this;

        return {
            content: "",
            position: "",
            status_res: {
                0: "待配送",
                1: "已妥投",
                2: "未妥投"
            },
            windowEvents: {
                close: function close() {
                    _this.position = "";
                }
            },
            information: function information(cont) {
                if (cont.vid == "car-marker") {
                    this.position = cont.extData.position.location;
                    this.content = "<div class=\"amap-window\">\n                                <h6>" + cont.extData.position.address + "</h6>\n                                <dl>\n                                    <dd>\n                                        <strong>\u4ED3\u540D\u79F0:</strong>\n                                        <span>\n                                            " + cont.extData.warehouse.title + "\n                                        </span>\n                                    </dd>\n                                    <dd>\n                                        <strong>\u53F8\u673A\u59D3\u540D:</strong>\n                                        <span>\n                                            " + cont.extData.driver.name + "\n                                        </span>\n                                    </dd>\n                                    <dd>\n                                        <strong>\u8054\u7CFB\u7535\u8BDD:</strong>\n                                        <span>\n                                            " + cont.extData.driver.phone + "\n                                        </span>\n                                    </dd>\n                                    <dd>\n                                        <strong>\u8F66\u724C\u53F7:</strong>\n                                        <span>\n                                            " + cont.extData.driver.car_number + "\n                                        </span>\n                                    </dd>\n                                    <dd>\n                                        <strong>\u5B9A\u4F4D\u65F6\u95F4:</strong>\n                                        <span>\n                                            " + cont.extData.position.createTime + "\n                                        </span>\n                                    </dd>\n                                </dl>\n                            </div>";
                } else if (cont.vid == "warehouse-marker") {
                    this.position = cont.extData.location;
                    this.content = "                    <div class=\"amap-window\">\n                        <h6>" + cont.extData.address + "</h6>\n                        <dl>\n                            <dd>\n                                <strong>\u8054\u7CFB\u4EBA:</strong>\n                                <span>" + cont.extData.contacts + "</span>\n                            </dd>\n                            <dd>\n                                <strong>\u8054\u7CFB\u7535\u8BDD:</strong>\n                                <span>" + cont.extData.contacts_phone + "</span>\n                            </dd>\n                        </dl>\n                    </div>";
                } else {
                    this.position = cont.extData.location;
                    this.content = "                    <div class=\"amap-window\">\n                        <h6>\n                            " + cont.extData.task.name + "\n                        </h6>\n                        <dl>\n                            <dd>\n                                <strong>\u8054\u7CFB\u4EBA:</strong>\n                                <span>" + cont.extData.contacts + "</span>\n                            </dd>\n                            <dd>\n                                <strong>\u8054\u7CFB\u7535\u8BDD:</strong>\n                                <span>" + cont.extData.contact_way + "</span>\n                            </dd>\n                            <dd>\n                                <strong>\u59A5\u6295\u7ED3\u679C:</strong>\n                                <span>" + this.status_res[cont.extData.status] + "</span>\n                            </dd>\n                            <dd>\n                                <strong>\u59A5\u6295\u65F6\u95F4:</strong>\n                                <span>" + (cont.extData.finish_time == null ? "-" : cont.extData.finish_time) + "</span>\n                            </dd>\n                            <dd>\n                                <strong>\u59A5\u6295\u70B9:</strong>\n                                <span>" + cont.extData.name + "</span>\n                            </dd>\n                            <dd>\n                                <h6>\n                                    <span style=\"background-color: #2d8cf0;padding:2px;color:#fff\">" + (cont.extData.task.type == 1 ? "主" : "临") + "</span>\n                                    " + cont.extData.task.name + "\n                                </h6>\n                            </dd>\n                            <dd>\n                                <strong>\u53F8\u673A\u59D3\u540D:</strong>\n                                <span>" + cont.extData.driver.name + "</span>\n                            </dd>\n                            <dd>\n                                <strong>\u8054\u7CFB\u7535\u8BDD:</strong>\n                                <span>" + cont.extData.driver.phone + "</span>\n                            </dd>\n                        </dl>\n                    </div>";
                }
            }
        };
    }
};

/***/ }),

/***/ 448:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = {
    props: {},
    data: function data() {
        return {
            markers: {
                data: [],
                car: function car(h, _ref) {
                    var extData = _ref.extData;

                    return h(
                        "span",
                        { "class": "marker-car" },
                        [h(
                            "i",
                            { "class": " ivu-icon ivu-icon-ios-car" },
                            [" "]
                        )]
                    );
                },
                warehouse: function warehouse(h, _ref2) {
                    var extData = _ref2.extData;

                    return h(
                        "span",
                        { "class": "marker-warehouse" },
                        ["\u4ED3"]
                    );
                },
                delivery: function delivery(h, _ref3) {
                    var extData = _ref3.extData;

                    if (extData.status == 0) {
                        return h(
                            "span",
                            { "class": "marker-delivery yellow" },
                            [extData.sort]
                        );
                    } else if (extData.status == 1) {
                        return h(
                            "span",
                            { "class": "marker-delivery green" },
                            [extData.sort]
                        );
                    } else {
                        return h(
                            "span",
                            { "class": "marker-delivery red" },
                            [extData.sort]
                        );
                    }
                }
            }
        };
    }
};

/***/ }),

/***/ 449:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c(
        "div",
        { staticClass: "top" },
        [
          _c(
            "Input",
            {
              attrs: {
                search: "",
                placeholder: "请输入商户简称/线路名称/司机姓名"
              },
              model: {
                value: _vm.search_val,
                callback: function($$v) {
                  _vm.search_val = $$v
                },
                expression: "search_val"
              }
            },
            [
              _c(
                "Select",
                {
                  staticStyle: { width: "80px" },
                  attrs: { slot: "prepend" },
                  slot: "prepend",
                  model: {
                    value: _vm.search_sel,
                    callback: function($$v) {
                      _vm.search_sel = $$v
                    },
                    expression: "search_sel"
                  }
                },
                [
                  _c("Option", { attrs: { value: "merchants" } }, [
                    _vm._v("商户")
                  ]),
                  _vm._v(" "),
                  _c("Option", { attrs: { value: "task" } }, [_vm._v("线路")]),
                  _vm._v(" "),
                  _c("Option", { attrs: { value: "driver" } }, [_vm._v("司机")])
                ],
                1
              ),
              _vm._v(" "),
              _c("Button", {
                attrs: { slot: "append", icon: "ios-search" },
                on: {
                  click: function($event) {
                    _vm.search()
                  }
                },
                slot: "append"
              })
            ],
            1
          ),
          _vm._v(" "),
          _c("div", { style: { marginLeft: "5rem" } }, [
            _c(
              "span",
              {
                staticClass: "btn btn-radius-left pointer",
                on: {
                  click: function($event) {
                    _vm.settime()
                  }
                }
              },
              [_c("Icon", { attrs: { type: "md-sync" } }), _vm._v(" 刷新")],
              1
            ),
            _vm._v(" "),
            _c(
              "span",
              {
                staticClass: "btn pointer",
                on: {
                  click: function($event) {
                    _vm.cejuf()
                  }
                }
              },
              [
                _c("Icon", { attrs: { type: "md-color-filter" } }),
                _vm._v(" 测距")
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "span",
              {
                directives: [
                  {
                    name: "show",
                    rawName: "v-show",
                    value: _vm.marker_visi,
                    expression: "marker_visi"
                  }
                ],
                staticClass: "btn btn-radius-right pointer",
                on: {
                  click: function($event) {
                    _vm.marker_isvisi()
                  }
                }
              },
              [
                _c("Icon", { attrs: { type: "ios-eye-off" } }),
                _vm._v(" 隐藏配送点")
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "span",
              {
                directives: [
                  {
                    name: "show",
                    rawName: "v-show",
                    value: !_vm.marker_visi,
                    expression: "!marker_visi"
                  }
                ],
                staticClass: "btn btn-radius-right pointer",
                on: {
                  click: function($event) {
                    _vm.marker_isvisi()
                  }
                }
              },
              [
                _c("Icon", { attrs: { type: "ios-eye" } }),
                _vm._v(" 显示配送点")
              ],
              1
            )
          ]),
          _vm._v(" "),
          _c("div", { style: { marginLeft: "5rem" } }, [
            _c("span", { staticClass: "btn btn-radius-left" }, [
              _vm._v("订单:待配送\n                "),
              _c("b", { staticClass: "icon-yellow" }, [
                _vm._v(" " + _vm._s(_vm.point[0]))
              ])
            ]),
            _vm._v(" "),
            _c("span", { staticClass: "btn" }, [
              _vm._v("已妥投\n                "),
              _c("b", { staticClass: "icon-green" }, [
                _vm._v(" " + _vm._s(_vm.point[1]))
              ])
            ]),
            _vm._v(" "),
            _c("span", { staticClass: "btn btn-radius-right" }, [
              _vm._v("未妥投\n                "),
              _c("b", { staticClass: "icon-red" }, [
                _vm._v(" " + _vm._s(_vm.point[2]))
              ])
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "tip" }, [
            _c("ul", [
              _c(
                "li",
                {
                  on: {
                    click: function($event) {
                      _vm.last()
                    }
                  }
                },
                [_vm._v("昨天")]
              ),
              _vm._v(" "),
              _c(
                "li",
                {
                  on: {
                    click: function($event) {
                      _vm.getTime()
                    }
                  }
                },
                [_vm._v("今天")]
              ),
              _vm._v(" "),
              _c(
                "li",
                {
                  on: {
                    click: function($event) {
                      _vm.next()
                    }
                  }
                },
                [_vm._v("明天")]
              )
            ])
          ]),
          _vm._v(" "),
          _c(
            "DatePicker",
            {
              attrs: {
                open: _vm.open,
                value: _vm.time,
                confirm: "",
                type: "date"
              },
              on: {
                "on-change": _vm.handleChange,
                "on-clear": _vm.handleClear,
                "on-ok": _vm.handleOk
              }
            },
            [
              _c("div", { staticClass: "time_box" }, [
                _c("div", { staticClass: "time_temp" }, [
                  _vm._v(_vm._s(_vm._f("timeformat")(_vm.time)))
                ]),
                _vm._v(" "),
                _c(
                  "a",
                  {
                    staticClass: "time_icon",
                    attrs: { href: "javascript:void(0)" },
                    on: { click: _vm.handleClick }
                  },
                  [_c("Icon", { attrs: { type: "ios-calendar-outline" } })],
                  1
                )
              ])
            ]
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "div",
        {
          staticStyle: {
            padding: "20px",
            position: "absolute",
            "z-index": "1",
            top: "1.9rem"
          }
        },
        [
          _c(
            "Card",
            {
              directives: [
                {
                  name: "show",
                  rawName: "v-show",
                  value: _vm.cardflag,
                  expression: "cardflag"
                }
              ],
              style: { borderRadius: "5px", border: "1px solid #dadada" },
              attrs: { bordered: false }
            },
            [
              _c("table", { staticClass: "card_table" }, [
                _c("tbody", [
                  _c("tr", [
                    _c(
                      "td",
                      {
                        attrs: { rowspan: "2" },
                        on: {
                          click: function($event) {
                            _vm.settime()
                          }
                        }
                      },
                      [
                        _vm._v(
                          "全部 " +
                            _vm._s(
                              _vm.status[0] +
                                _vm.status[1] +
                                _vm.status[2] +
                                _vm.status[3] +
                                _vm.status[4] +
                                _vm.status[6]
                            )
                        )
                      ]
                    ),
                    _vm._v(" "),
                    _c(
                      "td",
                      {
                        on: {
                          click: function($event) {
                            _vm.tab(0)
                          }
                        }
                      },
                      [_vm._v("未签到 " + _vm._s(_vm.status[0]))]
                    ),
                    _vm._v(" "),
                    _c(
                      "td",
                      {
                        on: {
                          click: function($event) {
                            _vm.tab(1)
                          }
                        }
                      },
                      [_vm._v("签到 " + _vm._s(_vm.status[1]))]
                    ),
                    _vm._v(" "),
                    _c(
                      "td",
                      {
                        on: {
                          click: function($event) {
                            _vm.tab(2)
                          }
                        }
                      },
                      [_vm._v("配送中 " + _vm._s(_vm.status[2]))]
                    )
                  ]),
                  _vm._v(" "),
                  _c("tr", [
                    _c(
                      "td",
                      {
                        on: {
                          click: function($event) {
                            _vm.tab(3)
                          }
                        }
                      },
                      [_vm._v("已完成 " + _vm._s(_vm.status[3]))]
                    ),
                    _vm._v(" "),
                    _c(
                      "td",
                      {
                        on: {
                          click: function($event) {
                            _vm.tab(4)
                          }
                        }
                      },
                      [_vm._v("不配送 " + _vm._s(_vm.status[4]))]
                    ),
                    _vm._v(" "),
                    _c(
                      "td",
                      {
                        on: {
                          click: function($event) {
                            _vm.tab(6)
                          }
                        }
                      },
                      [_vm._v("取消 " + _vm._s(_vm.status[6]))]
                    )
                  ])
                ])
              ]),
              _vm._v(" "),
              _vm._l(_vm.list.data, function(i, index) {
                return _c(
                  "Card",
                  {
                    key: index,
                    staticStyle: {
                      width: "350px",
                      "font-size": "12px",
                      "margin-bottom": "6px"
                    }
                  },
                  [
                    _c("p", { attrs: { slot: "title" }, slot: "title" }, [
                      _c("span", { staticClass: "temporary" }, [
                        _vm._v(_vm._s(i.task.type == 1 ? "主" : "临"))
                      ]),
                      _vm._v(" "),
                      _c(
                        "span",
                        {
                          staticClass: "nameFormat",
                          style: { margin: "0 0.2rem" }
                        },
                        [_vm._v(_vm._s(i.name))]
                      ),
                      _vm._v(" "),
                      _c(
                        "span",
                        {
                          staticClass: "nameFormat",
                          style: { margin: "0 0.2rem" }
                        },
                        [_vm._v(_vm._s(i.merchant.short_name))]
                      ),
                      _vm._v(" "),
                      _c(
                        "a",
                        {
                          attrs: { slot: "extra" },
                          on: {
                            click: function($event) {
                              _vm.task(i)
                            }
                          },
                          slot: "extra"
                        },
                        [
                          _vm._v(
                            "\n                        任务详情\n                    "
                          )
                        ]
                      )
                    ]),
                    _vm._v(" "),
                    _c(
                      "a",
                      {
                        attrs: { slot: "extra" },
                        on: {
                          click: function($event) {
                            _vm.car_close(i)
                          }
                        },
                        slot: "extra"
                      },
                      [
                        _vm._v(
                          "\n                    详情\n                    "
                        ),
                        _c("Icon", { attrs: { type: "md-arrow-dropright" } })
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      {
                        staticClass: "card_body",
                        on: {
                          click: function($event) {
                            _vm.card_coor(i)
                          }
                        }
                      },
                      [
                        _c("p", [
                          _vm._v(
                            _vm._s(i.car_type.name) + "\n                    "
                          )
                        ]),
                        _vm._v(" "),
                        _c(
                          "router-link",
                          {
                            style: { color: "#515a6e" },
                            attrs: { to: "task.create" }
                          },
                          [
                            _vm._v(
                              _vm._s(i.driver.name) + _vm._s(i.driver.phone)
                            )
                          ]
                        ),
                        _vm._v(" "),
                        _c("br"),
                        _vm._v(
                          _vm._s(_vm.status_type[i.status]) + _vm._s(i.late)
                        ),
                        _c("br"),
                        _vm._v(
                          " 到仓时间：" +
                            _vm._s(i.arrival_warehouse_time) +
                            "\n\n                "
                        )
                      ],
                      1
                    )
                  ]
                )
              }),
              _vm._v(" "),
              _c(
                "div",
                { style: { textAlign: "right" } },
                [
                  _c(
                    "Button",
                    {
                      style: { color: "#2b85e4" },
                      attrs: { type: "dashed" },
                      on: {
                        click: function($event) {
                          _vm.prev_page()
                        }
                      }
                    },
                    [_vm._v("上一页")]
                  ),
                  _vm._v(
                    _vm._s(_vm.list.current_page) +
                      "/" +
                      _vm._s(_vm.list.last_page) +
                      "\n                "
                  ),
                  _c(
                    "Button",
                    {
                      style: { color: "#2b85e4" },
                      attrs: { type: "dashed" },
                      on: {
                        click: function($event) {
                          _vm.last_page()
                        }
                      }
                    },
                    [_vm._v("下一页")]
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "div",
                { style: { textAlign: "right" } },
                [
                  _c(
                    "Button",
                    {
                      attrs: {
                        type: "primary",
                        ghost: "",
                        to: "task.create/?type=1"
                      }
                    },
                    [_vm._v("+招主司机")]
                  ),
                  _vm._v(" "),
                  _c(
                    "Button",
                    { attrs: { type: "primary", to: "task.create/?type=2" } },
                    [_vm._v("+招临时司机")]
                  )
                ],
                1
              )
            ],
            2
          ),
          _vm._v(" "),
          _c(
            "span",
            {
              staticClass: "cardmin",
              on: {
                click: function($event) {
                  _vm.cardmin()
                }
              }
            },
            [_vm._v("\n            " + _vm._s(_vm.pack) + "\n        ")]
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "amap-page-container" },
        [
          _c(
            "el-amap",
            {
              ref: "amap",
              staticClass: "amap-demo",
              attrs: {
                vid: "amapDemo",
                "amap-manager": _vm.amapManager,
                center: _vm.center,
                events: _vm.events,
                zoom: _vm.zoom
              }
            },
            [
              _vm._l(_vm.markers.data, function(item, index) {
                return [
                  item.position
                    ? _c("el-amap-marker", {
                        key: "car" + index,
                        attrs: {
                          vid: "car-marker",
                          position: item.position.location,
                          "ext-data": item,
                          events: _vm.makerEvents,
                          "content-render": _vm.markers.car
                        }
                      })
                    : _vm._e(),
                  _vm._v(" "),
                  item.warehouse.location
                    ? _c("el-amap-marker", {
                        key: "warehouse" + index,
                        attrs: {
                          vid: "warehouse-marker",
                          position: item.warehouse.location,
                          events: _vm.makerEvents,
                          "ext-data": item.warehouse,
                          "content-render": _vm.markers.warehouse
                        }
                      })
                    : _vm._e(),
                  _vm._v(" "),
                  _vm._l(item.delivery, function(val, key) {
                    return _c("el-amap-marker", {
                      key: index + "-" + key,
                      staticClass: "amap-marker",
                      attrs: {
                        vid: "delivery-marker",
                        position: val.location,
                        events: _vm.makerEvents,
                        "ext-data": val,
                        visible: _vm.marker_visi,
                        "content-render": _vm.markers.delivery
                      }
                    })
                  })
                ]
              }),
              _vm._v(" "),
              _vm.position
                ? _c("el-amap-info-window", {
                    attrs: {
                      position: _vm.position,
                      events: _vm.windowEvents,
                      content: _vm.content
                    }
                  })
                : _vm._e()
            ],
            2
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(_vm.component.current, {
        tag: "components",
        attrs: { data: _vm.component.data },
        on: { "on-change": _vm.hideComponent }
      }),
      _vm._v(" "),
      _vm._m(0)
    ],
    1
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "prompt" }, [
      _c("span", { staticClass: "tools" }, [
        _c("i", { staticClass: "yellow" }),
        _vm._v(" 待配送\n        ")
      ]),
      _vm._v(" "),
      _c("span", { staticClass: "tools" }, [
        _c("i", { staticClass: "green" }),
        _vm._v(" 已妥投\n        ")
      ]),
      _vm._v(" "),
      _c("span", { staticClass: "tools" }, [
        _c("i", { staticClass: "red" }),
        _vm._v(" 未妥投\n        ")
      ])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-39a61d40", module.exports)
  }
}

/***/ })

});