webpackJsonp([18],{

/***/ 1195:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(2111)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(2114)
/* template */
var __vue_template__ = __webpack_require__(2141)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-b86f35ee"
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
Component.options.__file = "resources\\assets\\admin\\js\\views\\warehouse\\index.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-b86f35ee", Component.options)
  } else {
    hotAPI.reload("data-v-b86f35ee", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1211:
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

/***/ 1212:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(1343)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(1346)
/* template */
var __vue_template__ = __webpack_require__(1347)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-5dddf25a"
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
Component.options.__file = "resources\\assets\\admin\\js\\components\\modal\\component-modal.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-5dddf25a", Component.options)
  } else {
    hotAPI.reload("data-v-5dddf25a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1213:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _http = __webpack_require__(217);

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

/***/ 1214:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(1348)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(1351)
/* template */
var __vue_template__ = __webpack_require__(1357)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-47a0cb52"
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
Component.options.__file = "resources\\assets\\admin\\js\\components\\layout\\my-lists.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-47a0cb52", Component.options)
  } else {
    hotAPI.reload("data-v-47a0cb52", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1215:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(1360)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(1363)
/* template */
var __vue_template__ = __webpack_require__(1364)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-32a98ed2"
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
Component.options.__file = "resources\\assets\\admin\\js\\components\\select\\remote.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-32a98ed2", Component.options)
  } else {
    hotAPI.reload("data-v-32a98ed2", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1339:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _http = __webpack_require__(217);

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

/***/ 1340:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(1367)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(1370)
/* template */
var __vue_template__ = __webpack_require__(1371)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-c397d8a6"
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
Component.options.__file = "resources\\assets\\admin\\js\\components\\box\\index.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-c397d8a6", Component.options)
  } else {
    hotAPI.reload("data-v-c397d8a6", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1341:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(1352)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(1355)
/* template */
var __vue_template__ = __webpack_require__(1356)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-e7348f82"
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
Component.options.__file = "resources\\assets\\admin\\js\\components\\table\\my-table.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-e7348f82", Component.options)
  } else {
    hotAPI.reload("data-v-e7348f82", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1342:
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
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vue__ = __webpack_require__(30);
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

/***/ 1343:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(1344);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(4)("50ed61bc", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5dddf25a\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./component-modal.vue", function() {
     var newContent = require("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5dddf25a\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./component-modal.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 1344:
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(1345);

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(3)(content, options);

if(content.locals) module.exports = content.locals;

if(false) {
	module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5dddf25a\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./component-modal.vue", function() {
		var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5dddf25a\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./component-modal.vue");

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

/***/ 1345:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.modal-body[data-v-5dddf25a] {\n  max-height: 8.66666667rem;\n  overflow-y: auto;\n}", ""]);

// exports


/***/ }),

/***/ 1346:
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

/***/ 1347:
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
    require("vue-hot-reload-api")      .rerender("data-v-5dddf25a", module.exports)
  }
}

/***/ }),

/***/ 1348:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(1349);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(4)("17c654a8", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-47a0cb52\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./my-lists.vue", function() {
     var newContent = require("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-47a0cb52\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./my-lists.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 1349:
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(1350);

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(3)(content, options);

if(content.locals) module.exports = content.locals;

if(false) {
	module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-47a0cb52\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./my-lists.vue", function() {
		var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-47a0cb52\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./my-lists.vue");

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

/***/ 1350:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.ivu-table .table-info-row td[data-v-47a0cb52] {\n  background-color: #2db7f5;\n  color: #fff;\n}", ""]);

// exports


/***/ }),

/***/ 1351:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _myTable = __webpack_require__(1341);

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

/***/ 1352:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(1353);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(4)("512bdcf5", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-e7348f82\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./my-table.vue", function() {
     var newContent = require("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-e7348f82\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./my-table.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 1353:
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(1354);

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(3)(content, options);

if(content.locals) module.exports = content.locals;

if(false) {
	module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-e7348f82\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./my-table.vue", function() {
		var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-e7348f82\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./my-table.vue");

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

/***/ 1354:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "", ""]);

// exports


/***/ }),

/***/ 1355:
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

/***/ 1356:
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
    require("vue-hot-reload-api")      .rerender("data-v-e7348f82", module.exports)
  }
}

/***/ }),

/***/ 1357:
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
    require("vue-hot-reload-api")      .rerender("data-v-47a0cb52", module.exports)
  }
}

/***/ }),

/***/ 1359:
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

/***/ 1360:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(1361);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(4)("0e44ceba", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-32a98ed2\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./remote.vue", function() {
     var newContent = require("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-32a98ed2\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./remote.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 1361:
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(1362);

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(3)(content, options);

if(content.locals) module.exports = content.locals;

if(false) {
	module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-32a98ed2\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./remote.vue", function() {
		var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-32a98ed2\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./remote.vue");

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

/***/ 1362:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.remote-select[data-v-32a98ed2] {\n  width: 2rem;\n}", ""]);

// exports


/***/ }),

/***/ 1363:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _http = __webpack_require__(217);

var _http2 = _interopRequireDefault(_http);

var _uuid = __webpack_require__(218);

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

/***/ 1364:
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
    require("vue-hot-reload-api")      .rerender("data-v-32a98ed2", module.exports)
  }
}

/***/ }),

