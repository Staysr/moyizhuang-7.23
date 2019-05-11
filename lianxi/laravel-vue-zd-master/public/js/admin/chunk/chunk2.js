webpackJsonp([2],{

/***/ 252:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(723)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(725)
/* template */
var __vue_template__ = __webpack_require__(773)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-72c54bfb"
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
Component.options.__file = "resources/assets/admin/js/views/task/index.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-72c54bfb", Component.options)
  } else {
    hotAPI.reload("data-v-72c54bfb", Component.options)
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

/***/ 723:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(724);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("ff5ba82a", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-72c54bfb\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./index.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-72c54bfb\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./index.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 724:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 725:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _myLists = __webpack_require__(269);

var _myLists2 = _interopRequireDefault(_myLists);

var _lists = __webpack_require__(265);

var _lists2 = _interopRequireDefault(_lists);

var _status = __webpack_require__(324);

var _status2 = _interopRequireDefault(_status);

var _driverStatus = __webpack_require__(726);

var _driverStatus2 = _interopRequireDefault(_driverStatus);

var _trueOrFalse = __webpack_require__(731);

var _trueOrFalse2 = _interopRequireDefault(_trueOrFalse);

var _remote = __webpack_require__(266);

var _remote2 = _interopRequireDefault(_remote);

var _selectStatus = __webpack_require__(736);

var _selectStatus2 = _interopRequireDefault(_selectStatus);

var _driverSelectStatus = __webpack_require__(741);

var _driverSelectStatus2 = _interopRequireDefault(_driverSelectStatus);

var _index = __webpack_require__(293);

var _index2 = _interopRequireDefault(_index);

var _view = __webpack_require__(746);

var _view2 = _interopRequireDefault(_view);

var _assigned = __webpack_require__(757);

var _assigned2 = _interopRequireDefault(_assigned);

var _change = __webpack_require__(762);

var _change2 = _interopRequireDefault(_change);

var _safe = __webpack_require__(767);

var _safe2 = _interopRequireDefault(_safe);

var _show = __webpack_require__(370);

var _show2 = _interopRequireDefault(_show);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; } //
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
    name: "index",
    components: {
        CDatePicker: _index2.default,
        DriverSelectStatus: _driverSelectStatus2.default, TaskType: _selectStatus2.default, Remote: _remote2.default, MyLists: _myLists2.default, TaskStatus: _status2.default, TagsTrueOrFalse: _trueOrFalse2.default, TaskDriverStatus: _driverStatus2.default,
        mView: _view2.default, assigned: _assigned2.default, safe: _safe2.default, change: _change2.default, show: _show2.default
    },
    mixins: [_lists2.default],
    data: function data() {
        var _this = this;

        return {
            searchForm: {},
            columns: [{
                title: '任务类型',
                render: function render(h, _ref) {
                    var row = _ref.row;

                    return h(
                        "div",
                        null,
                        [h(
                            "tag",
                            {
                                attrs: { color: "gold" }
                            },
                            [row.type === 1 ? '主' : '临']
                        )]
                    );
                }
            }, {
                title: '任务编号',
                key: 'id',
                render: function render(h, _ref2) {
                    var row = _ref2.row;

                    return h(
                        "div",
                        null,
                        [h(
                            "a",
                            {
                                on: {
                                    "click": function click() {
                                        return _this.showComponent('mView', row);
                                    }
                                }
                            },
                            [row.id]
                        )]
                    );
                }
            }, {
                title: '商户简称',
                render: function render(h, _ref3) {
                    var row = _ref3.row;

                    return h(
                        "span",
                        null,
                        [row.merchant ? row.merchant.short_name : '']
                    );
                }
            }, {
                title: '仓名称',
                render: function render(h, _ref4) {
                    var row = _ref4.row;

                    return h(
                        "span",
                        null,
                        [row.warehouse.title]
                    );
                }
            }, {
                title: '线路名称',
                key: 'name'
            }, {
                title: '（报价/查看）',
                render: function render(h, _ref5) {
                    var row = _ref5.row;

                    return h(
                        "span",
                        null,
                        [row.browse_count, " / ", row.browse_count]
                    );
                }
            }, {
                title: '任务状态',
                width: 130,
                render: function render(h, _ref6) {
                    var row = _ref6.row;

                    return h(
                        _status2.default,
                        {
                            attrs: { status: row.status }
                        },
                        []
                    );
                }
            }, {
                title: '司机信息',
                render: function render(h, _ref7) {
                    var row = _ref7.row;

                    if (row.rescind) {
                        return h(
                            "tooltip",
                            {
                                attrs: { theme: "light", placement: "top", transfer: true,
                                    content: "\u624B\u673A\u53F7\u7801: " + row.rescind.phone + " \n \u8F66\u8F86\u7C7B\u578B\uFF1A" + row.rescind.car_type.name + " \n \u8F66\u724C\u53F7\u7801 " + row.rescind.car_number,
                                    "max-width": 250 }
                            },
                            [row.rescind ? row.rescind.name : '']
                        );
                    } else if (row.driver) {
                        return h(
                            "tooltip",
                            {
                                attrs: { theme: "light", placement: "top", transfer: true,
                                    content: "\u624B\u673A\u53F7\u7801: " + row.driver.phone + " \n \u8F66\u8F86\u7C7B\u578B\uFF1A" + row.driver.car_type.name + " \n \u8F66\u724C\u53F7\u7801 " + row.driver.car_number,
                                    "max-width": 250 }
                            },
                            [row.driver ? row.driver.name : '']
                        );
                    }
                }
            }, {
                title: '司机状态',
                width: 120,
                render: function render(h, _ref8) {
                    var row = _ref8.row;

                    return h(
                        _driverStatus2.default,
                        {
                            attrs: { status: row.driver_status }
                        },
                        []
                    );
                }
            }, {
                title: '上岗日期',
                render: function render(h, _ref9) {
                    var row = _ref9.row;

                    return h(
                        "span",
                        null,
                        [row.type === 1 ? row.arrival_date : row.temp_start_date]
                    );
                }
            }, {
                title: '是否指派司机',
                render: function render(h, _ref10) {
                    var row = _ref10.row;

                    return h(
                        _trueOrFalse2.default,
                        {
                            attrs: { status: row.assign_status }
                        },
                        []
                    );
                }
            }, {
                title: '是否显示',
                render: function render(h, _ref11) {
                    var row = _ref11.row;

                    return h(
                        "i-button",
                        {
                            attrs: _defineProperty({ size: "small", type: "" + (row.is_show === 1 ? 'success' : 'primary') }, "size", "small"),
                            on: {
                                "click": function click() {
                                    return _this.toggle(row);
                                }
                            }
                        },
                        [row.is_show === 1 ? '是' : '否']
                    );
                }
            }, {
                title: '详情',
                render: function render(h, _ref12) {
                    var row = _ref12.row;

                    return h(
                        "div",
                        null,
                        [h(
                            "a",
                            {
                                on: {
                                    "click": function click() {
                                        return _this.showComponent('show', row);
                                    }
                                }
                            },
                            ["\u8BE6\u60C5"]
                        )]
                    );
                }
            }, {
                title: '操作',
                render: function render(h, _ref13) {
                    var row = _ref13.row;

                    return h(
                        "dropdown",
                        {
                            attrs: { trigger: "click" },
                            on: {
                                "on-click": function onClick(name) {
                                    return _this.listTrigger(name, row);
                                }
                            }
                        },
                        [h(
                            "i-button",
                            {
                                attrs: { size: "small" }
                            },
                            ["\u64CD\u4F5C"]
                        ), h(
                            "dropdown-menu",
                            { slot: "list" },
                            [h(
                                "dropdown-item",
                                {
                                    attrs: { name: "\u590D\u5236" }
                                },
                                ["\u590D\u5236"]
                            ), h(
                                "dropdown-item",
                                {
                                    attrs: { name: "\u8D2D\u4E70\u4FDD\u4EF7" }
                                },
                                ["\u8D2D\u4E70\u4FDD\u4EF7"]
                            ), h(
                                "dropdown-item",
                                {
                                    attrs: { name: "\u5220\u9664" }
                                },
                                ["\u5220\u9664"]
                            ), h(
                                "dropdown-item",
                                {
                                    attrs: { name: "\u4F5C\u5E9F" }
                                },
                                ["\u4F5C\u5E9F"]
                            ), h(
                                "dropdown-item",
                                {
                                    attrs: { name: "\u5168\u90FD\u4E0D\u9009" }
                                },
                                ["\u5168\u90FD\u4E0D\u9009"]
                            ), h(
                                "dropdown-item",
                                {
                                    attrs: { name: "\u6307\u6D3E\u4EFB\u52A1" }
                                },
                                ["\u6307\u6D3E\u4EFB\u52A1"]
                            ), h(
                                "dropdown-item",
                                {
                                    attrs: { name: "\u6539\u6D3E\u4EFB\u52A1" }
                                },
                                ["\u6539\u6D3E\u4EFB\u52A1"]
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
            this.$http.get("task", { params: this.request(page) }).then(function (res) {
                _this2.assignmentData(res.data.data);
            }).finally(function (res) {
                _this2.loading = false;
            });
        },
        go: function go(name, params) {
            this.$router.push({ name: name, params: params });
        },
        listTrigger: function listTrigger(name, row) {
            switch (name) {
                case '复制':
                    this.go('task.create', { id: row.id });
                    break;
                case '指派任务':
                    this.showComponent('assigned', row);
                    break;
                case '改派任务':
                    this.showComponent('change', row);
                    break;
                case '作废':
                    this.abandon(row);
                    break;
                case '删除':
                    this.delete(row);
                    break;
                case '全都不选':
                    this.none(row);
                    break;
                case '购买保价':
                    this.showComponent('safe', row);
                    break;
            }
        },
        toggle: function toggle(row) {
            var _this3 = this;

            var current = this.lists.data.page.current;
            this.$http.put("task/toggle/" + row.id, { params: { 'status': row.status } }).then(function (res) {}).finally(function (res) {
                _this3.search(current);
            });
        },
        abandon: function abandon(row) {
            var _this4 = this;

            var current = this.lists.data.page.current;
            this.$http.put("task/abandon/" + row.id).then(function (res) {
                _this4.$Message.success('任务作废成功');
            }).catch(function (res) {
                _this4.formatErrors(res);
            }).finally(function (res) {
                _this4.search(current);
            });
        },
        delete: function _delete(row) {
            var _this5 = this;

            var current = this.lists.data.page.current;
            this.$http.put("task/delete/" + row.id).then(function (res) {
                _this5.$Message.success('任务删除成功');
            }).catch(function (res) {
                _this5.error(res);
            }).finally(function (res) {
                _this5.search(current);
            });
        },
        none: function none(row) {
            var _this6 = this;

            var current = this.lists.data.page.current;
            this.$http.put("task/none/" + row.id).then(function (res) {
                _this6.$Message.success('全都不选成功');
            }).catch(function (res) {
                _this6.formatErrors(res);
            }).finally(function (res) {
                _this6.search(current);
            });
        }
    }

};

/***/ }),

/***/ 726:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(727)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(729)
/* template */
var __vue_template__ = __webpack_require__(730)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-0ec7703a"
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
Component.options.__file = "resources/assets/admin/js/views/components/task/driver-status.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-0ec7703a", Component.options)
  } else {
    hotAPI.reload("data-v-0ec7703a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 727:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(728);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("58de2ec3", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0ec7703a\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./driver-status.vue", function() {
     var newContent = require("!!../../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0ec7703a\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./driver-status.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 728:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 729:
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
    name: "task-driver-status",
    props: {
        status: {
            type: Number,
            required: true
        }
    }
};

/***/ }),

/***/ 730:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _vm.status === 0
    ? _c("tag", { attrs: { color: "warning" } }, [_vm._v("无司机")])
    : _vm.status === 1
      ? _c("tag", { attrs: { color: "default" } }, [_vm._v("被选中")])
      : _vm.status === 2
        ? _c("tag", { attrs: { color: "primary" } }, [_vm._v("确认上岗")])
        : _vm.status === 3
          ? _c("tag", { attrs: { color: "success" } }, [_vm._v("任务完成")])
          : _vm.status === 4
            ? _c("tag", { attrs: { color: "error" } }, [_vm._v("任务取消")])
            : _vm.status === 5
              ? _c("tag", { attrs: { color: "error" } }, [_vm._v("无责任解约")])
              : _vm._e()
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-0ec7703a", module.exports)
  }
}

/***/ }),

/***/ 731:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(732)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(734)
/* template */
var __vue_template__ = __webpack_require__(735)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-4071a1b9"
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
Component.options.__file = "resources/assets/admin/js/components/tags/true-or-false.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-4071a1b9", Component.options)
  } else {
    hotAPI.reload("data-v-4071a1b9", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 732:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(733);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("95b4a22e", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-4071a1b9\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./true-or-false.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-4071a1b9\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./true-or-false.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 733:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 734:
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
    name: "tags-true-or-false",
    props: {
        status: {
            type: Number,
            required: true
        },
        trueValue: {
            type: String,
            default: '是'
        },
        falseValue: {
            type: String,
            default: '否'
        }
    }
};

/***/ }),

