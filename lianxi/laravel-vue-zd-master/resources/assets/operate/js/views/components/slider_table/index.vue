<template>
    <div :class=" type == 'smalltype' ? 'normal': 'outermost-layer' ">
        <Schoose v-if="showleader" :datatype="type" :smallname="smallname"></Schoose>
        <div class="left" v-if="this.list.length != 0 || this.list.length == 'undefined'">
            <div class="left-head" :style="{height: `${headHeight}px`}">
                姓名
            </div>
            <div :style="{height: auto}" class="left-body shadow"  id="leftBodyId" onscroll="rightBodyId.scrollTop = this.scrollTop;">
                <div v-for="i in list" class="left-body-item" v-if="type != 'big'">
                    {{i.name}}
                </div>
                <div v-for="i in list" style="color: #07CA61;" class="left-body-item" v-if="type=='big'" @click="deliveryDetail(i)">
                    {{i.driver.name}}
                </div>
            </div>
        </div>
        <div class="right" v-if="this.list.length != 0 || this.list.length == 'undefined'">
            <div class="right-head small" :style="{height: `${headHeight}px`}" v-show="type == 'small'">
                <ul class="small_right">
                    <li v-for='item in small'>
                        {{item}}
                    </li>
                </ul>
            </div>
            <div class="right-head listname" :style="{height: `${headHeight}px`}" v-show="type == 'listname'">
                <ul class="listname_right"> 
                    <li v-for='item in listname'>
                        {{item}}
                    </li>
                </ul>
            </div>
            <div class="big-right-head" :style="{height: `${headHeight}px`}" v-if="type == 'big'">
                <ul class="big_right">
                    <li v-for='item in big'>
                        {{item}}
                    </li>
                </ul>
            </div>
            
         
            <div :style="{height: auto}" class="right-body" id="rightBodyId" onscroll="leftBodyId.scrollTop = this.scrollTop;" v-show = "type != 'big'">
                
                <div v-for="i in list" class="right-body-item listspan" v-show="type == 'small'">
                        <span v-if="i.is_work == 0">未出车</span>
                        <span v-if="i.is_work == 1">出车</span>
                        <span>{{i.total_work_time == null ? '0' : i.total_work_time}}</span>
                        <span>{{i.last_end_work ? i.last_end_work : ' '}}</span>
                        <span v-if=" i.is_big_work == 0 && i.work_status == 1">小B业务运单中</span>
                        <span v-if=" i.is_big_work == 1">大B业务运单中</span>
                        <span v-if=" i.is_big_work == 0 && i.work_status == 0 && i.is_work == 1">空闲</span>
                        <span v-if=" i.is_big_work == 0 && i.work_status == 0 && i.is_work == 0"> － </span>
                        <span>{{i.car_number}}</span>
                    <span class="phone" @click="telphone(i)">
                        <img src="../../../../images/phonecall.png" class="phonecall" alt="">
                    </span>
                </div>

                 <div v-for="i in list" class="right-body-item smallspan" v-show="type == 'listname'">
                    <span>{{i.order_complete_total}}</span>
                    <span>{{i.order_complete_cancel}}</span>
                    <span>{{i.order_complete_fee}}</span>
                    <span>{{i.work_time}}</span>
                    <span>{{i.task_order_total}}</span>
                    <span>{{i.task_order_fee}}</span>
                    <span>{{bigpersonal}}</span>
                    <span>{{bigtotal}}</span>
                </div>
            </div>
            
            
               <div :style="{height: auto}" class="right-big-body" id="rightBodyId" onscroll="leftBodyId.scrollTop = this.scrollTop;" v-if = "type == 'big'">
                    <div v-for="i in list" class="right-body-item bigspan">
                    <span>{{i.driver.supervisor.name ? i.driver.supervisor.name : ' ' }}</span>
                    <span>{{i.merchant.short_name == undefined ? '1212' : i.merchant.short_name}}</span>
                    <span >{{i.arrival_warehouse_time}}</span>
                    <span v-if="i.status == 0" style="color: #F32F00">未签到</span>
                    <span v-if="i.status == 1">已签到</span>
                    <span v-if="i.status == 2">配送中</span>
                    <span v-if="i.status == 3">配送完成</span>
                    <span v-if="i.status == 4">设置不配送</span>
                    <span v-if="i.status == 5">无责任解约</span>
                    <span v-if="i.status == 6">运营取消</span>
                </div>
               </div>
        </div>
       
    </div>

</template>

<!--这里可以防止滚动到顶部时，整体往上偏移，底部出现空白-->
<style>
    #vux_view_box_body{
        padding:0px;
    }
</style>

<script>
import Schoose from '../../components/tabSelect/schoose'

    export default {
        name: "home",
        props: [ 'type','list', 'showleader' ],
        components: { Schoose },
        watch: {
            
        },
        computed: {     
           bigpersonal() {
               if( this.type == 'listname') {
                   let num = this.list.task_order_fee / this.list.task_order_total 
                   return num ? num : 0
               }
           },
           bigtotal() {
               if( this.type == 'listname') {
                    let num = this.list.task_order_fee + this.list.order_complete_fee
                    return num ? num : 0
               }
           }
        },
        data(){
            return {
                headHeight: 50,
                bodyHeight: window.innerHeight - 50,
                small : ['出车状态','在线时长','收车原因','空闲状态','车牌号码','联系方式'],
                listname: ['小B完成单数','小B取消单数', '小B金额','小B在线时长','大B金额','大B单数','大B人均金额','总金额'],
                big: ['所属队长','商户简称','到仓时间','出车单状态',''],
                smallname: ''
            }
        },
        methods:{
            auto() {},
            deliveryDetail(i) {
                //跳转出车单
                this.$router.push({path: '/deliverdetail', query:{id: this.$mobile.user().id, merchant: i.id}} )
            },
            telphone(e) {
                window.location.href = 'tel:'+e
            }
        }
    }