/***/ 1366:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(1372)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(1375)
/* template */
var __vue_template__ = __webpack_require__(1376)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-16f29aef"
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
Component.options.__file = "resources\\assets\\admin\\js\\components\\date-picker\\index.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-16f29aef", Component.options)
  } else {
    hotAPI.reload("data-v-16f29aef", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1367:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(1368);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(4)("047d64a0", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-c397d8a6\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue", function() {
     var newContent = require("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-c397d8a6\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 1368:
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(1369);

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(3)(content, options);

if(content.locals) module.exports = content.locals;

if(false) {
	module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-c397d8a6\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue", function() {
		var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-c397d8a6\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue");

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

/***/ 1369:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.box[data-v-c397d8a6] {\n  margin-bottom: 0.13333333rem;\n  border: 0.01333333rem solid #dddee1;\n  border-radius: 0.06666667rem;\n}\n.box[data-v-c397d8a6]:last-child {\n  margin-bottom: 0;\n}\n.box-header[data-v-c397d8a6] {\n  padding: 0.10666667rem 0.64rem 0.10666667rem 0.21333333rem;\n  color: #495060;\n  font-size: 0.16rem;\n  line-height: 0.21333333rem;\n  border-bottom: 0.01333333rem solid #dddee1;\n}\n.box-detail[data-v-c397d8a6] {\n  padding: 0.13333333rem;\n}", ""]);

// exports


/***/ }),

/***/ 1370:
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

/***/ 1371:
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
    require("vue-hot-reload-api")      .rerender("data-v-c397d8a6", module.exports)
  }
}

/***/ }),

/***/ 1372:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(1373);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(4)("0a80d64f", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-16f29aef\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue", function() {
     var newContent = require("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-16f29aef\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 1373:
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(1374);

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(3)(content, options);

if(content.locals) module.exports = content.locals;

if(false) {
	module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-16f29aef\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue", function() {
		var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-16f29aef\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue");

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

/***/ 1374:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "", ""]);

// exports


/***/ }),

/***/ 1375:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _assist = __webpack_require__(1342);

var _emitter = __webpack_require__(1359);

var _emitter2 = _interopRequireDefault(_emitter);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

//
//
//
//
//

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
            this.sValue = val;
        }
    }
};

/***/ }),

/***/ 1376:
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
    require("vue-hot-reload-api")      .rerender("data-v-16f29aef", module.exports)
  }
}

/***/ }),

/***/ 1377:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(1378)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(1381)
/* template */
var __vue_template__ = __webpack_require__(1382)
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
Component.options.__file = "resources\\assets\\admin\\js\\components\\detail\\index.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-31b97a0b", Component.options)
  } else {
    hotAPI.reload("data-v-31b97a0b", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1378:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(1379);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(4)("b94b525e", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-31b97a0b\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue", function() {
     var newContent = require("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-31b97a0b\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 1379:
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(1380);

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(3)(content, options);

if(content.locals) module.exports = content.locals;

if(false) {
	module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-31b97a0b\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue", function() {
		var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-31b97a0b\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue");

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

/***/ 1380:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.box-detail {\n  line-height: 0.34666667rem;\n}\n.box-form .box-detail {\n  margin-bottom: 0.13333333rem;\n  line-height: 0.44rem;\n}\n.box-detail > .ivu-form-item {\n  margin-bottom: 0;\n  display: inline-block;\n}\n.box-detail .box-detail-title {\n  text-align: right;\n  display: inline-block;\n  overflow: hidden;\n  text-overflow: ellipsis;\n  white-space: nowrap;\n  vertical-align: middle;\n}", ""]);

// exports


/***/ }),

/***/ 1381:
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

/***/ 1382:
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
            [_vm._v(_vm._s(_vm.title) + ":")]
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
    require("vue-hot-reload-api")      .rerender("data-v-31b97a0b", module.exports)
  }
}

/***/ }),

/***/ 1425:
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(global) {!function(e,t){ true?module.exports=t():"function"==typeof define&&define.amd?define([],t):"object"==typeof exports?exports.vClickOutside=t():e.vClickOutside=t()}(function(){"use strict";return"undefined"!=typeof self?self:"undefined"!=typeof window?window:"undefined"!=typeof global?global:Function("return this")()}(),function(){return function(e){var t={};function n(o){if(t[o])return t[o].exports;var r=t[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}return n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(o,r,function(t){return e[t]}.bind(null,r));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=0)}([function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},r=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(e[o]=n[o])}return e};t.install=function(e){e.directive("click-outside",p)};var u=Object.create(null),i=Object.create(null),f=[u,i],c=function(e,t,n){var o=n.target,r=function(t){var r=t.el;if(r!==o&&!r.contains(o)){var u=t.binding;u.modifiers.stop&&n.stopPropagation(),u.modifiers.prevent&&n.preventDefault(),u.value.call(e,n)}};Object.keys(t).forEach(function(e){return t[e].forEach(r)})},a=function(e){c(this,u,e)},l=function(e){c(this,i,e)},d=function(e){return e?a:l},p=t.directive=Object.defineProperties({},{$_captureInstances:{value:u},$_nonCaptureInstances:{value:i},$_onCaptureEvent:{value:a},$_onNonCaptureEvent:{value:l},bind:{value:function(e,t){if("function"!=typeof t.value)throw new TypeError("Binding value must be a function.");var n=t.arg||"click",f=r({},t,{arg:n,modifiers:r({capture:!1,prevent:!1,stop:!1},t.modifiers)}),c=f.modifiers.capture,a=c?u:i;Array.isArray(a[n])||(a[n]=[]),1===a[n].push({el:e,binding:f})&&"object"===("undefined"==typeof document?"undefined":o(document))&&document&&document.addEventListener(n,d(c),c)}},unbind:{value:function(e){var t=function(t){return t.el!==e};f.forEach(function(e){var n=Object.keys(e);if(n.length){var r=e===u;n.forEach(function(n){var u=e[n].filter(t);u.length?e[n]=u:("object"===("undefined"==typeof document?"undefined":o(document))&&document&&document.removeEventListener(n,d(r),r),delete e[n])})}})}}})}])});
//# sourceMappingURL=v-click-outside-x.min.js.map
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(41)))

/***/ }),

