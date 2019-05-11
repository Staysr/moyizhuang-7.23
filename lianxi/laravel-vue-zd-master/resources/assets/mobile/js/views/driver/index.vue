<template>
    <div class="scroll">
        <m-header left="home.index">{{$store.getters.headerPrefix}}队员概况</m-header>
        <item-box>
            <item-input>
                <template slot="left">姓名</template>
                <template slot="right">{{data.name}}</template>
            </item-input>
            <item-input>
                <template slot="left">车辆号</template>
                <template slot="right">{{data.car_number}}</template>
            </item-input>
            <item-input>
                <template slot="left">出车状态</template>
                <template slot="right">{{data.is_work === 1? '已出车' : '未出车'}}</template>
            </item-input>
            <item-input v-if="data.is_work === 1">
                <template slot="left">空闲状态</template>
                <template slot="right" v-if="data.is_big_work === 1">大B业务运单中</template>
                <template slot="right" v-else-if="data.is_work === 1 && data.work_status === 1">小B业务运单中</template>
                <template slot="right" v-if="data.work_status === 0 && data.is_big_work === 0">空闲</template>
            </item-input>
            <item-input v-if="data.is_work === 0">
                <template slot="left">空闲状态</template>
                <template slot="right"> - </template>
            </item-input>
            <item-input>
                <template slot="left">是否有大B单</template>
                <template slot="right" v-if="taskOrder.length > 0">
                    <div class="hasOrder" @click="push"> 有 ({{taskOrder.length}}) 单</div>
                </template>
                <template slot="right" v-else>无</template>
            </item-input>
            <item-input>
                <template slot="left">定位时间</template>
                <template slot="right">{{data.position ? data.position.createTime : ''}}</template>
            </item-input>
            <item-input class="two-row">
                <template slot="left">当前位置</template>
                <span slot="right">
                        {{data.position ? data.position.address : ''}}
                </span>
            </item-input>
        </item-box>

        <item-box class="order">
            <item-input>
                <div class="title">今天共有 {{ordersLength}} 个订单</div>
            </item-input>

            <div v-for="(item, index) in data.orders" class="mini">
                <item-input mini>
                    <template slot="left">订单编号</template>
                    <template slot="right">{{item.order_no ? item.order_no : ' '}}</template>
                </item-input>
                <item-input mini>
                    <template slot="left">预约时间</template>
                    <template slot="right">{{item.appointment_time ? item.appointment_time : ' '}}</template>
                </item-input>
                <item-input mini>
                    <template slot="left">到达时间</template>
                    <template slot="right">{{item.reach_time ? item.reach_time : ''}}</template>
                </item-input>
                <item-input mini>
                    <template slot="left">开始时间</template>
                    <template slot="right">{{item.start_time ? item.start_time : '232323'}}</template>
                </item-input>
                <item-input mini>
                    <template slot="left">起始地点</template>
                    <template slot="right">{{item.start_address ? item.start_address : ' '}}</template>
                </item-input>
                <item-input mini>
                    <template slot="left">结束地点</template>
                    <template slot="right">{{item.end_address ? item.end_address : ' '}}</template>
                </item-input>
                <item-input mini>
                    <template slot="left">订单金额</template>
                    <template slot="right">{{item.total_fee ? item.total_fee : ' ' }}</template>
                </item-input>
                <item-input mini>
                    <template slot="left">订单里程</template>
                    <template slot="right">{{item.estimate_distance ? item.estimate_distance : ' '}}</template>
                </item-input>
                <item-input mini>
                    <template slot="left">订单状态</template>
                    <template slot="right" v-if="item.order_status === 0"> 等待分配司机</template>
                    <template slot="right" v-if="item.order_status === 1"> 司机已分配</template>
                    <template slot="right" v-if="item.order_status === 2"> 司机到达发货地</template>
                    <template slot="right" v-if="item.order_status === 3"> 订单进行中</template>
                    <template slot="right" v-if="item.order_status === 4"> 用户取消订单</template>
                    <template slot="right" v-if="item.order_status === 5"> 运营取消订单</template>
                    <template slot="right" v-if="item.order_status === 6"> 行程结束待支付</template>
                    <template slot="right" v-if="item.order_status === 7"> 行程结束已支付</template>
                    <template slot="right" v-if="item.order_status === 8"> 订单已评价</template>
                    <template slot="right" v-if="item.order_status === 9"> 订单超时自动关闭</template>
                    <template slot="right" v-if="item.order_status === 10"> 用户有责取消未支付</template>
                    <template slot="right" v-if="item.order_status === 11"> 用户有责取消已支付</template>
                </item-input>
            </div>
        </item-box>
    </div>
</template>

<script>
    import MHeader from "../../components/header/index";
    import ItemBox from "../../components/item/box";
    import ItemInput from "../../components/item/input";

    export default {
        name: "index",
        components: {ItemInput, ItemBox, MHeader},
        data() {
            return {
                data: {orders: []}
            }
        },
        computed: {
            taskOrder() {
                return this.data.task_orders || []
            },
            taskLength() {
                return this.taskOrder.length
            },
            orders() {
                return this.data.orders || []
            },
            ordersLength() {
                return this.orders.length
            }
        },
        created() {
            this.$store.commit('setLoading', true)
        },
        mounted() {
            this.$loading('loading...');
            this.$http.get(`map/${this.$route.params.id}`).then((res) => {
                this.data = res.data.data
                this.$store.commit('setLoading', false)
            }).finally(() => {
                this.$loading.close();
            })
        },
        methods: {
            push() {
                this.$router.push({
                    name: 'profile.index',
                    params: {id: 1}
                })
            }
        }
    }
</script>

<style scoped lang="less">
    .order {
        margin-top: 10px;
        .title {
            text-align: left;
            color: #333;
        }
        .mini {
            margin-bottom: 20px;
            &::last-of-type {
                margin-bottom: 0px;
            }
        }
    }

    .hasOrder {
        color: #F32F00;
        height: inherit;
        width: inherit;
        display: inline-block;
        z-index: 99;
    }
    
    
</style>

<style lang="less">
.two-row {
        height: 136px !important;
        .right {
            padding-top: 20px;
            line-height: 50px!important;
            text-align: right!important;
        }
    }
</style>