/***/ 735:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _vm.status
    ? _c("tag", { attrs: { color: "green" } }, [_vm._v(_vm._s(_vm.trueValue))])
    : _c("tag", { attrs: { color: "red" } }, [_vm._v(_vm._s(_vm.falseValue))])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-4071a1b9", module.exports)
  }
}

/***/ }),

/***/ 736:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(737)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(739)
/* template */
var __vue_template__ = __webpack_require__(740)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-7e5d1e8f"
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
Component.options.__file = "resources/assets/admin/js/views/components/task/select-status.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-7e5d1e8f", Component.options)
  } else {
    hotAPI.reload("data-v-7e5d1e8f", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 737:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(738);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("76d54a2a", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7e5d1e8f\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./select-status.vue", function() {
     var newContent = require("!!../../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7e5d1e8f\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./select-status.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 738:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 739:
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
    name: "task-type",
    props: {
        value: [String, Number]
    },
    data: function data() {
        return {
            model: this.value
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
        }
    }
};

/***/ }),

/***/ 740:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "Select",
    {
      staticStyle: { width: "100px" },
      attrs: { placeholder: "请选择任务类型", clearable: "", filterable: "" },
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
      _c("Option", { attrs: { value: 1 } }, [_vm._v("主任务")]),
      _vm._v(" "),
      _c("Option", { attrs: { value: 2 } }, [_vm._v("临时任务")])
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-7e5d1e8f", module.exports)
  }
}

