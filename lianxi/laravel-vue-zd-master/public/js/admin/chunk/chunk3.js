webpackJsonp([3],{

/***/ 246:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(585)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(587)
/* template */
var __vue_template__ = __webpack_require__(613)
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
Component.options.__file = "resources/assets/admin/js/views/task/create.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-0d987e23", Component.options)
  } else {
    hotAPI.reload("data-v-0d987e23", Component.options)
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

/***/ 318:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(319)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(321)
/* template */
var __vue_template__ = __webpack_require__(322)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-01388e16"
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
Component.options.__file = "resources/assets/admin/js/components/input/number-range.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-01388e16", Component.options)
  } else {
    hotAPI.reload("data-v-01388e16", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 319:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(320);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("091071c3", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-01388e16\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./number-range.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-01388e16\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./number-range.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 320:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.number-range .ivu-input-wrapper[data-v-01388e16] {\n    display: inline-block;\n    width: 60px;\n}\n", ""]);

// exports


/***/ }),

/***/ 321:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _emitter = __webpack_require__(270);

var _emitter2 = _interopRequireDefault(_emitter);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
    name: 'number-range',
    mixins: [_emitter2.default],
    props: {
        value: {
            type: Object,
            default: function _default() {
                return { min: 0, max: 0 };
            }
        },
        step: [Number],
        unit: String,
        explanation: String
    },
    data: function data() {
        return {
            publicValue: this.value
        };
    },

    methods: {
        blur: function blur() {
            this.$emit('blur', this.publicValue);
            this.dispatch('FormItem', 'on-form-blur', this.publicValue);
        }
    },
    watch: {
        value: {
            handler: function handler(val) {
                this.publicValue = val;
            },

            deep: true
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

/***/ }),

/***/ 322:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "number-range" },
    [
      _c("Input", {
        attrs: { number: "", max: _vm.publicValue.max, step: _vm.step },
        on: { "on-change": _vm.blur },
        model: {
          value: _vm.publicValue.min,
          callback: function($$v) {
            _vm.$set(_vm.publicValue, "min", $$v)
          },
          expression: "publicValue.min"
        }
      }),
      _vm._v(" "),
      _c("span", [_vm._v("-")]),
      _vm._v(" "),
      _c("Input", {
        attrs: { number: "", min: _vm.publicValue.min, step: _vm.step },
        on: { "on-change": _vm.blur },
        model: {
          value: _vm.publicValue.max,
          callback: function($$v) {
            _vm.$set(_vm.publicValue, "max", $$v)
          },
          expression: "publicValue.max"
        }
      }),
      _vm._v(" "),
      _c("span", [_vm._v(_vm._s(_vm.unit))]),
      _c("br"),
      _vm._v(_vm._s(_vm.explanation) + "\n")
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-01388e16", module.exports)
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

/***/ 355:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(379)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(381)
/* template */
var __vue_template__ = __webpack_require__(382)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-20c2fd16"
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
Component.options.__file = "resources/assets/admin/js/components/checkbox/group-checkbox.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-20c2fd16", Component.options)
  } else {
    hotAPI.reload("data-v-20c2fd16", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 379:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(380);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("1616e392", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-20c2fd16\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./group-checkbox.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-20c2fd16\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./group-checkbox.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 380:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 381:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _emitter = __webpack_require__(270);

var _emitter2 = _interopRequireDefault(_emitter);

var _http = __webpack_require__(144);

var _http2 = _interopRequireDefault(_http);

var _groupBox = __webpack_require__(311);

var _groupBox2 = _interopRequireDefault(_groupBox);

var _index = __webpack_require__(312);

var _index2 = _interopRequireDefault(_index);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

//
//
//
//
//
//
//
//

exports.default = {
    name: 'group-checkbox',
    mixins: [_emitter2.default, _http2.default],
    components: { CheckboxButtonGroup: _groupBox2.default, CheckboxButton: _index2.default },
    props: {
        value: {
            type: Array,
            default: function _default() {
                return [];
            }
        },
        url: {
            type: String,
            required: true,
            default: ''
        }
    },
    data: function data() {
        return {
            publicValue: this.value,
            checkboxs: []
        };
    },
    mounted: function mounted() {
        this.$nextTick(function () {
            var _this = this;

            this.loading = true;
            this.$http.get(this.url).then(function (res) {
                _this.checkboxs = res.data.data;
            }).finally(function () {
                _this.loading = false;
            });
        });
    },

    methods: {
        change: function change(val) {
            this.$emit('input', this.publicValue);
            this.dispatch('FormItem', 'on-form-blur', this.publicValue);
        }
    },
    watch: {
        value: function value(val) {
            this.publicValue = val;
        }
    }
};

/***/ }),

/***/ 382:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "checkbox-button-group",
    {
      on: { "on-change": _vm.change },
      model: {
        value: _vm.publicValue,
        callback: function($$v) {
          _vm.publicValue = $$v
        },
        expression: "publicValue"
      }
    },
    [
      _vm._l(_vm.checkboxs, function(item, index) {
        return [
          _c("checkbox-button", { attrs: { value: item.id } }, [
            _vm._v(_vm._s(item.name))
          ])
        ]
      })
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-20c2fd16", module.exports)
  }
}

/***/ }),

/***/ 388:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(389)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(391)
/* template */
var __vue_template__ = __webpack_require__(392)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-6cb6c05c"
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
Component.options.__file = "resources/assets/admin/js/components/radio/group-radio.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-6cb6c05c", Component.options)
  } else {
    hotAPI.reload("data-v-6cb6c05c", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 389:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(390);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("46babb52", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-6cb6c05c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./group-radio.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-6cb6c05c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./group-radio.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 390:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 391:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _emitter = __webpack_require__(270);

var _emitter2 = _interopRequireDefault(_emitter);

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

exports.default = {
    name: 'group-radio',
    mixins: [_emitter2.default, _http2.default],
    props: {
        value: {
            type: Number
        },
        url: {
            type: String,
            required: true,
            default: ''
        }
    },
    data: function data() {
        return {
            publicValue: this.value,
            checkboxs: []
        };
    },
    mounted: function mounted() {
        this.$nextTick(function () {
            var _this = this;

            this.loading = true;
            this.$http.get(this.url).then(function (res) {
                _this.checkboxs = res.data.data;
            }).finally(function () {
                _this.loading = false;
            });
        });
    },

    methods: {
        change: function change(val) {
            this.$emit('input', this.publicValue);
            this.dispatch('FormItem', 'on-form-blur', this.publicValue);
        }
    },
    watch: {
        value: function value(val) {
            this.publicValue = val;
        }
    }
};

/***/ }),

/***/ 392:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "RadioGroup",
    {
      attrs: { type: "button" },
      on: { "on-change": _vm.change },
      model: {
        value: _vm.publicValue,
        callback: function($$v) {
          _vm.publicValue = $$v
        },
        expression: "publicValue"
      }
    },
    [
      _vm._l(_vm.checkboxs, function(item, index) {
        return [
          _c("Radio", { attrs: { value: item.id, label: item.id } }, [
            _vm._v(_vm._s(item.title))
          ])
        ]
      })
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-6cb6c05c", module.exports)
  }
}

/***/ }),

/***/ 585:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(586);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("8eb1511c", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0d987e23\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/_sass-loader@6.0.7@sass-loader/lib/loader.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./create.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0d987e23\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/_sass-loader@6.0.7@sass-loader/lib/loader.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./create.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 586:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "", ""]);

// exports


/***/ }),

/***/ 587:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _form = __webpack_require__(267);

var _form2 = _interopRequireDefault(_form);

var _http = __webpack_require__(144);

var _http2 = _interopRequireDefault(_http);

var _component = __webpack_require__(263);

var _component2 = _interopRequireDefault(_component);

var _createPreviousStep = __webpack_require__(588);

var _createPreviousStep2 = _interopRequireDefault(_createPreviousStep);

var _createNextStep = __webpack_require__(602);

var _createNextStep2 = _interopRequireDefault(_createNextStep);

var _createPreview = __webpack_require__(608);

var _createPreview2 = _interopRequireDefault(_createPreview);

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

exports.default = {
    name: 'create',
    mixins: [_form2.default, _http2.default, _component2.default],
    components: {
        CreatePreview: _createPreview2.default,
        CreateNextStep: _createNextStep2.default,
        CreatePreviousStep: _createPreviousStep2.default
    },
    data: function data() {
        return {
            current: 'CreatePreviousStep',
            exclude: 'create-preview',
            config: this.$store.getters.cache('config'),
            taskConfig: {},
            extra: {},
            formCreate: {
                is_back: 0,
                distance_json: {},
                send_time: [],
                goods_volume: {},
                goods_weight: {},
                goods_num: {},
                back_bill: 0,
                receipt: {
                    type: '',
                    recipient: '',
                    phone: '',
                    address: '',
                    express: ''
                },
                unit_price: {},
                is_delivery: 0,
                dispatching: [],
                choose_driver_end_time: '',
                carry_type: 0,
                carry: {
                    textarea: '',
                    is_worker: 0,
                    is_loading: 0,
                    is_unloading: 0
                },
                other: {
                    is_remove_seat: 0,
                    is_trolley: 0,
                    is_tail_plate: 0,
                    is_extinguisher: 0,
                    is_lock: 0,
                    other_require: ''
                },
                supply: [],
                welfare: [],
                is_show: 0
            }
        };
    },
    mounted: function mounted() {
        this.setType();
        this.copy();
        this.setConfig();
        this.setTaskConfig();
    },

    methods: {
        setType: function setType() {
            this.$set(this.formCreate, 'type', Number(this.$route.query.type) || '');
        },
        copy: function copy() {
            var _this = this;

            var id = this.$route.params.id;
            if (id) this.$http.get('task/copy/' + id).then(function (res) {
                var data = _this.formCreate = res.data.data;
                _this.extra = {
                    supply: data.supply[data.supply.length - 1] || '',
                    welfare: data.welfare[data.welfare.length - 1] || ''
                };
            });
        },
        setConfig: function setConfig() {
            var _this2 = this;

            if (this.config.length === 0) {
                if (!this.$store.getters.cacheLock('config')) {
                    this.$http.get('config/index').then(function (res) {
                        _this2.$store.commit('setCacheData', {
                            key: 'config',
                            data: res.data.data
                        });
                        _this2.config = res.data.data;
                    }).catch(function (err) {
                        _this2.config = {};
                        _this2.formatErrors(err);
                    });
                } else {
                    setTimeout(function () {
                        _this2.config = _this2.$store.getters.cache('config');
                    }, 2000);
                }
            }
        },
        setTaskConfig: function setTaskConfig() {
            var config = this.config;
            if (this.formCreate.type === 1) this.taskConfig = {
                earliest_arrival_time: config.master_driver_reach_earliest_time,
                earliest_quote_time: config.master_driver_quote_latest_time,
                choose_driver_latest_time: config.change_master_driver_latest_time_before_work
            };
            if (this.formCreate.type === 2) this.taskConfig = {
                earliest_arrival_time: config.temp_driver_reach_earliest_time,
                earliest_quote_time: config.temp_driver_quote_earliest_time,
                choose_driver_latest_time: config.change_temp_driver_latest_time_before_work
            };
        },
        objToArr: function objToArr(obj) {
            if (!(obj instanceof Array)) {
                var arr = [];
                Object.keys(obj).forEach(function (item, index) {
                    arr.push(obj[index]);
                });
                return arr;
            }
            return false;
        },
        go: function go(name, params) {
            this.$router.push({ name: name, params: params });
        },
        next: function next() {
            if (this.current === 'CreatePreviousStep') this.current = 'CreateNextStep';
        },
        previous: function previous() {
            if (this.current === 'CreateNextStep') this.current = 'CreatePreviousStep';
        },
        ok: function ok() {
            var _this3 = this;

            this.loading = true;
            this.$http.post('task/create', this.formCreate).then(function (res) {
                _this3.$Message.success(res.data.message);
                _this3.change(false);
                _this3.go('task.lists');
            }).catch(function (res) {
                _this3.formatErrors(res);
            }).finally(function () {
                _this3.loading = false;
            });
        },
        preview: function preview() {
            if (this.current === 'CreateNextStep') this.current = 'CreatePreview';
        },
        cancelPreview: function cancelPreview() {
            if (this.current === 'CreatePreview') this.current = 'CreateNextStep';
        }
    },
    watch: {
        'formCreate.type': function formCreateType(val) {
            this.setTaskConfig();
        },
        config: function config(val) {
            this.setTaskConfig();
        },
        'formCreate.dispatching': function formCreateDispatching(val) {
            this.formCreate.dispatching = this.objToArr(val) || val;
        },
        'formCreate.welfare': function formCreateWelfare(val) {
            this.formCreate.welfare = this.objToArr(val) || val;
        }
    }
};

/***/ }),

