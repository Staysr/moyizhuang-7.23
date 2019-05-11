webpackJsonp([1],{

/***/ 251:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(684)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(686)
/* template */
var __vue_template__ = __webpack_require__(722)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-61be83e9"
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
Component.options.__file = "resources/assets/admin/js/views/taskOrder/index.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-61be83e9", Component.options)
  } else {
    hotAPI.reload("data-v-61be83e9", Component.options)
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

/***/ 269:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(276)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(278)
/* template */
var __vue_template__ = __webpack_require__(283)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-40e93a72"
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
Component.options.__file = "resources/assets/admin/js/components/layout/my-lists.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-40e93a72", Component.options)
  } else {
    hotAPI.reload("data-v-40e93a72", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 270:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
function broadcast(componentName, eventName, params) {
    this.$children.forEach(child => {
        const name = child.$options.name;

        if (name === componentName) {
            child.$emit.apply(child, [eventName].concat(params));
        } else {
            // todo 如果 params 是空数组，接收到的会是 undefined
            broadcast.apply(child, [componentName, eventName].concat([params]));
        }
    });
}
/* harmony default export */ __webpack_exports__["default"] = ({
    methods: {
        dispatch(componentName, eventName, params) {
            let parent = this.$parent || this.$root;
            let name = parent.$options.name;

            while (parent && (!name || name !== componentName)) {
                parent = parent.$parent;

                if (parent) {
                    name = parent.$options.name;
                }
            }
            if (parent) {
                parent.$emit.apply(parent, [eventName].concat(params));
            }
        },
        broadcast(componentName, eventName, params) {
            broadcast.call(this, componentName, eventName, params);
        }
    }
});

/***/ }),

/***/ 271:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(279)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(281)
/* template */
var __vue_template__ = __webpack_require__(282)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-4bf4d225"
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
Component.options.__file = "resources/assets/admin/js/components/table/my-table.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-4bf4d225", Component.options)
  } else {
    hotAPI.reload("data-v-4bf4d225", Component.options)
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

/***/ 276:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(277);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("1f8f95fc", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-40e93a72\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./my-lists.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-40e93a72\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./my-lists.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 277:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.ivu-table .table-info-row td[data-v-40e93a72]{\n    background-color: #2db7f5;\n    color: #fff;\n}\n", ""]);

// exports


/***/ }),

/***/ 278:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _myTable = __webpack_require__(271);

var _myTable2 = _interopRequireDefault(_myTable);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
    name: "my-lists",
    components: { MyTable: _myTable2.default },
    props: {
        value: {
            type: Object,
            default: function _default() {
                return { data: [], page: { total: 100, current: 1, page_size: 20 } };
            }
        },
        columns: {
            type: Array,
            default: function _default() {
                return [];
            }
        },
        loading: {
            type: Boolean,
            default: false
        }
    },
    methods: {
        change: function change(v) {
            this.$emit('change', v);
        },
        rowClassName: function rowClassName(row, index) {}
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

/***/ }),

/***/ 279:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(280);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("1b37e07c", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-4bf4d225\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./my-table.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-4bf4d225\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./my-table.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 280:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 281:
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

exports.default = {
    name: "my-table",
    props: {
        data: {
            type: Array,
            default: function _default() {
                return [];
            }
        },
        columns: {
            type: Array,
            default: function _default() {
                return [];
            }
        },
        loading: {
            type: Boolean,
            default: false
        }
    },
    data: function data() {
        return {
            leftCol: [{
                title: '序号',
                render: function render(h, _ref) {
                    var index = _ref.index;

                    return h(
                        "span",
                        null,
                        [++index]
                    );
                },
                width: 75
            }],
            rightCol: []
        };
    },

    computed: {
        tableCol: function tableCol() {
            return this.leftCol.concat(this.columns, this.rightCol);
        }
    }
};

/***/ }),

/***/ 282:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("Table", {
    ref: "table",
    attrs: {
      columns: _vm.tableCol,
      data: _vm.data,
      size: "small",
      loading: _vm.loading
    }
  })
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-4bf4d225", module.exports)
  }
}

/***/ }),

/***/ 283:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _vm._t("default"),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "box-flex-list" },
        [
          _c(
            "Card",
            { attrs: { "dis-hover": "" } },
            [
              _c(
                "p",
                { attrs: { slot: "title" }, slot: "title" },
                [
                  _vm._t("title", [_c("span", [_vm._v("列表")])]),
                  _vm._v(" "),
                  _vm._t("button")
                ],
                2
              ),
              _vm._v(" "),
              _c("my-table", {
                ref: "table",
                attrs: {
                  columns: _vm.columns,
                  data: _vm.value.data,
                  size: "small",
                  "row-class-name": _vm.rowClassName,
                  loading: _vm.loading
                }
              }),
              _vm._v(" "),
              _c("Page", {
                attrs: {
                  total: _vm.value.page.total,
                  size: "small",
                  current: _vm.value.page.current,
                  "page-size": _vm.value.page.page_size,
                  "show-total": ""
                },
                on: { "on-change": _vm.change }
              })
            ],
            1
          )
        ],
        1
      )
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-40e93a72", module.exports)
  }
}

/***/ }),

/***/ 284:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony export (immutable) */ __webpack_exports__["oneOf"] = oneOf;
/* harmony export (immutable) */ __webpack_exports__["camelcaseToHyphen"] = camelcaseToHyphen;
/* harmony export (immutable) */ __webpack_exports__["getScrollBarSize"] = getScrollBarSize;
/* harmony export (immutable) */ __webpack_exports__["getStyle"] = getStyle;
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "firstUpperCase", function() { return firstUpperCase; });
/* harmony export (immutable) */ __webpack_exports__["warnProp"] = warnProp;
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "deepCopy", function() { return deepCopy; });
/* harmony export (immutable) */ __webpack_exports__["scrollTop"] = scrollTop;
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "findComponentUpward", function() { return findComponentUpward; });
/* harmony export (immutable) */ __webpack_exports__["findComponentDownward"] = findComponentDownward;
/* harmony export (immutable) */ __webpack_exports__["findComponentsDownward"] = findComponentsDownward;
/* harmony export (immutable) */ __webpack_exports__["findComponentsUpward"] = findComponentsUpward;
/* harmony export (immutable) */ __webpack_exports__["findBrothersComponents"] = findBrothersComponents;
/* harmony export (immutable) */ __webpack_exports__["hasClass"] = hasClass;
/* harmony export (immutable) */ __webpack_exports__["addClass"] = addClass;
/* harmony export (immutable) */ __webpack_exports__["removeClass"] = removeClass;
/* harmony export (immutable) */ __webpack_exports__["setMatchMedia"] = setMatchMedia;
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vue__ = __webpack_require__(5);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_vue__);

const isServer = __WEBPACK_IMPORTED_MODULE_0_vue___default.a.prototype.$isServer;
// 判断参数是否是其中之一
function oneOf (value, validList) {
    for (let i = 0; i < validList.length; i++) {
        if (value === validList[i]) {
            return true;
        }
    }
    return false;
}

function camelcaseToHyphen (str) {
    return str.replace(/([a-z])([A-Z])/g, '$1-$2').toLowerCase();
}

