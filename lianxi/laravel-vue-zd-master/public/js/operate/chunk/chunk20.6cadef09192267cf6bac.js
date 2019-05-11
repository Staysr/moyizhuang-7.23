webpackJsonp([20],{"+3Os":function(e,t){e.exports={render:function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("i-select",{ref:e.uuid,staticClass:"remote-select",attrs:{filterable:e.remote,remote:e.remote,"remote-method":e.remoteMethod,clearable:"",loading:e.loading},on:{"on-change":e.setValue},model:{value:e.publicValue,callback:function(t){e.publicValue=t},expression:"publicValue"}},e._l(e.options,function(t,r){return a("i-option",{key:t.id,attrs:{value:t.id}},[e._v(e._s(t.name))])}))},staticRenderFns:[]}},"1Cn+":function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=i(a("HtL/")),o=i(a("xi7R")),n=a("pDQs"),s=i(a("6NqX")),l=i(a("KrrG"));function i(e){return e&&e.__esModule?e:{default:e}}t.default={name:"update",components:{Remote:l.default,ComponentModal:r.default},mixins:[s.default,o.default],data:function(){return{authority_levels:[{id:0,name:"全部"},{id:1,name:"客户顾问"},{id:2,name:"运行经理"},{id:3,name:"扩展经理"},{id:4,name:"品质交互经理"}],formUpdate:{name:"",phone:"",role:"",password:"",password_confirmation:"",status:1,manager:0,authority_level:"",sex:0,job_number:"",contact:"",birthday:""},ruleUpdate:(0,n.Validator)(this)}},mounted:function(){var e=this;this.$nextTick(function(){e.loading=!0,e.$http.get("admin/"+e.data.id).then(function(t){e.formUpdate=Object.assign(e.unObserver(e.formUpdate),t.data.data)}).catch(function(t){e.formatErrors(t)}).finally(function(){e.loading=!1})})},methods:{changRole:function(e){this.formUpdate.authority_level=null,e&&e.authority&&1==e.authority?this.authority_levels=[{id:1,name:"客户顾问"},{id:2,name:"运行经理"},{id:3,name:"扩展经理"},{id:4,name:"品质交互经理"}]:this.authority_levels=[{id:0,name:"全部"}]}}}},"4ud/":function(e,t){e.exports={render:function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("component-modal",{attrs:{title:"更新用户",loading:e.loading}},[a("Form",{ref:"formUpdate",attrs:{model:e.formUpdate,"label-width":80,rules:e.ruleUpdate}},[a("FormItem",{attrs:{label:"用户姓名",prop:"name"}},[a("Input",{attrs:{placeholder:"用户姓名",clearable:""},model:{value:e.formUpdate.name,callback:function(t){e.$set(e.formUpdate,"name",t)},expression:"formUpdate.name"}})],1),e._v(" "),a("FormItem",{attrs:{label:"手机号码",prop:"phone"}},[a("Input",{attrs:{placeholder:"手机号码",clearable:""},model:{value:e.formUpdate.phone,callback:function(t){e.$set(e.formUpdate,"phone",t)},expression:"formUpdate.phone"}})],1),e._v(" "),a("FormItem",{attrs:{label:"密码",prop:"password"}},[a("Input",{attrs:{type:"password",placeholder:"无输入则不更新密码",clearable:""},model:{value:e.formUpdate.password,callback:function(t){e.$set(e.formUpdate,"password",t)},expression:"formUpdate.password"}})],1),e._v(" "),a("FormItem",{attrs:{label:"确认密码",prop:"password_confirmation"}},[a("Input",{attrs:{type:"password",placeholder:"确认密码",clearable:""},model:{value:e.formUpdate.password_confirmation,callback:function(t){e.$set(e.formUpdate,"password_confirmation",t)},expression:"formUpdate.password_confirmation"}})],1),e._v(" "),a("FormItem",{attrs:{label:"所属角色",prop:"role"}},[a("remote",{attrs:{"remote-url":"role/select",remote:!1,ready:!0},on:{"on-change":e.changRole},model:{value:e.formUpdate.role,callback:function(t){e.$set(e.formUpdate,"role",t)},expression:"formUpdate.role"}})],1),e._v(" "),a("FormItem",{attrs:{label:"权限等级",prop:"authority_level"}},[a("Select",{attrs:{placeholder:"请选择等级",clearable:""},model:{value:e.formUpdate.authority_level,callback:function(t){e.$set(e.formUpdate,"authority_level",t)},expression:"formUpdate.authority_level"}},e._l(e.authority_levels,function(t,r){return a("Option",{key:r,attrs:{value:t.id}},[e._v(e._s(t.name)+"\n                ")])}))],1),e._v(" "),a("FormItem",{attrs:{label:"是否启用",prop:"status"}},[a("RadioGroup",{attrs:{type:"button"},model:{value:e.formUpdate.status,callback:function(t){e.$set(e.formUpdate,"status",t)},expression:"formUpdate.status"}},[a("Radio",{attrs:{label:1,value:1}},[e._v("是")]),e._v(" "),a("Radio",{attrs:{label:0,value:0}},[e._v("否")])],1)],1),e._v(" "),a("FormItem",{attrs:{label:"性别",prop:"sex"}},[a("RadioGroup",{attrs:{type:"button"},model:{value:e.formUpdate.sex,callback:function(t){e.$set(e.formUpdate,"sex",t)},expression:"formUpdate.sex"}},[a("Radio",{attrs:{label:1,value:1}},[e._v("男")]),e._v(" "),a("Radio",{attrs:{label:2,value:2}},[e._v("女")])],1)],1),e._v(" "),a("FormItem",{attrs:{label:"工号",prop:"job_number"}},[a("Input",{attrs:{placeholder:"工号",clearable:""},model:{value:e.formUpdate.job_number,callback:function(t){e.$set(e.formUpdate,"job_number",t)},expression:"formUpdate.job_number"}})],1),e._v(" "),a("FormItem",{attrs:{label:"联系电话",prop:"contact"}},[a("Input",{attrs:{placeholder:"联系电话",clearable:""},model:{value:e.formUpdate.contact,callback:function(t){e.$set(e.formUpdate,"contact",t)},expression:"formUpdate.contact"}})],1),e._v(" "),a("FormItem",{attrs:{label:"生日",prop:"birthday"}},[a("DatePicker",{attrs:{type:"date",placement:"top",placeholder:"生日",clearable:""},model:{value:e.formUpdate.birthday,callback:function(t){e.$set(e.formUpdate,"birthday",t)},expression:"formUpdate.birthday"}})],1)],1),e._v(" "),a("div",{attrs:{slot:"footer"},slot:"footer"},[a("Button",{attrs:{type:"primary",loading:e.loading},on:{click:function(t){e.updateSubmit("formUpdate","admin/"+e.data.id)}}},[e._v("更新\n        ")])],1)],1)},staticRenderFns:[]}},"5IxC":function(e,t,a){(e.exports=a("FZ+f")(!1)).push([e.i,".modal-body[data-v-67bf1da2]{max-height:8.66666667rem;overflow-y:auto}",""])},"5Qa0":function(e,t,a){var r=a("eive");"string"==typeof r&&(r=[[e.i,r,""]]),r.locals&&(e.exports=r.locals);a("rjj0")("26316a8c",r,!0,{})},"5mcM":function(e,t,a){var r=a("5IxC");"string"==typeof r&&(r=[[e.i,r,""]]);var o={hmr:!0,transform:void 0,insertInto:void 0};a("MTIv")(r,o);r.locals&&(e.exports=r.locals)},"5zC9":function(e,t,a){(e.exports=a("FZ+f")(!1)).push([e.i,".ivu-table .table-info-row td[data-v-46901fae]{background-color:#2db7f5;color:#fff}",""])},"6NqX":function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default={props:{data:{}},data:function(){return{loading:!1}},methods:{change:function(e){!1===e&&this.$emit("on-change")}}}},"8IMW":function(e,t,a){(e.exports=a("FZ+f")(!1)).push([e.i,"",""])},"8Zki":function(e,t,a){var r=a("FjqK");"string"==typeof r&&(r=[[e.i,r,""]]),r.locals&&(e.exports=r.locals);a("rjj0")("b19b766a",r,!0,{})},BCDU:function(e,t){e.exports={render:function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("Select",{attrs:{clearable:""},on:{"on-change":e.setValue},model:{value:e.model,callback:function(t){e.model=t},expression:"model"}},[a("Option",{attrs:{value:1}},[e._v(e._s(e.trueValueModel))]),e._v(" "),a("Option",{attrs:{value:0}},[e._v(e._s(e.falseValueModel))])],1)},staticRenderFns:[]}},DVXi:function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0});t.Validator=function(e){return{name:[{required:!0,type:"string",message:"用户姓名不能为空",trigger:"blur"},{type:"string",min:2,max:10,message:"用户姓名必须在 2 到 10 个字符之间",trigger:"blur"}],phone:[{required:!0,message:"手机号码不能为空",trigger:"blur"},{pattern:/^1[34578]\d{9}$/,message:"手机号码格式不正确",trigger:"blur"}],email:[{required:!0,message:"用户邮箱不能为空",trigger:"blur"},{type:"email",message:"邮箱格式不正确",trigger:"blur"}],role:[{required:!0,type:"number",message:"用户角色必须选择",trigger:"change"}],password:[{required:!0,message:"用户密码不能为空",trigger:"blur"},{min:6,max:20,type:"string",message:"用户密码必须在 6 到 20 个字符之间",trigger:"blur"}],password_confirmation:[{required:!0,message:"确认密码不能为空",trigger:"blur"},{validator:function(t,a,r){e.formCreate.password!==a?r(new Error("两次密码输入不一致")):r()},trigger:"blur"}],authority_level:[{required:!0,type:"number",message:"权限等级必须选择",trigger:"change"}]}}},FSn4:function(e,t){e.exports={render:function(){var e=this.$createElement;return(this._self._c||e)("Table",{ref:"table",attrs:{columns:this.tableCol,data:this.data,size:"small",loading:this.loading}})},staticRenderFns:[]}},FjqK:function(e,t,a){var r=a("u0ja");"string"==typeof r&&(r=[[e.i,r,""]]);var o={hmr:!0,transform:void 0,insertInto:void 0};a("MTIv")(r,o);r.locals&&(e.exports=r.locals)},H2ef:function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default={name:"my-table",props:{data:{type:Array,default:function(){return[]}},columns:{type:Array,default:function(){return[]}},loading:{type:Boolean,default:!1}},data:function(){return{leftCol:[{title:"序号",render:function(e,t){var a=t.index;return e("span",null,[++a])},width:75}],rightCol:[]}},computed:{tableCol:function(){return this.leftCol.concat(this.columns,this.rightCol)}}}},"HtL/":function(e,t,a){var r=a("VU/8")(a("cgbW"),a("I2F8"),!1,function(e){a("RQOa")},"data-v-67bf1da2",null);e.exports=r.exports},I2F8:function(e,t){e.exports={render:function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("Modal",{staticStyle:{position:"relative"},attrs:{title:e.title,value:!0,transfer:!1,"mask-closable":!1,width:e.width},on:{"on-visible-change":e.change}},[e.loading?a("Spin",{attrs:{size:"large",fix:""}}):e._e(),e._v(" "),a("div",{staticClass:"modal-body"},[e._t("default")],2),e._v(" "),a("div",{attrs:{slot:"footer"},slot:"footer"},[e._t("footer")],2)],1)},staticRenderFns:[]}},JEfw:function(e,t,a){var r=a("uI88");"string"==typeof r&&(r=[[e.i,r,""]]),r.locals&&(e.exports=r.locals);a("rjj0")("0840721c",r,!0,{})},JtOP:function(e,t,a){var r=a("VU/8")(a("dITg"),a("BCDU"),!1,function(e){a("XhEF")},"data-v-403dbbd7",null);e.exports=r.exports},KrrG:function(e,t,a){var r=a("VU/8")(a("hd7X"),a("+3Os"),!1,function(e){a("ZTA/")},"data-v-9fb5ba38",null);e.exports=r.exports},NDCw:function(e,t){e.exports={render:function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",[e._t("default"),e._v(" "),a("div",{staticClass:"box-flex-list"},[a("Card",{attrs:{"dis-hover":""}},[a("p",{attrs:{slot:"title"},slot:"title"},[e._t("title",[a("span",[e._v("列表")])]),e._v(" "),e._t("button")],2),e._v(" "),a("my-table",{ref:"table",attrs:{columns:e.columns,data:e.value.data,size:"small","row-class-name":e.rowClassName,loading:e.loading}}),e._v(" "),a("Page",{attrs:{total:e.value.page.total,size:"small",current:e.value.page.current,"page-size":e.value.page.page_size,"show-total":""},on:{"on-change":e.change}})],1)],1)],2)},staticRenderFns:[]}},PYbh:function(e,t){e.exports={render:function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("component-modal",{attrs:{title:"创建用户",loading:e.loading}},[a("Form",{ref:"formCreate",attrs:{model:e.formCreate,"label-width":80,rules:e.ruleCreate}},[a("FormItem",{attrs:{label:"用户姓名",prop:"name"}},[a("Input",{attrs:{placeholder:"用户姓名",clearable:""},model:{value:e.formCreate.name,callback:function(t){e.$set(e.formCreate,"name",t)},expression:"formCreate.name"}})],1),e._v(" "),a("FormItem",{attrs:{label:"手机号码",prop:"phone"}},[a("Input",{attrs:{placeholder:"手机号码",clearable:""},model:{value:e.formCreate.phone,callback:function(t){e.$set(e.formCreate,"phone",t)},expression:"formCreate.phone"}})],1),e._v(" "),a("FormItem",{attrs:{label:"密码",prop:"password"}},[a("Input",{attrs:{type:"password",placeholder:"用户密码",clearable:""},model:{value:e.formCreate.password,callback:function(t){e.$set(e.formCreate,"password",t)},expression:"formCreate.password"}})],1),e._v(" "),a("FormItem",{attrs:{label:"确认密码",prop:"password_confirmation"}},[a("Input",{attrs:{type:"password",placeholder:"确认密码",clearable:""},model:{value:e.formCreate.password_confirmation,callback:function(t){e.$set(e.formCreate,"password_confirmation",t)},expression:"formCreate.password_confirmation"}})],1),e._v(" "),a("FormItem",{attrs:{label:"所属角色",prop:"role"}},[a("remote",{attrs:{"remote-url":"role/select",remote:!1,ready:!0},on:{"on-change":e.changRole},model:{value:e.formCreate.role,callback:function(t){e.$set(e.formCreate,"role",t)},expression:"formCreate.role"}})],1),e._v(" "),a("FormItem",{attrs:{label:"权限等级",prop:"authority_level"}},[a("i-select",{attrs:{placeholder:"请选择等级",clearable:""},model:{value:e.formCreate.authority_level,callback:function(t){e.$set(e.formCreate,"authority_level",t)},expression:"formCreate.authority_level"}},e._l(e.authority_levels,function(t,r){return a("Option",{key:r,attrs:{value:t.id}},[e._v(e._s(t.name)+"\n                ")])}))],1),e._v(" "),a("FormItem",{attrs:{label:"是否启用",prop:"status"}},[a("RadioGroup",{attrs:{type:"button"},model:{value:e.formCreate.status,callback:function(t){e.$set(e.formCreate,"status",t)},expression:"formCreate.status"}},[a("Radio",{attrs:{label:1,value:1}},[e._v("是")]),e._v(" "),a("Radio",{attrs:{label:0,value:0}},[e._v("否")])],1)],1),e._v(" "),a("FormItem",{attrs:{label:"性别",prop:"sex"}},[a("RadioGroup",{attrs:{type:"button"},model:{value:e.formCreate.sex,callback:function(t){e.$set(e.formCreate,"sex",t)},expression:"formCreate.sex"}},[a("Radio",{attrs:{label:1,value:1}},[e._v("男")]),e._v(" "),a("Radio",{attrs:{label:2,value:2}},[e._v("女")])],1)],1),e._v(" "),a("FormItem",{attrs:{label:"工号",prop:"job_number"}},[a("Input",{attrs:{placeholder:"工号",clearable:""},model:{value:e.formCreate.job_number,callback:function(t){e.$set(e.formCreate,"job_number",t)},expression:"formCreate.job_number"}})],1),e._v(" "),a("FormItem",{attrs:{label:"联系电话",prop:"contact"}},[a("Input",{attrs:{placeholder:"联系电话",clearable:""},model:{value:e.formCreate.contact,callback:function(t){e.$set(e.formCreate,"contact",t)},expression:"formCreate.contact"}})],1),e._v(" "),a("FormItem",{attrs:{label:"生日",prop:"birthday"}},[a("DatePicker",{attrs:{type:"date",placement:"top",placeholder:"生日",clearable:""},model:{value:e.formCreate.birthday,callback:function(t){e.$set(e.formCreate,"birthday",t)},expression:"formCreate.birthday"}})],1)],1),e._v(" "),a("div",{attrs:{slot:"footer"},slot:"footer"},[a("Button",{attrs:{type:"primary",loading:e.loading},on:{click:function(t){e.createSubmit("formCreate","admin")}}},[e._v("创建")])],1)],1)},staticRenderFns:[]}},RQOa:function(e,t,a){var r=a("5mcM");"string"==typeof r&&(r=[[e.i,r,""]]),r.locals&&(e.exports=r.locals);a("rjj0")("8c8ae600",r,!0,{})},SaAI:function(e,t,a){var r=a("doa3");"string"==typeof r&&(r=[[e.i,r,""]]);var o={hmr:!0,transform:void 0,insertInto:void 0};a("MTIv")(r,o);r.locals&&(e.exports=r.locals)},"SiY/":function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r,o=a("Uo1L"),n=(r=o)&&r.__esModule?r:{default:r};t.default={name:"my-lists",components:{MyTable:n.default},props:{value:{type:Object,default:function(){return{data:[],page:{total:100,current:1,page_size:20}}}},columns:{type:Array,default:function(){return[]}},loading:{type:Boolean,default:!1}},methods:{change:function(e){this.$emit("change",e)},rowClassName:function(e,t){}}}},SzSi:function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=u(a("HtL/")),o=u(a("xi7R")),n=u(a("bO6f")),s=a("DVXi"),l=u(a("6NqX")),i=u(a("KrrG"));function u(e){return e&&e.__esModule?e:{default:e}}t.default={name:"create",components:{Remote:i.default,PhotoOnce:n.default,ComponentModal:r.default},mixins:[l.default,o.default],data:function(){return{authority_levels:[{id:0,name:"全部"},{id:1,name:"客户顾问"},{id:2,name:"运行经理"},{id:3,name:"扩展经理"},{id:4,name:"品质交互经理"}],formCreate:{name:"",phone:"",role:"",password:"",password_confirmation:"",status:1,manager:0,authority_level:"",sex:0,job_number:"",contact:"",birthday:""},ruleCreate:(0,s.Validator)(this)}},methods:{changRole:function(e){this.formCreate.authority_level=null,e&&e.authority&&1==e.authority?this.authority_levels=[{id:1,name:"客户顾问"},{id:2,name:"运行经理"},{id:3,name:"扩展经理"},{id:4,name:"品质交互经理"}]:this.authority_levels=[{id:0,name:"全部"}]}}}},UM8K:function(e,t,a){var r=a("VU/8")(a("SzSi"),a("PYbh"),!1,function(e){a("c+x6")},"data-v-e0a3f1b0",null);e.exports=r.exports},Uo1L:function(e,t,a){var r=a("VU/8")(a("H2ef"),a("FSn4"),!1,function(e){a("8Zki")},"data-v-7eccc0f0",null);e.exports=r.exports},V9MT:function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=i(a("dSCJ")),o=i(a("h7KM")),n=i(a("lnaK")),s=i(a("UM8K")),l=i(a("JtOP"));function i(e){return e&&e.__esModule?e:{default:e}}t.default={name:"index",components:{TrueOrFalse:l.default,MyLists:r.default,Create:s.default,Update:n.default},mixins:[o.default],data:function(){var e=this;return{columns:[{title:"用户姓名",render:function(e,t){return e("span",null,[t.row.name])}},{title:"手机号码",key:"phone"},{title:"所属角色",render:function(e,t){var a=t.row;return e("span",null,[a.roles?a.roles.name:""])}},{title:"数据权限",render:function(e,t){switch(t.row.authority_level){case 0:return e("span",null,["全部"]);case 1:return e("span",null,["客户顾问"]);case 2:return e("span",null,["运行经理"]);case 3:return e("span",null,["拓展经理"]);case 4:return e("span",null,["品质交互经理"])}}},{title:"是否部门负责人",render:function(e,t){return e("span",null,[1===t.row.manager?"是":"否"])}},{title:"状态",render:function(e,t){return e("span",null,[1===t.row.status?"开启":"关闭"])}},{title:"操作",render:function(t,a){var r=a.row;r.roles&&r.roles.is_admin;return t("button-group",null,[t("i-button",{attrs:{size:"small",disabled:r.roles&&0!==r.roles.is_admin},on:{click:function(){return e.showComponent("Update",r)}}},["修改"]),t("poptip",{attrs:{confirm:!0,transfer:!0,title:"确定要删除吗？"},on:{"on-ok":function(){return e.destroyItem(r,"admin/"+r.id)}}},[t("i-button",{attrs:{size:"small",disabled:r.roles&&0!==r.roles.is_admin}},["删除"])])])}}]}},methods:{search:function(){var e=this,t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:1;this.loading=!0,this.$http.get("admin",{params:this.request(t)}).then(function(t){e.assignmentData(t.data.data)}).catch(function(t){e.formatErrors(t)}).finally(function(){e.loading=!1})}}}},XhEF:function(e,t,a){var r=a("o/j/");"string"==typeof r&&(r=[[e.i,r,""]]),r.locals&&(e.exports=r.locals);a("rjj0")("365b32e8",r,!0,{})},"ZTA/":function(e,t,a){var r=a("SaAI");"string"==typeof r&&(r=[[e.i,r,""]]),r.locals&&(e.exports=r.locals);a("rjj0")("e5ae1928",r,!0,{})},ahQX:function(e,t,a){var r=a("ajlx");"string"==typeof r&&(r=[[e.i,r,""]]);var o={hmr:!0,transform:void 0,insertInto:void 0};a("MTIv")(r,o);r.locals&&(e.exports=r.locals)},ajlx:function(e,t,a){(e.exports=a("FZ+f")(!1)).push([e.i,"",""])},bt0p:function(e,t,a){var r=a("VU/8")(a("V9MT"),a("mBJT"),!1,function(e){a("JEfw")},"data-v-68471bc7",null);e.exports=r.exports},"c+x6":function(e,t,a){var r=a("w65p");"string"==typeof r&&(r=[[e.i,r,""]]),r.locals&&(e.exports=r.locals);a("rjj0")("e00791e4",r,!0,{})},cgbW:function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default={name:"component-modal",props:{title:{type:String,default:"弹窗"},width:{type:Number,default:650},loading:{type:Boolean,default:!1}},methods:{change:function(e){this.$parent.$emit("on-change")}}}},dITg:function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default={name:"true-or-false",props:{value:[String,Number],trueValue:{type:String,default:"是"},falseValue:{type:String,default:"否"}},data:function(){return{model:this.value,trueValueModel:this.trueValue,falseValueModel:this.falseValue}},methods:{setValue:function(e){this.$emit("input",e)}},watch:{value:function(e){this.model=e},falseValue:function(e){this.falseValueModel=e},trueValue:function(e){this.trueValueModel=e}}}},dSCJ:function(e,t,a){var r=a("VU/8")(a("SiY/"),a("NDCw"),!1,function(e){a("5Qa0")},"data-v-46901fae",null);e.exports=r.exports},doa3:function(e,t,a){(e.exports=a("FZ+f")(!1)).push([e.i,".remote-select[data-v-9fb5ba38]{width:2rem}",""])},eive:function(e,t,a){var r=a("5zC9");"string"==typeof r&&(r=[[e.i,r,""]]);var o={hmr:!0,transform:void 0,insertInto:void 0};a("MTIv")(r,o);r.locals&&(e.exports=r.locals)},h7KM:function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r,o=a("nf43"),n=(r=o)&&r.__esModule?r:{default:r};t.default={mixins:[n.default],data:function(){return{searchForm:{},lists:{data:{data:[],page:{total:0,current:1,page_size:20}}},component:{current:"",data:{}}}},mounted:function(){this.search()},methods:{search:function(){arguments.length>0&&void 0!==arguments[0]&&arguments[0]},assignmentData:function(e){this.lists.data.data=e.data,this.lists.data.page.total=e.total,this.lists.data.page.current=e.current_page,this.lists.data.page.page_size=e.per_page},showComponent:function(e,t){this.component.current=e,this.component.data=t},hideComponent:function(){this.component.current="",this.component.data={},this.search()},destroyItem:function(e,t){var a=this;this.loading=!0,this.$http.delete(t).then(function(e){a.search()}).catch(function(e){a.formatErrors(e)}).finally(function(){a.loading=!1})},request:function(e){var t=JSON.parse(JSON.stringify(this.searchForm));return t.page=e,t}}}},hd7X:function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=n(a("nf43")),o=n(a("BtGT"));function n(e){return e&&e.__esModule?e:{default:e}}t.default={name:"remote",mixins:[r.default,o.default],props:{remoteUrl:{type:String,default:"",required:!0},remote:{type:Boolean,default:!0},cache:{type:Boolean,default:!0},ready:{type:Boolean,default:!1},params:{type:Object,default:function(){}},searchKey:{type:String,default:"name"},value:{type:[String,Number]}},data:function(){return{publicValue:"",publicOptions:[],publicParams:{},options:this.defaultOption()}},mounted:function(){this.ready&&this.request()},methods:{setValue:function(e){this.$emit("input",e),this.$emit("on-change",this.options.find(function(t){return t.id===e}))},remoteMethod:function(e){var t=this;this.options.find(function(e){return e.id===t.$refs[t.uuid].publicValue})&&this.options.find(function(e){return e.id===t.$refs[t.uuid].publicValue}).name===e||this.remote&&(this.publicParams[this.searchKey]=e,this.request())},request:function(){var e=this;0===this.$store.getters.cache(this.key()).length?this.$store.getters.cacheLock(this.key())?(this.loading=!0,setTimeout(function(){e.refresh(),e.loading=!1},4e3)):this.search():this.refresh()},search:function(){var e=this;this.loading=!0,this.$store.commit("setCacheLock",this.key()),this.$http.get(this.remoteUrl,{params:this.getParams()}).then(function(t){e.cache?e.$store.commit("setCacheData",{key:e.key(),data:t.data.data}):e.publicOptions=t.data.data}).finally(function(){e.refresh(),e.loading=!1})},defaultOption:function(){return this.cache?this.$store.getters.cache(this.key()):this.publicOptions},key:function(){return this.remoteUrl+JSON.stringify(this.getParams())},refresh:function(){this.options=this.cache?this.$store.getters.cache(this.key()):this.publicOptions},getParams:function(){return Object.assign({},this.params,this.publicParams)},unObserver:function(e){return JSON.parse(JSON.stringify(e))}},watch:{params:{handler:function(e,t){JSON.stringify(e)!==JSON.stringify(t)&&(this.$refs[this.uuid].clearSingleSelect(),this.request())},deep:!0},value:{handler:function(e){this.publicValue=e},immediate:!0}}}},jqVL:function(e,t,a){(e.exports=a("FZ+f")(!1)).push([e.i,"",""])},lnaK:function(e,t,a){var r=a("VU/8")(a("1Cn+"),a("4ud/"),!1,function(e){a("tphE")},"data-v-5d5bf6c4",null);e.exports=r.exports},mBJT:function(e,t){e.exports={render:function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("my-lists",{attrs:{columns:e.columns,loading:e.loading},on:{change:e.search},model:{value:e.lists.data,callback:function(t){e.$set(e.lists,"data",t)},expression:"lists.data"}},[a("Card",[a("p",{attrs:{slot:"title"},slot:"title"},[a("span",[e._v("搜索")])]),e._v(" "),a("Form",{ref:"searchForm",attrs:{model:e.searchForm,"label-width":80,inline:""}},[a("FormItem",{attrs:{prop:"phone",label:"手机号码","label-width":60}},[a("Input",{attrs:{type:"text",placeholder:"手机号码",clearable:""},model:{value:e.searchForm.phone,callback:function(t){e.$set(e.searchForm,"phone",t)},expression:"searchForm.phone"}})],1),e._v(" "),a("FormItem",{attrs:{prop:"name",label:"用户姓名","label-width":60}},[a("Input",{attrs:{type:"text",placeholder:"用户姓名",clearable:""},model:{value:e.searchForm.name,callback:function(t){e.$set(e.searchForm,"name",t)},expression:"searchForm.name"}})],1),e._v(" "),a("FormItem",{attrs:{"label-width":1}},[a("Button",{attrs:{type:"primary"},on:{click:function(t){e.search(1)}}},[e._v("搜索")]),e._v(" "),a("Button",{attrs:{type:"warning"},on:{click:function(t){e.showComponent("Create")}}},[e._v("添加")])],1)],1)],1),e._v(" "),a(e.component.current,{tag:"components",attrs:{data:e.component.data},on:{"on-change":e.hideComponent}})],1)},staticRenderFns:[]}},"o/j/":function(e,t,a){var r=a("vD9j");"string"==typeof r&&(r=[[e.i,r,""]]);var o={hmr:!0,transform:void 0,insertInto:void 0};a("MTIv")(r,o);r.locals&&(e.exports=r.locals)},pDQs:function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0});t.Validator=function(e){return{name:[{required:!0,type:"string",message:"用户姓名不能为空",trigger:"blur"},{type:"string",min:2,max:10,message:"用户姓名必须在 2 到 10 个字符之间",trigger:"blur"}],phone:[{required:!0,message:"手机号码不能为空",trigger:"blur"},{pattern:/^1[34578]\d{9}$/,message:"手机号码格式不正确",trigger:"blur"}],email:[{required:!0,message:"用户邮箱不能为空",trigger:"blur"},{type:"email",message:"邮箱格式不正确",trigger:"blur"}],role:[{required:!0,type:"number",message:"用户角色必须选择",trigger:"change"}],password:[{min:6,max:20,type:"string",message:"用户密码必须在 6 到 20 个字符之间",trigger:"blur"}],password_confirmation:[{validator:function(t,a,r){e.formUpdate.password!==a?r(new Error("两次密码不相同")):r()},trigger:"blur"}],authority_level:[{required:!0,type:"number",message:"权限等级必须选择",trigger:"change"}]}}},tphE:function(e,t,a){var r=a("ahQX");"string"==typeof r&&(r=[[e.i,r,""]]),r.locals&&(e.exports=r.locals);a("rjj0")("227aa0e7",r,!0,{})},u0ja:function(e,t,a){(e.exports=a("FZ+f")(!1)).push([e.i,"",""])},uI88:function(e,t,a){var r=a("8IMW");"string"==typeof r&&(r=[[e.i,r,""]]);var o={hmr:!0,transform:void 0,insertInto:void 0};a("MTIv")(r,o);r.locals&&(e.exports=r.locals)},vD9j:function(e,t,a){(e.exports=a("FZ+f")(!1)).push([e.i,"",""])},w65p:function(e,t,a){var r=a("jqVL");"string"==typeof r&&(r=[[e.i,r,""]]);var o={hmr:!0,transform:void 0,insertInto:void 0};a("MTIv")(r,o);r.locals&&(e.exports=r.locals)},xi7R:function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r,o=a("nf43"),n=(r=o)&&r.__esModule?r:{default:r};t.default={mixins:[n.default],methods:{unObserver:function(e){return JSON.parse(JSON.stringify(e))},updateSubmit:function(e,t){var a=this;this.$refs[e].validate(function(r){r?(a.loading=!0,a.$http.put(t,a.unObserver(a._data[e])).then(function(e){a.$Message.success("Success!"),a.change(!1)}).catch(function(e){a.formatErrors(e)}).finally(function(){a.loading=!1})):a.$Message.error("验证不通过!")})},createSubmit:function(e,t){var a=this;this.$refs[e].validate(function(r){r&&(a.loading=!0,a.$http.post(t,a._data[e]).then(function(e){a.$Message.success("Success!"),a.change(!1)}).catch(function(e){a.formatErrors(e)}).finally(function(){a.loading=!1}))})}}}}});