/***/ 1454:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(1548)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(1551)
/* template */
var __vue_template__ = __webpack_require__(1553)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-35fe4027"
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
Component.options.__file = "resources\\assets\\admin\\js\\components\\map\\place-search-select.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-35fe4027", Component.options)
  } else {
    hotAPI.reload("data-v-35fe4027", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 1548:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(1549);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(4)("2c037fb6", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-35fe4027\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./place-search-select.vue", function() {
     var newContent = require("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-35fe4027\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./place-search-select.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 1549:
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(1550);

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(3)(content, options);

if(content.locals) module.exports = content.locals;

if(false) {
	module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-35fe4027\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./place-search-select.vue", function() {
		var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-35fe4027\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./place-search-select.vue");

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

/***/ 1550:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "", ""]);

// exports


/***/ }),

/***/ 1551:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _vueAmap = __webpack_require__(220);

var _transferDom = __webpack_require__(1552);

var _transferDom2 = _interopRequireDefault(_transferDom);

var _vClickOutsideX = __webpack_require__(1425);

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
        initSearch: function initSearch() {
            this.setDefaultValue();
            this.initFocus();
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

/***/ 1552:
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

/***/ 1553:
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
    require("vue-hot-reload-api")      .rerender("data-v-35fe4027", module.exports)
  }
}

/***/ }),

/***/ 2111:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(2112);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(4)("3fd69c52", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-b86f35ee\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue", function() {
     var newContent = require("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-b86f35ee\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 2112:
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(2113);

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(3)(content, options);

if(content.locals) module.exports = content.locals;

if(false) {
	module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-b86f35ee\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue", function() {
		var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-b86f35ee\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./index.vue");

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

/***/ 2113:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "", ""]);

// exports


/***/ }),

/***/ 2114:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _myLists = __webpack_require__(1214);

var _myLists2 = _interopRequireDefault(_myLists);

var _lists = __webpack_require__(1213);

var _lists2 = _interopRequireDefault(_lists);

var _index = __webpack_require__(1366);

var _index2 = _interopRequireDefault(_index);

var _view = __webpack_require__(2115);

var _view2 = _interopRequireDefault(_view);

var _update = __webpack_require__(2121);

var _update2 = _interopRequireDefault(_update);

var _create = __webpack_require__(2131);

var _create2 = _interopRequireDefault(_create);

var _remote = __webpack_require__(1215);