// For Modal scrollBar hidden
let cached;
function getScrollBarSize (fresh) {
    if (isServer) return 0;
    if (fresh || cached === undefined) {
        const inner = document.createElement('div');
        inner.style.width = '100%';
        inner.style.height = '200px';

        const outer = document.createElement('div');
        const outerStyle = outer.style;

        outerStyle.position = 'absolute';
        outerStyle.top = 0;
        outerStyle.left = 0;
        outerStyle.pointerEvents = 'none';
        outerStyle.visibility = 'hidden';
        outerStyle.width = '200px';
        outerStyle.height = '150px';
        outerStyle.overflow = 'hidden';

        outer.appendChild(inner);

        document.body.appendChild(outer);

        const widthContained = inner.offsetWidth;
        outer.style.overflow = 'scroll';
        let widthScroll = inner.offsetWidth;

        if (widthContained === widthScroll) {
            widthScroll = outer.clientWidth;
        }

        document.body.removeChild(outer);

        cached = widthContained - widthScroll;
    }
    return cached;
}

// watch DOM change
const MutationObserver = isServer ? false : window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver || false;
/* harmony export (immutable) */ __webpack_exports__["MutationObserver"] = MutationObserver;


const SPECIAL_CHARS_REGEXP = /([\:\-\_]+(.))/g;
const MOZ_HACK_REGEXP = /^moz([A-Z])/;

function camelCase(name) {
    return name.replace(SPECIAL_CHARS_REGEXP, function(_, separator, letter, offset) {
        return offset ? letter.toUpperCase() : letter;
    }).replace(MOZ_HACK_REGEXP, 'Moz$1');
}
// getStyle
function getStyle (element, styleName) {
    if (!element || !styleName) return null;
    styleName = camelCase(styleName);
    if (styleName === 'float') {
        styleName = 'cssFloat';
    }
    try {
        const computed = document.defaultView.getComputedStyle(element, '');
        return element.style[styleName] || computed ? computed[styleName] : null;
    } catch(e) {
        return element.style[styleName];
    }
}

// firstUpperCase
function firstUpperCase(str) {
    return str.toString()[0].toUpperCase() + str.toString().slice(1);
}


// Warn
function warnProp(component, prop, correctType, wrongType) {
    correctType = firstUpperCase(correctType);
    wrongType = firstUpperCase(wrongType);
    console.error(`[iView warn]: Invalid prop: type check failed for prop ${prop}. Expected ${correctType}, got ${wrongType}. (found in component: ${component})`);    // eslint-disable-line
}

function typeOf(obj) {
    const toString = Object.prototype.toString;
    const map = {
        '[object Boolean]'  : 'boolean',
        '[object Number]'   : 'number',
        '[object String]'   : 'string',
        '[object Function]' : 'function',
        '[object Array]'    : 'array',
        '[object Date]'     : 'date',
        '[object RegExp]'   : 'regExp',
        '[object Undefined]': 'undefined',
        '[object Null]'     : 'null',
        '[object Object]'   : 'object'
    };
    return map[toString.call(obj)];
}

// deepCopy
function deepCopy(data) {
    const t = typeOf(data);
    let o;

    if (t === 'array') {
        o = [];
    } else if ( t === 'object') {
        o = {};
    } else {
        return data;
    }

    if (t === 'array') {
        for (let i = 0; i < data.length; i++) {
            o.push(deepCopy(data[i]));
        }
    } else if ( t === 'object') {
        for (let i in data) {
            o[i] = deepCopy(data[i]);
        }
    }
    return o;
}



// scrollTop animation
function scrollTop(el, from = 0, to, duration = 500, endCallback) {
    if (!window.requestAnimationFrame) {
        window.requestAnimationFrame = (
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame ||
            window.msRequestAnimationFrame ||
            function (callback) {
                return window.setTimeout(callback, 1000/60);
            }
        );
    }
    const difference = Math.abs(from - to);
    const step = Math.ceil(difference / duration * 50);

    function scroll(start, end, step) {
        if (start === end) {
            endCallback && endCallback();
            return;
        }

        let d = (start + step > end) ? end : start + step;
        if (start > end) {
            d = (start - step < end) ? end : start - step;
        }

        if (el === window) {
            window.scrollTo(d, d);
        } else {
            el.scrollTop = d;
        }
        window.requestAnimationFrame(() => scroll(d, end, step));
    }
    scroll(from, to, step);
}

// Find components upward
function findComponentUpward (context, componentName, componentNames) {
    if (typeof componentName === 'string') {
        componentNames = [componentName];
    } else {
        componentNames = componentName;
    }

    let parent = context.$parent;
    let name = parent.$options.name;
    while (parent && (!name || componentNames.indexOf(name) < 0)) {
        parent = parent.$parent;
        if (parent) name = parent.$options.name;
    }
    return parent;
}


// Find component downward
function findComponentDownward (context, componentName) {
    const childrens = context.$children;
    let children = null;

    if (childrens.length) {
        for (const child of childrens) {
            const name = child.$options.name;
            if (name === componentName) {
                children = child;
                break;
            } else {
                children = findComponentDownward(child, componentName);
                if (children) break;
            }
        }
    }
    return children;
}

// Find components downward
function findComponentsDownward (context, componentName) {
    return context.$children.reduce((components, child) => {
        if (child.$options.name === componentName) components.push(child);
        const foundChilds = findComponentsDownward(child, componentName);
        return components.concat(foundChilds);
    }, []);
}

// Find components upward
function findComponentsUpward (context, componentName) {
    let parents = [];
    const parent = context.$parent;
    if (parent) {
        if (parent.$options.name === componentName) parents.push(parent);
        return parents.concat(findComponentsUpward(parent, componentName));
    } else {
        return [];
    }
}

// Find brothers components
function findBrothersComponents (context, componentName, exceptMe = true) {
    let res = context.$parent.$children.filter(item => {
        return item.$options.name === componentName;
    });
    let index = res.findIndex(item => item._uid === context._uid);
    if (exceptMe) res.splice(index, 1);
    return res;
}

/* istanbul ignore next */
const trim = function(string) {
    return (string || '').replace(/^[\s\uFEFF]+|[\s\uFEFF]+$/g, '');
};

/* istanbul ignore next */
function hasClass(el, cls) {
    if (!el || !cls) return false;
    if (cls.indexOf(' ') !== -1) throw new Error('className should not contain space.');
    if (el.classList) {
        return el.classList.contains(cls);
    } else {
        return (' ' + el.className + ' ').indexOf(' ' + cls + ' ') > -1;
    }
}

/* istanbul ignore next */
function addClass(el, cls) {
    if (!el) return;
    let curClass = el.className;
    const classes = (cls || '').split(' ');

    for (let i = 0, j = classes.length; i < j; i++) {
        const clsName = classes[i];
        if (!clsName) continue;

        if (el.classList) {
            el.classList.add(clsName);
        } else {
            if (!hasClass(el, clsName)) {
                curClass += ' ' + clsName;
            }
        }
    }
    if (!el.classList) {
        el.className = curClass;
    }
}

