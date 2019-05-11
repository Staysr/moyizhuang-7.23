<template>
    <div>
        <Backheader :title="title" :path="path"></Backheader>
        <div class="member_detail">
            <div class="detail_box clearfix">
                <div class="detail_label">
                    <p>司机姓名</p>
                    <p>司机类型</p>
                    <p>司机手机号</p>
                    <p>出车单状态</p>
                </div>
                <div class="detail_info">
                    <p>{{list.driver.name}}</p>
                    <p v-if="list.task.type == 1">小队长</p>
                    <p v-if="list.task.type == 2">大队长</p>
                    <p class="phone" style="color: #07CA61;" @click="telphone(list.driver.phone)">
                        <!--<a href="tel:">-->
                            {{list.driver.phone}}
                        <!--</a>-->
                    </p>
                    <p v-if="list.status == 0">未签到</p>
                    <p v-if="list.status == 1">已签到</p>
                    <p v-if="list.status == 2">配送中</p>
                    <p v-if="list.status == 3">配送完成</p>
                    <p v-if="list.status == 4">设置不配送</p>
                    <p v-if="list.status == 5">无责任解约</p>
                    <p v-if="list.status == 6">运营取消</p>
                </div>
            </div>
            <div class="detail_box">
                <div class="detail_label">
                    <p>车型</p>
                    <p>车牌号</p>
                    <p>商户简称</p>
                </div>
                <div class="detail_info">
                    <p>{{list.car_type.name == null ? '123123' : list.car_type.name}}</p>
                    <p>{{list.driver.car_number == null ? '123123' : list.driver.car_number }}</p>
                    <p>{{list.merchant.short_name == null ?  '123123' : list.merchant.short_name }}</p>
                </div>
            </div>
            <div class="detail_box">
                 <div class="detail_label">
                    <p>出车单号</p>
                    <p>到仓时间</p>
                    <p>线路名称</p>
                    <p>仓名称</p>
                </div>
                <div class="detail_info">
                    <p>{{list.order_no}}</p>
                    <p>{{list.arrival_warehouse_time}}</p>
                    <p>{{list.name}}</p>
                    <p>{{list.warehouse.title}}</p>
                </div>
            </div>
            <div class="detail_box">
                 <div class="detail_label">
                    <p>迟到时间</p>
                    <p>签到时间</p>
                    <p>离仓时间</p>
                    <p>配送完成时间</p>
                </div>
                <div class="detail_info">
                    <p>迟到时间</p>
                    <p>{{list.punch_time == null ? '&nbsp;' : list.punch_time}}</p>
                    <p>{{list.leaves_warehouse_time == null ? '&nbsp;': list.leaves_warehouse_time }}</p>
                    <p>{{list.finish_time == null ? '&nbsp;': list.finish_time}}</p>
                </div>
            </div>
            <div class="detail_box">
                 <div class="detail_label">
                    <p>配送点数量</p>
                    <p>运费</p>
                    
                </div>
                <div class="detail_info">
                    <p>{{list.point_count}}</p>
                    <p>{{list.unit_price}}</p>

                </div>
                <p class="deliver_detail">
                    备注                    
                    <br><span>{{list.delivery_point_remark}}</span>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import Backheader from '../components/header/back'

    export default {
        // name: 'detail',
        components: { Backheader },
        created () {
            this.path = '/profile?id='+ this.$route.query.id
            this.merchantId =  this.$route.query.merchant
            this.getdata(this.merchantId)
        },
        data () {
            return {
                title: 'zhangsna ',
                path: '',
                merchantId: {},
                list:{}
            }
        },
        methods: {
            getdata(e) {
                this.$http.get(`task/${e}`).then((res)=> {
                    if(res.status == 200) {
                        this.list = res.data.data
                        this.title = this.list.driver.name + '出车单详情'
                    }
                })
            },
            telphone(e) {
                window.location.href = 'tel:'+e     
            }
        }
    }
</script>

<style lang="less">
.member_detail {
    height: auto;
    background: #fff;
    box-sizing: border-box;
    .detail_box {
        background: #fff;
        background: #fff;
        .detail_label, .detail_info {
            background: #fff;
            width: 50%;
            font-size: 32px;
            line-height: 98px;
            float: left;
            box-sizing: border-box;
            margin-bottom: 20px;
            p {
                border-bottom: 1px solid #eee;
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
            
        }
        .deliver_detail {
            background: #fff;
            width: 100%;
            font-size: 32px;
            line-height: 98px;
            float: left;
            box-sizing: border-box;
            margin-bottom: 20px;
            padding-left: 20px;
            color: #999;
            span {
                font-size: 32px;
                color: #333;
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