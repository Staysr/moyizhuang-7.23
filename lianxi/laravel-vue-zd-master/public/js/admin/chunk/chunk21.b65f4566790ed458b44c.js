webpackJsonp([21],{"0IRZ":function(t,e,a){var n=a("p/y2");"string"==typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);a("rjj0")("2923ef86",n,!0,{})},"0eeJ":function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[t._t("default"),t._v(" "),a("div",{staticClass:"box-flex-list"},[a("Card",{attrs:{"dis-hover":""}},[a("p",{attrs:{slot:"title"},slot:"title"},[t._t("title",[a("span",[t._v("列表")])]),t._v(" "),t._t("button")],2),t._v(" "),a("my-table",{ref:"table",attrs:{columns:t.columns,data:t.value.data,size:"small","row-class-name":t.rowClassName,loading:t.loading}}),t._v(" "),a("Page",{attrs:{total:t.value.page.total,size:"small",current:t.value.page.current,"page-size":t.value.page.page_size,"show-total":""},on:{"on-change":t.change}})],1)],1)],2)},staticRenderFns:[]}},"1XX2":function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={name:"my-table",props:{data:{type:Array,default:function(){return[]}},columns:{type:Array,default:function(){return[]}},loading:{type:Boolean,default:!1}},data:function(){return{leftCol:[{title:"序号",render:function(t,e){var a=e.index;return t("span",null,[++a])},width:75}],rightCol:[]}},computed:{tableCol:function(){return this.leftCol.concat(this.columns,this.rightCol)}}}},"5EYM":function(t,e,a){(t.exports=a("FZ+f")(!1)).push([t.i,".ivu-table .table-info-row td[data-v-46901fae]{background-color:#2db7f5;color:#fff}",""])},"6NqX":function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={props:{data:{}},data:function(){return{loading:!1}},methods:{change:function(t){!1===t&&this.$emit("on-change")}}}},"A+fW":function(t,e,a){var n=a("zd+0");"string"==typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);a("rjj0")("1663c8c6",n,!0,{})},Aysg:function(t,e){t.exports={render:function(){var t=this.$createElement;return(this._self._c||t)("Table",{ref:"table",attrs:{columns:this.tableCol,data:this.data,size:"small",loading:this.loading}})},staticRenderFns:[]}},B8AP:function(t,e,a){var n=a("VU/8")(a("cUhD"),a("lqT6"),!1,function(t){a("A+fW")},"data-v-e483680a",null);t.exports=n.exports},FT8R:function(t,e,a){var n=a("VU/8")(a("cXPw"),a("a9JB"),!1,function(t){a("VsCO")},"data-v-4429e28d",null);t.exports=n.exports},GWUp:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={name:"component-modal",props:{title:{type:String,default:"弹窗"},width:{type:Number,default:650},loading:{type:Boolean,default:!1}},methods:{change:function(t){this.$parent.$emit("on-change")}}}},"HtL/":function(t,e,a){var n=a("VU/8")(a("GWUp"),a("zN6J"),!1,function(t){a("LrlP")},"data-v-67bf1da2",null);t.exports=n.exports},LrlP:function(t,e,a){var n=a("qkgB");"string"==typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);a("rjj0")("4cb8b4f2",n,!0,{})},Uo1L:function(t,e,a){var n=a("VU/8")(a("1XX2"),a("Aysg"),!1,function(t){a("0IRZ")},"data-v-7eccc0f0",null);t.exports=n.exports},VsCO:function(t,e,a){var n=a("n9P2");"string"==typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);a("rjj0")("6d87e2e6",n,!0,{})},a9JB:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("component-modal",{attrs:{title:"创建保险",loading:t.loading}},[a("Form",{ref:"formCreate",attrs:{model:t.formCreate,"label-width":100}},[a("FormItem",{attrs:{label:"保险类型：",prop:"type",rules:{required:!0,message:"请选择保险类型"}}},[a("RadioGroup",{attrs:{type:"button"},model:{value:t.formCreate.type,callback:function(e){t.$set(t.formCreate,"type",e)},expression:"formCreate.type"}},[a("Radio",{attrs:{label:1,value:1}},[t._v("商业险")]),t._v(" "),a("Radio",{attrs:{label:2,value:2}},[t._v("司机险")])],1)],1),t._v(" "),a("FormItem",{attrs:{label:"保险名称：",prop:"title",rules:{required:!0,message:"保险名称不能为空"}}},[a("Input",{attrs:{placeholder:"保险名称"},model:{value:t.formCreate.title,callback:function(e){t.$set(t.formCreate,"title",e)},expression:"formCreate.title"}})],1),t._v(" "),a("FormItem",{attrs:{label:"保障方式：",prop:"is_per",rules:{required:!0,message:"请选择保障方式"}}},[a("RadioGroup",{attrs:{type:"button"},on:{"on-change":function(e){t.change()}},model:{value:t.formCreate.is_per,callback:function(e){t.$set(t.formCreate,"is_per",e)},expression:"formCreate.is_per"}},[a("Radio",{attrs:{label:0,value:0}},[t._v("按金额购买")]),t._v(" "),a("Radio",{attrs:{label:1,value:1}},[t._v("按运费X%购买")])],1)],1),t._v(" "),a("FormItem",{attrs:{label:"保障服务费：",prop:"safe_fee",rules:{required:!0,message:"保障服务费不能为空"}}},[a("Col",{attrs:{span:"22"}},[a("Input",{attrs:{placeholder:"保障服务费"},model:{value:t.formCreate.safe_fee,callback:function(e){t.$set(t.formCreate,"safe_fee",e)},expression:"formCreate.safe_fee"}})],1),t._v(" "+t._s(this.is_per)+"\n        ")],1),t._v(" "),a("FormItem",{attrs:{label:"最高赔付：",prop:"max_payment",rules:{required:!0,message:"最高赔付不能为空"}}},[a("Row",[a("Col",{attrs:{span:"22"}},[a("Input",{attrs:{placeholder:"最高赔付"},model:{value:t.formCreate.max_payment,callback:function(e){t.$set(t.formCreate,"max_payment",e)},expression:"formCreate.max_payment"}})],1),t._v(" 万元\n            ")],1)],1),t._v(" "),a("FormItem",{attrs:{label:"是否启用：",prop:"status",rules:{required:!0,message:"请选择是否启用"}}},[a("i-switch",{attrs:{"true-value":1,"false-value":0,size:"large"},model:{value:t.formCreate.status,callback:function(e){t.$set(t.formCreate,"status",e)},expression:"formCreate.status"}},[a("span",{attrs:{slot:"open"},slot:"open"},[t._v("是")]),t._v(" "),a("span",{attrs:{slot:"close"},slot:"close"},[t._v("否")])])],1)],1),t._v(" "),a("div",{attrs:{slot:"footer"},slot:"footer"},[a("Button",{attrs:{type:"primary",loading:t.loading},on:{click:function(e){t.createSubmit("formCreate","safe/store")}}},[t._v("创建")])],1)],1)},staticRenderFns:[]}},cUhD:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var n=s(a("dSCJ")),r=s(a("h7KM")),o=s(a("FT8R"));function s(t){return t&&t.__esModule?t:{default:t}}e.default={components:{MyLists:n.default,Create:o.default},mixins:[r.default],name:"index",data:function(){var t=this;return{columns:[{title:"保险类型",render:function(t,e){return t("span",null,[1===e.row.type?"商户险":"司机险"])}},{title:"保险名称",key:"title"},{title:"保障服务费",render:function(t,e){return t("span",null,[e.row.safe_fee,"元"])}},{title:"最高赔付",render:function(t,e){return t("span",null,[e.row.max_payment,"万元"])}},{title:"状态",render:function(t,e){return 1===e.row.status?t("span",null,["启用"]):t("span",{style:"color:red"},["禁用"])}},{title:"操作",render:function(e,a){var n=a.row;return e("button-group",null,[e("poptip",{attrs:{confirm:!0,transfer:!0,title:"确定要切换状态吗？"},on:{"on-ok":function(){return t.cutoverStatus(n,"safe/"+n.id+"/status")}}},[1===n.status?e("i-button",{attrs:{size:"small"}},["禁用"]):e("i-button",{attrs:{type:"primary",size:"small"}},["启用"])])])}}]}},methods:{search:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:1;this.loading=!0,this.$http.get("safe/index",{params:this.request(e)}).then(function(e){t.assignmentData(e.data.data)}).finally(function(){t.loading=!1})},cutoverStatus:function(t,e){var a=this;this.$http.put(e,{status:1===t.status?0:1}).then(function(t){a.$Message.success(t.data.message),a.search()}).catch(function(t){a.formatErrors(t)})}}}},cXPw:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var n=s(a("HtL/")),r=s(a("xi7R")),o=s(a("6NqX"));function s(t){return t&&t.__esModule?t:{default:t}}e.default={name:"create",components:{ComponentModal:n.default},mixins:[r.default,o.default],data:function(){return{is_per:"元",formCreate:{type:1,title:"",is_per:0,safe_fee:"",max_payment:"",status:1}}},methods:{change:function(){this.is_per="元"===this.is_per?"%":"元"}}}},dSCJ:function(t,e,a){var n=a("VU/8")(a("tCFX"),a("0eeJ"),!1,function(t){a("qN8B")},"data-v-46901fae",null);t.exports=n.exports},h7KM:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var n,r=a("nf43"),o=(n=r)&&n.__esModule?n:{default:n};e.default={mixins:[o.default],data:function(){return{searchForm:{},lists:{data:{data:[],page:{total:0,current:1,page_size:20}}},component:{current:"",data:{}}}},mounted:function(){this.search()},methods:{search:function(){arguments.length>0&&void 0!==arguments[0]&&arguments[0]},assignmentData:function(t){this.lists.data.data=t.data,this.lists.data.page.total=t.total,this.lists.data.page.current=t.current_page,this.lists.data.page.page_size=t.per_page},showComponent:function(t,e){this.component.current=t,this.component.data=e},hideComponent:function(){this.component.current="",this.component.data={},this.search()},destroyItem:function(t,e){var a=this;this.loading=!0,this.$http.delete(e).then(function(t){a.search()}).catch(function(t){a.formatErrors(t)}).finally(function(){a.loading=!1})},request:function(t){var e=JSON.parse(JSON.stringify(this.searchForm));return e.page=t,e}}}},lqT6:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("my-lists",{attrs:{columns:t.columns,loading:t.loading},model:{value:t.lists.data,callback:function(e){t.$set(t.lists,"data",e)},expression:"lists.data"}},[a("p",{attrs:{slot:"title"},slot:"title"},[a("span",[t._v("列表")]),t._v(" "),a("Button",{attrs:{size:"small",type:"success"},on:{click:function(e){t.showComponent("Create")}}},[t._v("添加")])],1),t._v(" "),a(t.component.current,{tag:"components",attrs:{data:t.component.data},on:{"on-change":t.hideComponent}})],1)},staticRenderFns:[]}},n9P2:function(t,e,a){(t.exports=a("FZ+f")(!1)).push([t.i,"",""])},"p/y2":function(t,e,a){(t.exports=a("FZ+f")(!1)).push([t.i,"",""])},qN8B:function(t,e,a){var n=a("5EYM");"string"==typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);a("rjj0")("78e1c74c",n,!0,{})},qkgB:function(t,e,a){(t.exports=a("FZ+f")(!1)).push([t.i,".modal-body[data-v-67bf1da2]{max-height:650px;overflow-y:auto}",""])},tCFX:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var n,r=a("Uo1L"),o=(n=r)&&n.__esModule?n:{default:n};e.default={name:"my-lists",components:{MyTable:o.default},props:{value:{type:Object,default:function(){return{data:[],page:{total:100,current:1,page_size:20}}}},columns:{type:Array,default:function(){return[]}},loading:{type:Boolean,default:!1}},methods:{change:function(t){this.$emit("change",t)},rowClassName:function(t,e){}}}},xi7R:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var n,r=a("nf43"),o=(n=r)&&n.__esModule?n:{default:n};e.default={mixins:[o.default],methods:{unObserver:function(t){return JSON.parse(JSON.stringify(t))},updateSubmit:function(t,e){var a=this;this.$refs[t].validate(function(n){n?(a.loading=!0,a.$http.put(e,a.unObserver(a._data[t])).then(function(t){a.$Message.success("Success!"),a.change(!1)}).catch(function(t){a.formatErrors(t)}).finally(function(){a.loading=!1})):a.$Message.error("验证不通过!")})},createSubmit:function(t,e){var a=this;this.$refs[t].validate(function(n){n&&(a.loading=!0,a.$http.post(e,a._data[t]).then(function(t){a.$Message.success("Success!"),a.change(!1)}).catch(function(t){a.formatErrors(t)}).finally(function(){a.loading=!1}))})}}}},zN6J:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("Modal",{staticStyle:{position:"relative"},attrs:{title:t.title,value:!0,transfer:!1,"mask-closable":!1,width:t.width},on:{"on-visible-change":t.change}},[t.loading?a("Spin",{attrs:{size:"large",fix:""}}):t._e(),t._v(" "),a("div",{staticClass:"modal-body"},[t._t("default")],2),t._v(" "),a("div",{attrs:{slot:"footer"},slot:"footer"},[t._t("footer")],2)],1)},staticRenderFns:[]}},"zd+0":function(t,e,a){(t.exports=a("FZ+f")(!1)).push([t.i,"",""])}});