/* istanbul ignore next */
function removeClass(el, cls) {
    if (!el || !cls) return;
    const classes = cls.split(' ');
    let curClass = ' ' + el.className + ' ';

    for (let i = 0, j = classes.length; i < j; i++) {
        const clsName = classes[i];
        if (!clsName) continue;

        if (el.classList) {
            el.classList.remove(clsName);
        } else {
            if (hasClass(el, clsName)) {
                curClass = curClass.replace(' ' + clsName + ' ', ' ');
            }
        }
    }
    if (!el.classList) {
        el.className = trim(curClass);
    }
}

const dimensionMap = {
    xs: '480px',
    sm: '768px',
    md: '992px',
    lg: '1200px',
    xl: '1600px',
};
/* harmony export (immutable) */ __webpack_exports__["dimensionMap"] = dimensionMap;


function setMatchMedia () {
    if (typeof window !== 'undefined') {
        const matchMediaPolyfill = mediaQuery => {
            return {
                media: mediaQuery,
                matches: false,
                on() {},
                off() {},
            };
        };
        window.matchMedia = window.matchMedia || matchMediaPolyfill;
    }
}

const sharpMatcherRegx = /#([^#]+)$/;
/* harmony export (immutable) */ __webpack_exports__["sharpMatcherRegx"] = sharpMatcherRegx;



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

/***/ 293:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(295)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(297)
/* template */
var __vue_template__ = __webpack_require__(298)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-8af6e5ee"
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
Component.options.__file = "resources/assets/admin/js/components/date-picker/index.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-8af6e5ee", Component.options)
  } else {
    hotAPI.reload("data-v-8af6e5ee", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


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

/***/ 295:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(296);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("3628215e", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-8af6e5ee\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./index.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-8af6e5ee\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./index.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 296:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 297:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _assist = __webpack_require__(284);

var _emitter = __webpack_require__(270);

var _emitter2 = _interopRequireDefault(_emitter);

var _moment = __webpack_require__(0);

var _moment2 = _interopRequireDefault(_moment);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
    name: 'c-date-picker',
    mixins: [_emitter2.default],
    props: {
        value: {
            type: [Date, String, Array]
        },
        type: {
            validator: function validator(value) {
                return (0, _assist.oneOf)(value, ['year', 'month', 'date', 'daterange', 'datetime', 'datetimerange']);
            },

            default: 'date'
        },
        format: String,
        options: Object,
        readonly: {
            type: Boolean,
            default: false
        },
        panels: {
            type: Boolean,
            default: false
        },
        customize: {
            type: Boolean,
            default: false
        }
    },
    data: function data() {
        return {
            sValue: this.value
        };
    },

    methods: {
        change: function change(format, date) {
            this.$emit('on-change', format);
            this.$emit('input', format);
            this.$emit('on-change', format);
            this.dispatch('FormItem', 'on-form-blur', format);
        }
    },
    watch: {
        value: function value(val) {
            if (this.customize && val !== undefined) {
                if ((0, _moment2.default)(val[1]).format('HH:mm:ss') === '00:00:00') {
                    val[1] = (0, _moment2.default)(val[1]).format('YYYY-MM-DD') + ' 23:59:59';
                }
            }
            this.sValue = val;
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

/***/ }),

/***/ 298:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("DatePicker", {
    attrs: {
      type: _vm.type,
      format: _vm.format,
      options: _vm.options,
      placement: "bottom-end",
      placeholder: "选择时间",
      readonly: _vm.readonly,
      "split-panels": _vm.panels,
      transfer: ""
    },
    on: { "on-change": _vm.change },
    model: {
      value: _vm.sValue,
      callback: function($$v) {
        _vm.sValue = $$v
      },
      expression: "sValue"
    }
  })
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-8af6e5ee", module.exports)
  }
}

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

/***/ 311:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(325)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(327)
/* template */
var __vue_template__ = __webpack_require__(328)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-49dfdc70"
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
Component.options.__file = "resources/assets/admin/js/components/checkbox/group-box.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-49dfdc70", Component.options)
  } else {
    hotAPI.reload("data-v-49dfdc70", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 312:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(329)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(331)
/* template */
var __vue_template__ = __webpack_require__(332)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-67ac081d"
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
Component.options.__file = "resources/assets/admin/js/components/checkbox/index.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-67ac081d", Component.options)
  } else {
    hotAPI.reload("data-v-67ac081d", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 313:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(314)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(316)
/* template */
var __vue_template__ = __webpack_require__(317)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-66e3ec1c"
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
Component.options.__file = "resources/assets/admin/js/components/select/true-or-false.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-66e3ec1c", Component.options)
  } else {
    hotAPI.reload("data-v-66e3ec1c", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 314:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(315);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("21d70b2a", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-66e3ec1c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./true-or-false.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-66e3ec1c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./true-or-false.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 315:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 316:
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
    name: "true-or-false",
    props: {
        value: [String, Number],
        trueValue: {
            type: String,
            default: '是'
        },
        falseValue: {
            type: String,
            default: '否'
        }
    },
    data: function data() {
        return {
            model: this.value,
            trueValueModel: this.trueValue,
            falseValueModel: this.falseValue
        };
    },

    methods: {
        setValue: function setValue(val) {
            this.$emit('input', val);
        }
    },
    watch: {
        value: function value(val) {
            this.model = val;
        },
        falseValue: function falseValue(val) {
            this.falseValueModel = val;
        },
        trueValue: function trueValue(val) {
            this.trueValueModel = val;
        }
    }
};

/***/ }),

/***/ 317:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "Select",
    {
      attrs: { clearable: "" },
      on: { "on-change": _vm.setValue },
      model: {
        value: _vm.model,
        callback: function($$v) {
          _vm.model = $$v
        },
        expression: "model"
      }
    },
    [
      _c("Option", { attrs: { value: 1 } }, [
        _vm._v(_vm._s(_vm.trueValueModel))
      ]),
      _vm._v(" "),
      _c("Option", { attrs: { value: 0 } }, [
        _vm._v(_vm._s(_vm.falseValueModel))
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-66e3ec1c", module.exports)
  }
}

/***/ }),

/***/ 325:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(326);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("9d12194a", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-49dfdc70\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./group-box.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-49dfdc70\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./group-box.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 326:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.checkbox-button-group[data-v-49dfdc70]{\r\n    display: inline-block;\r\n    font-size: 0px;\r\n    vertical-align: middle;\n}\r\n", ""]);

// exports


/***/ }),

/***/ 327:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _emitter = __webpack_require__(270);

var _emitter2 = _interopRequireDefault(_emitter);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
    name: "checkbox-button-group",
    mixins: [_emitter2.default],
    props: {
        value: {
            type: Array,
            default: function _default() {
                return [];
            }
        }
    },
    data: function data() {
        return {
            defaultCheck: this.value,
            currentCheck: []
        };
    },

    methods: {
        values: function values() {
            this.currentCheck = this.$children.filter(function (val) {
                return val.check;
            }).map(function (val) {
                return val.value;
            });
        }
    },
    watch: {
        currentCheck: function currentCheck(val) {
            this.$emit('input', val);
            this.$emit('on-change', val);
            this.dispatch('FormItem', 'on-form-blur', val);
        },
        value: function value(val) {
            this.defaultCheck = val;
            this.$children.forEach(function (item) {
                item.change();
            });
        }
    }
}; //
//
//
//
//
//