/***/ }),

/***/ 741:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(742)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(744)
/* template */
var __vue_template__ = __webpack_require__(745)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-878cf2fc"
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
Component.options.__file = "resources/assets/admin/js/views/components/task/driver-select-status.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-878cf2fc", Component.options)
  } else {
    hotAPI.reload("data-v-878cf2fc", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 742:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(743);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("dc16819c", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-878cf2fc\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./driver-select-status.vue", function() {
     var newContent = require("!!../../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-878cf2fc\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./driver-select-status.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 743:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 744:
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

exports.default = {
    name: "driver-select-status",
    props: {
        value: [String, Number]
    },
    data: function data() {
        return {
            model: this.value
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
        }
    }
};

/***/ }),

/***/ 745:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "Select",
    {
      staticStyle: { width: "100px" },
      attrs: { placeholder: "请选择司机状态", clearable: "", filterable: "" },
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
      _c("i-option", { attrs: { value: 1 } }, [_vm._v("被选中")]),
      _vm._v(" "),
      _c("i-option", { attrs: { value: 2 } }, [_vm._v("确认上岗")]),
      _vm._v(" "),
      _c("i-option", { attrs: { value: 3 } }, [_vm._v("无责任解约")])
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-878cf2fc", module.exports)
  }
}

/***/ }),