var _remote2 = _interopRequireDefault(_remote);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
    name: "index",
    components: { Remote: _remote2.default, CDatePicker: _index2.default, MyLists: _myLists2.default, mView: _view2.default, Update: _update2.default, Create: _create2.default },
    mixins: [_lists2.default],
    data: function data() {
        var _this = this;

        return {
            columns: [{
                title: '仓库编号',
                key: 'id'
            }, {
                title: '商户简称',
                render: function render(h, _ref) {
                    var row = _ref.row;

                    return h(
                        "span",
                        null,
                        [row.merchant ? row.merchant.short_name : '']
                    );
                }
            }, {
                title: '仓名称',
                key: 'title'
            }, {
                title: '地址',
                key: 'address',
                tooltip: true
            }, {
                title: '联系人',
                key: 'contacts'
            }, {
                title: '联系电话',
                key: 'contacts_phone'
            }, {
                title: '是否启用',
                render: function render(h, _ref2) {
                    var row = _ref2.row;

                    return h(
                        "span",
                        null,
                        [row.status === 1 ? '可用' : '不可用']
                    );
                }
            }, {
                title: '创建日期',
                key: 'create_time'
            }, {
                title: '操作',
                render: function render(h, _ref3) {
                    var row = _ref3.row;

                    return h(
                        "button-group",
                        null,
                        [h(
                            "i-button",
                            {
                                attrs: { size: "small" },
                                on: {
                                    "click": function click() {
                                        return _this.showComponent('mView', row);
                                    }
                                }
                            },
                            ["\u67E5\u770B"]
                        ), h(
                            "i-button",
                            {
                                attrs: { size: "small",
                                    disabled: row.order_count !== 0 },
                                on: {
                                    "click": function click() {
                                        return _this.showComponent('Update', row);
                                    }
                                }
                            },
                            ["\u4FEE\u6539"]
                        ), h(
                            "poptip",
                            {
                                attrs: { confirm: true, transfer: true, title: "\u786E\u5B9A\u8981\u5220\u9664\u5417\uFF1F" },
                                on: {
                                    "on-ok": function onOk() {
                                        return _this.destroyItem(row, "warehouse/" + row.id);
                                    }
                                }
                            },
                            [h(
                                "i-button",
                                {
                                    attrs: { size: "small", disabled: row.order_count !== 0 }
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
        search: function search() {
            var _this2 = this;

            var page = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;

            this.loading = true;
            this.$http.get("warehouse", { params: this.request(page) }).then(function (res) {
                _this2.assignmentData(res.data.data);
            }).finally(function () {
                _this2.loading = false;
            });
        },
        download: function download() {
            this.$http.download("warehouse/export", this.request(), '仓库列表.xls');
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

/***/ }),

/***/ 2115:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(2116)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(2119)
/* template */
var __vue_template__ = __webpack_require__(2120)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-3d88803e"
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
Component.options.__file = "resources\\assets\\admin\\js\\views\\warehouse\\view.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-3d88803e", Component.options)
  } else {
    hotAPI.reload("data-v-3d88803e", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 2116:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(2117);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(4)("ab277620", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3d88803e\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./view.vue", function() {
     var newContent = require("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3d88803e\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./view.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 2117:
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(2118);

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(3)(content, options);

if(content.locals) module.exports = content.locals;

if(false) {
	module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3d88803e\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./view.vue", function() {
		var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3d88803e\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./view.vue");

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

/***/ 2118:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.amap-page-container[data-v-3d88803e] {\n  height: 2.66666667rem;\n}", ""]);

// exports


/***/ }),

/***/ 2119:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _componentModal = __webpack_require__(1212);

var _componentModal2 = _interopRequireDefault(_componentModal);

var _component = __webpack_require__(1211);

var _component2 = _interopRequireDefault(_component);

var _index = __webpack_require__(1340);

var _index2 = _interopRequireDefault(_index);

var _index3 = __webpack_require__(1377);

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

exports.default = {
    name: "mview",
    components: { Detail: _index4.default, Box: _index2.default, ComponentModal: _componentModal2.default },
    mixins: [_component2.default],
    data: function data() {
        return {
            row: {}
        };
    },

    computed: {
        position: function position() {
            return [this.row && this.row.longitude ? this.row.longitude : 0, this.row && this.row.latitude ? this.row.latitude : 0];
        }
    },
    mounted: function mounted() {
        var _this = this;

        this.loading = true;
        this.$http.get("warehouse/" + this.data.id).then(function (res) {
            _this.row = res.data.data;
        }).finally(function () {
            _this.loading = false;
        });
    }
};

/***/ }),

/***/ 2120:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "component-modal",
    { attrs: { title: "查看仓库", loading: _vm.loading } },
    [
      _c(
        "box",
        { attrs: { title: "仓库信息" } },
        [
          _c("detail", { attrs: { title: "商户简称", span: 12 } }, [
            _vm._v(_vm._s(_vm.row.merchant ? _vm.row.merchant.short_name : ""))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "仓名称", span: 12 } }, [
            _vm._v(_vm._s(_vm.row.title))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "联系人", span: 12 } }, [
            _vm._v(_vm._s(_vm.row.contacts))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "联系人手机", span: 12 } }, [
            _vm._v(_vm._s(_vm.row.contacts_phone))
          ]),
          _vm._v(" "),
          _vm._l(_vm.row.backup_contacts, function(item, index) {
            return [
              _c("detail", { attrs: { title: "备用联系人", span: 12 } }, [
                _vm._v(_vm._s(item.name))
              ]),
              _vm._v(" "),
              _c("detail", { attrs: { title: "备用联系手机", span: 12 } }, [
                _vm._v(_vm._s(item.phone))
              ])
            ]
          }),
          _vm._v(" "),
          _c("detail", { attrs: { title: "详细地址", span: 24 } }, [
            _vm._v(_vm._s(_vm.row.address))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "位置描述", span: 24 } }, [
            _vm._v(_vm._s(_vm.row.description))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "行车指引", span: 24 } }, [
            _vm._v(_vm._s(_vm.row.instruction))
          ]),
          _vm._v(" "),
          _c("detail", { attrs: { title: "备注", span: 24 } }, [
            _vm._v(_vm._s(_vm.row.remark))
          ])
        ],
        2
      ),
      _vm._v(" "),
      _c("box", { attrs: { title: "仓库地图" } }, [
        _c(
          "div",
          { staticClass: "amap-page-container" },
          [
            _c(
              "el-amap",
              { attrs: { center: _vm.position } },
              [
                _c("el-amap-marker", {
                  attrs: { vid: "component-marker", position: _vm.position }
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
    require("vue-hot-reload-api")      .rerender("data-v-3d88803e", module.exports)
  }
}

/***/ }),

/***/ 2121:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(2122)
  __webpack_require__(2125)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(2128)
/* template */
var __vue_template__ = __webpack_require__(2130)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-cc8f1fbc"
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
Component.options.__file = "resources\\assets\\admin\\js\\views\\warehouse\\update.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-cc8f1fbc", Component.options)
  } else {
    hotAPI.reload("data-v-cc8f1fbc", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 2122:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(2123);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(4)("01d48939", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-cc8f1fbc\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./update.vue", function() {
     var newContent = require("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-cc8f1fbc\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./update.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 2123:
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(2124);

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(3)(content, options);

if(content.locals) module.exports = content.locals;

if(false) {
	module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-cc8f1fbc\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./update.vue", function() {
		var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-cc8f1fbc\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./update.vue");

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

/***/ 2124:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.amap-page-container[data-v-cc8f1fbc] {\n  height: 2.53333333rem;\n  position: relative;\n}\n.long-lat-text[data-v-cc8f1fbc] {\n  background-color: #ffffff;\n  border: 0.01333333rem #c0c0c0 solid;\n  padding: 0.02666667rem;\n  position: absolute;\n  top: 0.13333333rem;\n  right: 0.13333333rem;\n  border-radius: 0.08rem;\n}", ""]);

// exports


/***/ }),

/***/ 2125:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(2126);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(4)("50a7c343", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-cc8f1fbc\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=1!./update.vue", function() {
     var newContent = require("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-cc8f1fbc\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=1!./update.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 2126:
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(2127);

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(3)(content, options);

if(content.locals) module.exports = content.locals;

if(false) {
	module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-cc8f1fbc\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=1!./update.vue", function() {
		var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-cc8f1fbc\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=1!./update.vue");

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

/***/ 2127:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.ivu-form  .box-detail {\n  margin-bottom: 0.26666667rem;\n}", ""]);

// exports


/***/ }),

/***/ 2128:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _componentModal = __webpack_require__(1212);

var _componentModal2 = _interopRequireDefault(_componentModal);

var _component = __webpack_require__(1211);

var _component2 = _interopRequireDefault(_component);

var _index = __webpack_require__(1340);

var _index2 = _interopRequireDefault(_index);

var _index3 = __webpack_require__(1377);

var _index4 = _interopRequireDefault(_index3);

var _placeSearchSelect = __webpack_require__(1454);

var _placeSearchSelect2 = _interopRequireDefault(_placeSearchSelect);

var _update = __webpack_require__(2129);

var _form = __webpack_require__(1339);

var _form2 = _interopRequireDefault(_form);

var _remote = __webpack_require__(1215);

var _remote2 = _interopRequireDefault(_remote);

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

exports.default = {
    name: "Update",
    components: { Remote: _remote2.default, PlaceSearchSelect: _placeSearchSelect2.default, Detail: _index4.default, Box: _index2.default, ComponentModal: _componentModal2.default },
    mixins: [_component2.default, _form2.default],
    data: function data() {
        return {
            formUpdate: {
                longitude: 0,
                latitude: 0,
                backup_contacts: []
            },
            ruleUpdate: (0, _update.Validator)(this)
        };
    },

    computed: {
        longitude: function longitude() {
            return this.formUpdate.longitude;
        },
        latitude: function latitude() {
            return this.formUpdate.latitude;
        }
    },
    mounted: function mounted() {
        var _this = this;

        this.loading = true;
        this.$http.get("warehouse/" + this.data.id).then(function (res) {
            _this.formUpdate = res.data.data;
        }).finally(function () {
            _this.loading = false;
        });
    },

    methods: {
        pois: function pois(item) {
            this.formUpdate.latitude = item.location ? item.location.lat : 0;
            this.formUpdate.longitude = item.location ? item.location.lng : 0;
            this.formUpdate.description = item.address || '';
            this.formUpdate.category_zone = (item.pname || '') + ' ' + (item.cityname || '') + ' ' + (item.adname || '');
        },
        spliceContacts: function spliceContacts(index) {
            this.formUpdate.backup_contacts.splice(index, 1);
        },
        pushContacts: function pushContacts() {
            this.formUpdate.backup_contacts.push({
                name: '',
                phone: ''
            });
        }
    }
};

/***/ }),

/***/ 2129:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});
var Validator = exports.Validator = function Validator(data) {
    return {
        merchant_id: [{
            required: true,
            type: 'number',
            message: '商户简称必须填写',
            trigger: 'change'
        }],
        title: [{
            required: true,
            message: '仓名称必须填写',
            trigger: 'blur'
        }],
        contacts: [{
            required: true,
            message: '联系人必须填写',
            trigger: 'blur'
        }],
        contacts_phone: [{
            required: true,
            message: '联系人手机号码必须填写',
            trigger: 'blur'
        }],
        address: [{
            required: true,
            message: '详细地址必须填写',
            trigger: 'change'
        }]
    };
};

/***/ }),

/***/ 2130:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "component-modal",
    { attrs: { title: "查看仓库", width: 700, loading: _vm.loading } },
    [
      _c(
        "Form",
        {
          ref: "formUpdate",
          attrs: {
            model: _vm.formUpdate,
            "label-width": 90,
            rules: _vm.ruleUpdate
          }
        },
        [
          _c(
            "box",
            { attrs: { title: "仓库信息", form: "" } },
            [
              _c(
                "detail",
                { attrs: { span: 12 } },
                [
                  _c(
                    "FormItem",
                    { attrs: { prop: "merchant_id", label: "商户简称" } },
                    [
                      _vm.formUpdate.merchant
                        ? _c(
                            "Tag",
                            {
                              attrs: { type: "border", closable: "" },
                              on: {
                                "on-close": function($event) {
                                  _vm.formUpdate.merchant = null
                                }
                              }
                            },
                            [_vm._v(_vm._s(_vm.formUpdate.merchant.short_name))]
                          )
                        : _c("remote", {
                            attrs: {
                              "remote-url": "merchants/select",
                              "search-key": "title",
                              remote: true
                            },
                            model: {
                              value: _vm.formUpdate.merchant_id,
                              callback: function($$v) {
                                _vm.$set(_vm.formUpdate, "merchant_id", $$v)
                              },
                              expression: "formUpdate.merchant_id"
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
                "detail",
                { attrs: { span: 12 } },
                [
                  _c(
                    "FormItem",
                    { attrs: { prop: "title", label: "仓名称" } },
                    [
                      _c("Input", {
                        model: {
                          value: _vm.formUpdate.title,
                          callback: function($$v) {
                            _vm.$set(_vm.formUpdate, "title", $$v)
                          },
                          expression: "formUpdate.title"
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
                "detail",
                { attrs: { span: 12 } },
                [
                  _c(
                    "FormItem",
                    { attrs: { prop: "contacts", label: "联系人" } },
                    [
                      _c("Input", {
                        model: {
                          value: _vm.formUpdate.contacts,
                          callback: function($$v) {
                            _vm.$set(_vm.formUpdate, "contacts", $$v)
                          },
                          expression: "formUpdate.contacts"
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
                "detail",
                { attrs: { span: 12 } },
                [
                  _c(
                    "FormItem",
                    { attrs: { prop: "contacts_phone", label: "联系人手机" } },
                    [
                      _c("Input", {
                        model: {
                          value: _vm.formUpdate.contacts_phone,
                          callback: function($$v) {
                            _vm.$set(_vm.formUpdate, "contacts_phone", $$v)
                          },
                          expression: "formUpdate.contacts_phone"
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
                "detail",
                { attrs: { span: 20 } },
                [
                  _c(
                    "FormItem",
                    { attrs: { prop: "address", label: "详细地址" } },
                    [
                      _c("place-search-select", {
                        staticStyle: { width: "400px" },
                        on: { pois: _vm.pois },
                        model: {
                          value: _vm.formUpdate.address,
                          callback: function($$v) {
                            _vm.$set(_vm.formUpdate, "address", $$v)
                          },
                          expression: "formUpdate.address"
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
                "detail",
                { staticStyle: { "text-align": "right" }, attrs: { span: 4 } },
                [
                  _c(
                    "Button",
                    {
                      attrs: { size: "small" },
                      on: { click: _vm.pushContacts }
                    },
                    [_vm._v("添加联系人")]
                  )
                ],
                1
              ),
              _vm._v(" "),
              _vm._l(_vm.formUpdate.backup_contacts, function(item, index) {
                return [
                  _c(
                    "detail",
                    { attrs: { span: 10 } },
                    [
                      _c(
                        "FormItem",
                        {
                          key: index,
                          attrs: {
                            prop: "backup_contacts." + index + ".name",
                            rules: {
                              type: "string",
                              trigger: "blur",
                              required: true,
                              message: "备用联系人必须填写"
                            },
                            label: "备用联系人"
                          }
                        },
                        [
                          _c("Input", {
                            model: {
                              value: item.name,
                              callback: function($$v) {
                                _vm.$set(item, "name", $$v)
                              },
                              expression: "item.name"
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
                    "detail",
                    { attrs: { span: 10 } },
                    [
                      _c(
                        "FormItem",
                        {
                          key: index,
                          attrs: {
                            prop: "backup_contacts." + index + ".phone",
                            rules: {
                              type: "string",
                              trigger: "blur",
                              required: true,
                              message: "备用联系手机必须填写"
                            },
                            label: "联系手机"
                          }
                        },
                        [
                          _c("Input", {
                            model: {
                              value: item.phone,
                              callback: function($$v) {
                                _vm.$set(item, "phone", $$v)
                              },
                              expression: "item.phone"
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
                    "detail",
                    {
                      staticStyle: { "text-align": "right" },
                      attrs: { span: 4 }
                    },
                    [
                      _c(
                        "Button",
                        {
                          attrs: { size: "small" },
                          on: {
                            click: function($event) {
                              _vm.spliceContacts(index)
                            }
                          }
                        },
                        [_vm._v("删除联系人\n                    ")]
                      )
                    ],
                    1
                  )
                ]
              }),
              _vm._v(" "),
              _c(
                "detail",
                { attrs: { span: 24 } },
                [
                  _c(
                    "FormItem",
                    {
                      staticStyle: { width: "400px" },
                      attrs: { prop: "description", label: "位置描述" }
                    },
                    [
                      _c("Input", {
                        attrs: { type: "textarea" },
                        model: {
                          value: _vm.formUpdate.description,
                          callback: function($$v) {
                            _vm.$set(_vm.formUpdate, "description", $$v)
                          },
                          expression: "formUpdate.description"
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
                "detail",
                { attrs: { span: 24 } },
                [
                  _c(
                    "FormItem",
                    {
                      staticStyle: { width: "400px" },
                      attrs: { prop: "instruction", label: "行车指引" }
                    },
                    [
                      _c("Input", {
                        attrs: { type: "textarea" },
                        model: {
                          value: _vm.formUpdate.instruction,
                          callback: function($$v) {
                            _vm.$set(_vm.formUpdate, "instruction", $$v)
                          },
                          expression: "formUpdate.instruction"
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
                "detail",
                { attrs: { span: 24 } },
                [
                  _c(
                    "FormItem",
                    {
                      staticStyle: { width: "400px" },
                      attrs: { prop: "remark", label: "备注" }
                    },
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
              )
            ],
            2
          ),
          _vm._v(" "),
          _c("box", { attrs: { title: "地图页面" } }, [
            _c(
              "div",
              { staticClass: "amap-page-container" },
              [
                _c(
                  "el-amap",
                  { attrs: { center: [_vm.longitude, _vm.latitude] } },
                  [
                    _c("el-amap-marker", {
                      attrs: {
                        vid: "component-marker",
                        position: [_vm.longitude, _vm.latitude]
                      }
                    }),
                    _vm._v(" "),
                    _c("div", { staticClass: "long-lat-text" }, [
                      _vm._v(
                        "经度：" +
                          _vm._s(_vm.longitude) +
                          " ， 维度：" +
                          _vm._s(_vm.latitude)
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
                  _vm.updateSubmit("formUpdate", "warehouse/" + _vm.data.id)
                }
              }
            },
            [_vm._v("更新")]
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
    require("vue-hot-reload-api")      .rerender("data-v-cc8f1fbc", module.exports)
  }
}

/***/ }),

/***/ 2131:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(2132)
  __webpack_require__(2135)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(2138)
/* template */
var __vue_template__ = __webpack_require__(2140)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-060ef256"
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
Component.options.__file = "resources\\assets\\admin\\js\\views\\warehouse\\create.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-060ef256", Component.options)
  } else {
    hotAPI.reload("data-v-060ef256", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 2132:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(2133);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(4)("626357dd", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-060ef256\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./create.vue", function() {
     var newContent = require("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-060ef256\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./create.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 2133:
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(2134);

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(3)(content, options);

if(content.locals) module.exports = content.locals;

if(false) {
	module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-060ef256\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./create.vue", function() {
		var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-060ef256\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./create.vue");

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

/***/ 2134:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.amap-page-container[data-v-060ef256] {\n  height: 2.53333333rem;\n  position: relative;\n}\n.long-lat-text[data-v-060ef256] {\n  background-color: #ffffff;\n  border: 0.01333333rem #c0c0c0 solid;\n  padding: 0.02666667rem;\n  position: absolute;\n  top: 0.13333333rem;\n  right: 0.13333333rem;\n  border-radius: 0.08rem;\n}", ""]);

// exports


/***/ }),

/***/ 2135:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(2136);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(4)("03f1a542", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-060ef256\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=1!./create.vue", function() {
     var newContent = require("!!../../../../../../node_modules/style-loader/index.js!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-060ef256\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=1!./create.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 2136:
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(2137);

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(3)(content, options);

if(content.locals) module.exports = content.locals;

if(false) {
	module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-060ef256\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=1!./create.vue", function() {
		var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-060ef256\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/px2rem-loader/index.js?{\"remUnit\":75,\"remPrecision\":8}!../../../../../../node_modules/vux-loader/src/style-loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=1!./create.vue");

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

/***/ 2137:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.ivu-form .box-detail {\n  /*margin-bottom: 20px;*/\n}\n.amap-page-container {\n  height: 5.33333333rem;\n  position: relative;\n}\n.long-lat-text {\n  background-color: #ffffff;\n  border: 0.01333333rem #c0c0c0 solid;\n  padding: 0.02666667rem;\n  position: absolute;\n  top: 0.13333333rem;\n  right: 0.13333333rem;\n  border-radius: 0.08rem;\n}\n.checkbox-button-all {\n  vertical-align: middle;\n  display: inline-block;\n  height: 0.42666667rem;\n  line-height: 0.4rem;\n  margin: 0;\n  padding: 0 0.2rem;\n  font-size: 0.16rem;\n  color: #515a6e;\n  -webkit-transition: all .2s ease-in-out;\n  transition: all .2s ease-in-out;\n  cursor: pointer;\n  border: 0.01333333rem solid #dcdee2;\n  background: #fff;\n  position: relative;\n  border-radius: 0.05333333rem;\n}\n.checkbox-button-all-checked {\n  border-color: #2d8cf0;\n  color: #2d8cf0;\n}", ""]);

// exports


/***/ }),

/***/ 2138:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _componentModal = __webpack_require__(1212);

var _componentModal2 = _interopRequireDefault(_componentModal);

var _component = __webpack_require__(1211);

var _component2 = _interopRequireDefault(_component);

var _index = __webpack_require__(1340);

var _index2 = _interopRequireDefault(_index);

var _index3 = __webpack_require__(1377);

var _index4 = _interopRequireDefault(_index3);

var _placeSearchSelect = __webpack_require__(1454);

var _placeSearchSelect2 = _interopRequireDefault(_placeSearchSelect);

var _create = __webpack_require__(2139);

var _form = __webpack_require__(1339);

var _form2 = _interopRequireDefault(_form);

var _remote = __webpack_require__(1215);

var _remote2 = _interopRequireDefault(_remote);

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

exports.default = {
    name: 'Create',
    components: { Remote: _remote2.default, PlaceSearchSelect: _placeSearchSelect2.default, Detail: _index4.default, Box: _index2.default, ComponentModal: _componentModal2.default },
    mixins: [_component2.default, _form2.default],
    data: function data() {
        return {
            formCreate: {
                longitude: 0,
                latitude: 0,
                backup_contacts: []
            },
            ruleCreate: (0, _create.Validator)(this)
        };
    },

    computed: {
        longitude: function longitude() {
            return this.formCreate.longitude;
        },
        latitude: function latitude() {
            return this.formCreate.latitude;
        }
    },
    methods: {
        pois: function pois(item) {
            this.formCreate.latitude = item.location ? item.location.lat : 0;
            this.formCreate.longitude = item.location ? item.location.lng : 0;
            this.formCreate.description = item.address || '';
            this.formCreate.category_zone = (item.pname || '') + ' ' + (item.cityname || '') + ' ' + (item.adname || '');
        },
        spliceContacts: function spliceContacts(index) {
            this.formCreate.backup_contacts.splice(index, 1);
        },
        pushContacts: function pushContacts() {
            this.formCreate.backup_contacts.push({
                name: '',
                phone: ''
            });
        }
    }
};

/***/ }),

/***/ 2139:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});
var Validator = exports.Validator = function Validator(data) {
    return {
        merchant_id: [{
            required: true,
            type: 'number',
            message: '商户简称必须填写',
            trigger: 'change'
        }],
        title: [{
            required: true,
            message: '仓名称必须填写',
            trigger: 'blur'
        }],
        contacts: [{
            required: true,
            message: '联系人必须填写',
            trigger: 'blur'
        }],
        contacts_phone: [{
            required: true,
            message: '联系人手机号码必须填写',
            trigger: 'blur'
        }],
        address: [{
            required: true,
            message: '详细地址必须填写',
            trigger: 'change'
        }]
    };
};

/***/ }),

/***/ 2140:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "component-modal",
    { attrs: { title: "添加仓库", width: 700, loading: _vm.loading } },
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
            "box",
            { attrs: { title: "仓库信息", form: "" } },
            [
              _c(
                "detail",
                { attrs: { span: 12 } },
                [
                  _c(
                    "FormItem",
                    { attrs: { prop: "merchant_id", label: "商户简称" } },
                    [
                      _c("remote", {
                        attrs: {
                          "remote-url": "merchants/select",
                          "search-key": "title",
                          remote: true
                        },
                        model: {
                          value: _vm.formCreate.merchant_id,
                          callback: function($$v) {
                            _vm.$set(_vm.formCreate, "merchant_id", $$v)
                          },
                          expression: "formCreate.merchant_id"
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
                "detail",
                { attrs: { span: 12 } },
                [
                  _c(
                    "FormItem",
                    { attrs: { prop: "title", label: "仓名称" } },
                    [
                      _c("Input", {
                        model: {
                          value: _vm.formCreate.title,
                          callback: function($$v) {
                            _vm.$set(_vm.formCreate, "title", $$v)
                          },
                          expression: "formCreate.title"
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
                "detail",
                { attrs: { span: 12 } },
                [
                  _c(
                    "FormItem",
                    { attrs: { prop: "contacts", label: "联系人" } },
                    [
                      _c("Input", {
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
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "detail",
                { attrs: { span: 12 } },
                [
                  _c(
                    "FormItem",
                    { attrs: { prop: "contacts_phone", label: "联系人手机" } },
                    [
                      _c("Input", {
                        model: {
                          value: _vm.formCreate.contacts_phone,
                          callback: function($$v) {
                            _vm.$set(_vm.formCreate, "contacts_phone", $$v)
                          },
                          expression: "formCreate.contacts_phone"
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
                "detail",
                { attrs: { span: 20 } },
                [
                  _c(
                    "FormItem",
                    { attrs: { prop: "address", label: "详细地址" } },
                    [
                      _c("place-search-select", {
                        staticStyle: { width: "400px" },
                        on: { pois: _vm.pois },
                        model: {
                          value: _vm.formCreate.address,
                          callback: function($$v) {
                            _vm.$set(_vm.formCreate, "address", $$v)
                          },
                          expression: "formCreate.address"
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
                "detail",
                { staticStyle: { "text-align": "right" }, attrs: { span: 4 } },
                [
                  _c(
                    "Button",
                    {
                      attrs: { size: "small" },
                      on: { click: _vm.pushContacts }
                    },
                    [_vm._v("添加联系人")]
                  )
                ],
                1
              ),
              _vm._v(" "),
              _vm._l(_vm.formCreate.backup_contacts, function(item, index) {
                return [
                  _c(
                    "detail",
                    { attrs: { span: 10 } },
                    [
                      _c(
                        "FormItem",
                        {
                          key: index,
                          attrs: {
                            prop: "backup_contacts." + index + ".name",
                            rules: {
                              type: "string",
                              trigger: "blur",
                              required: true,
                              message: "备用联系人必须填写"
                            },
                            label: "备用联系人"
                          }
                        },
                        [
                          _c("Input", {
                            model: {
                              value: item.name,
                              callback: function($$v) {
                                _vm.$set(item, "name", $$v)
                              },
                              expression: "item.name"
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
                    "detail",
                    { attrs: { span: 10 } },
                    [
                      _c(
                        "FormItem",
                        {
                          key: index,
                          attrs: {
                            prop: "backup_contacts." + index + ".phone",
                            rules: {
                              type: "string",
                              trigger: "blur",
                              required: true,
                              message: "备用联系手机必须填写"
                            },
                            label: "联系手机"
                          }
                        },
                        [
                          _c("Input", {
                            model: {
                              value: item.phone,
                              callback: function($$v) {
                                _vm.$set(item, "phone", $$v)
                              },
                              expression: "item.phone"
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
                    "detail",
                    {
                      staticStyle: { "text-align": "right" },
                      attrs: { span: 4 }
                    },
                    [
                      _c(
                        "Button",
                        {
                          attrs: { size: "small" },
                          on: {
                            click: function($event) {
                              _vm.spliceContacts(index)
                            }
                          }
                        },
                        [_vm._v("删除联系人\n                    ")]
                      )
                    ],
                    1
                  )
                ]
              }),
              _vm._v(" "),
              _c(
                "detail",
                { attrs: { span: 24 } },
                [
                  _c(
                    "FormItem",
                    {
                      staticStyle: { width: "400px" },
                      attrs: { prop: "description", label: "位置描述" }
                    },
                    [
                      _c("Input", {
                        attrs: { type: "textarea" },
                        model: {
                          value: _vm.formCreate.description,
                          callback: function($$v) {
                            _vm.$set(_vm.formCreate, "description", $$v)
                          },
                          expression: "formCreate.description"
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
                "detail",
                { attrs: { span: 24 } },
                [
                  _c(
                    "FormItem",
                    {
                      staticStyle: { width: "400px" },
                      attrs: { prop: "instruction", label: "行车指引" }
                    },
                    [
                      _c("Input", {
                        attrs: { type: "textarea" },
                        model: {
                          value: _vm.formCreate.instruction,
                          callback: function($$v) {
                            _vm.$set(_vm.formCreate, "instruction", $$v)
                          },
                          expression: "formCreate.instruction"
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
                "detail",
                { attrs: { span: 24 } },
                [
                  _c(
                    "FormItem",
                    {
                      staticStyle: { width: "400px" },
                      attrs: { prop: "remark", label: "备注" }
                    },
                    [
                      _c("Input", {
                        attrs: { type: "textarea" },
                        model: {
                          value: _vm.formCreate.remark,
                          callback: function($$v) {
                            _vm.$set(_vm.formCreate, "remark", $$v)
                          },
                          expression: "formCreate.remark"
                        }
                      })
                    ],
                    1
                  )
                ],
                1
              )
            ],
            2
          ),
          _vm._v(" "),
          _c("box", { attrs: { title: "地图页面" } }, [
            _c(
              "div",
              { staticClass: "amap-page-container" },
              [
                _c(
                  "el-amap",
                  { attrs: { center: [_vm.longitude, _vm.latitude] } },
                  [
                    _c("el-amap-marker", {
                      attrs: {
                        vid: "component-marker",
                        position: [_vm.longitude, _vm.latitude]
                      }
                    }),
                    _vm._v(" "),
                    _c("div", { staticClass: "long-lat-text" }, [
                      _vm._v(
                        "经度：" +
                          _vm._s(_vm.longitude) +
                          " ， 维度：" +
                          _vm._s(_vm.latitude)
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
                  _vm.createSubmit("formCreate", "warehouse")
                }
              }
            },
            [_vm._v("创建")]
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
    require("vue-hot-reload-api")      .rerender("data-v-060ef256", module.exports)
  }
}

/***/ }),

/***/ 2141:
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
                      "search-key": "title",
                      remote: true
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
                { attrs: { label: "仓编号" } },
                [
                  _c("Input", {
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
                { attrs: { label: "仓名称" } },
                [
                  _c("Input", {
                    model: {
                      value: _vm.searchForm.title,
                      callback: function($$v) {
                        _vm.$set(_vm.searchForm, "title", $$v)
                      },
                      expression: "searchForm.title"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "FormItem",
                { attrs: { label: "创建时间" } },
                [
                  _c("c-date-picker", {
                    attrs: { type: "daterange" },
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
                          _vm.download()
                        }
                      }
                    },
                    [_vm._v("导出")]
                  ),
                  _vm._v(" "),
                  _c(
                    "Button",
                    {
                      attrs: { type: "primary" },
                      on: {
                        click: function($event) {
                          _vm.showComponent("Create")
                        }
                      }
                    },
                    [_vm._v("添加")]
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
    require("vue-hot-reload-api")      .rerender("data-v-b86f35ee", module.exports)
  }
}

/***/ })

});