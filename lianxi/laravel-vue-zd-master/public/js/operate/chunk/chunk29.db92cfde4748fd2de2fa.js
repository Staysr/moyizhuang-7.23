webpackJsonp([29],{"1/4U":function(t,e,i){(t.exports=i("FZ+f")(!1)).push([t.i,".member_detail{height:auto;-webkit-box-sizing:border-box;box-sizing:border-box}.member_detail,.member_detail .detail_box{background:#fff}.member_detail .detail_box .detail_info,.member_detail .detail_box .detail_label{background:#fff;width:50%;font-size:.42666667rem;line-height:1.30666667rem;float:left;-webkit-box-sizing:border-box;box-sizing:border-box;margin-bottom:.26666667rem}.member_detail .detail_box .detail_info p,.member_detail .detail_box .detail_label p{border-bottom:.01333333rem solid #eee}.member_detail .detail_box .detail_info p::last-of-type,.member_detail .detail_box .detail_label p::last-of-type{border-bottom:transparent}.member_detail .detail_box .detail_label{padding-left:.26666667rem;color:#999}.member_detail .detail_box .detail_info{text-align:right;padding-right:.26666667rem}.member_detail .detail_box .deliver_detail{background:#fff;width:100%;font-size:.42666667rem;line-height:1.30666667rem;float:left;-webkit-box-sizing:border-box;box-sizing:border-box;margin-bottom:.26666667rem;padding-left:.26666667rem;color:#999}.member_detail .detail_box .deliver_detail span{font-size:.42666667rem;color:#333}.member_detail .detail_box .phone a{color:#07ca61}",""])},"1lNb":function(t,e,i){var s=i("cIIr");"string"==typeof s&&(s=[[t.i,s,""]]);var a={hmr:!0,transform:void 0,insertInto:void 0};i("MTIv")(s,a);s.locals&&(t.exports=s.locals)},"4uXt":function(t,e,i){var s=i("1/4U");"string"==typeof s&&(s=[[t.i,s,""]]);var a={hmr:!0,transform:void 0,insertInto:void 0};i("MTIv")(s,a);s.locals&&(t.exports=s.locals)},"52Qo":function(t,e,i){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var s,a=i("aX5+"),l=(s=a)&&s.__esModule?s:{default:s};e.default={components:{Backheader:l.default},created:function(){this.path="/profile?id="+this.$route.query.id,this.merchantId=this.$route.query.merchant,this.getdata(this.merchantId)},data:function(){return{title:"zhangsna ",path:"",merchantId:{},list:{}}},methods:{getdata:function(t){var e=this;this.$http.get("task/"+t).then(function(t){200==t.status&&(e.list=t.data.data,e.title=e.list.driver.name+"出车单详情")})},telphone:function(t){window.location.href="tel:"+t}}}},5822:function(t,e){t.exports={render:function(){var t=this.$createElement,e=this._self._c||t;return e("div",[e("header",{staticClass:"back"},[e("router-link",{attrs:{to:this.path}},[e("div",{staticClass:"title"},[this._v(this._s(this.title))])])],1)])},staticRenderFns:[]}},Dw3d:function(t,e,i){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={name:"back",props:{title:{type:String},path:{type:String}},data:function(){return{}}}},Qh2I:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",[i("Backheader",{attrs:{title:t.title,path:t.path}}),t._v(" "),i("div",{staticClass:"member_detail"},[i("div",{staticClass:"detail_box clearfix"},[t._m(0),t._v(" "),i("div",{staticClass:"detail_info"},[i("p",[t._v(t._s(t.list.driver.name))]),t._v(" "),1==t.list.task.type?i("p",[t._v("小队长")]):t._e(),t._v(" "),2==t.list.task.type?i("p",[t._v("大队长")]):t._e(),t._v(" "),i("p",{staticClass:"phone",staticStyle:{color:"#07CA61"},on:{click:function(e){t.telphone(t.list.driver.phone)}}},[t._v("\n                        "+t._s(t.list.driver.phone)+"\n                    ")]),t._v(" "),0==t.list.status?i("p",[t._v("未签到")]):t._e(),t._v(" "),1==t.list.status?i("p",[t._v("已签到")]):t._e(),t._v(" "),2==t.list.status?i("p",[t._v("配送中")]):t._e(),t._v(" "),3==t.list.status?i("p",[t._v("配送完成")]):t._e(),t._v(" "),4==t.list.status?i("p",[t._v("设置不配送")]):t._e(),t._v(" "),5==t.list.status?i("p",[t._v("无责任解约")]):t._e(),t._v(" "),6==t.list.status?i("p",[t._v("运营取消")]):t._e()])]),t._v(" "),i("div",{staticClass:"detail_box"},[t._m(1),t._v(" "),i("div",{staticClass:"detail_info"},[i("p",[t._v(t._s(null==t.list.car_type.name?"123123":t.list.car_type.name))]),t._v(" "),i("p",[t._v(t._s(null==t.list.driver.car_number?"123123":t.list.driver.car_number))]),t._v(" "),i("p",[t._v(t._s(null==t.list.merchant.short_name?"123123":t.list.merchant.short_name))])])]),t._v(" "),i("div",{staticClass:"detail_box"},[t._m(2),t._v(" "),i("div",{staticClass:"detail_info"},[i("p",[t._v(t._s(t.list.order_no))]),t._v(" "),i("p",[t._v(t._s(t.list.arrival_warehouse_time))]),t._v(" "),i("p",[t._v(t._s(t.list.name))]),t._v(" "),i("p",[t._v(t._s(t.list.warehouse.title))])])]),t._v(" "),i("div",{staticClass:"detail_box"},[t._m(3),t._v(" "),i("div",{staticClass:"detail_info"},[i("p",[t._v("迟到时间")]),t._v(" "),i("p",[t._v(t._s(null==t.list.punch_time?" ":t.list.punch_time))]),t._v(" "),i("p",[t._v(t._s(null==t.list.leaves_warehouse_time?" ":t.list.leaves_warehouse_time))]),t._v(" "),i("p",[t._v(t._s(null==t.list.finish_time?" ":t.list.finish_time))])])]),t._v(" "),i("div",{staticClass:"detail_box"},[t._m(4),t._v(" "),i("div",{staticClass:"detail_info"},[i("p",[t._v(t._s(t.list.point_count))]),t._v(" "),i("p",[t._v(t._s(t.list.unit_price))])]),t._v(" "),i("p",{staticClass:"deliver_detail"},[t._v("\n                备注                    \n                "),i("br"),i("span",[t._v(t._s(t.list.delivery_point_remark))])])])])],1)},staticRenderFns:[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"detail_label"},[e("p",[this._v("司机姓名")]),this._v(" "),e("p",[this._v("司机类型")]),this._v(" "),e("p",[this._v("司机手机号")]),this._v(" "),e("p",[this._v("出车单状态")])])},function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"detail_label"},[e("p",[this._v("车型")]),this._v(" "),e("p",[this._v("车牌号")]),this._v(" "),e("p",[this._v("商户简称")])])},function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"detail_label"},[e("p",[this._v("出车单号")]),this._v(" "),e("p",[this._v("到仓时间")]),this._v(" "),e("p",[this._v("线路名称")]),this._v(" "),e("p",[this._v("仓名称")])])},function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"detail_label"},[e("p",[this._v("迟到时间")]),this._v(" "),e("p",[this._v("签到时间")]),this._v(" "),e("p",[this._v("离仓时间")]),this._v(" "),e("p",[this._v("配送完成时间")])])},function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"detail_label"},[e("p",[this._v("配送点数量")]),this._v(" "),e("p",[this._v("运费")])])}]}},"aX5+":function(t,e,i){var s=i("VU/8")(i("Dw3d"),i("5822"),!1,function(t){i("nUNO")},null,null);t.exports=s.exports},cIIr:function(t,e,i){(t.exports=i("FZ+f")(!1)).push([t.i,'.back{width:100%;text-align:center}.back .title{line-height:1.2rem;font-size:.48rem;color:#333;position:relative}.back .title:after{display:inline-block;content:" ";height:.33333333rem;width:.33333333rem;border-width:.05333333rem .05333333rem 0 0;border-color:#c7c7cc;border-style:solid;-webkit-transform:rotate(222deg);transform:rotate(222deg);position:absolute;left:.4rem;top:38%}',""])},nUNO:function(t,e,i){var s=i("1lNb");"string"==typeof s&&(s=[[t.i,s,""]]),s.locals&&(t.exports=s.locals);i("rjj0")("00bc81ba",s,!0,{})},oGme:function(t,e,i){var s=i("VU/8")(i("52Qo"),i("Qh2I"),!1,function(t){i("wOTN")},null,null);t.exports=s.exports},wOTN:function(t,e,i){var s=i("4uXt");"string"==typeof s&&(s=[[t.i,s,""]]),s.locals&&(t.exports=s.locals);i("rjj0")("75ccb50c",s,!0,{})}});