/***/ 746:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(747)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(749)
/* template */
var __vue_template__ = __webpack_require__(756)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-54b9f30c"
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
Component.options.__file = "resources/assets/admin/js/views/task/view.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-54b9f30c", Component.options)
  } else {
    hotAPI.reload("data-v-54b9f30c", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 747:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(748);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("17826b8a", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-54b9f30c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./view.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-54b9f30c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./view.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 748:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 749:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _componentModal = __webpack_require__(264);

var _componentModal2 = _interopRequireDefault(_componentModal);

var _lists = __webpack_require__(265);

var _lists2 = _interopRequireDefault(_lists);

var _component = __webpack_require__(263);

var _component2 = _interopRequireDefault(_component);

var _index = __webpack_require__(294);

var _index2 = _interopRequireDefault(_index);

var _index3 = __webpack_require__(268);

var _index4 = _interopRequireDefault(_index3);

var _myTable = __webpack_require__(271);

var _myTable2 = _interopRequireDefault(_myTable);

var _status = __webpack_require__(324);

var _status2 = _interopRequireDefault(_status);

var _assist = __webpack_require__(284);

var _rescind = __webpack_require__(750);

var _rescind2 = _interopRequireDefault(_rescind);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
    name: "mview",
    components: { TaskStatus: _status2.default, MyTable: _myTable2.default, Box: _index4.default, Detail: _index2.default, ComponentModal: _componentModal2.default, Rescind: _rescind2.default },
    mixins: [_component2.default, _lists2.default],
    data: function data() {
        var _this = this;

        return {
            task: {},
            columns: [{
                title: '司机姓名',
                render: function render(h, _ref) {
                    var row = _ref.row;

                    return h(
                        "span",
                        null,
                        [row.driver ? row.driver.name : '']
                    );
                }
            }, {
                title: '手机号码',
                width: 120,
                render: function render(h, _ref2) {
                    var row = _ref2.row;

                    return h(
                        "span",
                        null,
                        [row.driver ? row.driver.phone : '']
                    );
                }
            }, {
                title: '车牌号码',
                render: function render(h, _ref3) {
                    var row = _ref3.row;

                    return h(
                        "span",
                        null,
                        [row.driver ? row.driver.car_number : '']
                    );
                }
            }, {
                title: '报价时间',
                key: 'create_time',
                tooltip: true
            }, {
                title: '竞标语',
                key: 'remark',
                tooltip: true
            }, {
                title: '状态',
                render: function render(h, _ref4) {
                    var row = _ref4.row;

                    return h(
                        "span",
                        null,
                        [h(
                            "tag",
                            {
                                directives: [{
                                    name: "show",
                                    value: row.driver_id === _this.task.driver_id
                                }],
                                attrs: { color: "green" }
                            },
                            ["\u88AB\u9009\u4E2D"]
                        ), h(
                            "tag",
                            {
                                directives: [{
                                    name: "show",
                                    value: (0, _assist.oneOf)(row.status, [1, 2]) && row.driver_id !== _this.task.driver_id
                                }],
                                attrs: {
                                    color: "lime" }
                            },
                            ["\u6CA1\u9009\u4E2D"]
                        ), h(
                            "tag",
                            {
                                directives: [{
                                    name: "show",
                                    value: row.status === 0
                                }],
                                attrs: { color: "yellow" }
                            },
                            ["\u53D6\u6D88\u62A5\u4EF7"]
                        )]
                    );
                }
            }, {
                title: '报价',
                key: 'unit_price'
            }, {
                title: '操作',
                render: function render(h, _ref5) {
                    var row = _ref5.row;

                    if ((0, _assist.oneOf)(_this.task.status, [3, 4, 5, 6]) || (0, _assist.oneOf)(_this.task.driver_status, [3, 4]) || row.status !== 0) {
                        return h(
                            "div",
                            null,
                            [h(
                                "i-button",
                                {
                                    attrs: { size: "small", type: "info" },
                                    on: {
                                        "click": function click() {
                                            return _this.choose(row);
                                        }
                                    },
                                    directives: [{
                                        name: "show",
                                        value: row.driver_id !== _this.task.driver_id
                                    }]
                                },
                                ["\u9009\u53F8\u673A"]
                            ), h(
                                "i-button",
                                {
                                    attrs: { size: "small", type: "error" },
                                    on: {
                                        "click": function click() {
                                            return _this.showComponent('Rescind', row);
                                        }
                                    },
                                    directives: [{
                                        name: "show",
                                        value: row.driver_id === _this.task.driver_id
                                    }]
                                },
                                ["\u65E0\u8D23\u4EFB\u89E3\u7EA6"]
                            )]
                        );
                    }
                }
            }]
        };
    },

    computed: {
        offer: function offer() {
            return this.task.offer || [];
        },
        offerChangeCount: function offerChangeCount() {
            return this.offer.filter(function (val) {
                return val.status !== 0;
            }).length;
        }
    },
    mounted: function mounted() {
        this.search();
    },

    methods: {
        search: function search() {
            var _this2 = this;

            var page = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;

            this.loading = true;
            this.$http.get("task/offer/" + this.data.id).then(function (res) {
                _this2.task = res.data.data;
                _this2.loading = false;
            });
        },
        choose: function choose(row) {
            var _this3 = this;

            this.$http.put("task/choose/" + this.data.id, {
                driver_id: row.driver_id
            }).then(function (res) {
                _this3.search();
            });
        }
    },
    filters: {
        formatArray: function formatArray(arr) {
            return (arr || []).join(',');
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

/***/ }),

/***/ 750:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(751)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(753)
/* template */
var __vue_template__ = __webpack_require__(755)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-a21a81b6"
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
Component.options.__file = "resources/assets/admin/js/views/task/rescind.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-a21a81b6", Component.options)
  } else {
    hotAPI.reload("data-v-a21a81b6", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 751:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(752);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("30a565c2", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-a21a81b6\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./rescind.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-a21a81b6\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./rescind.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 752:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 753:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _component = __webpack_require__(263);

var _component2 = _interopRequireDefault(_component);

var _componentModal = __webpack_require__(264);

var _componentModal2 = _interopRequireDefault(_componentModal);

var _rescind = __webpack_require__(754);

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
                driver_id: this.data.driver_id,
                remark: ''
            },
            rulesUpdate: (0, _rescind.Validator)(this)
        };
    }
};