/***/ }),

/***/ 328:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "checkbox-button-group" },
    [_vm._t("default")],
    2
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-49dfdc70", module.exports)
  }
}

/***/ }),

/***/ 329:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(330);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("606665c6", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-67ac081d\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./index.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-67ac081d\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./index.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 330:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.checkbox-button-input[data-v-67ac081d] {\n    opacity: 0;\n    width: 0;\n    height: 0;\n}\n.checkbox-button[data-v-67ac081d]:first-child {\n    border-top-left-radius: 4px;\n    border-bottom-left-radius: 4px;\n    border-left: 1px solid #dcdee2;\n    -webkit-box-shadow: none;\n            box-shadow: none;\n}\n.checkbox-button[data-v-67ac081d]:last-child {\n    border-top-right-radius: 4px;\n    border-bottom-right-radius: 4px;\n}\n.checkbox-button[data-v-67ac081d] {\n    vertical-align: middle;\n    display: inline-block;\n    height: 32px;\n    line-height: 30px;\n    margin: 0;\n    padding: 0 15px;\n    font-size: 12px;\n    color: #515a6e;\n    -webkit-transition: all .2s ease-in-out;\n    transition: all .2s ease-in-out;\n    cursor: pointer;\n    border: 1px solid #dcdee2;\n    border-left: 0;\n    background: #fff;\n    position: relative;\n}\n.checkbox-button-checked[data-v-67ac081d] {\n    border-color: #2d8cf0;\n    color: #2d8cf0;\n    -webkit-box-shadow: -1px 0 0 0 #2d8cf0;\n            box-shadow: -1px 0 0 0 #2d8cf0;\n}\n.checkbox-button-checked[data-v-67ac081d]:first-child {\n    border-color: #2d8cf0;\n    -webkit-box-shadow: none;\n            box-shadow: none;\n}\n", ""]);

// exports


/***/ }),

/***/ 331:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _uuid = __webpack_require__(145);

var _uuid2 = _interopRequireDefault(_uuid);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
    name: "checkbox-button",
    mixins: [_uuid2.default],
    props: {
        value: {
            type: [String, Number],
            required: true
        }
    },
    data: function data() {
        return {
            check: false
        };
    },
    mounted: function mounted() {
        var _this = this;

        this.$nextTick(function () {
            _this.change();
        });
    },

    methods: {
        change: function change() {
            if (this.$parent.$options.name === 'checkbox-button-group') {
                if (this.$parent.defaultCheck.indexOf(this.value) !== -1) {
                    this.check = true;
                } else {
                    this.check = false;
                }
            }
        }
    },
    watch: {
        check: function check(val) {
            if (this.$parent.$options.name === 'checkbox-button-group') {
                this.$parent.values();
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

/***/ }),

/***/ 332:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "label",
    {
      staticClass: "checkbox-button",
      class: { "checkbox-button-checked": _vm.check },
      attrs: { for: _vm.uuid }
    },
    [
      _c("input", {
        directives: [
          {
            name: "model",
            rawName: "v-model",
            value: _vm.check,
            expression: "check"
          }
        ],
        staticClass: "checkbox-button-input",
        attrs: { type: "checkbox", id: _vm.uuid },
        domProps: {
          value: _vm.value,
          checked: Array.isArray(_vm.check)
            ? _vm._i(_vm.check, _vm.value) > -1
            : _vm.check
        },
        on: {
          change: function($event) {
            var $$a = _vm.check,
              $$el = $event.target,
              $$c = $$el.checked ? true : false
            if (Array.isArray($$a)) {
              var $$v = _vm.value,
                $$i = _vm._i($$a, $$v)
              if ($$el.checked) {
                $$i < 0 && (_vm.check = $$a.concat([$$v]))
              } else {
                $$i > -1 &&
                  (_vm.check = $$a.slice(0, $$i).concat($$a.slice($$i + 1)))
              }
            } else {
              _vm.check = $$c
            }
          }
        }
      }),
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-67ac081d", module.exports)
  }
}

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

/***/ 684:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(685);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("8b4761ee", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-61be83e9\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./index.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-61be83e9\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./index.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 685:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.checkbox-button-all[data-v-61be83e9] {\n    vertical-align: middle;\n    display: inline-block;\n    height: 32px;\n    line-height: 30px;\n    margin: 0;\n    padding: 0 15px;\n    font-size: 12px;\n    color: #515a6e;\n    -webkit-transition: all .2s ease-in-out;\n    transition: all .2s ease-in-out;\n    cursor: pointer;\n    border: 1px solid #dcdee2;\n    background: #fff;\n    position: relative;\n    border-radius: 4px;\n}\n.checkbox-button-all-checked[data-v-61be83e9] {\n    border-color: #2d8cf0;\n    color: #2d8cf0;\n}\n", ""]);

// exports


/***/ }),

/***/ 686:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _myLists = __webpack_require__(269);

var _myLists2 = _interopRequireDefault(_myLists);

var _lists = __webpack_require__(265);

var _lists2 = _interopRequireDefault(_lists);

var _index = __webpack_require__(293);

var _index2 = _interopRequireDefault(_index);

var _trueOrFalse = __webpack_require__(313);

var _trueOrFalse2 = _interopRequireDefault(_trueOrFalse);

var _groupBox = __webpack_require__(311);

var _groupBox2 = _interopRequireDefault(_groupBox);

var _index3 = __webpack_require__(312);

var _index4 = _interopRequireDefault(_index3);

var _view = __webpack_require__(357);

var _view2 = _interopRequireDefault(_view);

var _remote = __webpack_require__(266);

var _remote2 = _interopRequireDefault(_remote);

var _cancel = __webpack_require__(687);

var _cancel2 = _interopRequireDefault(_cancel);

var _undo = __webpack_require__(693);

var _undo2 = _interopRequireDefault(_undo);

var _finish = __webpack_require__(699);

var _finish2 = _interopRequireDefault(_finish);

var _agent = __webpack_require__(705);

var _agent2 = _interopRequireDefault(_agent);

var _change = __webpack_require__(711);

var _change2 = _interopRequireDefault(_change);

var _status = __webpack_require__(717);

var _status2 = _interopRequireDefault(_status);

var _assist = __webpack_require__(284);

var _moment = __webpack_require__(0);

var _moment2 = _interopRequireDefault(_moment);

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

