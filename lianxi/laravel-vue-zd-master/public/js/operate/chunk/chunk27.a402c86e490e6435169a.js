webpackJsonp([27],{"1lNb":function(e,t,i){var r=i("cIIr");"string"==typeof r&&(r=[[e.i,r,""]]);var a={hmr:!0,transform:void 0,insertInto:void 0};i("MTIv")(r,a);r.locals&&(e.exports=r.locals)},"4fK+":function(e,t){e.exports={render:function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("div",[i("Backheader",{attrs:{title:e.title,path:e.path}}),e._v(" "),i("div",{staticClass:"member_detail"},[i("div",{staticClass:"detail_box clearfix"},[e._m(0),e._v(" "),i("div",{staticClass:"detail_info"},[i("p",[e._v(e._s(e.list.name))]),e._v(" "),i("p",[e._v(e._s(e.list.car_number))]),e._v(" "),0==e.list.is_work?i("p",[e._v(" 未出车")]):e._e(),e._v(" "),1==e.list.is_work?i("p",[e._v(" 已出车")]):e._e(),e._v(" "),0==e.list.is_work&&0==e.list.is_big_work?i("p",[e._v("空闲")]):e._e(),e._v(" "),1==e.list.is_work&&0==e.list.is_big_work?i("p",[e._v("小B业务运单中")]):e._e(),e._v(" "),1==e.list.is_work&&1==e.list.is_big_work?i("p",[e._v("大B业务运单中")]):e._e(),e._v(" "),e.taskOrders.length>0?i("p",[e._v("有("+e._s(e.taskOrders.length)+")单")]):i("p",[e._v("无")]),e._v(" "),i("p",[e._v(e._s(e.list.position?e.list.position.createTime:"  "))]),e._v(" "),i("p",[e._v(e._s(e.list.position?e.list.position.address:"  "))])])]),e._v(" "),i("div",{staticClass:"detail_title"},[e._v("\n                今日共"+e._s(e.orderslist.length)+"个订单\n            ")]),e._v(" "),e._l(e.orderslist,function(t){return i("div",{staticClass:"small_detail_box"},[e._m(1,!0),e._v(" "),i("div",{staticClass:"detail_info"},[i("p",[e._v(e._s(t.order_no?t.order_no:"  "))]),e._v(" "),i("p",[e._v(e._s(t.appointment_time?t.appointment_time:"  "))]),e._v(" "),i("p",[e._v(e._s(t.reach_time?t.reach_time:"2323232"))]),e._v(" "),i("p",[e._v(e._s(t.start_time?t.start_time:"232323"))]),e._v(" "),i("p",[e._v(e._s(t.start_address?t.start_address:"  "))]),e._v(" "),i("p",[e._v(e._s(t.end_address?t.end_address:"  "))]),e._v(" "),i("p",[e._v(e._s(t.total_fee?t.total_fee:" "))]),e._v(" "),i("p",[e._v(e._s(t.estimate_distance?t.estimate_distance:"  "))]),e._v(" "),0==t.order_status?i("p",[e._v("等待分配司机")]):e._e(),e._v(" "),1==t.order_status?i("p",[e._v("司机已分配")]):e._e(),e._v(" "),2==t.order_status?i("p",[e._v("司机到达发货地")]):e._e(),e._v(" "),3==t.order_status?i("p",[e._v("订单进行中")]):e._e(),e._v(" "),4==t.order_status?i("p",[e._v("用户取消订单")]):e._e(),e._v(" "),5==t.order_status?i("p",[e._v("运营取消订单")]):e._e(),e._v(" "),6==t.order_status?i("p",[e._v("行程结束待支付")]):e._e(),e._v(" "),7==t.order_status?i("p",[e._v("行程结束已支付")]):e._e(),e._v(" "),8==t.order_status?i("p",[e._v("订单已评价")]):e._e(),e._v(" "),9==t.order_status?i("p",[e._v("订单超时自动关闭")]):e._e(),e._v(" "),10==t.order_status?i("p",[e._v("用户有责取消未支付")]):e._e(),e._v(" "),11==t.order_status?i("p",[e._v("用户有责取消已支付")]):e._e()])])})],2)],1)},staticRenderFns:[function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("div",{staticClass:"detail_label"},[i("p",[e._v("姓名")]),e._v(" "),i("p",[e._v("车牌号")]),e._v(" "),i("p",[e._v("出车状态")]),e._v(" "),i("p",[e._v("空闲状态")]),e._v(" "),i("p",[e._v("是否有大B单")]),e._v(" "),i("p",[e._v("定位时间")]),e._v(" "),i("p",[e._v("当前位置")])])},function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("div",{staticClass:"detail_label"},[i("p",[e._v("订单编号")]),e._v(" "),i("p",[e._v("预约时间")]),e._v(" "),i("p",[e._v("到达时间")]),e._v(" "),i("p",[e._v("开始时间")]),e._v(" "),i("p",[e._v("起始地点")]),e._v(" "),i("p",[e._v("结束地点")]),e._v(" "),i("p",[e._v("订单金额")]),e._v(" "),i("p",[e._v("订单里程")]),e._v(" "),i("p",[e._v("订单状态")])])}]}},5822:function(e,t){e.exports={render:function(){var e=this.$createElement,t=this._self._c||e;return t("div",[t("header",{staticClass:"back"},[t("router-link",{attrs:{to:this.path}},[t("div",{staticClass:"title"},[this._v(this._s(this.title))])])],1)])},staticRenderFns:[]}},"7ABd":function(e,t,i){var r=i("uFtF");"string"==typeof r&&(r=[[e.i,r,""]]);var a={hmr:!0,transform:void 0,insertInto:void 0};i("MTIv")(r,a);r.locals&&(e.exports=r.locals)},BHwi:function(e,t,i){var r=i("7ABd");"string"==typeof r&&(r=[[e.i,r,""]]),r.locals&&(e.exports=r.locals);i("rjj0")("74b5078a",r,!0,{})},Dw3d:function(e,t,i){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default={name:"back",props:{title:{type:String},path:{type:String}},data:function(){return{}}}},MKBu:function(e,t,i){var r=i("VU/8")(i("w+Jm"),i("4fK+"),!1,function(e){i("BHwi")},null,null);e.exports=r.exports},"aX5+":function(e,t,i){var r=i("VU/8")(i("Dw3d"),i("5822"),!1,function(e){i("nUNO")},null,null);e.exports=r.exports},cIIr:function(e,t,i){(e.exports=i("FZ+f")(!1)).push([e.i,'.back{width:100%;text-align:center}.back .title{line-height:1.2rem;font-size:.48rem;color:#333;position:relative}.back .title:after{display:inline-block;content:" ";height:.33333333rem;width:.33333333rem;border-width:.05333333rem .05333333rem 0 0;border-color:#c7c7cc;border-style:solid;-webkit-transform:rotate(222deg);transform:rotate(222deg);position:absolute;left:.4rem;top:38%}',""])},nUNO:function(e,t,i){var r=i("1lNb");"string"==typeof r&&(r=[[e.i,r,""]]),r.locals&&(e.exports=r.locals);i("rjj0")("00bc81ba",r,!0,{})},uFtF:function(e,t,i){(e.exports=i("FZ+f")(!1)).push([e.i,'.member_detail{height:auto;-webkit-box-sizing:border-box;box-sizing:border-box}.member_detail .detail_title{background:#fff;font-size:.42666667rem;color:#333;padding-left:.26666667rem;line-height:1.32rem;border-bottom:.01333333rem solid #eee;padding-top:.26666667rem}.member_detail .detail_title:after{content:"";height:.26666667rem;width:100%;background:#eee;position:absolute;top:10.4rem;left:0}.member_detail .small_detail_box{background:#fff}.member_detail .small_detail_box .detail_info,.member_detail .small_detail_box .detail_label{background:#fff;font-size:.37333333rem;line-height:.90666667rem;float:left;-webkit-box-sizing:border-box;box-sizing:border-box;margin-bottom:.26666667rem}.member_detail .small_detail_box .detail_label{width:30%;color:#999;padding-left:.26666667rem}.member_detail .small_detail_box .detail_info{width:70%;color:#666;text-align:right;padding-right:.26666667rem}.member_detail .small_detail_box .detail_info p{white-space:nowrap;overflow:hidden}.member_detail .detail_box{background:#fff}.member_detail .detail_box .detail_title{font-size:.42666667rem;color:#333;line-height:1.32rem;border-bottom:.01333333rem solid #eee;padding-left:.26666667rem;margin-bottom:.26666667rem}.member_detail .detail_box .detail_info,.member_detail .detail_box .detail_label{background:#fff;width:50%;font-size:.42666667rem;line-height:1.30666667rem;float:left;-webkit-box-sizing:border-box;box-sizing:border-box;margin-bottom:.26666667rem}.member_detail .detail_box .detail_info p,.member_detail .detail_box .detail_label p{width:100%;height:1.30666667rem;border-bottom:.01333333rem solid #eee;overflow:hidden}.member_detail .detail_box .detail_info p::last-of-type,.member_detail .detail_box .detail_label p::last-of-type{border-bottom:transparent}.member_detail .detail_box .detail_label{padding-left:.26666667rem;color:#999}.member_detail .detail_box .detail_info{text-align:right;padding-right:.26666667rem}.member_detail .detail_box .detail_info p{overflow:hidden}.member_detail .detail_box .phone a{color:#07ca61}',""])},"w+Jm":function(e,t,i){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r,a=i("aX5+"),_=(r=a)&&r.__esModule?r:{default:r};t.default={name:"detail",components:{Backheader:_.default},created:function(){this.path="/membermap?id="+this.$route.query.id,this.getdata(this.$route.query.memberid)},data:function(){return{title:"",path:"",list:{}}},computed:{taskOrders:function(){return this.list.task_orders||[]},orderslist:function(){return this.list.orders||[]}},methods:{getdata:function(e){var t=this;this.$http.get("map/"+e).then(function(e){200==e.status&&(t.list=e.data.data,t.title="出车单详情-"+t.list.name)})}}}}});