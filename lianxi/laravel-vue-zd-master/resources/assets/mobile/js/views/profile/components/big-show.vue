<template>
    <div class="scroll">
        <m-header left="profile.index">{{$route.params.id.driver.name}}-出车单详情</m-header>
        <item-box class="item">
            <item-input>
                <template slot="left">司机姓名</template>
                <template slot="right">{{data.driver ? data.driver.name : ''}}</template>
            </item-input>
            <item-input>
                <template slot="left">司机类型</template>
                <template slot="right" v-if="data.task">
                    <span v-if="data.task.type === 1">主任务</span>
                    <span v-else>临时任务</span>
                </template>
            </item-input>
            <item-input>
                <template slot="left">司机手机号</template>
                <template slot="right">{{data.driver ? data.driver.phone : ''}}</template>
            </item-input>
            <item-input>
                <template slot="left">出车单状态</template>
                <template slot="right">
                    <span v-if="data.status === 0">未签到</span>
                    <span v-else-if="data.status === 1">已签到</span>
                    <span v-else-if="data.status === 2">配送中</span>
                    <span v-else-if="data.status === 3">配送完成</span>
                    <span v-else-if="data.status === 4">设置不配送</span>
                    <span v-else-if="data.status === 5">无责任解约</span>
                    <span v-else-if="data.status === 6">运营取消</span>
                </template>
            </item-input>
        </item-box>

        <item-box class="item">
            <item-input>
                <template slot="left">车型</template>
                <template slot="right">{{data.car_type ? data.car_type.name : ''}}</template>
            </item-input>
            <item-input>
                <template slot="left">车牌号</template>
                <template slot="right">{{data.driver ? data.driver.car_number : ''}}</template>
            </item-input>
            <item-input>
                <template slot="left">商户简称</template>
                <template slot="right">{{data.merchant ? data.merchant.short_name : ''}}</template>
            </item-input>
        </item-box>

        <item-box class="item">
            <item-input>
                <template slot="left">出车单号</template>
                <template slot="right">{{data.order_no}}</template>
            </item-input>
            <item-input>
                <template slot="left">到仓时间</template>
                <template slot="right">{{data.arrival_warehouse_time}}</template>
            </item-input>
            <item-input>
                <template slot="left">线路名称</template>
                <template slot="right">{{data.name}}</template>
            </item-input>
            <item-input>
                <template slot="left">仓名称</template>
                <template slot="right">{{data.warehouse ? data.warehouse.title : ''}}</template>
            </item-input>
        </item-box>

        <item-box class="item">
            <item-input>
                <template slot="left">迟到时间</template>
                <template slot="right">{{late}}</template>
            </item-input>
            <item-input>
                <template slot="left">签到时间</template>
                <template slot="right">{{data.punch_time}}</template>
            </item-input>
            <item-input>
                <template slot="left">离仓时间</template>
                <template slot="right">{{data.leaves_warehouse_time}}</template>
            </item-input>
            <item-input>
                <template slot="left">配送完成时间</template>
                <template slot="right">{{data.finish_time}}</template>
            </item-input>
        </item-box>

        <item-box class="item">
            <item-input>
                <template slot="left">配送点数量</template>
                <template slot="right">{{data.point_count}}</template>
            </item-input>
            <item-input>
                <template slot="left">运费</template>
                <template slot="right">{{data.unit_price}}</template>
            </item-input>
            <item-input>
                <template slot="left">备注</template>
                <template slot="right">{{data.delivery_point_remark}}</template>
            </item-input>
        </item-box>
    </div>
</template>

<script>
    import MHeader from "../../../components/header/index";
    import ItemBox from "../../../components/item/box";
    import ItemInput from "../../../components/item/input";
    import moment from 'moment'

    export default {
        name: "big-show",
        components: {MHeader, ItemBox, ItemInput},
        data() {
            return {
                data: {}
            }
        },
        computed: {
            late() {
                return this.data.punch_time !== null ?
                    this.diffTime(moment(this.data.punch_time).diff(this.data.arrival_warehouse_time)) :
                    this.diffTime(moment().diff(this.data.arrival_warehouse_time));
            }
        },
        created(){
            this.$store.commit('setLoading', true)
        },
        mounted() {
            this.$loading('loading...');
            this.$http.get(`task/${this.$route.params.id.id}`).then((res) => {
                this.data = res.data.data
                this.$store.commit('setLoading', false)
            }).finally(() => {
                this.$loading.close();
            })
        },
        methods: {
            diffTime(diff) {
                //计算出相差天数
                let days = Math.floor(diff / (24 * 3600 * 1000));

                //计算出小时数
                let leave1 = diff % (24 * 3600 * 1000);    //计算天数后剩余的毫秒数
                let hours = Math.floor(leave1 / (3600 * 1000));
                //计算相差分钟数
                let leave2 = leave1 % (3600 * 1000);        //计算小时数后剩余的毫秒数
                let minutes = Math.floor(leave2 / (60 * 1000));

                //计算相差秒数
                let leave3 = leave2 % (60 * 1000);      //计算分钟数后剩余的毫秒数
                let seconds = Math.round(leave3 / 1000);
                let returnStr = '';
                if(seconds > 0){
                    returnStr = seconds + "秒";
                }

                if (minutes > 0) {
                    returnStr = minutes + "分" + returnStr;
                }
                if (hours > 0) {
                    returnStr = hours + "小时" + returnStr;
                }
                if (days > 0) {
                    returnStr = days + "天" + returnStr;
                }
                return returnStr;
            }
        },
        filters: {
            toFixed(num){
                return isNaN(num.toFixed(2)) ? 0 : num.toFixed(2);
            }
        }
    }
</script>

<style scoped lang="less">
    .item {
        margin-bottom: 20px;
        &:last-child {
            margin-bottom: 0px;
        }
    }
</style>