exports.default = {
    name: 'index',
    components: {
        TaskOrderStatus: _status2.default, Remote: _remote2.default, CheckboxButton: _index4.default, CheckboxButtonGroup: _groupBox2.default,
        TrueOrFalse: _trueOrFalse2.default, CDatePicker: _index2.default, MyLists: _myLists2.default, mView: _view2.default, Cancel: _cancel2.default, Undo: _undo2.default, Agent: _agent2.default, Finish: _finish2.default, Change: _change2.default
    },
    mixins: [_lists2.default],
    data: function data() {
        var _this = this;

        return {
            searchForm: {
                status: []
            },
            columns: [{
                title: '商户简称',
                render: function render(h, _ref) {
                    var row = _ref.row;

                    return h(
                        'span',
                        null,
                        [row.merchant.short_name]
                    );
                }
            }, {
                title: '出车单号',
                render: function render(h, _ref2) {
                    var row = _ref2.row;

                    return h(
                        'a',
                        {
                            on: {
                                'click': function click() {
                                    _this.showComponent('mView', row);
                                }
                            }
                        },
                        [row.order_no]
                    );
                }
            }, {
                title: '到仓时间',
                key: 'arrival_warehouse_time',
                width: 150
            }, {
                title: '任务编号',
                render: function render(h, _ref3) {
                    var row = _ref3.row;

                    return h(
                        'span',
                        null,
                        [row.task_id]
                    );
                }
            }, {
                title: '线路名称',
                key: 'name'
            }, {
                title: '仓名称',
                render: function render(h, _ref4) {
                    var row = _ref4.row;

                    return h(
                        'span',
                        null,
                        [row.warehouse.title]
                    );
                }
            }, {
                title: '状态',
                render: function render(h, _ref5) {
                    var row = _ref5.row;

                    return h(
                        _status2.default,
                        {
                            attrs: { status: row.status }
                        },
                        []
                    );
                }
            }, {
                title: '司机姓名',
                render: function render(h, _ref6) {
                    var row = _ref6.row;

                    return h(
                        'span',
                        null,
                        [row.driver ? row.driver.name : '']
                    );
                }
            }, {
                title: '所属队长',
                render: function render(h, _ref7) {
                    var row = _ref7.row;

                    return h(
                        'span',
                        null,
                        [row.driver && row.driver.supervisor ? row.driver.supervisor.name : '']
                    );
                }
            }, {
                title: '司机手机号',
                render: function render(h, _ref8) {
                    var row = _ref8.row;

                    return h(
                        'span',
                        null,
                        [row.driver ? row.driver.phone : '']
                    );
                }
            }, {
                title: '车型',
                render: function render(h, _ref9) {
                    var row = _ref9.row;

                    return h(
                        'span',
                        null,
                        [row.car_type ? row.car_type.name : '']
                    );
                }
            }, {
                title: '操作',
                render: function render(h, _ref10) {
                    var row = _ref10.row;

                    return h(
                        'dropdown',
                        {
                            attrs: { trigger: 'click' },
                            on: {
                                'on-click': function onClick(name) {
                                    return _this.listTrigger(name, row);
                                }
                            },
                            directives: [{
                                name: 'show',
                                value: !(0, _assist.oneOf)(row.status, [4, 5, 6])
                            }]
                        },
                        [h(
                            'i-button',
                            {
                                attrs: { size: 'small' }
                            },
                            ['\u64CD\u4F5C']
                        ), h(
                            'dropdown-menu',
                            { slot: 'list' },
                            [h(
                                'dropdown-item',
                                {
                                    attrs: { name: '\u8BBE\u7F6E\u4E0D\u914D\u9001' },
                                    directives: [{
                                        name: 'show',
                                        value: !(0, _assist.oneOf)(row.status, [3, 4, 5, 6])
                                    }]
                                },
                                ['\u8BBE\u7F6E\u4E0D\u914D\u9001']
                            ), h(
                                'dropdown-item',
                                {
                                    attrs: { name: '\u8FD0\u8425\u53D6\u6D88'
                                    },
                                    directives: [{
                                        name: 'show',
                                        value: !(0, _assist.oneOf)(row.status, [4, 5, 6])
                                    }]
                                },
                                ['\u8FD0\u8425\u53D6\u6D88']
                            ), h(
                                'dropdown-item',
                                {
                                    attrs: { name: '\u4EE3\u7B7E\u5230' },
                                    directives: [{
                                        name: 'show',
                                        value: !(0, _assist.oneOf)(row.status, [1, 2, 3, 4, 5, 6])
                                    }]
                                },
                                ['\u4EE3\u7B7E\u5230']
                            ), h(
                                'dropdown-item',
                                {
                                    attrs: { name: '\u4E00\u952E\u5B8C\u6210' },
                                    directives: [{
                                        name: 'show',
                                        value: !(0, _assist.oneOf)(row.status, [3, 4, 5, 6])
                                    }]
                                },
                                ['\u4E00\u952E\u5B8C\u6210']
                            ), h(
                                'dropdown-item',
                                {
                                    attrs: { name: '\u5230\u4ED3\u65F6\u95F4\u6216\u4EF7\u683C\u53D8\u66F4' },
                                    directives: [{
                                        name: 'show',
                                        value: _this.isChange(row)
                                    }]
                                },
                                ['\u5230\u4ED3\u65F6\u95F4\u6216\u4EF7\u683C\u53D8\u66F4']
                            )]
                        )]
                    );
                }
            }]
        };
    },

    methods: {
        search: function search() {
            var _this2 = this;

            var page = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;

            this.loading = true;
            this.$http.get('order', { params: this.request(page) }).then(function (res) {
                _this2.assignmentData(res.data.data);
            }).catch(function () {
                _this2.assignmentData([]);
            }).finally(function () {
                _this2.loading = false;
            });
        },
        isChange: function isChange(row) {
            return (0, _moment2.default)(row.arrival_warehouse_time).isBetween((0, _moment2.default)().subtract('day', 2), (0, _moment2.default)().add('day', 1), 'day') && !(0, _assist.oneOf)(row.status, [4, 5, 6]);
        },
        listTrigger: function listTrigger(name, row) {
            switch (name) {
                case '设置不配送':
                    this.showComponent('Undo', row);
                    break;
                case '运营取消':
                    this.showComponent('Cancel', row);
                    break;
                case '代签到':
                    this.showComponent('Agent', row);
                    break;
                case '一键完成':
                    this.showComponent('Finish', row);
                    break;
                case '到仓时间或价格变更':
                    this.showComponent('Change', row);
                    break;
            }
        },
        download: function download() {
            this.$http.download('order/export', this.request(), '出车单列表.xls');
        }
    },
    watch: {
        'searchForm.arrival_warehouse_time': function searchFormArrival_warehouse_time(val) {
            if (!val[0] || !val[1]) delete this.searchForm.arrival_warehouse_time;
        }
    }
};

/***/ }),

/***/ 687:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(688)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(690)
/* template */
var __vue_template__ = __webpack_require__(692)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-1cbbe273"
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
Component.options.__file = "resources/assets/admin/js/views/taskOrder/cancel.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-1cbbe273", Component.options)
  } else {
    hotAPI.reload("data-v-1cbbe273", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 688:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(689);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("fa29ff96", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-1cbbe273\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./cancel.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-1cbbe273\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./cancel.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 689:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 690:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _component = __webpack_require__(263);

var _component2 = _interopRequireDefault(_component);

var _componentModal = __webpack_require__(264);

var _componentModal2 = _interopRequireDefault(_componentModal);

var _cancel = __webpack_require__(691);

var _form = __webpack_require__(267);

var _form2 = _interopRequireDefault(_form);

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

exports.default = {
    name: "cancel",
    components: { ComponentModal: _componentModal2.default },
    mixins: [_component2.default, _form2.default],
    data: function data() {
        return {
            formUpdate: {
                remark: ''
            },
            rulesUpdate: (0, _cancel.Validator)(this)
        };
    }
};

/***/ }),

/***/ 691:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});
var Validator = exports.Validator = function Validator(data) {
    return {
        remark: [{
            required: true,
            trigger: 'blur',
            message: '取消备注必须填写'
        }]
    };
};