/***/ 588:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(589)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(591)
/* template */
var __vue_template__ = __webpack_require__(601)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-1ba5c76d"
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
Component.options.__file = "resources/assets/admin/js/views/task/create/create-previous-step.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-1ba5c76d", Component.options)
  } else {
    hotAPI.reload("data-v-1ba5c76d", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 589:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(590);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("7f33ee1e", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-1ba5c76d\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./create-previous-step.vue", function() {
     var newContent = require("!!../../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-1ba5c76d\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./create-previous-step.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 590:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.amap-page-container[data-v-1ba5c76d] {\n    height: 400px;\n    position: relative;\n}\n.long-lat-text[data-v-1ba5c76d] {\n    background-color: #ffffff;\n    border: 1px #c0c0c0 solid;\n    padding: 2px;\n    position: absolute;\n    top: 10px;\n    right: 10px;\n    border-radius: 6px;\n}\n.checkbox-button-all[data-v-1ba5c76d] {\n    vertical-align: middle;\n    display: inline-block;\n    height: 32px;\n    line-height: 30px;\n    margin: 0;\n    padding: 0 15px;\n    font-size: 12px;\n    color: #515a6e;\n    -webkit-transition: all .2s ease-in-out;\n    transition: all .2s ease-in-out;\n    cursor: pointer;\n    border: 1px solid #dcdee2;\n    background: #fff;\n    position: relative;\n    border-radius: 4px;\n}\n.checkbox-button-all-checked[data-v-1ba5c76d] {\n    border-color: #2d8cf0;\n    color: #2d8cf0;\n}\n", ""]);

// exports


/***/ }),

/***/ 591:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _moment = __webpack_require__(0);

var _moment2 = _interopRequireDefault(_moment);

var _createPrevious = __webpack_require__(592);

var _component = __webpack_require__(263);

var _component2 = _interopRequireDefault(_component);

var _lists = __webpack_require__(265);

var _lists2 = _interopRequireDefault(_lists);

var _points = __webpack_require__(593);

var _points2 = _interopRequireDefault(_points);

var _index = __webpack_require__(268);

var _index2 = _interopRequireDefault(_index);

var _index3 = __webpack_require__(294);

var _index4 = _interopRequireDefault(_index3);

var _remote = __webpack_require__(266);

var _remote2 = _interopRequireDefault(_remote);

var _numberRange = __webpack_require__(318);

var _numberRange2 = _interopRequireDefault(_numberRange);

var _groupBox = __webpack_require__(311);

var _groupBox2 = _interopRequireDefault(_groupBox);

var _index5 = __webpack_require__(312);

var _index6 = _interopRequireDefault(_index5);

var _index7 = __webpack_require__(293);

var _index8 = _interopRequireDefault(_index7);

var _placeSearchSelect = __webpack_require__(305);

var _placeSearchSelect2 = _interopRequireDefault(_placeSearchSelect);

var _taskFormPoint = __webpack_require__(596);

var _taskFormPoint2 = _interopRequireDefault(_taskFormPoint);

var _groupCheckbox = __webpack_require__(355);

var _groupCheckbox2 = _interopRequireDefault(_groupCheckbox);

var _groupRadio = __webpack_require__(388);

var _groupRadio2 = _interopRequireDefault(_groupRadio);

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

exports.default = {
    name: 'create-previous-step',
    mixins: [_component2.default, _lists2.default],
    components: {
        GroupRadio: _groupRadio2.default,
        GroupCheckbox: _groupCheckbox2.default,
        TaskFormPoint: _taskFormPoint2.default,
        PlaceSearchSelect: _placeSearchSelect2.default,
        CDatePicker: _index8.default,
        CheckboxButton: _index6.default,
        CheckboxButtonGroup: _groupBox2.default,
        NumberRange: _numberRange2.default,
        Remote: _remote2.default,
        Detail: _index4.default,
        Box: _index2.default,
        Points: _points2.default
    },
    props: {
        value: {
            type: Object,
            required: true
        },
        config: {
            type: Object,
            required: true
        }
    },
    data: function data() {
        return {
            publicValue: this.value,
            publicConfig: this.config,
            params: {},
            temp_date: [],
            options: {
                disabledDate: function disabledDate(date) {
                    return date && date.valueOf() < Date.now() - 86400000;
                }
            },
            currentRules: {
                unfixed_json: {
                    required: true,
                    validator: function validator(rule, value, callback) {
                        if (/^[1-9]+$/.test(value.min)) {
                            if (/^[1-9]\d*$/.test(value.max)) {
                                if (value.min < value.max) {
                                    callback();
                                } else {
                                    callback(new Error('最小值须小于最大值'));
                                }
                            } else {
                                callback(new Error('请输入有效最大值'));
                            }
                        } else {
                            callback(new Error('请输入有效最小值'));
                        }
                    },
                    trigger: 'blur'
                },
                arrival_date: [{
                    required: true,
                    message: '请选择司机上岗日期',
                    trigger: 'blur'
                }, {
                    validator: function validator(rule, value, callback) {
                        if (value < (0, _moment2.default)().format('YYYY-MM-DD')) callback(new Error('司机上岗日期不得小于当前日期'));else callback();
                    },
                    trigger: 'blur'
                }]
            },
            publicValueRules: (0, _createPrevious.Validator)(this)
        };
    },

    computed: {
        days: function days() {
            var temp_start = this.temp_date[0];
            var temp_end = this.temp_date[1];
            if (temp_start && temp_end) {
                this.publicValue.temp_start_date = temp_start;
                this.publicValue.temp_end_date = temp_end;
                return (0, _moment2.default)(temp_end).diff((0, _moment2.default)(temp_start), 'days') + 1;
            } else {
                delete this.publicValue.temp_start_date;
                delete this.publicValue.temp_end_date;
                return 0;
            }
        },
        timeDiff: function timeDiff() {
            var arrival = this.publicValue.arrival_warehouse_time;
            var estimate = this.publicValue.estimate_time;
            if (arrival && estimate && arrival !== estimate) {
                var today = (0, _moment2.default)().format('YYYY-MM-DD') + ' ';
                var date = (arrival < estimate ? (0, _moment2.default)().format('YYYY-MM-DD') : (0, _moment2.default)().subtract(-1, 'days').format('YYYY-MM-DD')) + ' ';
                var minutes = (0, _moment2.default)(date + estimate).diff((0, _moment2.default)(today + arrival), 'minutes');
                var hours = (0, _moment2.default)(date + estimate).diff((0, _moment2.default)(today + arrival), 'hours');
                return minutes < 60 ? minutes + '分钟' : hours + '小时' + (minutes % 60 !== 0 ? minutes % 60 + '分钟' : '');
            }
        }
    },
    mounted: function mounted() {},

    methods: {
        importPoints: function importPoints() {
            this.showComponent('Points', this.publicValue.warehouse_id);
        },
        points: function points(val) {
            if (val.length > 0) {
                var points = [];
                val.forEach(function (item, index) {
                    points.push({
                        name: item.fixed_name,
                        lng: item.lng,
                        lat: item.lat,
                        contacts: item.contacts,
                        contact_way: item.contact_way
                    });
                });
                this.publicValue.delivery_point = points;
            }
        },
        go: function go(name) {
            this.$router.push({ name: name });
        },
        add: function add() {
            this.publicValue.delivery_point.push({
                name: '',
                lng: 0,
                lat: 0,
                contacts: '',
                contact_way: ''
            });
        },
        del: function del(index) {
            this.publicValue.delivery_point.splice(index, 1);
        },
        next: function next(previous) {
            var _this = this;

            this.$refs[previous].validate(function (valid) {
                if (valid) _this.$emit('on-next');
            });
        }
    },
    watch: {
        value: {
            handler: function handler(val) {
                this.publicValue = val;
            },

            deep: true
        },
        publicValue: function publicValue(val) {
            var start = val.temp_start_date;
            var end = val.temp_end_date;
            if (start && end) this.temp_date = [start, end];
            var num = val.goods_num;
            if (num === null || num.min === 0 && num.max === 0) this.publicValue.goods_num = {};
        },
        config: function config(val) {
            this.publicConfig = val;
        },
        'publicValue.type': function publicValueType(val) {
            if (!this.$route.params.id) {
                if (val === 1) this.$set(this.publicValue, 'arrival_date', (0, _moment2.default)().format('YYYY-MM-DD'));
                if (val === 2) this.$delete(this.publicValue, 'arrival_date');
            } else {
                if (val === 1 && !this.publicValue.send_time) this.$set(this.publicValue, 'send_time', []);
                if (val === 2) this.$delete(this.publicValue, 'send_time');
            }
        },
        'publicValue.merchant.short_name': function publicValueMerchantShort_name(val) {
            if (this.$route.params.id) this.params = { title: val };
        },
        'publicValue.is_fixed_point': function publicValueIs_fixed_point(val) {
            if (val === 1) {
                if (!this.$route.params.id || !this.publicValue.delivery_point) this.$set(this.publicValue, 'delivery_point', [{
                    name: '',
                    lng: 0,
                    lat: 0,
                    contacts: '',
                    contact_way: ''
                }]);
                this.$delete(this.publicValue, 'unfixed_json');
            } else {
                if (!this.$route.params.id || !this.publicValue.unfixed_json) this.publicValue.unfixed_json = {};
                this.$delete(this.publicValue, 'delivery_point');
            }
        }
    }
};

/***/ }),

/***/ 592:
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
    var validatorInterregional = function validatorInterregional(rule, value, callback, regular1, regular2) {
        if (regular1.test(value.min)) {
            if (regular2.test(value.max)) {
                if (value.min < value.max) {
                    callback();
                } else {
                    callback(new Error('最小值须小于最大值'));
                }
            } else {
                callback(new Error('请输入有效最大值'));
            }
        } else {
            callback(new Error('请输入有效最小值'));
        }
    };
    var interregionalRule = {
        required: true,
        validator: function validator(rule, value, callback) {
            validatorInterregional(rule, value, callback, /^\d+(\.\d{1,2})?$/, /^[1-9]\d*(\.\d{1,2})?$/);
        },
        trigger: 'blur'
    };
    return {
        type: [{
            required: true,
            type: 'number',
            message: '请选择司机类型',
            trigger: 'change'
        }],
        merchant_id: [{
            required: true,
            type: 'number',
            message: '请选择商户',
            trigger: 'change'
        }],
        warehouse_id: [{
            required: true,
            type: 'number',
            message: '请选择仓',
            trigger: 'change'
        }],
        name: [{
            required: true,
            type: 'string',
            max: 20,
            message: '请输入线路名称，最多输入20字',
            trigger: 'blur'
        }],
        is_fixed_point: [{
            required: true,
            type: 'number',
            message: '请选择配送点是否固定',
            trigger: 'change'
        }],
        delivery_point_remark: [{
            required: true,
            type: 'string',
            max: 300,
            message: '请输入配送点备注，最多输入300字',
            trigger: 'blur'
        }],
        /*unfixed_json: [
            {
                required: true,
                validator: (rule, value, callback) => {
                    validatorInterregional(rule, value, callback, /^\d+$/, /^[1-9]\d*$/)
                },
                trigger: 'blur',
            }
        ],*/
        is_back: [{
            required: true,
            type: 'number',
            message: '请选择是否需要返仓',
            trigger: 'change'
        }],
        distance_json: [interregionalRule],
        send_time: [{
            required: true,
            type: 'array',
            message: '请选择配送时间',
            trigger: 'blur'
        }],
        temp_date: [{
            required: true,
            validator: function validator(rule, value, callback) {
                if (!data.temp_date[0] && !data.temp_date[1]) {
                    callback(new Error('请选择配送时间'));
                } else {
                    var now = (0, _moment2.default)().format('YYYY-MM-DD');
                    if (data.temp_date[0] < now || data.temp_date[1] < now) {
                        callback(new Error('配送时间须小于当前日期'));
                    } else {
                        callback();
                    }
                }
            },
            trigger: 'blur'
        }],
        arrival_warehouse_time: [{
            required: true,
            message: '请选择到仓时间',
            trigger: 'change'
        }, {
            validator: function validator(rule, value, callback) {
                var arrival_date = data.publicValue.arrival_date;
                value = (0, _moment2.default)(arrival_date).format('YYYY-MM-DD') + ' ' + value;
                var now = (0, _moment2.default)().format('YYYY-MM-DD HH:mm');
                var time = data.publicConfig.earliest_arrival_time;
                if (time) {
                    if ((0, _moment2.default)(value).diff(now, 'minutes') < time * 60) {
                        callback(new Error('到仓时间至少为当前时间后' + time + '小时'));
                    } else {
                        callback();
                    }
                } else {
                    var type = data.publicValue.type === 1 ? '主' : data.publicValue.type === 2 ? '临时' : '';
                    callback(new Error('未获取到' + type + '司机（任务）时间的配置信息'));
                }
            },
            trigger: 'change'
        }],
        estimate_time: [{
            required: true,
            message: '请选择预计完成时间',
            trigger: 'change'
        }, {
            validator: function validator(rule, value, callback) {
                value = (0, _moment2.default)().format('YYYY-MM-DD') + ' ' + value;
                var arrival = (0, _moment2.default)().format('YYYY-MM-DD') + ' ' + data.publicValue.arrival_warehouse_time;
                if (value === arrival) {
                    callback(new Error('预计完成时间与到仓时间不能相同'));
                } else {
                    callback();
                }
            },
            trigger: 'change'
        }],
        car_type_ids: [{
            type: 'array',
            required: true,
            message: '请选择车型',
            trigger: 'blur'
        }],
        goods_remark: [{
            required: true,
            type: 'string',
            max: 20,
            message: '请输入需要配送什么货物，最多20字',
            trigger: 'blur'
        }],
        goods_volume: [interregionalRule],
        goods_weight: [interregionalRule],
        goods_num: [{
            validator: function validator(rule, value, callback) {
                if (value.min || value.max || value.min === 0 || value.max === 0) {
                    validatorInterregional(rule, value, callback, /^\d+$/, /^[1-9]\d*$/);
                } else {
                    callback();
                }
            },
            trigger: 'blur'
        }],
        back_bill: [{
            required: true,
            type: 'number',
            message: '请选择是否需要回单',
            trigger: 'change'
        }],
        'receipt.type': [{
            required: true,
            type: 'number',
            message: '请选择回单方式',
            trigger: 'change'
        }, {
            validator: function validator(rule, value, callback) {
                if (value === 1 && data.publicValue.is_back !== 1) {
                    callback(new Error('请先选择需要返仓，否则不能选择返仓交回'));
                } else {
                    callback();
                }
            },
            trigger: 'change'
        }],
        'receipt.recipient': [{
            required: true,
            type: 'string',
            message: '请输入接收人',
            trigger: 'blur'
        }],
        'receipt.phone': [{
            required: true,
            pattern: /^1[34578]\d{9}$/,
            message: '请输入有效的联系方式',
            trigger: 'blur'
        }],
        'receipt.address': [{
            required: true,
            type: 'string',
            message: '请输入收件地址',
            trigger: 'blur'
        }],
        'receipt.express': [{
            required: true,
            type: 'number',
            message: '请输入快递费类型',
            trigger: 'blur'
        }],
        unit_price: [{
            validator: function validator(rule, value, callback) {
                if (value.min || value.max || value.min === 0 || value.max === 0) {
                    validatorInterregional(rule, value, callback, /^\d+(\.\d{1,2})?$/, /^[1-9]\d*(\.\d{1,2})?$/);
                } else {
                    callback();
                }
            },
            trigger: 'blur'
        }],
        price_remark: [{
            type: 'string',
            max: 20,
            message: '请输入线路名称，最多输入20字',
            trigger: 'blur'
        }]
    };
};