/***/ }),

/***/ 754:
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
            message: '备注必须填写'
        }]
    };
};

/***/ }),

/***/ 755:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "component-modal",
    { attrs: { title: "无责任解约", width: 350, loading: _vm.loading } },
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
                  _vm.updateSubmit(
                    "formUpdate",
                    "task/rescind/" + _vm.data.task_id
                  )
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-a21a81b6", module.exports)
  }
}

/***/ }),

/***/ 756:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "component-modal",
    { attrs: { title: "查看任务报价", width: 950, loading: _vm.loading } },
    [
      _c(
        "box",
        { attrs: { title: "查看任务报价" } },
        [
          _c(
            "detail",
            { attrs: { title: "任务状态" } },
            [_c("task-status", { attrs: { status: _vm.task.status } })],
            1
          ),
          _vm._v(" "),
          _c("detail", { attrs: { title: "任务编号" } }, [
            _vm._v(_vm._s(_vm.task.id))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "仓库名称" } }),
          _vm._v(" "),
          _c("detail", { attrs: { title: "线路名称" } }, [
            _vm._v(_vm._s(_vm.task.name))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "车型" } }, [
            _vm._v(_vm._s(_vm._f("formatArray")(_vm.task.car_type_name)))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "上岗时间" } }, [
            _vm._v(_vm._s(_vm.task.work_time))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "到仓时间" } }, [
            _vm._v(_vm._s(_vm.task.arrival_warehouse_time))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "司机报价截止时间" } }, [
            _vm._v(_vm._s(_vm.task.offer_end_time))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "选司机截止时间" } }, [
            _vm._v(_vm._s(_vm.task.choose_driver_end_time))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "任务创建时间" } }, [
            _vm._v(_vm._s(_vm.task.create_time))
          ])
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "box",
        { attrs: { title: "司机列表" } },
        [
          _c("alert", [
            _vm._v(
              "总计 " +
                _vm._s(_vm.offer.length) +
                " 人报价，" +
                _vm._s(_vm.offerChangeCount) +
                " 人可选(所有的司机都会经过方舟仔细筛选，请您放心选择)"
            )
          ]),
          _vm._v(" "),
          _c("my-table", { attrs: { columns: _vm.columns, data: _vm.offer } })
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-54b9f30c", module.exports)
  }
}

/***/ }),