/***/ }),

/***/ 692:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "component-modal",
    { attrs: { title: "运营取消", width: 350, loading: _vm.loading } },
    [
      _c(
        "Form",
        {
          ref: "formUpdate",
          attrs: {
            model: _vm.formUpdate,
            "label-width": 50,
            rules: _vm.rulesUpdate
          }
        },
        [
          _c(
            "FormItem",
            { attrs: { label: "备注", prop: "remark" } },
            [
              _c("Input", {
                attrs: { type: "textarea" },
                model: {
                  value: _vm.formUpdate.remark,
                  callback: function($$v) {
                    _vm.$set(_vm.formUpdate, "remark", $$v)
                  },
                  expression: "formUpdate.remark"
                }
              })
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
                  _vm.updateSubmit("formUpdate", "order/cancel/" + _vm.data.id)
                }
              }
            },
            [_vm._v("提交")]
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-1cbbe273", module.exports)
  }
}

/***/ }),

/***/ 693:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(694)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(696)
/* template */
var __vue_template__ = __webpack_require__(698)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-6d4927c6"
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
Component.options.__file = "resources/assets/admin/js/views/taskOrder/undo.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-6d4927c6", Component.options)
  } else {
    hotAPI.reload("data-v-6d4927c6", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 694:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(695);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("d9710db6", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-6d4927c6\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./undo.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-6d4927c6\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./undo.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 695:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 696:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _componentModal = __webpack_require__(264);

var _componentModal2 = _interopRequireDefault(_componentModal);

var _component = __webpack_require__(263);

var _component2 = _interopRequireDefault(_component);

var _undo = __webpack_require__(697);

var _form = __webpack_require__(267);

var _form2 = _interopRequireDefault(_form);

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

exports.default = {
    name: "undo",
    components: { ComponentModal: _componentModal2.default },
    mixins: [_component2.default, _form2.default],
    data: function data() {
        return {
            formUpdate: {
                remark: ''
            },
            rulesUpdate: (0, _undo.Validator)(this)
        };
    }
};

/***/ }),

/***/ 697:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});
var Validator = exports.Validator = function Validator(data) {
    return {
        remark: [{
            required: true,
            trigger: 'blur',
            message: '设置不配送备注必须填写'
        }]
    };
};

/***/ }),

/***/ 698:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "component-modal",
    { attrs: { title: "设置不配送", width: 450, loading: _vm.loading } },
    [
      _c("Alert", { attrs: { "show-icon": "", closable: "" } }, [
        _vm._v("设置之后，司机在 2018-08-24 将不会配送!")
      ]),
      _vm._v(" "),
      _c("Alert", { attrs: { "show-icon": "", closable: "" } }, [
        _vm._v(
          "如果司机在您设置后，报价其他该时间段的任务并被选中，您将不能再设置配送!"
        )
      ]),
      _vm._v(" "),
      _c(
        "Form",
        {
          ref: "formUpdate",
          attrs: {
            model: _vm.formUpdate,
            "label-width": 50,
            rules: _vm.rulesUpdate
          }
        },
        [
          _c(
            "FormItem",
            { attrs: { label: "备注", prop: "remark" } },
            [
              _c("Input", {
                attrs: { type: "textarea" },
                model: {
                  value: _vm.formUpdate.remark,
                  callback: function($$v) {
                    _vm.$set(_vm.formUpdate, "remark", $$v)
                  },
                  expression: "formUpdate.remark"
                }
              })
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
                  _vm.updateSubmit("formUpdate", "order/undo/" + _vm.data.id)
                }
              }
            },
            [_vm._v("提交\n        ")]
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-6d4927c6", module.exports)
  }
}

/***/ }),

/***/ 699:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(700)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(702)
/* template */
var __vue_template__ = __webpack_require__(704)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-1e66e7e8"
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
Component.options.__file = "resources/assets/admin/js/views/taskOrder/finish.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-1e66e7e8", Component.options)
  } else {
    hotAPI.reload("data-v-1e66e7e8", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 700:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(701);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("84f6cc12", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-1e66e7e8\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./finish.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-1e66e7e8\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./finish.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 701:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 702:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _component = __webpack_require__(263);

var _component2 = _interopRequireDefault(_component);

var _componentModal = __webpack_require__(264);

var _componentModal2 = _interopRequireDefault(_componentModal);

var _finish = __webpack_require__(703);

var _form = __webpack_require__(267);

var _form2 = _interopRequireDefault(_form);

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

exports.default = {
    name: "finish",
    components: { ComponentModal: _componentModal2.default },
    mixins: [_component2.default, _form2.default],
    data: function data() {
        return {
            formUpdate: {
                remark: ''
            },
            rulesUpdate: (0, _finish.Validator)(this)
        };
    }
};

/***/ }),

/***/ 703:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});
var Validator = exports.Validator = function Validator(data) {
    return {
        remark: [{
            required: true,
            trigger: 'blur',
            message: '取消备注必须填写'
        }]
    };
};

/***/ }),

/***/ 704:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "component-modal",
    { attrs: { title: "一键完成", width: 350, loading: _vm.loading } },
    [
      _c(
        "Form",
        {
          ref: "formUpdate",
          attrs: {
            model: _vm.formUpdate,
            "label-width": 50,
            rules: _vm.rulesUpdate
          }
        },
        [
          _c(
            "FormItem",
            { attrs: { label: "备注", prop: "remark" } },
            [
              _c("Input", {
                attrs: { type: "textarea" },
                model: {
                  value: _vm.formUpdate.remark,
                  callback: function($$v) {
                    _vm.$set(_vm.formUpdate, "remark", $$v)
                  },
                  expression: "formUpdate.remark"
                }
              })
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
                  _vm.updateSubmit("formUpdate", "order/finish/" + _vm.data.id)
                }
              }
            },
            [_vm._v("提交")]
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-1e66e7e8", module.exports)
  }
}

/***/ }),

/***/ 705:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(706)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(708)
/* template */
var __vue_template__ = __webpack_require__(710)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-2c7c4c9c"
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
Component.options.__file = "resources/assets/admin/js/views/taskOrder/agent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-2c7c4c9c", Component.options)
  } else {
    hotAPI.reload("data-v-2c7c4c9c", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 706:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(707);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("62223df4", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2c7c4c9c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./agent.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2c7c4c9c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./agent.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 707:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 708:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _component = __webpack_require__(263);

var _component2 = _interopRequireDefault(_component);

var _componentModal = __webpack_require__(264);

var _componentModal2 = _interopRequireDefault(_componentModal);

var _agent = __webpack_require__(709);

var _form = __webpack_require__(267);

var _form2 = _interopRequireDefault(_form);

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

exports.default = {
    name: "agent",
    components: { ComponentModal: _componentModal2.default },
    mixins: [_component2.default, _form2.default],
    data: function data() {
        return {
            formUpdate: {
                remark: ''
            },
            rulesUpdate: (0, _agent.Validator)(this)
        };
    }
};

/***/ }),

/***/ 709:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});
var Validator = exports.Validator = function Validator(data) {
    return {
        remark: [{
            required: true,
            trigger: 'blur',
            message: '代签到备注必须填写'
        }]
    };
};