/***/ }),

/***/ 593:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(594)
/* template */
var __vue_template__ = __webpack_require__(595)
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
Component.options.__file = "resources/assets/admin/js/views/task/create/points.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-f0b02d02", Component.options)
  } else {
    hotAPI.reload("data-v-f0b02d02", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 594:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _myLists = __webpack_require__(269);

var _myLists2 = _interopRequireDefault(_myLists);

var _lists = __webpack_require__(265);

var _lists2 = _interopRequireDefault(_lists);

var _component = __webpack_require__(263);

var _component2 = _interopRequireDefault(_component);

var _componentModal = __webpack_require__(264);

var _componentModal2 = _interopRequireDefault(_componentModal);

var _index = __webpack_require__(293);

var _index2 = _interopRequireDefault(_index);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
    name: 'points',
    components: {
        MyLists: _myLists2.default,
        ComponentModal: _componentModal2.default,
        CDatePicker: _index2.default
    },
    mixins: [_lists2.default, _component2.default],
    data: function data() {
        var _this = this;

        return {
            options: {},
            extra: {
                total: []
            },
            columns: [{
                title: '线路名称',
                render: function render(h, _ref) {
                    var row = _ref.row;

                    return h(
                        'span',
                        null,
                        [row.title]
                    );
                }
            }, {
                title: '到仓时间',
                render: function render(h, _ref2) {
                    var row = _ref2.row;

                    return h(
                        'span',
                        null,
                        [row.arrival_warehouse_day + ' ' + row.arrival_warehouse_time]
                    );
                }
            }, {
                title: '操作',
                render: function render(h, _ref3) {
                    var row = _ref3.row;

                    return h(
                        'button-group',
                        null,
                        [h(
                            'i-button',
                            {
                                attrs: {
                                    size: 'small'
                                },
                                on: {
                                    'click': function click() {
                                        return _this.import(row.id);
                                    }
                                }
                            },
                            ['\u6307\u5B9A']
                        )]
                    );
                }
            }]
        };
    },

    computed: {
        total: function total() {
            return this.extra.total;
        }
    },
    methods: {
        search: function search() {
            var _this2 = this;

            var page = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;

            this.loading = true;
            this.$http.get('point/taskline/' + this.data, { params: this.request(page) }).then(function (res) {
                _this2.assignmentData(res.data.data);
            }).catch(function (res) {
                _this2.formatErrors(res);
            }).finally(function () {
                _this2.loading = false;
            });
        },
        import: function _import(id) {
            var _this3 = this;

            this.loading = true;
            this.$http.get('point/tasklinepoint/' + id).then(function (res) {
                if (res.data.data.length > 0) {
                    _this3.$emit('points', res.data.data);
                }
                _this3.change(false);
            }).catch(function (res) {
                _this3.formatErrors(res);
            }).finally(function () {
                _this3.loading = false;
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

/***/ }),

/***/ 595:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "component-modal",
    { attrs: { title: "导入配送点信息", width: 50 } },
    [
      _c(
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
                  attrs: {
                    model: _vm.searchForm,
                    inline: "",
                    "label-width": 60
                  }
                },
                [
                  _c(
                    "FormItem",
                    { attrs: { label: "到仓时间" } },
                    [
                      _c("c-date-picker", {
                        staticStyle: { width: "300px" },
                        attrs: {
                          options: _vm.options,
                          type: "datetimerange",
                          panels: true
                        },
                        model: {
                          value: _vm.searchForm.arrival_time,
                          callback: function($$v) {
                            _vm.$set(_vm.searchForm, "arrival_time", $$v)
                          },
                          expression: "searchForm.arrival_time"
                        }
                      })
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "FormItem",
                    { attrs: { "label-width": 1 } },
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
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-f0b02d02", module.exports)
  }
}

/***/ }),

/***/ 596:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(597)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(599)
/* template */
var __vue_template__ = __webpack_require__(600)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-b1b3138a"
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
Component.options.__file = "resources/assets/admin/js/views/components/task/task-form-point.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-b1b3138a", Component.options)
  } else {
    hotAPI.reload("data-v-b1b3138a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 597:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(598);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("bf8b5964", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-b1b3138a\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./task-form-point.vue", function() {
     var newContent = require("!!../../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-b1b3138a\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./task-form-point.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 598:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 599:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _placeSearchSelect = __webpack_require__(305);

var _placeSearchSelect2 = _interopRequireDefault(_placeSearchSelect);

var _emitter = __webpack_require__(270);

var _emitter2 = _interopRequireDefault(_emitter);

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

exports.default = {
    components: { PlaceSearchSelect: _placeSearchSelect2.default },
    mixins: [_emitter2.default],
    name: 'task-form-point',
    props: {
        value: {
            type: Object,
            required: true
        }
    },
    data: function data() {
        return {
            publicValue: this.value
        };
    },

    methods: {
        change: function change() {
            this.$emit('input', this.publicValue);
            this.dispatch('FormItem', 'on-form-blur', this.publicValue);
        }
    },
    watch: {
        value: {
            handler: function handler(val) {
                this.publicValue = val;
            },

            deep: true
        }
    }
};

/***/ }),

/***/ 600:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "Row",
    [
      _c(
        "Col",
        { attrs: { span: "7" } },
        [
          _c("place-search-select", {
            on: {
              "on-change": _vm.change,
              pois: function(val) {
                _vm.publicValue.lat = val.location ? val.location.lat : 0
                _vm.publicValue.lng = val.location ? val.location.lng : 0
              }
            },
            model: {
              value: _vm.publicValue.name,
              callback: function($$v) {
                _vm.$set(_vm.publicValue, "name", $$v)
              },
              expression: "publicValue.name"
            }
          })
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "Col",
        { attrs: { span: "5" } },
        [
          _c("Input", {
            attrs: { placeholder: "联系人", clearable: "" },
            on: { "on-change": _vm.change },
            model: {
              value: _vm.publicValue.contacts,
              callback: function($$v) {
                _vm.$set(_vm.publicValue, "contacts", $$v)
              },
              expression: "publicValue.contacts"
            }
          })
        ],
        1
      ),
      _vm._v(" \n    "),
      _c(
        "Col",
        { attrs: { span: "5" } },
        [
          _c("Input", {
            attrs: { placeholder: "联系方式", clearable: "" },
            on: { "on-change": _vm.change },
            model: {
              value: _vm.publicValue.contact_way,
              callback: function($$v) {
                _vm.$set(_vm.publicValue, "contact_way", $$v)
              },
              expression: "publicValue.contact_way"
            }
          })
        ],
        1
      ),
      _vm._v(" \n")
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-b1b3138a", module.exports)
  }
}

/***/ }),

/***/ 601:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var this$1 = this
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c(
        "Form",
        {
          ref: "previous",
          attrs: {
            model: _vm.publicValue,
            "label-width": 150,
            rules: _vm.publicValueRules
          }
        },
        [
          _c(
            "FormItem",
            { attrs: { label: "司机类型", prop: "type" } },
            [
              _c(
                "RadioGroup",
                {
                  attrs: { type: "button" },
                  model: {
                    value: _vm.publicValue.type,
                    callback: function($$v) {
                      _vm.$set(_vm.publicValue, "type", $$v)
                    },
                    expression: "publicValue.type"
                  }
                },
                [
                  _c("Radio", { attrs: { label: 1, value: 1 } }, [
                    _vm._v("招主司机")
                  ]),
                  _vm._v(" "),
                  _c("Radio", { attrs: { label: 2, value: 2 } }, [
                    _vm._v("招临时司机")
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
            { attrs: { label: "选择商户", prop: "merchant_id" } },
            [
              _c("remote", {
                staticStyle: { width: "400px" },
                attrs: {
                  "remote-url": "merchants/select",
                  "search-key": "title",
                  params: _vm.params
                },
                model: {
                  value: _vm.publicValue.merchant_id,
                  callback: function($$v) {
                    _vm.$set(_vm.publicValue, "merchant_id", $$v)
                  },
                  expression: "publicValue.merchant_id"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "选择仓", prop: "warehouse_id" } },
            [
              _c("remote", {
                staticStyle: { width: "400px" },
                attrs: {
                  "remote-url": "warehouse/select",
                  ready: false,
                  remote: false,
                  params: { merchant_id: this.publicValue.merchant_id }
                },
                model: {
                  value: _vm.publicValue.warehouse_id,
                  callback: function($$v) {
                    _vm.$set(_vm.publicValue, "warehouse_id", $$v)
                  },
                  expression: "publicValue.warehouse_id"
                }
              }),
              _vm._v(" "),
              _c(
                "Button",
                {
                  attrs: { type: "default" },
                  on: {
                    click: function($event) {
                      _vm.go("warehouse.index")
                    }
                  }
                },
                [_vm._v("新建仓")]
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "线路名称", prop: "name" } },
            [
              _c("Input", {
                staticStyle: { width: "400px" },
                attrs: { placeholder: "线路名称，最多输入20字", clearable: "" },
                model: {
                  value: _vm.publicValue.name,
                  callback: function($$v) {
                    _vm.$set(_vm.publicValue, "name", $$v)
                  },
                  expression: "publicValue.name"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "配送点固定", prop: "is_fixed_point" } },
            [
              _c(
                "RadioGroup",
                {
                  attrs: { type: "button" },
                  model: {
                    value: _vm.publicValue.is_fixed_point,
                    callback: function($$v) {
                      _vm.$set(_vm.publicValue, "is_fixed_point", $$v)
                    },
                    expression: "publicValue.is_fixed_point"
                  }
                },
                [
                  _c(
                    "Radio",
                    {
                      attrs: {
                        label: 1,
                        value: 1,
                        disabled: !_vm.publicValue.warehouse_id
                      }
                    },
                    [_vm._v("是")]
                  ),
                  _vm._v(" "),
                  _c(
                    "Radio",
                    {
                      attrs: {
                        label: 0,
                        value: 0,
                        disabled: !_vm.publicValue.warehouse_id
                      }
                    },
                    [_vm._v("否")]
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _vm.publicValue.is_fixed_point === 1 && _vm.publicValue.warehouse_id
            ? [
                _vm._l(_vm.publicValue.delivery_point, function(item, index) {
                  return _c(
                    "FormItem",
                    {
                      key: index,
                      staticStyle: { width: "70%" },
                      attrs: {
                        label: index === 0 ? "配送点信息" : "",
                        prop: "delivery_point." + index,
                        rules: {
                          required: true,
                          type: "object",
                          trigger: "blur",
                          fields: {
                            name: {
                              required: true,
                              type: "string",
                              message: "请输入有效地址"
                            },
                            contacts: {
                              required: true,
                              type: "string",
                              message: "请输入联系人"
                            },
                            contact_way: {
                              required: true,
                              pattern: /^1[34578]\d{9}$/,
                              message: "请输入有效联系方式"
                            }
                          }
                        }
                      }
                    },
                    [
                      _c(
                        "Row",
                        [
                          _c(
                            "Col",
                            { attrs: { span: "20" } },
                            [
                              _c("task-form-point", {
                                model: {
                                  value: _vm.publicValue.delivery_point[index],
                                  callback: function($$v) {
                                    _vm.$set(
                                      _vm.publicValue.delivery_point,
                                      index,
                                      $$v
                                    )
                                  },
                                  expression:
                                    "publicValue.delivery_point[index]"
                                }
                              })
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c(
                            "Col",
                            { attrs: { span: "4" } },
                            [
                              index === 0
                                ? _c(
                                    "div",
                                    [
                                      _c("Button", { on: { click: _vm.add } }, [
                                        _vm._v("添加")
                                      ]),
                                      _vm._v(" "),
                                      _c(
                                        "Button",
                                        { on: { click: _vm.importPoints } },
                                        [_vm._v("导入")]
                                      )
                                    ],
                                    1
                                  )
                                : _c(
                                    "Button",
                                    {
                                      on: {
                                        click: function($event) {
                                          _vm.del(index)
                                        }
                                      }
                                    },
                                    [_vm._v("删除")]
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
                }),
                _vm._v(" "),
                _c(
                  "FormItem",
                  { staticStyle: { width: "70%" } },
                  [
                    _c("box", { attrs: { title: "地图" } }, [
                      _c(
                        "div",
                        { staticClass: "amap-page-container" },
                        [
                          _c(
                            "el-amap",
                            { attrs: { vid: "amap" } },
                            _vm._l(_vm.publicValue.delivery_point, function(
                              item,
                              index
                            ) {
                              return _c("el-amap-marker", {
                                key: index,
                                attrs: {
                                  vid: "component-marker" + index,
                                  position: [item.lng, item.lat]
                                }
                              })
                            })
                          )
                        ],
                        1
                      )
                    ])
                  ],
                  1
                )
              ]
            : _vm._e(),
          _vm._v(" "),
          _vm.publicValue.is_fixed_point === 0 && _vm.publicValue.warehouse_id
            ? [
                _c(
                  "FormItem",
                  {
                    attrs: {
                      label: "配送点数量",
                      prop: "unfixed_json",
                      rules: _vm.currentRules.unfixed_json
                    }
                  },
                  [
                    _c("number-range", {
                      attrs: { unit: "个" },
                      model: {
                        value: _vm.publicValue.unfixed_json,
                        callback: function($$v) {
                          _vm.$set(_vm.publicValue, "unfixed_json", $$v)
                        },
                        expression: "publicValue.unfixed_json"
                      }
                    })
                  ],
                  1
                )
              ]
            : _vm._e(),
          _vm._v(" "),
          (_vm.publicValue.is_fixed_point === 0 ||
            _vm.publicValue.is_fixed_point === 1) &&
          _vm.publicValue.warehouse_id
            ? [
                _c(
                  "FormItem",
                  {
                    staticStyle: { width: "70%" },
                    attrs: {
                      label:
                        _vm.publicValue.is_fixed_point === 0
                          ? "配送区域描述"
                          : "配送点备注",
                      prop: "delivery_point_remark"
                    }
                  },
                  [
                    _c("Input", {
                      attrs: {
                        type: "textarea",
                        placeholder:
                          "货物要配送到哪些区域？请尽量写明详细地址，有利于司机报价，最多输入300字"
                      },
                      model: {
                        value: _vm.publicValue.delivery_point_remark,
                        callback: function($$v) {
                          _vm.$set(
                            _vm.publicValue,
                            "delivery_point_remark",
                            $$v
                          )
                        },
                        expression: "publicValue.delivery_point_remark"
                      }
                    })
                  ],
                  1
                )
              ]
            : _vm._e(),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "需要返仓", prop: "is_back" } },
            [
              _c(
                "RadioGroup",
                {
                  attrs: { type: "button" },
                  model: {
                    value: _vm.publicValue.is_back,
                    callback: function($$v) {
                      _vm.$set(_vm.publicValue, "is_back", $$v)
                    },
                    expression: "publicValue.is_back"
                  }
                },
                [
                  _c("Radio", { attrs: { label: 1, value: 1 } }, [
                    _vm._v("是")
                  ]),
                  _vm._v(" "),
                  _c("Radio", { attrs: { label: 0, value: 0 } }, [_vm._v("否")])
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "配送总里程", prop: "distance_json" } },
            [
              _c("number-range", {
                attrs: { unit: "公里" },
                model: {
                  value: _vm.publicValue.distance_json,
                  callback: function($$v) {
                    _vm.$set(_vm.publicValue, "distance_json", $$v)
                  },
                  expression: "publicValue.distance_json"
                }
              }),
              _vm._v(
                "\n            如需返仓，配送总里程包括返仓公里数\n        "
              )
            ],
            1
          ),
          _vm._v(" "),
          _vm.publicValue.type === 1
            ? _c(
                "FormItem",
                { attrs: { label: "配送时间", prop: "send_time" } },
                [
                  _c(
                    "div",
                    {
                      staticClass: "checkbox-button-all",
                      class: {
                        "checkbox-button-all-checked":
                          _vm.publicValue.send_time.length === 7
                      },
                      on: {
                        click: function() {
                          _vm.publicValue.send_time.length === 7
                            ? (this$1.publicValue.send_time = [])
                            : (this$1.publicValue.send_time = [
                                1,
                                2,
                                3,
                                4,
                                5,
                                6,
                                7
                              ])
                        }
                      }
                    },
                    [_vm._v("全部\n            ")]
                  ),
                  _vm._v(" "),
                  _c(
                    "checkbox-button-group",
                    {
                      model: {
                        value: _vm.publicValue.send_time,
                        callback: function($$v) {
                          _vm.$set(_vm.publicValue, "send_time", $$v)
                        },
                        expression: "publicValue.send_time"
                      }
                    },
                    [
                      _c("checkbox-button", { attrs: { value: 1 } }, [
                        _vm._v("周一")
                      ]),
                      _vm._v(" "),
                      _c("checkbox-button", { attrs: { value: 2 } }, [
                        _vm._v("周二")
                      ]),
                      _vm._v(" "),
                      _c("checkbox-button", { attrs: { value: 3 } }, [
                        _vm._v("周三")
                      ]),
                      _vm._v(" "),
                      _c("checkbox-button", { attrs: { value: 4 } }, [
                        _vm._v("周四")
                      ]),
                      _vm._v(" "),
                      _c("checkbox-button", { attrs: { value: 5 } }, [
                        _vm._v("周五")
                      ]),
                      _vm._v(" "),
                      _c("checkbox-button", { attrs: { value: 6 } }, [
                        _vm._v("周六")
                      ]),
                      _vm._v(" "),
                      _c("checkbox-button", { attrs: { value: 7 } }, [
                        _vm._v("周日")
                      ])
                    ],
                    1
                  )
                ],
                1
              )
            : _vm._e(),
          _vm._v(" "),
          _vm.publicValue.type === 1
            ? _c(
                "FormItem",
                {
                  attrs: {
                    label: "司机上岗日期",
                    prop: "arrival_date",
                    rules: _vm.currentRules.arrival_date
                  }
                },
                [
                  _c("c-date-picker", {
                    attrs: { type: "date", options: _vm.options },
                    model: {
                      value: _vm.publicValue.arrival_date,
                      callback: function($$v) {
                        _vm.$set(_vm.publicValue, "arrival_date", $$v)
                      },
                      expression: "publicValue.arrival_date"
                    }
                  })
                ],
                1
              )
            : _vm._e(),
          _vm._v(" "),
          _vm.publicValue.type === 2
            ? _c(
                "FormItem",
                { attrs: { label: "配送时间", prop: "temp_date" } },
                [
                  _c("c-date-picker", {
                    attrs: { type: "daterange", options: _vm.options },
                    model: {
                      value: _vm.temp_date,
                      callback: function($$v) {
                        _vm.temp_date = $$v
                      },
                      expression: "temp_date"
                    }
                  }),
                  _vm._v(" "),
                  _c("span", [_vm._v(_vm._s(_vm.days) + "天")]),
                  _vm._v(" "),
                  _c("br"),
                  _vm._v(
                    " 您可发起连续10天以内的临时司机线路任务，用车日期必须连续\n        "
                  )
                ],
                1
              )
            : _vm._e(),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "到仓时间", prop: "arrival_warehouse_time" } },
            [
              _c("TimePicker", {
                attrs: {
                  format: "HH:mm",
                  steps: [1, 5],
                  disabled: !_vm.publicValue.type,
                  readonly: !_vm.publicValue.type,
                  placeholder: "到仓时间",
                  clearable: ""
                },
                model: {
                  value: _vm.publicValue.arrival_warehouse_time,
                  callback: function($$v) {
                    _vm.$set(_vm.publicValue, "arrival_warehouse_time", $$v)
                  },
                  expression: "publicValue.arrival_warehouse_time"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "预计完成时间", prop: "estimate_time" } },
            [
              _c("TimePicker", {
                attrs: {
                  format: "HH:mm",
                  steps: [1, 5],
                  placeholder: "预计完成时间",
                  clearable: ""
                },
                model: {
                  value: _vm.publicValue.estimate_time,
                  callback: function($$v) {
                    _vm.$set(_vm.publicValue, "estimate_time", $$v)
                  },
                  expression: "publicValue.estimate_time"
                }
              }),
              _vm._v(" "),
              _c("span", [_vm._v(_vm._s(_vm.timeDiff))]),
              _c("br"),
              _vm._v(" 如需返仓,该完成时间为司机返回至仓库的时间点\n        ")
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "车型", prop: "car_type_ids" } },
            [
              _c("group-checkbox", {
                attrs: { url: "cartype/select" },
                model: {
                  value: _vm.publicValue.car_type_ids,
                  callback: function($$v) {
                    _vm.$set(_vm.publicValue, "car_type_ids", $$v)
                  },
                  expression: "publicValue.car_type_ids"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "保价服务", prop: "merchant_safe_id" } },
            [
              _c("group-radio", {
                attrs: { url: "safe/select" },
                model: {
                  value: _vm.publicValue.merchant_safe_id,
                  callback: function($$v) {
                    _vm.$set(_vm.publicValue, "merchant_safe_id", $$v)
                  },
                  expression: "publicValue.merchant_safe_id"
                }
              }),
              _vm._v(" "),
              _c("br"),
              _vm._v("选择的保价服务将在司机签到时生效\n        ")
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "货物类型", prop: "goods_remark" } },
            [
              _c("Input", {
                staticStyle: { width: "400px" },
                attrs: {
                  placeholder: "需要配送什么货物，最多20字",
                  clearable: ""
                },
                model: {
                  value: _vm.publicValue.goods_remark,
                  callback: function($$v) {
                    _vm.$set(_vm.publicValue, "goods_remark", $$v)
                  },
                  expression: "publicValue.goods_remark"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "货物体积", prop: "goods_volume" } },
            [
              _c("number-range", {
                attrs: { unit: "立方米" },
                model: {
                  value: _vm.publicValue.goods_volume,
                  callback: function($$v) {
                    _vm.$set(_vm.publicValue, "goods_volume", $$v)
                  },
                  expression: "publicValue.goods_volume"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "货物总重量", prop: "goods_weight" } },
            [
              _c("number-range", {
                attrs: { unit: "吨" },
                model: {
                  value: _vm.publicValue.goods_weight,
                  callback: function($$v) {
                    _vm.$set(_vm.publicValue, "goods_weight", $$v)
                  },
                  expression: "publicValue.goods_weight"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "货物件数", prop: "goods_num" } },
            [
              _c("number-range", {
                attrs: { unit: "个/件/捆/箱" },
                model: {
                  value: _vm.publicValue.goods_num,
                  callback: function($$v) {
                    _vm.$set(_vm.publicValue, "goods_num", $$v)
                  },
                  expression: "publicValue.goods_num"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "需要回单", prop: "back_bill" } },
            [
              _c(
                "RadioGroup",
                {
                  attrs: { type: "button" },
                  model: {
                    value: _vm.publicValue.back_bill,
                    callback: function($$v) {
                      _vm.$set(_vm.publicValue, "back_bill", $$v)
                    },
                    expression: "publicValue.back_bill"
                  }
                },
                [
                  _c("Radio", { attrs: { label: 1, value: 1 } }, [
                    _vm._v("是")
                  ]),
                  _vm._v(" "),
                  _c("Radio", { attrs: { label: 0, value: 0 } }, [_vm._v("否")])
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _vm.publicValue.back_bill === 1
            ? [
                _c(
                  "FormItem",
                  { attrs: { label: "回单方式", prop: "receipt.type" } },
                  [
                    _c(
                      "Select",
                      {
                        staticStyle: { width: "400px" },
                        attrs: { clearable: "" },
                        model: {
                          value: _vm.publicValue.receipt.type,
                          callback: function($$v) {
                            _vm.$set(_vm.publicValue.receipt, "type", $$v)
                          },
                          expression: "publicValue.receipt.type"
                        }
                      },
                      [
                        _c("Option", { attrs: { value: 1 } }, [
                          _vm._v("返仓交回")
                        ]),
                        _vm._v(" "),
                        _c("Option", { attrs: { value: 2 } }, [
                          _vm._v("下次配送交回")
                        ]),
                        _vm._v(" "),
                        _c("Option", { attrs: { value: 3 } }, [_vm._v("快递")]),
                        _vm._v(" "),
                        _c("Option", { attrs: { value: 4 } }, [
                          _vm._v("拍照发送电子版")
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
                  { attrs: { label: "接收人", prop: "receipt.recipient" } },
                  [
                    _c("Input", {
                      staticStyle: { width: "400px" },
                      attrs: { placeholder: "接收人", clearable: "" },
                      model: {
                        value: _vm.publicValue.receipt.recipient,
                        callback: function($$v) {
                          _vm.$set(_vm.publicValue.receipt, "recipient", $$v)
                        },
                        expression: "publicValue.receipt.recipient"
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _vm.publicValue.receipt.type === 1 ||
                _vm.publicValue.receipt.type === 2 ||
                _vm.publicValue.receipt.type === 4
                  ? _c(
                      "FormItem",
                      { attrs: { label: "联系方式", prop: "receipt.phone" } },
                      [
                        _c("Input", {
                          staticStyle: { width: "400px" },
                          attrs: { placeholder: "联系方式", clearable: "" },
                          model: {
                            value: _vm.publicValue.receipt.phone,
                            callback: function($$v) {
                              _vm.$set(_vm.publicValue.receipt, "phone", $$v)
                            },
                            expression: "publicValue.receipt.phone"
                          }
                        })
                      ],
                      1
                    )
                  : _vm._e(),
                _vm._v(" "),
                _vm.publicValue.receipt.type === 3
                  ? _c(
                      "FormItem",
                      { attrs: { label: "收件地址", prop: "receipt.address" } },
                      [
                        _c("Input", {
                          staticStyle: { width: "400px" },
                          attrs: { placeholder: "收件地址", clearable: "" },
                          model: {
                            value: _vm.publicValue.receipt.address,
                            callback: function($$v) {
                              _vm.$set(_vm.publicValue.receipt, "address", $$v)
                            },
                            expression: "publicValue.receipt.address"
                          }
                        })
                      ],
                      1
                    )
                  : _vm._e(),
                _vm._v(" "),
                _vm.publicValue.receipt.type === 3
                  ? _c(
                      "FormItem",
                      { attrs: { label: "快递费", prop: "receipt.express" } },
                      [
                        _c(
                          "RadioGroup",
                          {
                            model: {
                              value: _vm.publicValue.receipt.express,
                              callback: function($$v) {
                                _vm.$set(
                                  _vm.publicValue.receipt,
                                  "express",
                                  $$v
                                )
                              },
                              expression: "publicValue.receipt.express"
                            }
                          },
                          [
                            _c("Radio", { attrs: { label: 1, value: 1 } }, [
                              _vm._v("司机承担")
                            ]),
                            _vm._v(" "),
                            _c("Radio", { attrs: { label: 2, value: 2 } }, [
                              _vm._v("客户承担（发货时选到付）")
                            ])
                          ],
                          1
                        )
                      ],
                      1
                    )
                  : _vm._e()
              ]
            : _vm._e(),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "预期单趟价格", prop: "unit_price" } },
            [
              _c("number-range", {
                attrs: {
                  explanation: "您填写的预期价格,可以指导司机更合理报价"
                },
                model: {
                  value: _vm.publicValue.unit_price,
                  callback: function($$v) {
                    _vm.$set(_vm.publicValue, "unit_price", $$v)
                  },
                  expression: "publicValue.unit_price"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "报价说明", prop: "price_remark" } },
            [
              _c("Input", {
                staticStyle: { width: "400px" },
                attrs: {
                  placeholder: "请输入影响司机报价的说明，最多输入20字",
                  clearable: ""
                },
                model: {
                  value: _vm.publicValue.price_remark,
                  callback: function($$v) {
                    _vm.$set(_vm.publicValue, "price_remark", $$v)
                  },
                  expression: "publicValue.price_remark"
                }
              })
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
                  attrs: { type: "primary" },
                  on: {
                    click: function($event) {
                      _vm.next("previous")
                    }
                  }
                },
                [_vm._v("下一步")]
              )
            ],
            1
          )
        ],
        2
      ),
      _vm._v(" "),
      _c(_vm.component.current, {
        tag: "components",
        attrs: { data: _vm.component.data },
        on: { points: _vm.points, "on-change": _vm.hideComponent }
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-1ba5c76d", module.exports)
  }
}

/***/ }),

/***/ 602:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(603)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(605)
/* template */
var __vue_template__ = __webpack_require__(607)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-4a392471"
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
Component.options.__file = "resources/assets/admin/js/views/task/create/create-next-step.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-4a392471", Component.options)
  } else {
    hotAPI.reload("data-v-4a392471", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 603:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(604);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("34fd99e6", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-4a392471\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./create-next-step.vue", function() {
     var newContent = require("!!../../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-4a392471\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./create-next-step.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 604:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 605:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _moment = __webpack_require__(0);

var _moment2 = _interopRequireDefault(_moment);

var _createNext = __webpack_require__(606);

var _groupBox = __webpack_require__(311);

var _groupBox2 = _interopRequireDefault(_groupBox);

var _index = __webpack_require__(312);

var _index2 = _interopRequireDefault(_index);

var _index3 = __webpack_require__(293);

var _index4 = _interopRequireDefault(_index3);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
    name: 'create-next-step',
    mixins: [],
    components: {
        CDatePicker: _index4.default,
        CheckboxButton: _index2.default,
        CheckboxButtonGroup: _groupBox2.default
    },
    props: {
        value: {
            type: Object,
            required: true
        },
        config: {
            type: Object,
            required: true
        },
        extra: {
            type: Object
        }
    },
    data: function data() {
        return {
            publicValue: this.value,
            publicConfig: this.config,
            readonly: true,
            options: {
                disabledDate: function disabledDate(date) {
                    return date && date.valueOf() < Date.now() - 86400000;
                }
            },
            supply: '',
            welfare: '',
            publicValueRules: (0, _createNext.Validator)(this)
        };
    },
    mounted: function mounted() {
        this.setExtra();
    },

    computed: {
        offer_end_time: {
            get: function get() {
                var now = (0, _moment2.default)().format('YYYY-MM-DD HH:mm');
                var quote = this.publicConfig.earliest_quote_time;
                var choose = this.publicConfig.choose_driver_latest_time;
                if (quote && choose) {
                    var offer_end_time = (0, _moment2.default)(now).subtract(-quote * 60, 'minutes').format('YYYY-MM-DD HH:mm:ss');
                    this.$set(this.publicValue, 'choose_driver_end_time', (0, _moment2.default)(offer_end_time).subtract(-choose * 60, 'minutes').format('YYYY-MM-DD HH:mm'));
                    return this.publicValue.offer_end_time = offer_end_time;
                }
            },
            set: function set(newValue) {
                if (newValue !== '') this.$set(this.publicValue, 'choose_driver_end_time', (0, _moment2.default)(newValue).subtract(-this.publicConfig.choose_driver_latest_time * 60, 'minutes').format('YYYY-MM-DD HH:mm'));
                return this.publicValue.offer_end_time = newValue;
            }
        }
    },
    methods: {
        setExtra: function setExtra() {
            if (this.$route.params.id) {
                this.supply = this.extra.supply || '';
                this.welfare = this.extra.welfare || '';
            }
        },
        ok: function ok(next) {
            var _this = this;

            this.$refs[next].validate(function (valid) {
                if (valid) _this.$emit('on-ok');
            });
        },
        preview: function preview(next) {
            var _this2 = this;

            this.$refs[next].validate(function (valid) {
                if (valid) _this2.$emit('on-preview');
            });
        },
        previous: function previous() {
            this.$emit('on-previous');
        }
    },
    watch: {
        value: {
            handler: function handler(val) {
                this.publicValue = val;
            },

            deep: true
        },
        config: function config(val) {
            this.publicConfig = val;
        },
        supply: function supply(newVal, oldVal) {
            if (oldVal !== '') {
                var old = this.publicValue.supply.pop();
                if (old !== oldVal) this.publicValue.supply.push(old);
            }
            if (newVal !== '') this.publicValue.supply.push(newVal);
        },
        'publicValue.supply': function publicValueSupply(newVal, oldVal) {
            if (this.supply !== '') {
                if (this.publicValue.supply.indexOf(this.supply) === -1) this.publicValue.supply.push(this.supply);
            }
        },
        welfare: function welfare(newVal, oldVal) {
            if (oldVal !== '') {
                var old = this.publicValue.welfare.pop();
                if (old !== oldVal) this.publicValue.welfare.push(old);
            }
            if (newVal !== '') this.publicValue.welfare.push(newVal);
        },
        'publicValue.welfare': function publicValueWelfare(newVal, oldVal) {
            if (this.welfare !== '') {
                if (this.publicValue.welfare.indexOf(this.welfare) === -1) this.publicValue.welfare.push(this.welfare);
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
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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

/***/ 606:
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
        is_delivery: [{
            required: true,
            type: 'number',
            message: '请选择是否要求有配送经验',
            trigger: 'change'
        }],
        dispatching: [{
            required: true,
            type: 'array',
            message: '请选择要求的配送经验',
            trigger: 'blur'
        }],
        offer_end_time: [{
            required: true,
            message: '请选择司机报价截止时间',
            trigger: 'change'
        }, {
            validator: function validator(rule, value, callback) {
                var now = (0, _moment2.default)().format('YYYY-MM-DD HH:mm');
                var earliest_time = data.publicConfig.earliest_quote_time;
                var latest_time = parseFloat((data.publicConfig.earliest_arrival_time - earliest_time).toFixed(10));
                if (earliest_time && latest_time) {
                    if ((0, _moment2.default)(value).diff(now, 'minutes') < earliest_time * 60) {
                        callback(new Error('报价截止时间最早可设定为任务发布后' + earliest_time + '小时'));
                    } else {
                        var arrival = data.publicValue.arrival_date + ' ' + data.publicValue.arrival_warehouse_time;
                        if ((0, _moment2.default)(arrival).diff(value, 'minutes') < latest_time * 60) {
                            callback(new Error('报价截止时间最晚可设定为上岗前' + latest_time + '小时'));
                        } else {
                            callback();
                        }
                    }
                } else {
                    var type = data.publicValue.type === 1 ? '主' : data.publicValue.type === 2 ? '临时' : '';
                    callback(new Error('未获取到' + type + '司机（任务）时间的配置信息'));
                }
            },
            trigger: 'change'
        }],
        choose_driver_end_time: [{
            validator: function validator(rule, value, callback) {
                var end = data.publicValue.offer_end_time;
                if (end === '') {
                    callback(new Error('请先选择司机报价截止时间'));
                } else {
                    var time = data.publicConfig.choose_driver_latest_time;
                    if (time) {
                        if ((0, _moment2.default)(value).diff(end, 'minutes') !== time * 60) {
                            callback(new Error('为司机报价截止时间后' + time + '小时'));
                        } else {
                            callback();
                        }
                    } else {
                        var type = data.publicValue.type === 1 ? '主' : data.publicValue.type === 2 ? '临时' : '';
                        callback(new Error('未获取到' + type + '司机（任务）时间的配置信息'));
                    }
                }
            },
            trigger: 'change'
        }],
        carry_type: [{
            required: true,
            type: 'number',
            message: '请选择搬运说明',
            trigger: 'change'
        }],
        'carry.textarea': [{
            required: true,
            type: 'string',
            max: 300,
            message: '请详细描述司机搬运说明，最多输入300字',
            trigger: 'blur'
        }],
        'carry.is_worker': [{
            required: true,
            type: 'number',
            message: '请选择是否自带小工',
            trigger: 'change'
        }],
        'carry.is_loading': [{
            required: true,
            type: 'number',
            message: '请选择是否帮忙装货',
            trigger: 'change'
        }],
        'carry.is_unloading': [{
            required: true,
            type: 'number',
            message: '请选择是否帮忙卸货',
            trigger: 'change'
        }],
        'other.is_remove_seat': [{
            required: true,
            type: 'number',
            message: '请选择是否需要拆后座',
            trigger: 'change'
        }],
        'other.is_trolley': [{
            required: true,
            type: 'number',
            message: '请选择是否需要小推车',
            trigger: 'change'
        }],
        'other.is_tail_plate': [{
            required: true,
            type: 'number',
            message: '请选择是否需要带尾板',
            trigger: 'change'
        }],
        'other.is_extinguisher': [{
            required: true,
            type: 'number',
            message: '请选择是否需要配备双灭火器',
            trigger: 'change'
        }],
        'other.is_lock': [{
            required: true,
            type: 'number',
            message: '请选择是否需要配备明锁/暗锁',
            trigger: 'change'
        }],
        'other.other_require': [{
            type: 'string',
            max: 300,
            message: '最多输入300字',
            trigger: 'blur'
        }],
        supply_other: [{
            validator: function validator(rule, value, callback) {
                if (data.supply.length > 300) {
                    callback(new Error('最多输入300字'));
                } else {
                    callback();
                }
            },
            trigger: 'blur'
        }],
        welfare_other: [{
            validator: function validator(rule, value, callback) {
                if (data.supply.length > 300) {
                    callback(new Error('最多输入300字'));
                } else {
                    callback();
                }
            },
            trigger: 'blur'
        }]
    };
};

/***/ }),

/***/ 607:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c(
        "Form",
        {
          ref: "next",
          attrs: {
            model: _vm.publicValue,
            "label-width": 150,
            rules: _vm.publicValueRules
          }
        },
        [
          _c(
            "FormItem",
            { attrs: { label: "配送经验要求", prop: "is_delivery" } },
            [
              _c(
                "RadioGroup",
                {
                  attrs: { type: "button" },
                  model: {
                    value: _vm.publicValue.is_delivery,
                    callback: function($$v) {
                      _vm.$set(_vm.publicValue, "is_delivery", $$v)
                    },
                    expression: "publicValue.is_delivery"
                  }
                },
                [
                  _c("Radio", { attrs: { label: 1, value: 1 } }, [
                    _vm._v("有要求")
                  ]),
                  _vm._v(" "),
                  _c("Radio", { attrs: { label: 0, value: 0 } }, [
                    _vm._v("无要求")
                  ])
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _vm.publicValue.is_delivery === 1
            ? _c(
                "FormItem",
                { attrs: { prop: "dispatching" } },
                [
                  _c(
                    "checkbox-button-group",
                    {
                      model: {
                        value: _vm.publicValue.dispatching,
                        callback: function($$v) {
                          _vm.$set(_vm.publicValue, "dispatching", $$v)
                        },
                        expression: "publicValue.dispatching"
                      }
                    },
                    [
                      _c(
                        "checkbox-button",
                        { attrs: { value: "生鲜农产品" } },
                        [_vm._v("生鲜农产品")]
                      ),
                      _vm._v(" "),
                      _c("checkbox-button", { attrs: { value: "食品行业" } }, [
                        _vm._v("食品行业")
                      ]),
                      _vm._v(" "),
                      _c("checkbox-button", { attrs: { value: "快消品" } }, [
                        _vm._v("快消品")
                      ]),
                      _vm._v(" "),
                      _c("checkbox-button", { attrs: { value: "电子产品" } }, [
                        _vm._v("电子产品")
                      ]),
                      _vm._v(" "),
                      _c("checkbox-button", { attrs: { value: "图书" } }, [
                        _vm._v("图书")
                      ]),
                      _vm._v(" "),
                      _c("checkbox-button", { attrs: { value: "服装" } }, [
                        _vm._v("服装")
                      ]),
                      _vm._v(" "),
                      _c("checkbox-button", { attrs: { value: "建材" } }, [
                        _vm._v("建材")
                      ]),
                      _vm._v(" "),
                      _c("checkbox-button", { attrs: { value: "家居" } }, [
                        _vm._v("家居")
                      ]),
                      _vm._v(" "),
                      _c("checkbox-button", { attrs: { value: "汽车配件" } }, [
                        _vm._v("汽车配件")
                      ]),
                      _vm._v(" "),
                      _c("checkbox-button", { attrs: { value: "医院" } }, [
                        _vm._v("医院")
                      ]),
                      _vm._v(" "),
                      _c("checkbox-button", { attrs: { value: "物流行业" } }, [
                        _vm._v("物流行业")
                      ])
                    ],
                    1
                  )
                ],
                1
              )
            : _vm._e(),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "司机报价截止时间", prop: "offer_end_time" } },
            [
              _c("c-date-picker", {
                attrs: {
                  type: "datetime",
                  format: "yyyy-MM-dd HH:mm",
                  options: _vm.options
                },
                model: {
                  value: _vm.offer_end_time,
                  callback: function($$v) {
                    _vm.offer_end_time = $$v
                  },
                  expression: "offer_end_time"
                }
              }),
              _vm._v(" "),
              _c("br"),
              _vm._v(
                "报价截止时间最早可设定为任务发布后" +
                  _vm._s(_vm.publicConfig.earliest_quote_time) +
                  "小时,最晚可设定为上岗前" +
                  _vm._s(
                    parseFloat(
                      (
                        _vm.publicConfig.earliest_arrival_time -
                        _vm.publicConfig.earliest_quote_time
                      ).toFixed(10)
                    )
                  ) +
                  "小时 司机上岗时间已设置： " +
                  _vm._s(_vm.publicValue.arrival_date) +
                  " " +
                  _vm._s(_vm.publicValue.arrival_warehouse_time) +
                  "\n        "
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            {
              attrs: { label: "选司机截止时间", prop: "choose_driver_end_time" }
            },
            [
              _c("c-date-picker", {
                attrs: {
                  type: "datetime",
                  format: "yyyy-MM-dd HH:mm",
                  readonly: "readonly",
                  options: _vm.options
                },
                model: {
                  value: _vm.publicValue.choose_driver_end_time,
                  callback: function($$v) {
                    _vm.$set(_vm.publicValue, "choose_driver_end_time", $$v)
                  },
                  expression: "publicValue.choose_driver_end_time"
                }
              }),
              _vm._v(" "),
              _c("br"),
              _vm._v(
                "选司机截止时间为司机报价截止时间后" +
                  _vm._s(_vm.publicConfig.choose_driver_latest_time) +
                  "小时\n        "
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "搬运说明", prop: "carry_type" } },
            [
              _c(
                "RadioGroup",
                {
                  attrs: { type: "button" },
                  model: {
                    value: _vm.publicValue.carry_type,
                    callback: function($$v) {
                      _vm.$set(_vm.publicValue, "carry_type", $$v)
                    },
                    expression: "publicValue.carry_type"
                  }
                },
                [
                  _c("Radio", { attrs: { label: 0, value: 0 } }, [
                    _vm._v("无需搬运")
                  ]),
                  _vm._v(" "),
                  _c("Radio", { attrs: { label: 1, value: 1 } }, [
                    _vm._v("轻度搬运")
                  ]),
                  _vm._v(" "),
                  _c("Radio", { attrs: { label: 2, value: 2 } }, [
                    _vm._v("中度搬运")
                  ]),
                  _vm._v(" "),
                  _c("Radio", { attrs: { label: 3, value: 3 } }, [
                    _vm._v("重度搬运")
                  ])
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _vm.publicValue.carry_type === 1 ||
          _vm.publicValue.carry_type === 2 ||
          _vm.publicValue.carry_type === 3
            ? [
                _c(
                  "FormItem",
                  {
                    staticStyle: { width: "80%" },
                    attrs: { prop: "carry.textarea" }
                  },
                  [
                    _c("Input", {
                      attrs: {
                        type: "textarea",
                        placeholder:
                          "请详细描述司机搬运说明，例如：货物重量，形状，搬运距离、是否有电梯、是否有人协助....必填，最多300字。"
                      },
                      model: {
                        value: _vm.publicValue.carry.textarea,
                        callback: function($$v) {
                          _vm.$set(_vm.publicValue.carry, "textarea", $$v)
                        },
                        expression: "publicValue.carry.textarea"
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "FormItem",
                  { attrs: { label: "是否自带小工", prop: "carry.is_worker" } },
                  [
                    _c(
                      "RadioGroup",
                      {
                        attrs: { type: "button" },
                        model: {
                          value: _vm.publicValue.carry.is_worker,
                          callback: function($$v) {
                            _vm.$set(_vm.publicValue.carry, "is_worker", $$v)
                          },
                          expression: "publicValue.carry.is_worker"
                        }
                      },
                      [
                        _c("Radio", { attrs: { label: 1, value: 1 } }, [
                          _vm._v("是")
                        ]),
                        _vm._v(" "),
                        _c("Radio", { attrs: { label: 0, value: 0 } }, [
                          _vm._v("否")
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
                  {
                    attrs: { label: "是否帮忙装货", prop: "carry.is_loading" }
                  },
                  [
                    _c(
                      "RadioGroup",
                      {
                        attrs: { type: "button" },
                        model: {
                          value: _vm.publicValue.carry.is_loading,
                          callback: function($$v) {
                            _vm.$set(_vm.publicValue.carry, "is_loading", $$v)
                          },
                          expression: "publicValue.carry.is_loading"
                        }
                      },
                      [
                        _c("Radio", { attrs: { label: 1, value: 1 } }, [
                          _vm._v("是")
                        ]),
                        _vm._v(" "),
                        _c("Radio", { attrs: { label: 0, value: 0 } }, [
                          _vm._v("否")
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
                  {
                    attrs: { label: "是否帮忙卸货", prop: "carry.is_unloading" }
                  },
                  [
                    _c(
                      "RadioGroup",
                      {
                        attrs: { type: "button" },
                        model: {
                          value: _vm.publicValue.carry.is_unloading,
                          callback: function($$v) {
                            _vm.$set(_vm.publicValue.carry, "is_unloading", $$v)
                          },
                          expression: "publicValue.carry.is_unloading"
                        }
                      },
                      [
                        _c("Radio", { attrs: { label: 1, value: 1 } }, [
                          _vm._v("是")
                        ]),
                        _vm._v(" "),
                        _c("Radio", { attrs: { label: 0, value: 0 } }, [
                          _vm._v("否")
                        ])
                      ],
                      1
                    )
                  ],
                  1
                )
              ]
            : _vm._e(),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "需要拆后座", prop: "other.is_remove_seat" } },
            [
              _c(
                "RadioGroup",
                {
                  attrs: { type: "button" },
                  model: {
                    value: _vm.publicValue.other.is_remove_seat,
                    callback: function($$v) {
                      _vm.$set(_vm.publicValue.other, "is_remove_seat", $$v)
                    },
                    expression: "publicValue.other.is_remove_seat"
                  }
                },
                [
                  _c("Radio", { attrs: { label: 1, value: 1 } }, [
                    _vm._v("是")
                  ]),
                  _vm._v(" "),
                  _c("Radio", { attrs: { label: 0, value: 0 } }, [_vm._v("否")])
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "需要小推车", prop: "other.is_trolley" } },
            [
              _c(
                "RadioGroup",
                {
                  attrs: { type: "button" },
                  model: {
                    value: _vm.publicValue.other.is_trolley,
                    callback: function($$v) {
                      _vm.$set(_vm.publicValue.other, "is_trolley", $$v)
                    },
                    expression: "publicValue.other.is_trolley"
                  }
                },
                [
                  _c("Radio", { attrs: { label: 1, value: 1 } }, [
                    _vm._v("是")
                  ]),
                  _vm._v(" "),
                  _c("Radio", { attrs: { label: 0, value: 0 } }, [_vm._v("否")])
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "需要带尾板", prop: "other.is_tail_plate" } },
            [
              _c(
                "RadioGroup",
                {
                  attrs: { type: "button" },
                  model: {
                    value: _vm.publicValue.other.is_tail_plate,
                    callback: function($$v) {
                      _vm.$set(_vm.publicValue.other, "is_tail_plate", $$v)
                    },
                    expression: "publicValue.other.is_tail_plate"
                  }
                },
                [
                  _c("Radio", { attrs: { label: 1, value: 1 } }, [
                    _vm._v("是")
                  ]),
                  _vm._v(" "),
                  _c("Radio", { attrs: { label: 0, value: 0 } }, [_vm._v("否")])
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
                label: "需要配备双灭火器",
                prop: "other.is_extinguisher"
              }
            },
            [
              _c(
                "RadioGroup",
                {
                  attrs: { type: "button" },
                  model: {
                    value: _vm.publicValue.other.is_extinguisher,
                    callback: function($$v) {
                      _vm.$set(_vm.publicValue.other, "is_extinguisher", $$v)
                    },
                    expression: "publicValue.other.is_extinguisher"
                  }
                },
                [
                  _c("Radio", { attrs: { label: 1, value: 1 } }, [
                    _vm._v("是")
                  ]),
                  _vm._v(" "),
                  _c("Radio", { attrs: { label: 0, value: 0 } }, [_vm._v("否")])
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "需要配备明锁/暗锁", prop: "other.is_lock" } },
            [
              _c(
                "RadioGroup",
                {
                  attrs: { type: "button" },
                  model: {
                    value: _vm.publicValue.other.is_lock,
                    callback: function($$v) {
                      _vm.$set(_vm.publicValue.other, "is_lock", $$v)
                    },
                    expression: "publicValue.other.is_lock"
                  }
                },
                [
                  _c("Radio", { attrs: { label: 1, value: 1 } }, [
                    _vm._v("是")
                  ]),
                  _vm._v(" "),
                  _c("Radio", { attrs: { label: 0, value: 0 } }, [_vm._v("否")])
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
              staticStyle: { width: "80%" },
              attrs: { label: "其他上岗要求", prop: "other.other_require" }
            },
            [
              _c("Input", {
                attrs: {
                  type: "textarea",
                  placeholder:
                    "如果对司机上岗还有其他要求，请在这里填写，方便司机报价，最多300字。"
                },
                model: {
                  value: _vm.publicValue.other.other_require,
                  callback: function($$v) {
                    _vm.$set(_vm.publicValue.other, "other_require", $$v)
                  },
                  expression: "publicValue.other.other_require"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "任务补充说明" } },
            [
              _c(
                "checkbox-button-group",
                {
                  model: {
                    value: _vm.publicValue.supply,
                    callback: function($$v) {
                      _vm.$set(_vm.publicValue, "supply", $$v)
                    },
                    expression: "publicValue.supply"
                  }
                },
                [
                  _c(
                    "checkbox-button",
                    { attrs: { value: "需要出仓清点货物" } },
                    [_vm._v("需要出仓清点货物")]
                  ),
                  _vm._v(" "),
                  _c(
                    "checkbox-button",
                    { attrs: { value: "需要交接时清点货物" } },
                    [_vm._v("需要交接时清点货物")]
                  ),
                  _vm._v(" "),
                  _c(
                    "checkbox-button",
                    { attrs: { value: "需要参与仓内分拣" } },
                    [_vm._v("需要参与仓内分拣")]
                  ),
                  _vm._v(" "),
                  _c("checkbox-button", { attrs: { value: "需要司机分餐" } }, [
                    _vm._v("需要司机分餐")
                  ]),
                  _vm._v(" "),
                  _c(
                    "checkbox-button",
                    { attrs: { value: "需要参加上岗培训" } },
                    [_vm._v("需要参加上岗培训")]
                  ),
                  _vm._v(" "),
                  _c("checkbox-button", { attrs: { value: "需要代收现金" } }, [
                    _vm._v("需要代收现金")
                  ]),
                  _vm._v(" "),
                  _c(
                    "checkbox-button",
                    { attrs: { value: "需要穿您公司制服" } },
                    [_vm._v("需要穿您公司制服")]
                  ),
                  _vm._v(" "),
                  _c(
                    "checkbox-button",
                    { attrs: { value: "需要使用pos机代收款" } },
                    [_vm._v("需要使用pos机代收款")]
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
            { staticStyle: { width: "80%" }, attrs: { prop: "supply_other" } },
            [
              _c("Input", {
                attrs: {
                  type: "textarea",
                  placeholder:
                    "如果对司机上岗还有其他要求，请在这里填写，方便司机报价，最多300字。"
                },
                model: {
                  value: _vm.supply,
                  callback: function($$v) {
                    _vm.supply = $$v
                  },
                  expression: "supply"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "司机福利补贴奖励" } },
            [
              _c(
                "checkbox-button-group",
                {
                  model: {
                    value: _vm.publicValue.welfare,
                    callback: function($$v) {
                      _vm.$set(_vm.publicValue, "welfare", $$v)
                    },
                    expression: "publicValue.welfare"
                  }
                },
                [
                  _c("checkbox-button", { attrs: { value: "按件奖励" } }, [
                    _vm._v("按件奖励")
                  ]),
                  _vm._v(" "),
                  _c(
                    "checkbox-button",
                    { attrs: { value: "有按配送点奖励" } },
                    [_vm._v("有按配送点奖励")]
                  ),
                  _vm._v(" "),
                  _c(
                    "checkbox-button",
                    { attrs: { value: "帮忙拓展业务奖励" } },
                    [_vm._v("帮忙拓展业务奖励")]
                  ),
                  _vm._v(" "),
                  _c("checkbox-button", { attrs: { value: "报销停车费" } }, [
                    _vm._v("报销停车费")
                  ]),
                  _vm._v(" "),
                  _c("checkbox-button", { attrs: { value: "报销过路费" } }, [
                    _vm._v("报销过路费")
                  ]),
                  _vm._v(" "),
                  _c("checkbox-button", { attrs: { value: "报销油费" } }, [
                    _vm._v("报销油费")
                  ]),
                  _vm._v(" "),
                  _c("checkbox-button", { attrs: { value: "有加班费" } }, [
                    _vm._v("有加班费")
                  ]),
                  _vm._v(" "),
                  _c("checkbox-button", { attrs: { value: "提供饭补" } }, [
                    _vm._v("提供饭补")
                  ]),
                  _vm._v(" "),
                  _c("checkbox-button", { attrs: { value: "有假期" } }, [
                    _vm._v("有假期")
                  ]),
                  _vm._v(" "),
                  _c("checkbox-button", { attrs: { value: "提供住宿" } }, [
                    _vm._v("提供住宿")
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
            { staticStyle: { width: "80%" }, attrs: { prop: "welfare_other" } },
            [
              _c("Input", {
                attrs: {
                  type: "textarea",
                  placeholder: "如果还有其他说明信息，请在这里填写，最多300字。"
                },
                model: {
                  value: _vm.welfare,
                  callback: function($$v) {
                    _vm.welfare = $$v
                  },
                  expression: "welfare"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "是否显示", prop: "other.is_show" } },
            [
              _c(
                "RadioGroup",
                {
                  attrs: { type: "button" },
                  model: {
                    value: _vm.publicValue.is_show,
                    callback: function($$v) {
                      _vm.$set(_vm.publicValue, "is_show", $$v)
                    },
                    expression: "publicValue.is_show"
                  }
                },
                [
                  _c("Radio", { attrs: { label: 1, value: 1 } }, [
                    _vm._v("是")
                  ]),
                  _vm._v(" "),
                  _c("Radio", { attrs: { label: 0, value: 0 } }, [_vm._v("否")])
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
                  attrs: { type: "primary" },
                  on: {
                    click: function($event) {
                      _vm.ok("next")
                    }
                  }
                },
                [_vm._v("立即发布")]
              ),
              _vm._v(" "),
              _c(
                "Button",
                {
                  attrs: { type: "primary" },
                  on: {
                    click: function($event) {
                      _vm.preview("next")
                    }
                  }
                },
                [_vm._v("预览")]
              ),
              _vm._v(" "),
              _c("Button", { on: { click: _vm.previous } }, [_vm._v("上一步")])
            ],
            1
          )
        ],
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-4a392471", module.exports)
  }
}

/***/ }),

/***/ 608:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(609)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(611)
/* template */
var __vue_template__ = __webpack_require__(612)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-fc266ada"
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
Component.options.__file = "resources/assets/admin/js/views/task/create/create-preview.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-fc266ada", Component.options)
  } else {
    hotAPI.reload("data-v-fc266ada", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 609:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(610);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("6cbd0bc0", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-fc266ada\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./create-preview.vue", function() {
     var newContent = require("!!../../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-fc266ada\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./create-preview.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 610:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 611:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _myTable = __webpack_require__(271);

var _myTable2 = _interopRequireDefault(_myTable);

var _component = __webpack_require__(263);

var _component2 = _interopRequireDefault(_component);

var _index = __webpack_require__(268);

var _index2 = _interopRequireDefault(_index);

var _index3 = __webpack_require__(294);

var _index4 = _interopRequireDefault(_index3);

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

exports.default = {
    name: 'create-preview',
    mixins: [_component2.default],
    components: {
        Detail: _index4.default,
        Box: _index2.default,
        MyTable: _myTable2.default
    },
    props: {
        value: {
            type: Object,
            required: true
        }
    },
    data: function data() {
        return {
            publicValue: this.value,
            merchant_name: '',
            warehouse_name: '',
            safe_name: '未选择',
            car_type_name: '',
            columns: [{
                title: '地址',
                key: 'name'
            }, {
                title: '联系人',
                key: 'contacts'
            }, {
                title: '联系方式',
                key: 'contact_way'
            }]
        };
    },

    computed: {},
    mounted: function mounted() {
        this.warehouse();
        this.safe();
        this.carTypeName();
    },

    methods: {
        warehouse: function warehouse() {
            var _this = this;

            var warehouse_id = this.publicValue.warehouse_id;
            if (warehouse_id) {
                this.$http.get('warehouse/' + warehouse_id).then(function (res) {
                    _this.merchant_name = res.data.data.merchant.short_name;
                    _this.warehouse_name = res.data.data.title;
                });
            }
        },
        safe: function safe() {
            var _this2 = this;

            var merchant_safe_id = this.publicValue.merchant_safe_id;
            if (merchant_safe_id) {
                this.$http.get('safe/' + merchant_safe_id).then(function (res) {
                    _this2.safe_name = res.data.data.title;
                });
            }
        },
        carTypeName: function carTypeName() {
            var _this3 = this;

            var ids = this.publicValue.car_type_ids;
            if (ids && ids instanceof Array) {
                this.$http.get('cartype/select').then(function (res) {
                    var allCars = [];
                    res.data.data.forEach(function (item, index) {
                        allCars[item.id] = item.name;
                    });
                    var myCars = [];
                    ids.forEach(function (item, index) {
                        myCars.push(allCars[item]);
                    });
                    _this3.car_type_name = myCars.join('，');
                });
            }
        },
        ok: function ok() {
            this.$emit('on-ok');
        },
        cancelPrevious: function cancelPrevious() {
            this.$emit('on-cancel-preview');
        }
    },
    filters: {
        arrToWeek: function arrToWeek(arr) {
            if (arr && arr instanceof Array) {
                var num = ['一', '二', '三', '四', '五', '六', '日'];
                var week = [];
                arr.forEach(function (item, index) {
                    week.push('周' + num[item - 1]);
                });
                return week.join('，');
            } else {
                return '';
            }
        },
        arrToString: function arrToString(arr) {
            if (arr !== undefined && arr instanceof Array) return arr.join('，');else return '';
        },
        formatJson: function formatJson(json) {
            if (!json) return '';else return json.min + ' - ' + json.max;
        }
    },
    watch: {
        value: {
            handler: function handler(val) {
                this.publicValue = val;
            },

            deep: true
        }
    }
};

/***/ }),

/***/ 612:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "Form",
    { attrs: { "label-width": 150 } },
    [
      _c(
        "Card",
        [
          _c(
            "Row",
            [
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "司机类型：" } }, [
                    _vm.publicValue.type === 1
                      ? _c("span", [_vm._v("主司机")])
                      : _vm.publicValue.type === 2
                        ? _c("span", [_vm._v("临时司机")])
                        : _vm._e()
                  ])
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "商户名称：" } }, [
                    _vm._v(_vm._s(_vm.merchant_name))
                  ])
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "仓名称：" } }, [
                    _vm._v(_vm._s(_vm.warehouse_name))
                  ])
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "Row",
            [
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "线路名称：" } }, [
                    _vm._v(_vm._s(_vm.publicValue.name))
                  ])
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "是否需要返仓：" } }, [
                    _vm._v(_vm._s(_vm.publicValue.is_back === 0 ? "否" : "是"))
                  ])
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "配送总里程：" } }, [
                    _vm._v(
                      _vm._s(
                        _vm._f("formatJson")(_vm.publicValue.distance_json)
                      ) + " 公里"
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
            "Row",
            [
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "配送点固定：" } }, [
                    _vm._v(
                      _vm._s(_vm.publicValue.is_fixed_point === 0 ? "否" : "是")
                    )
                  ])
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _vm.publicValue.is_fixed_point === 0
                    ? _c("FormItem", { attrs: { label: "配送点数量：" } }, [
                        _vm._v(
                          "\n                " +
                            _vm._s(
                              _vm._f("formatJson")(_vm.publicValue.unfixed_json)
                            ) +
                            " 个\n            "
                        )
                      ])
                    : _vm._e()
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c(
                    "FormItem",
                    {
                      attrs: {
                        label:
                          _vm.publicValue.is_fixed_point === 0
                            ? "配送区域描述："
                            : "配送点备注："
                      }
                    },
                    [
                      _vm._v(
                        "\n                " +
                          _vm._s(_vm.publicValue.delivery_point_remark) +
                          "\n            "
                      )
                    ]
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _vm.publicValue.is_fixed_point === 1
            ? _c(
                "FormItem",
                {
                  staticStyle: { width: "85%" },
                  attrs: { label: "配送点信息：" }
                },
                [
                  _c("my-table", {
                    ref: "table",
                    attrs: {
                      columns: _vm.columns,
                      data: _vm.publicValue.delivery_point,
                      size: "small",
                      loading: _vm.loading
                    }
                  })
                ],
                1
              )
            : _vm._e()
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "Card",
        [
          _c(
            "Row",
            [
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "配送时间：" } }, [
                    _vm.publicValue.type === 1
                      ? _c("span", [
                          _vm._v(
                            _vm._s(
                              _vm._f("arrToWeek")(_vm.publicValue.send_time)
                            )
                          )
                        ])
                      : _vm.publicValue.type === 2
                        ? _c("span", [
                            _vm._v(
                              _vm._s(
                                _vm.publicValue.temp_start_date +
                                  " - " +
                                  _vm.publicValue.temp_end_date
                              )
                            )
                          ])
                        : _vm._e()
                  ])
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _vm.publicValue.type === 1
                    ? _c("FormItem", { attrs: { label: "司机上岗日期：" } }, [
                        _vm._v(_vm._s(_vm.publicValue.arrival_date))
                      ])
                    : _vm._e()
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "到仓时间：" } }, [
                    _vm._v(_vm._s(_vm.publicValue.arrival_warehouse_time))
                  ])
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "Row",
            [
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "预计完成时间：" } }, [
                    _vm._v(_vm._s(_vm.publicValue.estimate_time))
                  ])
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "Col",
                { attrs: { span: "16" } },
                [
                  _c("FormItem", { attrs: { label: "车型：" } }, [
                    _vm._v(_vm._s(_vm.car_type_name))
                  ])
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
            "Row",
            [
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "保价服务：" } }, [
                    _vm._v(_vm._s(_vm.safe_name))
                  ])
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "货物类型：" } }, [
                    _vm._v(_vm._s(_vm.publicValue.goods_remark))
                  ])
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "货物体积：" } }, [
                    _vm._v(
                      _vm._s(
                        _vm._f("formatJson")(_vm.publicValue.goods_volume)
                      ) + " 立方米"
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
            "Row",
            [
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "货物总重量：" } }, [
                    _vm._v(
                      _vm._s(
                        _vm._f("formatJson")(_vm.publicValue.goods_weight)
                      ) + " 吨"
                    )
                  ])
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "货物件数：" } }, [
                    _vm.publicValue.goods_num.min &&
                    _vm.publicValue.goods_num.max
                      ? _c("span", [
                          _vm._v(
                            "\n                " +
                              _vm._s(
                                _vm._f("formatJson")(_vm.publicValue.goods_num)
                              ) +
                              " 个/件/捆/箱\n            "
                          )
                        ])
                      : _c("span", [_vm._v("无")])
                  ])
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "预期单趟价格：" } }, [
                    _vm.publicValue.unit_price.min &&
                    _vm.publicValue.unit_price.max
                      ? _c("span", [
                          _vm._v(
                            "\n                " +
                              _vm._s(
                                _vm._f("formatJson")(_vm.publicValue.unit_price)
                              ) +
                              "\n            "
                          )
                        ])
                      : _c("span", [_vm._v("无")])
                  ])
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "Row",
            [
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "报价说明：" } }, [
                    _vm._v(_vm._s(_vm.publicValue.price_remark || "无"))
                  ])
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "是否需要回单：" } }, [
                    _vm._v(
                      _vm._s(
                        _vm.publicValue.other.back_bill === 0 ? "否" : "是"
                      )
                    )
                  ])
                ],
                1
              ),
              _vm._v(" "),
              _vm.publicValue.back_bill === 1
                ? _c(
                    "Col",
                    { attrs: { span: "8" } },
                    [
                      _c("FormItem", { attrs: { label: "回单方式：" } }, [
                        _vm.publicValue.receipt.type === 1
                          ? _c("span", [_vm._v("返仓交回")])
                          : _vm.publicValue.receipt.type === 2
                            ? _c("span", [_vm._v("下次配送交回")])
                            : _vm.publicValue.receipt.type === 3
                              ? _c("span", [_vm._v("快递")])
                              : _vm.publicValue.receipt.type === 4
                                ? _c("span", [_vm._v("拍照发送电子版")])
                                : _vm._e()
                      ])
                    ],
                    1
                  )
                : _vm._e()
            ],
            1
          ),
          _vm._v(" "),
          _vm.publicValue.back_bill === 1
            ? _c(
                "Row",
                [
                  _c(
                    "Col",
                    { attrs: { span: "8" } },
                    [
                      _c("FormItem", { attrs: { label: "接收人：" } }, [
                        _vm._v(_vm._s(_vm.publicValue.receipt.recipient))
                      ])
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _vm.publicValue.receipt.type === 3
                    ? _c(
                        "div",
                        [
                          _c(
                            "Col",
                            { attrs: { span: "8" } },
                            [
                              _c(
                                "FormItem",
                                { attrs: { label: "收件地址：" } },
                                [
                                  _vm._v(
                                    _vm._s(_vm.publicValue.receipt.address)
                                  )
                                ]
                              )
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c(
                            "Col",
                            { attrs: { span: "8" } },
                            [
                              _c("FormItem", { attrs: { label: "快递费：" } }, [
                                _vm.publicValue.receipt.express === 1
                                  ? _c("span", [_vm._v("司机承担")])
                                  : _vm.publicValue.receipt.express === 2
                                    ? _c("span", [
                                        _vm._v("客户承担（发货时选到付）")
                                      ])
                                    : _vm._e()
                              ])
                            ],
                            1
                          )
                        ],
                        1
                      )
                    : _c(
                        "div",
                        [
                          _c(
                            "Col",
                            { attrs: { span: "8" } },
                            [
                              _c(
                                "FormItem",
                                { attrs: { label: "联系方式：" } },
                                [_vm._v(_vm._s(_vm.publicValue.receipt.phone))]
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
            : _vm._e()
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "Card",
        [
          _c(
            "Row",
            [
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "配送经验要求：" } }, [
                    _vm.publicValue.is_delivery === 0
                      ? _c("div", [_vm._v("无要求")])
                      : _c("div", [
                          _vm._v(
                            _vm._s(
                              _vm._f("arrToString")(_vm.publicValue.dispatching)
                            )
                          )
                        ])
                  ])
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "司机报价截止时间：" } }, [
                    _vm._v(_vm._s(_vm.publicValue.offer_end_time))
                  ])
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "选司机截止时间：" } }, [
                    _vm._v(_vm._s(_vm.publicValue.choose_driver_end_time))
                  ])
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
          _vm.publicValue.carry_type !== 0
            ? _c(
                "div",
                [
                  _c(
                    "Row",
                    [
                      _c(
                        "Col",
                        { attrs: { span: "8" } },
                        [
                          _c("FormItem", { attrs: { label: "搬运说明：" } }, [
                            _vm.publicValue.carry_type === 0
                              ? _c("p", [_vm._v("无需搬运")])
                              : _vm.publicValue.carry_type === 1
                                ? _c("p", [_vm._v("轻度搬运")])
                                : _vm.publicValue.carry_type === 2
                                  ? _c("p", [_vm._v("中度搬运")])
                                  : _vm.publicValue.carry_type === 3
                                    ? _c("p", [_vm._v("重度搬运")])
                                    : _vm._e(),
                            _vm._v(" "),
                            _vm.publicValue.carry_type !== 0 &&
                            _vm.publicValue.carry.textarea
                              ? _c("p", [
                                  _vm._v(
                                    "\n                        其他：" +
                                      _vm._s(
                                        _vm.publicValue.carry.textarea || "无"
                                      ) +
                                      "\n                    "
                                  )
                                ])
                              : _vm._e()
                          ])
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "Col",
                        { attrs: { span: "8" } },
                        [
                          _c(
                            "FormItem",
                            { attrs: { label: "是否自带小工：" } },
                            [
                              _vm._v(
                                _vm._s(
                                  _vm.publicValue.carry.is_worker === 0
                                    ? "否"
                                    : "是"
                                )
                              )
                            ]
                          )
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "Col",
                        { attrs: { span: "8" } },
                        [
                          _c(
                            "FormItem",
                            { attrs: { label: "是否帮忙装货：" } },
                            [
                              _vm._v(
                                _vm._s(
                                  _vm.publicValue.carry.is_loading === 0
                                    ? "否"
                                    : "是"
                                )
                              )
                            ]
                          )
                        ],
                        1
                      )
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "Row",
                    [
                      _c(
                        "Col",
                        { attrs: { span: "8" } },
                        [
                          _c(
                            "FormItem",
                            { attrs: { label: "是否帮忙卸货：" } },
                            [
                              _vm._v(
                                _vm._s(
                                  _vm.publicValue.carry.is_unloading === 0
                                    ? "否"
                                    : "是"
                                )
                              )
                            ]
                          )
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "Col",
                        { attrs: { span: "8" } },
                        [
                          _c("FormItem", { attrs: { label: "需要拆后座：" } }, [
                            _vm._v(
                              _vm._s(
                                _vm.publicValue.other.is_remove_seat === 0
                                  ? "否"
                                  : "是"
                              )
                            )
                          ])
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "Col",
                        { attrs: { span: "8" } },
                        [
                          _c("FormItem", { attrs: { label: "需要小推车：" } }, [
                            _vm._v(
                              _vm._s(
                                _vm.publicValue.other.is_trolley === 0
                                  ? "否"
                                  : "是"
                              )
                            )
                          ])
                        ],
                        1
                      )
                    ],
                    1
                  )
                ],
                1
              )
            : _c(
                "Row",
                [
                  _c(
                    "Col",
                    { attrs: { span: "8" } },
                    [
                      _c("FormItem", { attrs: { label: "搬运说明：" } }, [
                        _vm.publicValue.carry_type === 0
                          ? _c("p", [_vm._v("无需搬运")])
                          : _vm.publicValue.carry_type === 1
                            ? _c("p", [_vm._v("轻度搬运")])
                            : _vm.publicValue.carry_type === 2
                              ? _c("p", [_vm._v("中度搬运")])
                              : _vm.publicValue.carry_type === 3
                                ? _c("p", [_vm._v("重度搬运")])
                                : _vm._e(),
                        _vm._v(" "),
                        _vm.publicValue.carry_type !== 0 &&
                        _vm.publicValue.carry.textarea
                          ? _c("p", [
                              _vm._v(
                                "\n                    其他：" +
                                  _vm._s(
                                    _vm.publicValue.carry.textarea || "无"
                                  ) +
                                  "\n                "
                              )
                            ])
                          : _vm._e()
                      ])
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "Col",
                    { attrs: { span: "8" } },
                    [
                      _c("FormItem", { attrs: { label: "需要拆后座：" } }, [
                        _vm._v(
                          _vm._s(
                            _vm.publicValue.other.is_remove_seat === 0
                              ? "否"
                              : "是"
                          )
                        )
                      ])
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "Col",
                    { attrs: { span: "8" } },
                    [
                      _c("FormItem", { attrs: { label: "需要小推车：" } }, [
                        _vm._v(
                          _vm._s(
                            _vm.publicValue.other.is_trolley === 0 ? "否" : "是"
                          )
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
            "Row",
            [
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "需要带尾板：" } }, [
                    _vm._v(
                      _vm._s(
                        _vm.publicValue.other.is_tail_plate === 0 ? "否" : "是"
                      )
                    )
                  ])
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "需要配备双灭火器：" } }, [
                    _vm._v(
                      _vm._s(
                        _vm.publicValue.other.is_extinguisher === 0
                          ? "否"
                          : "是"
                      )
                    )
                  ])
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "需要配备明锁/暗锁：" } }, [
                    _vm._v(
                      _vm._s(_vm.publicValue.other.is_lock === 0 ? "否" : "是")
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
            "Row",
            [
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "其他上岗要求：" } }, [
                    _vm._v(_vm._s(_vm.publicValue.other.other_require || "无"))
                  ])
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
            "Row",
            [
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "任务补充说明：" } }, [
                    _vm.publicValue.supply.length > 0
                      ? _c("div", [
                          _vm._v(
                            _vm._s(
                              _vm._f("arrToString")(_vm.publicValue.supply)
                            )
                          )
                        ])
                      : _c("div", [_vm._v("无")])
                  ])
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "司机福利补贴奖励：" } }, [
                    _vm.publicValue.welfare.length > 0
                      ? _c("div", [
                          _vm._v(
                            _vm._s(
                              _vm._f("arrToString")(_vm.publicValue.welfare)
                            )
                          )
                        ])
                      : _c("div", [_vm._v("无")])
                  ])
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "Col",
                { attrs: { span: "8" } },
                [
                  _c("FormItem", { attrs: { label: "是否显示：" } }, [
                    _vm._v(_vm._s(_vm.publicValue.is_show === 0 ? "否" : "是"))
                  ])
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c("formItem", [
            _vm._v(
              "\n            方舟货的将依据《方舟货的客户服务条款》为您提供服务。\n        "
            )
          ]),
          _vm._v(" "),
          _c(
            "FormItem",
            [
              _c(
                "Button",
                { attrs: { type: "primary" }, on: { click: _vm.ok } },
                [_vm._v("立即发布")]
              ),
              _vm._v(" "),
              _c("Button", { on: { click: _vm.cancelPrevious } }, [
                _vm._v("取消预览")
              ])
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-fc266ada", module.exports)
  }
}

/***/ }),

/***/ 613:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c("Card", [
        _c("p", { attrs: { slot: "title" }, slot: "title" }, [
          _vm._v("招司机")
        ]),
        _vm._v(" "),
        _c(
          "div",
          [
            _c(
              "keep-alive",
              { attrs: { exclude: _vm.exclude } },
              [
                _c(_vm.current, {
                  tag: "component",
                  attrs: { config: _vm.taskConfig, extra: _vm.extra },
                  on: {
                    "on-next": _vm.next,
                    "on-previous": _vm.previous,
                    "on-ok": _vm.ok,
                    "on-preview": _vm.preview,
                    "on-cancel-preview": _vm.cancelPreview
                  },
                  model: {
                    value: _vm.formCreate,
                    callback: function($$v) {
                      _vm.formCreate = $$v
                    },
                    expression: "formCreate"
                  }
                })
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-0d987e23", module.exports)
  }
}

/***/ })

});