</script>

<style scoped>
    .shadow {
        border-shadow: -1px 0px 6px -2px #aaa inset;
    }
    .outermost-layer {
        padding: 0px;
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        /*overflow-x: auto;
        overflow-y: auto;*/
    }
    .normal {
        padding: 0px;
        position: absolute;
    }
    .left{
        width: 158px;
        background-color: #F8F8F8;
        float: left;
        display: inline-block;
    }
    .left-head{
        width: 100%;
        clear: both;
        font-size: 30px;
        text-align: center;  
        line-height: 88px;
        color: #333;
    }
    .left-body{
        background: #fff;
        clear: both;
        overflow-x: scroll;
        /*左边设置滚动条，系统监听左边的滚动条位置，保持高度一致*/
        overflow-y: scroll;
        text-align: center;
    }
    .left-body::-webkit-scrollbar{
        display: none;
    }
    .left-body-item {
        color: #666;
        font-size: 28px;
        line-height: 98px;
        border-bottom: 1px solid #eee;
        height: 98px;
        width: 100%;
        overflow: hidden;
    }
    .right{
        width: calc(100% - 158px);
        float: left;
        overflow-x: scroll;
        overflow-y: scroll;
        display: inline-block;
    }
    .right::-webkit-scrollbar {
        display: none;
    }
    .right-head{
        width: 229%;
        line-height: 88px;
        background-color: #F8F8F8;
        z-index: 10;
        clear: both;
        padding: 0 0 0 0;
        margin: 0 0 0 0;
    }
    .right-head ul {
        list-style: none;
        padding: 0 0 0 0;
        margin: 0 0 0 0;
    }
     .small .small_right li {
        width: 16.4%;
        float: left;  
        font-size: 30px;
        text-align: center;  
        color: #333;
        padding: 0 0 0 0;
        margin: 0 0 0 0;
    }
    .small .small_right li:first-child {
        border-right: 1px solid transparent;
    }

    .big-right-head{
        padding: 0 0 0 0;
        margin: 0 0 0 0;
        width: 120%;
        line-height: 88px;
        background-color: #F8F8F8;
        z-index: 10;
        clear: both;
    }
    .big-right-head .big_right li {
        padding: 0 0 0 0;
        margin: 0 0 0 0;
        width: 24.7%;
        float: left;  
        font-size: 30px;
        text-align: center;  
        color: #333;
    }

    .big-right-head .big_right li:first-child {
        border-right: 1px solid transparent;
    }
    .listname .listname_right {
        padding: 0 0 0 0;
        margin: 0 0 0 0;
        overflow: hidden;
    }
    .listname .listname_right li {
        padding: 0 0 0 0;
        margin: 0 0 0 0;
        width: 12.4%;
        float: left;  
        font-size: 30px;
        text-align: center;  
        color: #333;
        word-break:break-all;
        word-wrap:break-word;
        line-height: 50px;
        overflow: hidden;
        vertical-align: middle;
    }
    .listname .listname_right li:first-child {
        border-right: 1px solid transparent;
        overflow: hidden;
    }

    .right-big-body {
        width: 120%;
        clear: both;
        overflow: auto;
        margin: 0 0 0 0;
        padding: 0 0 0 0;
        overflow: hidden;        
    }
    .right-body-item span{
        color: #666;
        display: inline-block;
        font-size: 28px;
        text-align: center;
        line-height: 98px;
        height: 98px;
        float: left;
        border-bottom: 1px solid #eee;
        background: #fff;
        overflow: hidden;
        display: table-cell;
        vertical-align: middle;
        padding: 0 0 0 0;
        margin: 0 0 0 0;
    }

    .right-body{
        width: 229%;
        clear: both;
        overflow: auto;
        margin: 0 0 0 0;
        padding: 0 0 0 0;
    }
    .right-body-item span{
        color: #666;
        display: inline-block;
        font-size: 28px;
        text-align: center;
        /*width: 16.6%;*/
        line-height: 98px;
        height: 98px;
        float: left;
        border-bottom: 1px solid #eee;
        background: #fff;
        overflow: hidden;
        display: table-cell;
        vertical-align: middle;
        margin: 0 0 0 0;
        padding: 0 0 0 0;
    }
    .listspan span{
        width: 16.6%;
        padding: 0 0 0 0;
        margin: 0 0 0 0;
    }
    .smallspan span{
        width: 12.5%;
        padding: 0 0 0 0;
        margin: 0 0 0 0;
    }
    .bigspan span {
        width: 25%;
        padding: 0 0 0 0;
        margin: 0 0 0 0;
    }

    .phonecall {
        width: 58px;
        height: 58px;
        margin-left: 0px;
        vertical-align: middle;
    }
   
</style>