/***/ }),

/***/ 710:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "component-modal",
    { attrs: { title: "代签到", width: 350, loading: _vm.loading } },
    [
      _c(
        "Form",
        {
          ref: "formUpdate",
          attrs: {
            model: _vm.formUpdate,
            "label-width": 50,
            rules: _vm.rulesUpdate
          }
        },
        [
          _c(
            "FormItem",
            { attrs: { label: "备注", prop: "remark" } },
            [
              _c("Input", {
                attrs: { type: "textarea" },
                model: {
                  value: _vm.formUpdate.remark,
                  callback: function($$v) {
                    _vm.$set(_vm.formUpdate, "remark", $$v)
                  },
                  expression: "formUpdate.remark"
                }
              })
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
                  _vm.updateSubmit("formUpdate", "order/agent/" + _vm.data.id)
                }
              }
            },
            [_vm._v("提交")]
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-2c7c4c9c", module.exports)
  }
}

/***/ }),

/***/ 711:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(712)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(714)
/* template */
var __vue_template__ = __webpack_require__(716)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-2d173ca9"
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
Component.options.__file = "resources/assets/admin/js/views/taskOrder/change.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-2d173ca9", Component.options)
  } else {
    hotAPI.reload("data-v-2d173ca9", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 712:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(713);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("99519be0", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2d173ca9\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./change.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2d173ca9\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./change.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 713:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 714:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _componentModal = __webpack_require__(264);

var _componentModal2 = _interopRequireDefault(_componentModal);

var _component = __webpack_require__(263);

var _component2 = _interopRequireDefault(_component);

var _form = __webpack_require__(267);

var _form2 = _interopRequireDefault(_form);

var _index = __webpack_require__(293);

var _index2 = _interopRequireDefault(_index);

var _change = __webpack_require__(715);

var _moment = __webpack_require__(0);

var _moment2 = _interopRequireDefault(_moment);

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

exports.default = {
    name: "change",
    components: { CDatePicker: _index2.default, ComponentModal: _componentModal2.default },
    mixins: [_component2.default, _form2.default],
    data: function data() {
        return {
            formUpdate: {
                arrival_warehouse_time: this.data.arrival_warehouse_time,
                unit_price: parseFloat(this.data.unit_price)
            },
            rulesUpdate: (0, _change.Validator)(this),
            options: {
                disabledDate: function disabledDate(value) {
                    return !(0, _moment2.default)(value).isBetween((0, _moment2.default)().subtract('day', 2), (0, _moment2.default)().add('day', 1), 'day');
                }
            }
        };
    }
};

/***/ }),

/***/ 715:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.Validator = undefined;

var _moment = __webpack_require__(0);

var _moment2 = _interopRequireDefault(_moment);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var Validator = exports.Validator = function Validator(data) {
    return {
        remark: [{
            required: true,
            trigger: 'blur',
            message: '备注必须填写'
        }],
        arrival_warehouse_time: [{
            required: true,
            trigger: 'blur',
            message: '到仓时间不能为空'
        }, {
            validator: function validator(rule, value, callback) {
                if ((0, _moment2.default)(value).isBetween((0, _moment2.default)().subtract('days', 2), (0, _moment2.default)().add('day', 1), 'day')) {
                    callback();
                } else {
                    callback(new Error('到仓时间只能修改为昨天和今天时间'));
                }
            },
            trigger: 'blur'
        }],
        unit_price: [{
            required: true,
            trigger: 'blur',
            type: 'number',
            message: '单价不能为空'
        }]
    };
};

/***/ }),

/***/ 716:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "component-modal",
    {
      attrs: { title: "更改到仓时间和价格", width: 450, loading: _vm.loading }
    },
    [
      _c(
        "Form",
        {
          ref: "formUpdate",
          attrs: {
            model: _vm.formUpdate,
            "label-width": 80,
            rules: _vm.rulesUpdate
          }
        },
        [
          _c(
            "FormItem",
            { attrs: { label: "到仓时间", prop: "arrival_warehouse_time" } },
            [
              _c("c-date-picker", {
                attrs: { options: _vm.options, type: "datetime" },
                model: {
                  value: _vm.formUpdate.arrival_warehouse_time,
                  callback: function($$v) {
                    _vm.$set(_vm.formUpdate, "arrival_warehouse_time", $$v)
                  },
                  expression: "formUpdate.arrival_warehouse_time"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "单价", prop: "unit_price" } },
            [
              _c("InputNumber", {
                attrs: { step: 0.01, precision: 2 },
                model: {
                  value: _vm.formUpdate.unit_price,
                  callback: function($$v) {
                    _vm.$set(_vm.formUpdate, "unit_price", $$v)
                  },
                  expression: "formUpdate.unit_price"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "备注", prop: "remark" } },
            [
              _c("Input", {
                attrs: { type: "textarea" },
                model: {
                  value: _vm.formUpdate.remark,
                  callback: function($$v) {
                    _vm.$set(_vm.formUpdate, "remark", $$v)
                  },
                  expression: "formUpdate.remark"
                }
              })
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
                  _vm.updateSubmit("formUpdate", "order/change/" + _vm.data.id)
                }
              }
            },
            [_vm._v("提交\n        ")]
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-2d173ca9", module.exports)
  }
}

/***/ }),

/***/ 717:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(718)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(720)
/* template */
var __vue_template__ = __webpack_require__(721)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-4064a4d5"
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
Component.options.__file = "resources/assets/admin/js/views/components/task-order/status.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-4064a4d5", Component.options)
  } else {
    hotAPI.reload("data-v-4064a4d5", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 718:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(719);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("0d589e1c", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-4064a4d5\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./status.vue", function() {
     var newContent = require("!!../../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-4064a4d5\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./status.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 719:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 720:
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
//
//
//
//
//
//

exports.default = {
    name: "task-order-status",
    props: {
        status: {
            type: Number,
            required: true
        }
    }
};

/***/ }),

/***/ 721:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _vm.status === 0
    ? _c("Tag", { attrs: { color: "green" } }, [_vm._v("\n    未签到\n")])
    : _vm.status === 1
      ? _c("Tag", { attrs: { color: "cyan" } }, [_vm._v("\n    已签到\n")])
      : _vm.status === 2
        ? _c("Tag", { attrs: { color: "blue" } }, [_vm._v("\n    配送中\n")])
        : _vm.status === 3
          ? _c("Tag", { attrs: { color: "geekblue" } }, [
              _vm._v("\n    配送完成\n")
            ])
          : _vm.status === 4
            ? _c("Tag", { attrs: { color: "red" } }, [
                _vm._v("\n    设置不配送\n")
              ])
            : _vm.status === 5
              ? _c("Tag", { attrs: { color: "volcano" } }, [
                  _vm._v("\n    无责任解约\n")
                ])
              : _vm.status === 6
                ? _c("Tag", { attrs: { color: "orange" } }, [
                    _vm._v("\n    运营取消\n")
                  ])
                : _vm._e()
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-4064a4d5", module.exports)
  }
}