/***/ 757:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(758)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(760)
/* template */
var __vue_template__ = __webpack_require__(761)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-7f804a35"
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
Component.options.__file = "resources/assets/admin/js/views/task/assigned.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-7f804a35", Component.options)
  } else {
    hotAPI.reload("data-v-7f804a35", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 758:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(759);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("76204408", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7f804a35\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./assigned.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7f804a35\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./assigned.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 759:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 760:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _componentModal = __webpack_require__(264);

var _componentModal2 = _interopRequireDefault(_componentModal);

var _myLists = __webpack_require__(269);

var _myLists2 = _interopRequireDefault(_myLists);

var _lists = __webpack_require__(265);

var _lists2 = _interopRequireDefault(_lists);

var _component = __webpack_require__(263);

var _component2 = _interopRequireDefault(_component);

var _remote = __webpack_require__(266);

var _remote2 = _interopRequireDefault(_remote);

var _myTable = __webpack_require__(271);

var _myTable2 = _interopRequireDefault(_myTable);

var _http = __webpack_require__(144);

var _http2 = _interopRequireDefault(_http);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
    name: "assigned",
    components: { MyTable: _myTable2.default, Remote: _remote2.default, MyLists: _myLists2.default, ComponentModal: _componentModal2.default },
    mixins: [_lists2.default, _component2.default, _http2.default],
    data: function data() {
        var _this = this;

        var col = [{
            title: '司机姓名',
            key: 'name'
        }, {
            title: '手机号码',
            key: 'phone'
        }, {
            title: '车牌号码',
            key: 'car_number'
        }, {
            title: '城市',
            render: function render(h, _ref) {
                var row = _ref.row;

                return h(
                    "span",
                    {
                        directives: [{
                            name: "show",
                            value: row.category
                        }]
                    },
                    [row.category.name]
                );
            }
        }, {
            title: '车型',
            render: function render(h, _ref2) {
                var row = _ref2.row;

                return h(
                    "span",
                    {
                        directives: [{
                            name: "show",
                            value: row.car_type
                        }]
                    },
                    [row.car_type.name]
                );
            }
        }];

        return {
            chooseColumns: col,
            columns: [].concat(col, [{
                title: '操作',
                render: function render(h, _ref3) {
                    var row = _ref3.row;

                    return h(
                        "div",
                        null,
                        [h(
                            "i-button",
                            {
                                attrs: { size: "small" },
                                on: {
                                    "click": function click() {
                                        _this.choose(row);
                                    }
                                },
                                directives: [{
                                    name: "show",
                                    value: _this.oneOf(row) === -1
                                }]
                            },
                            ["\u9009\u62E9"]
                        ), h(
                            "i-button",
                            {
                                attrs: { size: "small" },
                                on: {
                                    "click": function click() {
                                        _this.cancel(row);
                                    }
                                },
                                directives: [{
                                    name: "show",
                                    value: _this.oneOf(row) !== -1
                                }]
                            },
                            ["\u53D6\u6D88"]
                        )]
                    );
                }
            }]),
            searchForm: {
                car_type_id: this.data.car_type_ids
            },
            chooseDrivers: [],
            displayChooseDrivers: false,
            displayAssignedUnitPrice: false,
            assignedFrom: {
                drivers: [],
                unit_price: 0
            }
        };
    },

    methods: {
        search: function search() {
            var _this2 = this;

            var page = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;

            this.loading = true;
            this.$http.get("driver/lists", { params: this.request(page) }).then(function (res) {
                _this2.assignmentData(res.data.data);
            }).finally(function () {
                _this2.loading = false;
            });
        },
        choose: function choose(row) {
            if (this.oneOf(row) === -1) {
                this.chooseDrivers.push(row);
                this.assignedFrom.drivers.push(row.id);
            }
        },
        cancel: function cancel(row) {
            var index = void 0;
            if ((index = this.oneOf(row)) !== -1) {
                this.chooseDrivers.splice(index, 1);
                this.assignedFrom.drivers.splice(index, 1);
            }
        },
        oneOf: function oneOf(row) {
            return this.chooseDrivers.findIndex(function (value, index, obj) {
                return value.id === row.id;
            });
        },
        assigned: function assigned() {
            var _this3 = this;

            this.loading = true;
            this.$http.put("task/assigned/" + this.data.id, this.assignedFrom).then(function (res) {
                console.log(res);
            }).catch(function (res) {
                _this3.formatErrors(res);
            }).finally(function () {
                _this3.displayAssignedUnitPrice = false;
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
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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

/***/ 761:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "component-modal",
    { attrs: { title: "指派司机", width: 850, loading: _vm.loading } },
    [
      _c(
        "my-lists",
        {
          attrs: { columns: _vm.columns },
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
                    { attrs: { label: "司机姓名" } },
                    [
                      _c("remote", {
                        attrs: {
                          "remote-url": "driver/select",
                          "search-key": "name",
                          remote: true
                        },
                        model: {
                          value: _vm.searchForm.id,
                          callback: function($$v) {
                            _vm.$set(_vm.searchForm, "id", $$v)
                          },
                          expression: "searchForm.id"
                        }
                      })
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "FormItem",
                    { attrs: { label: "司机类型" } },
                    [
                      _c(
                        "i-select",
                        {
                          model: {
                            value: _vm.searchForm.driver_type,
                            callback: function($$v) {
                              _vm.$set(_vm.searchForm, "driver_type", $$v)
                            },
                            expression: "searchForm.driver_type"
                          }
                        },
                        [
                          _c("i-option", { attrs: { value: 0 } }, [
                            _vm._v("自营司机")
                          ]),
                          _vm._v(" "),
                          _c("i-option", { attrs: { value: 1 } }, [
                            _vm._v("合作司机")
                          ]),
                          _vm._v(" "),
                          _c("i-option", { attrs: { value: 2 } }, [
                            _vm._v("社会司机")
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
          ),
          _vm._v(" "),
          _c("span", { attrs: { slot: "title" }, slot: "title" }, [
            _vm._v("已选 （"),
            _c(
              "a",
              {
                on: {
                  click: function($event) {
                    _vm.displayChooseDrivers = true
                  }
                }
              },
              [_vm._v(_vm._s(_vm.chooseDrivers.length))]
            ),
            _vm._v("）个司机, "),
            _c(
              "a",
              {
                on: {
                  click: function($event) {
                    _vm.displayChooseDrivers = true
                  }
                }
              },
              [_vm._v("点击 ")]
            ),
            _vm._v("\n            可查看")
          ])
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
              attrs: {
                type: "primary",
                loading: _vm.loading,
                disabled: _vm.chooseDrivers.length === 0
              },
              on: {
                click: function($event) {
                  _vm.displayAssignedUnitPrice = true
                }
              }
            },
            [_vm._v("提交\n        ")]
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "Modal",
        {
          attrs: { title: "已选司机", width: 700 },
          model: {
            value: _vm.displayChooseDrivers,
            callback: function($$v) {
              _vm.displayChooseDrivers = $$v
            },
            expression: "displayChooseDrivers"
          }
        },
        [
          _c("my-table", {
            attrs: { columns: _vm.chooseColumns, data: _vm.chooseDrivers }
          }),
          _vm._v(" "),
          _c("div", { attrs: { slot: "footer" }, slot: "footer" })
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "Modal",
        {
          attrs: { title: "选择价格", width: 300 },
          model: {
            value: _vm.displayAssignedUnitPrice,
            callback: function($$v) {
              _vm.displayAssignedUnitPrice = $$v
            },
            expression: "displayAssignedUnitPrice"
          }
        },
        [
          _c(
            "i-input",
            {
              attrs: { number: "" },
              model: {
                value: _vm.assignedFrom.unit_price,
                callback: function($$v) {
                  _vm.$set(_vm.assignedFrom, "unit_price", $$v)
                },
                expression: "assignedFrom.unit_price"
              }
            },
            [
              _c("Icon", {
                attrs: { slot: "prepend", type: "logo-usd" },
                slot: "prepend"
              }),
              _vm._v(" "),
              _c(
                "i-button",
                {
                  attrs: { slot: "append", type: "primary" },
                  on: { click: _vm.assigned },
                  slot: "append"
                },
                [_vm._v("提交")]
              )
            ],
            1
          ),
          _vm._v(" "),
          _c("div", { attrs: { slot: "footer" }, slot: "footer" })
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-7f804a35", module.exports)
  }
}

/***/ }),

/***/ 762:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(763)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(765)
/* template */
var __vue_template__ = __webpack_require__(766)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-3ce976d7"
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
Component.options.__file = "resources/assets/admin/js/views/task/change.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-3ce976d7", Component.options)
  } else {
    hotAPI.reload("data-v-3ce976d7", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 763:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(764);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("57ffa2e0", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3ce976d7\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./change.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3ce976d7\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./change.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 764:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 765:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _componentModal = __webpack_require__(264);

var _componentModal2 = _interopRequireDefault(_componentModal);

var _myLists = __webpack_require__(269);

var _myLists2 = _interopRequireDefault(_myLists);

var _lists = __webpack_require__(265);

var _lists2 = _interopRequireDefault(_lists);

var _component = __webpack_require__(263);

var _component2 = _interopRequireDefault(_component);

var _remote = __webpack_require__(266);

var _remote2 = _interopRequireDefault(_remote);

var _myTable = __webpack_require__(271);

var _myTable2 = _interopRequireDefault(_myTable);

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

exports.default = {
    name: "assigned",
    components: { MyTable: _myTable2.default, Remote: _remote2.default, MyLists: _myLists2.default, ComponentModal: _componentModal2.default },
    mixins: [_lists2.default, _component2.default],
    data: function data() {
        var _this = this;

        var col = [{
            title: '司机姓名',
            key: 'name'
        }, {
            title: '手机号码',
            key: 'phone'
        }, {
            title: '车牌号码',
            key: 'car_number'
        }, {
            title: '城市',
            render: function render(h, _ref) {
                var row = _ref.row;

                return h(
                    "span",
                    {
                        directives: [{
                            name: "show",
                            value: row.category
                        }]
                    },
                    [row.category.name]
                );
            }
        }, {
            title: '车型',
            render: function render(h, _ref2) {
                var row = _ref2.row;

                return h(
                    "span",
                    {
                        directives: [{
                            name: "show",
                            value: row.car_type
                        }]
                    },
                    [row.car_type.name]
                );
            }
        }];

        return {
            chooseColumns: col,
            columns: [].concat(col, [{
                title: '操作',
                render: function render(h, _ref3) {
                    var row = _ref3.row;

                    return h(
                        "div",
                        null,
                        [h(
                            "i-button",
                            {
                                attrs: { size: "small" },
                                on: {
                                    "click": function click() {
                                        _this.choose(row);
                                    }
                                }
                            },
                            ["\u9009\u62E9"]
                        )]
                    );
                }
            }]),
            searchForm: {
                car_type_id: this.data.car_type_ids,
                n_id: this.data.driver_id
            },
            chooseDrivers: [],
            displayChooseDrivers: false,
            displayAssignedUnitPrice: false,
            assignedFrom: {
                driver_id: 0,
                unit_price: 0
            }
        };
    },

    methods: {
        search: function search() {
            var _this2 = this;

            var page = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;

            this.loading = true;
            this.$http.get("driver/lists", { params: this.request(page) }).then(function (res) {
                _this2.assignmentData(res.data.data);
            }).finally(function () {
                _this2.loading = false;
            });
        },
        choose: function choose(row) {
            this.assignedFrom.driver_id = row.id;
            this.displayAssignedUnitPrice = true;
        },
        assigned: function assigned() {
            var _this3 = this;

            this.loading = true;
            this.$http.put("task/change/" + this.data.id, this.assignedFrom).then(function (res) {
                console.log(res);
            }).catch(function (res) {
                _this3.formatErrors(res);
            }).finally(function () {
                _this3.loading = false;
            });
        }
    }
};

/***/ }),

/***/ 766:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "component-modal",
    { attrs: { title: "改派司机", width: 850, loading: _vm.loading } },
    [
      _c(
        "my-lists",
        {
          attrs: { columns: _vm.columns },
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
                    { attrs: { label: "司机姓名" } },
                    [
                      _c("remote", {
                        attrs: {
                          "remote-url": "driver/select",
                          "search-key": "name",
                          remote: true
                        },
                        model: {
                          value: _vm.searchForm.id,
                          callback: function($$v) {
                            _vm.$set(_vm.searchForm, "id", $$v)
                          },
                          expression: "searchForm.id"
                        }
                      })
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "FormItem",
                    { attrs: { label: "司机类型" } },
                    [
                      _c(
                        "i-select",
                        {
                          model: {
                            value: _vm.searchForm.driver_type,
                            callback: function($$v) {
                              _vm.$set(_vm.searchForm, "driver_type", $$v)
                            },
                            expression: "searchForm.driver_type"
                          }
                        },
                        [
                          _c("i-option", { attrs: { value: 0 } }, [
                            _vm._v("自营司机")
                          ]),
                          _vm._v(" "),
                          _c("i-option", { attrs: { value: 1 } }, [
                            _vm._v("合作司机")
                          ]),
                          _vm._v(" "),
                          _c("i-option", { attrs: { value: 2 } }, [
                            _vm._v("社会司机")
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
      ),
      _vm._v(" "),
      _c(
        "Modal",
        {
          attrs: { title: "已选司机", width: 700 },
          model: {
            value: _vm.displayChooseDrivers,
            callback: function($$v) {
              _vm.displayChooseDrivers = $$v
            },
            expression: "displayChooseDrivers"
          }
        },
        [
          _c("my-table", {
            attrs: { columns: _vm.chooseColumns, data: _vm.chooseDrivers }
          }),
          _vm._v(" "),
          _c("div", { attrs: { slot: "footer" }, slot: "footer" })
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "Modal",
        {
          attrs: { title: "选择价格", width: 300 },
          model: {
            value: _vm.displayAssignedUnitPrice,
            callback: function($$v) {
              _vm.displayAssignedUnitPrice = $$v
            },
            expression: "displayAssignedUnitPrice"
          }
        },
        [
          _c(
            "i-input",
            {
              attrs: { number: "" },
              model: {
                value: _vm.assignedFrom.unit_price,
                callback: function($$v) {
                  _vm.$set(_vm.assignedFrom, "unit_price", $$v)
                },
                expression: "assignedFrom.unit_price"
              }
            },
            [
              _c("Icon", {
                attrs: { slot: "prepend", type: "logo-usd" },
                slot: "prepend"
              }),
              _vm._v(" "),
              _c(
                "i-button",
                {
                  attrs: { slot: "append", type: "primary" },
                  on: { click: _vm.assigned },
                  slot: "append"
                },
                [_vm._v("提交")]
              )
            ],
            1
          ),
          _vm._v(" "),
          _c("div", { attrs: { slot: "footer" }, slot: "footer" })
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-3ce976d7", module.exports)
  }
}

/***/ }),

/***/ 767:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(768)
}
var normalizeComponent = __webpack_require__(4)
/* script */
var __vue_script__ = __webpack_require__(770)
/* template */
var __vue_template__ = __webpack_require__(772)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-769bc3f4"
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
Component.options.__file = "resources/assets/admin/js/views/task/safe.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-loader/node_modules/vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-769bc3f4", Component.options)
  } else {
    hotAPI.reload("data-v-769bc3f4", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 768:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(769);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("48c2ed0a", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-769bc3f4\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./safe.vue", function() {
     var newContent = require("!!../../../../../../node_modules/_css-loader@0.28.11@css-loader/index.js!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-769bc3f4\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/_vue-loader@13.7.3@vue-loader/lib/selector.js?type=styles&index=0!./safe.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 769:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 770:
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

var _index = __webpack_require__(268);

var _index2 = _interopRequireDefault(_index);

var _safe = __webpack_require__(771);

var _form = __webpack_require__(267);

var _form2 = _interopRequireDefault(_form);

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

exports.default = {
    name: "safe",
    components: { MyLists: _myLists2.default, ComponentModal: _componentModal2.default, Box: _index2.default, GroupRadio: _groupRadio2.default },
    mixins: [_lists2.default, _component2.default, _form2.default],
    data: function data() {
        return {
            formUpdate: {
                merchant_safe_id: this.data.merchant_safe_id
            },
            rulesUpdate: (0, _safe.Validator)(this)
        };
    }
};

/***/ }),

/***/ 771:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});
var Validator = exports.Validator = function Validator(data) {
    return {
        merchant_safe_id: [{
            type: 'number',
            required: true,
            trigger: 'blur',
            message: '必须选择保险'
        }]
    };
};

/***/ }),

/***/ 772:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "component-modal",
    { attrs: { title: "购买保价", width: 800 } },
    [
      _c(
        "Form",
        {
          ref: "formUpdate",
          attrs: {
            model: _vm.formUpdate,
            "label-width": 100,
            rules: _vm.rulesUpdate
          }
        },
        [
          _c(
            "FormItem",
            { attrs: { label: "保价服务", prop: "merchant_safe_id" } },
            [
              _c("group-radio", {
                attrs: { url: "safe/select" },
                model: {
                  value: _vm.formUpdate.merchant_safe_id,
                  callback: function($$v) {
                    _vm.$set(_vm.formUpdate, "merchant_safe_id", $$v)
                  },
                  expression: "formUpdate.merchant_safe_id"
                }
              }),
              _vm._v(" "),
              _c("br"),
              _vm._v(
                "选择方舟保价服务，为您的货物保驾护航,服务将在司机签到时生效\n        "
              )
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
                  _vm.updateSubmit("formUpdate", "task/safe/" + _vm.data.id)
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-769bc3f4", module.exports)
  }
}

/***/ }),

/***/ 773:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
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
                { attrs: { label: "仓库名称" } },
                [
                  _c("remote", {
                    attrs: {
                      "remote-url": "warehouse/select",
                      params: { merchant_id: this.searchForm.merchant_id },
                      remote: false
                    },
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
                { attrs: { label: "任务编号" } },
                [
                  _c("Input", {
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
                { attrs: { label: "任务类型" } },
                [
                  _c("task-type", {
                    model: {
                      value: _vm.searchForm.type,
                      callback: function($$v) {
                        _vm.$set(_vm.searchForm, "type", $$v)
                      },
                      expression: "searchForm.type"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "FormItem",
                { attrs: { label: "司机状态" } },
                [
                  _c("driver-select-status", {
                    model: {
                      value: _vm.searchForm.driver_status,
                      callback: function($$v) {
                        _vm.$set(_vm.searchForm, "driver_status", $$v)
                      },
                      expression: "searchForm.driver_status"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "FormItem",
                { attrs: { label: "发布日期" } },
                [
                  _c("c-date-picker", {
                    staticStyle: { width: "260px" },
                    attrs: { type: "datetimerange" },
                    model: {
                      value: _vm.searchForm.create_time,
                      callback: function($$v) {
                        _vm.$set(_vm.searchForm, "create_time", $$v)
                      },
                      expression: "searchForm.create_time"
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
                  ),
                  _vm._v(" "),
                  _c(
                    "Button",
                    {
                      attrs: { type: "primary" },
                      on: {
                        click: function($event) {
                          _vm.go("task.create")
                        }
                      }
                    },
                    [_vm._v("招司机")]
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
    require("vue-loader/node_modules/vue-hot-reload-api")      .rerender("data-v-72c54bfb", module.exports)
  }
}

/***/ })

});