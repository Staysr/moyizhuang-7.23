<template>
    <div>
        <Backheader :title="title" :path="path"></Backheader>
        <div class="member_detail">
            <div class="detail_box clearfix">
                <div class="detail_label">
                    <p>姓名</p>
                    <p>车牌号</p>
                    <p>出车状态</p>
                    <p>空闲状态</p>
                    <p>是否有大B单</p>
                    <p>定位时间</p>
                    <p>当前位置</p>
                </div>
                <div class="detail_info">
                    <p>{{list.name}}</p>
                    <p>{{list.car_number}}</p>
                    <p v-if="list.is_work == 0"> 未出车</p>
                    <p v-if="list.is_work == 1"> 已出车</p>
                    <p v-if="list.is_work == 0 && list.is_big_work == 0">空闲</p> 
                    <p v-if="list.is_work == 1 && list.is_big_work == 0">小B业务运单中</p> 
                    <p v-if="list.is_work == 1 && list.is_big_work == 1">大B业务运单中</p> 
                    <p v-if="taskOrders.length > 0">有({{taskOrders.length}})单</p>
                    <p v-else>无</p>
                    <p>{{list.position ? list.position.createTime :  '  '}}</p>
                    <p>{{list.position ? list.position.address : '  '}}</p>

                </div>
            </div>

            <div class="detail_title">
                    今日共{{orderslist.length}}个订单
                </div>
            <div class="small_detail_box" v-for="item in orderslist">
                <div class="detail_label">
                    <p>订单编号</p>
                    <p>预约时间</p>
                    <p>到达时间</p>
                    <p>开始时间</p>
                    <p>起始地点</p>
                    <p>结束地点</p>
                    <p>订单金额</p>
                    <p>订单里程</p>
                    <p>订单状态</p>
                </div>
                <div class="detail_info">
                    <p>{{item.order_no ? item.order_no : '  '}}</p>
                    <p>{{item.appointment_time ? item.appointment_time : '  '}}</p>
                    <p>{{item.reach_time ? item.reach_time : '2323232'}}</p>
                    <p>{{item.start_time ? item.start_time : '232323'}}</p>
                    <p>{{item.start_address ? item.start_address : '  '}}</p>
                    <p>{{item.end_address ? item.end_address : '  '}}</p>
                    <p>{{item.total_fee ? item.total_fee : ' ' }}</p>
                    <p>{{item.estimate_distance ? item.estimate_distance : '  '}}</p>
                    <p v-if="item.order_status == 0">等待分配司机</p>
                    <p v-if="item.order_status == 1">司机已分配</p>
                    <p v-if="item.order_status == 2">司机到达发货地</p>
                    <p v-if="item.order_status == 3">订单进行中</p>
                    <p v-if="item.order_status == 4">用户取消订单</p>
                    <p v-if="item.order_status == 5">运营取消订单</p>
                    <p v-if="item.order_status == 6">行程结束待支付</p>
                    <p v-if="item.order_status == 7">行程结束已支付</p>
                    <p v-if="item.order_status == 8">订单已评价</p>
                    <p v-if="item.order_status == 9">订单超时自动关闭</p>
                    <p v-if="item.order_status ==10">用户有责取消未支付</p>
                    <p v-if="item.order_status ==11">用户有责取消已支付</p>
                </div>
            </div>
           

        </div>
    </div>
</template>

<script>
import Backheader from '../components/header/back'

    export default {
        name: 'detail',
        components: { Backheader },
        created () {
            this.path = '/membermap?id='+ this.$route.query.id
            this.getdata(this.$route.query.memberid)
        },
        data () {
            return {
                title: '',
                path: '',
                list: {}
            }
        },
        computed: {
            taskOrders(){
                return this.list.task_orders || []
            },
            orderslist(){
                return this.list.orders || []
            }
        },
        methods: {
            getdata(e) {
                this.$http.get(`map/${e}`).then((res)=> {
                    if(res.status == 200) {
                        this.list = res.data.data
                        this.title = '出车单详情-'+ this.list.name
                    }
                })
            }
        }
    }
</script>

<style lang="less">
.member_detail {
    height: auto;
    box-sizing: border-box;
    
    .detail_title {
        background: #fff;
        font-size: 32px;
        color: #333;
        padding-left: 20px;
        line-height: 99px;
        border-bottom: 1px solid #eee;
        padding-top: 20px;
        &::after {
            content: '';
            height: 20px;
            width: 100%;
            background: #eee;
            position: absolute;
            top: 780px;
            left: 0;
        }
    }
    .small_detail_box {
        background: #fff;
        
        .detail_label, .detail_info {
            background: #fff;
            /*width: 50%;*/
            font-size: 28px;
            line-height: 68px;
            float: left;
            box-sizing: border-box;
            margin-bottom: 20px;
        }
        .detail_label {
            width: 30%;
            color: #999;
            padding-left: 20px;
        }
        .detail_info {
            width: 70%;
            color: #666;
            text-align: right;
            padding-right: 20px;
            p { 
                white-space: nowrap; 
                overflow: hidden;
            }
        }
    }
    .detail_box {
        background: #fff;
        .detail_title {
            font-size: 32px;
            color: #333;
            line-height: 99px;
            border-bottom: 1px solid #eee;
            padding-left: 20px;
            margin-bottom: 20px;
        }
        .detail_label, .detail_info {
            background: #fff;
            width: 50%;
            font-size: 32px;
            line-height: 98px;
            float: left;
            box-sizing: border-box;
            margin-bottom: 20px;
            p { 
                width: 100%;
                height: 98px;
                border-bottom: 1px solid #eee;
                overflow: hidden;
                &::last-of-type {
                    border-bottom: transparent;
                }
            }
            
        }
        .detail_label {
            padding-left: 20px;
            color: #999;
        }
        .detail_info  {
            text-align: right;
            padding-right: 20px;
            p {
                overflow: hidden;
            }
        }
        .phone {
            a {
                color: #07Ca61;
            }
        }
    }
}
</style>