/***/ }),

/***/ 722:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var this$1 = this
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "my-lists",
    {
      attrs: { columns: _vm.columns, loading: _vm.loading },
      on: { change: _vm.search },
      model: {
        value: _vm.lists.data,
        callback: function($$v) {
          _vm.$set(_vm.lists, "data", $$v)
        },
        expression: "lists.data"
      }
    },
    [
      _c(
        "Card",
        [
          _c("p", { attrs: { slot: "title" }, slot: "title" }, [
            _c("span", [_vm._v("搜索")])
          ]),
          _vm._v(" "),
          _c(
            "Form",
            {
              ref: "searchForm",
              attrs: { model: _vm.searchForm, inline: "", "label-width": 60 }
            },
            [
              _c(
                "FormItem",
                { attrs: { label: "商户简称" } },
                [
                  _c("remote", {
                    attrs: {
                      "remote-url": "merchants/select",
                      "search-key": "title"
                    },
                    model: {
                      value: _vm.searchForm.merchant_id,
                      callback: function($$v) {
                        _vm.$set(_vm.searchForm, "merchant_id", $$v)
                      },
                      expression: "searchForm.merchant_id"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "FormItem",
                { attrs: { label: "出车单号" } },
                [
                  _c("Input", {
                    model: {
                      value: _vm.searchForm.order_no,
                      callback: function($$v) {
                        _vm.$set(_vm.searchForm, "order_no", $$v)
                      },
                      expression: "searchForm.order_no"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "FormItem",
                { attrs: { label: "任务名称" } },
                [
                  _c("remote", {
                    attrs: { "remote-url": "task/select" },
                    model: {
                      value: _vm.searchForm.task_id,
                      callback: function($$v) {
                        _vm.$set(_vm.searchForm, "task_id", $$v)
                      },
                      expression: "searchForm.task_id"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "FormItem",
                { attrs: { label: "仓库名称" } },
                [
                  _c("remote", {
                    attrs: { "remote-url": "warehouse/select" },
                    model: {
                      value: _vm.searchForm.warehouse_id,
                      callback: function($$v) {
                        _vm.$set(_vm.searchForm, "warehouse_id", $$v)
                      },
                      expression: "searchForm.warehouse_id"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "FormItem",
                { attrs: { label: "线路名称" } },
                [
                  _c("Input", {
                    model: {
                      value: _vm.searchForm.name,
                      callback: function($$v) {
                        _vm.$set(_vm.searchForm, "name", $$v)
                      },
                      expression: "searchForm.name"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "FormItem",
                { attrs: { label: "司机姓名" } },
                [
                  _c("remote", {
                    attrs: {
                      "remote-url": "driver/select",
                      "search-key": "title"
                    },
                    model: {
                      value: _vm.searchForm.driver_id,
                      callback: function($$v) {
                        _vm.$set(_vm.searchForm, "driver_id", $$v)
                      },
                      expression: "searchForm.driver_id"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "FormItem",
                { attrs: { label: "异常" } },
                [
                  _c("true-or-false", {
                    model: {
                      value: _vm.searchForm.exception_count,
                      callback: function($$v) {
                        _vm.$set(_vm.searchForm, "exception_count", $$v)
                      },
                      expression: "searchForm.exception_count"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "FormItem",
                { attrs: { label: "代签到" } },
                [
                  _c("true-or-false", {
                    model: {
                      value: _vm.searchForm.is_agent,
                      callback: function($$v) {
                        _vm.$set(_vm.searchForm, "is_agent", $$v)
                      },
                      expression: "searchForm.is_agent"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "FormItem",
                { attrs: { label: "一键完成" } },
                [
                  _c("true-or-false", {
                    model: {
                      value: _vm.searchForm.is_one_step_finish,
                      callback: function($$v) {
                        _vm.$set(_vm.searchForm, "is_one_step_finish", $$v)
                      },
                      expression: "searchForm.is_one_step_finish"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "FormItem",
                { attrs: { label: "改派司机" } },
                [
                  _c("true-or-false", {
                    model: {
                      value: _vm.searchForm.is_reassigned,
                      callback: function($$v) {
                        _vm.$set(_vm.searchForm, "is_reassigned", $$v)
                      },
                      expression: "searchForm.is_reassigned"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "FormItem",
                { attrs: { label: "到仓时间" } },
                [
                  _c("c-date-picker", {
                    staticStyle: { width: "280px" },
                    attrs: { type: "datetimerange", customize: true },
                    model: {
                      value: _vm.searchForm.arrival_warehouse_time,
                      callback: function($$v) {
                        _vm.$set(_vm.searchForm, "arrival_warehouse_time", $$v)
                      },
                      expression: "searchForm.arrival_warehouse_time"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c("Divider"),
              _vm._v(" "),
              _c(
                "FormItem",
                { attrs: { label: "出车单状态", "label-width": 80 } },
                [
                  _c(
                    "div",
                    {
                      staticClass: "checkbox-button-all",
                      class: {
                        "checkbox-button-all-checked": !_vm.searchForm.status
                          .length
                      },
                      on: {
                        click: function() {
                          this$1.searchForm.status = []
                        }
                      }
                    },
                    [_vm._v("全部\n                ")]
                  ),
                  _vm._v(" "),
                  _c(
                    "checkbox-button-group",
                    {
                      model: {
                        value: _vm.searchForm.status,
                        callback: function($$v) {
                          _vm.$set(_vm.searchForm, "status", $$v)
                        },
                        expression: "searchForm.status"
                      }
                    },
                    [
                      _c("checkbox-button", { attrs: { value: "0" } }, [
                        _vm._v("未签到")
                      ]),
                      _vm._v(" "),
                      _c("checkbox-button", { attrs: { value: "1" } }, [
                        _vm._v("已签到")
                      ]),
                      _vm._v(" "),
                      _c("checkbox-button", { attrs: { value: "2" } }, [
                        _vm._v("配送中")
                      ]),
                      _vm._v(" "),
                      _c("checkbox-button", { attrs: { value: "3" } }, [
                        _vm._v("配送完成")
                      ]),
                      _vm._v(" "),
                      _c("checkbox-button", { attrs: { value: "4" } }, [
                        _vm._v("设置不配送")
                      ]),
                      _vm._v(" "),
                      _c("checkbox-button", { attrs: { value: "5" } }, [
                        _vm._v("无责任解约")
                      ]),
                      _vm._v(" "),
                      _c("checkbox-button", { attrs: { value: "6" } }, [
                        _vm._v("运营取消")
                      ])
                    ],
                    1
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "FormItem",
                { attrs: { "label-width": 2 } },
                [
                  _c(
                    "Button",
                    {
                      attrs: { type: "primary" },
                      on: {
                        click: function($event) {
                          _vm.search(1)
                        }
                      }
                    },
                    [_vm._v("搜索")]
                  ),
                  _vm._v(" "),
                  _c(
                    "Button",
                    {
                      attrs: { type: "primary" },
                      on: {
                        click: function($event) {
                          _vm.download()
                        }
                      }
                    },
                    [_vm._v("导出")]
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-61be83e9", module.exports)
  }
}

/***/ })

});