<template>
    <div class="collec">
        <div class="collection">
            <i-title class="title" icon="team-detail">
                数据汇总
            </i-title>
            <div class="content">
                <div class="big" v-if="dateType === 'Date'">
                    <div class="total item">
                        <div class="num">{{data.task_order_fee + data.order_complete_fee | toFixed}}</div>
                        <div class="name">总金额</div>
                    </div>
                    <div class="number item">
                        <div class="num">{{lists.length}}</div>
                        <div class="name">本队人数</div>
                    </div>
                    <div class="order_number item">
                        <div class="num">{{data.order_number}}</div>
                        <div class="name">小B接单人数</div>
                    </div>
                    <div class="task_order_number item">
                        <div class="num">{{data.task_order_number}}</div>
                        <div class="name">大B接单人数</div>
                    </div>
                </div>
                <div class="small" v-else>
                    <div class="item">
                        <div class="num">{{data.task_order_fee + data.order_complete_fee | toFixed}}</div>
                        <div class="name">总金额</div>
                    </div>
                </div>
                <div class="info">
                    <div class="left">
                        <div class="title">小B业务</div>
                        <div class="items">
                            <div>
                                接单金额 <span>{{data.order_complete_fee | toFixed}}</span>
                            </div>
                            <div>
                                接单总数 <span>{{data.order_complete_total}}</span>
                            </div>
                            <div>
                                人均金额 <span>{{data.order_complete_fee / data.order_number | toFixed}}</span>
                            </div>
                            <div>
                                取消单数 <span>{{data.order_cancel_total}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="right">
                        <div class="title">大B业务</div>
                        <div class="items">
                            <div>
                                接单金额 <span>{{data.task_order_fee | toFixed}}</span>
                            </div>
                            <div>
                                接单总数 <span>{{data.task_order_total }}</span>
                            </div>
                            <div>
                                人均金额 <span>{{data.task_order_fee / data.task_order_number | toFixed}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
            <i-title  icon="team">
                小队长 <span class="name" style="color: #666666; vertical-align: top;">{{name}}</span>
            </i-title>
        <div class="table" style="margin-top: 1px;" :class="{dateTable: dateType === 'Date'}">
            <template v-if="type === 2">
                <item-box @on-change="change">
                    <item v-for="(item, index) in smallLists" :key="index" :name="item">{{item.name}}
                        <template slot="sub">(小队长)</template>
                    </item>
                </item-box>
            </template>
            <template v-else>
                <is-table :column="column" :data="lists" class="is-table" ref="is-table"></is-table>
            </template>
        </div>
    </div>
</template>

<script>
    import ITitle from "../../../components/title/index";
    import ItemBox from "../../../components/item/box";
    import Item from "../../../components/item/index";
    import IsTable from "../../../components/table/index";

    export default {
        name: "Collection",
        components: {IsTable, Item, ItemBox, ITitle},
        props: {
            dateType: {
                type: String,
                default: 'Date'
            },
            name: {
                type: String,
                default: ''
            },
            smallLists: {
                type: Array,
                default: () => []
            },
            lists: {
                type: Array,
                default: () => []
            },
            data: {
                type: Object,
                default: () => {
                    return {
                        "task_order_number": 0,
                        "order_number": 0,
                        "number": 0,
                        "task_order_fee": 0,
                        "task_order_total": 0,
                        "order_cancel_total": 0,
                        "order_complete_total": 0,
                        "order_complete_fee": 0
                    }
                }
            },
            type: {
                type: Number,
                default: 2
            }
        },
        data() {
            return {
                column: [
                    {
                    name: "姓名",
                    fixed: true,
                    width: 100,
                    field: 'name'
                }, {
                    name: "小B完成数",
                    width: 100,
                    field: 'order_complete_total'
                }, {
                    name: "小B取消数",
                    width: 100,
                    field: 'order_cancel_total'
                }, {
                    name: "小B金额",
                    width: 100,
                    field: 'order_complete_fee'
                }, {
                    name: "大B金额",
                    width: 100,
                    field: 'task_order_fee'
                },{
                    name: '在线时长',
                    width: 100,
                    field: 'work_time',
                    render: (h, {row}) => {
                        let hours = this.diffTime(Number(row.work_time))
                        return <span>{hours}</span>
                    }
                }, {
                    name: "大B单数",
                    width: 100,
                    field: 'task_order_total'
                }, {
                    name: "大B人均金额",
                    width: 100,
                    render: (h, {row}) => {
                        return <span>{isNaN(Number(row.task_order_fee) / Number(row.task_order_total)) ? 0 : (Number(row.task_order_fee) / Number(row.task_order_total)).toFixed(2)}</span>
                    }
                }, {
                    name: "总金额",
                    width: 100,
                    render: (h, {row}) => {
                        return <span>{((Number(row.task_order_fee) + Number(row.order_complete_fee)).toFixed(2))}</span>
                    }
                }]
            }
        },
        methods: {
            change(item) {
                this.$emit('on-change', item)
            },
            diffTime(diff) {
                //计算出小时数
                let leave1 = diff % (24 * 3600);    //计算天数后剩余的毫秒数
                let hours = Math.floor(leave1 / (3600));
                //计算相差分钟数
                let leave2 = leave1 % (3600);        //计算小时数后剩余的毫秒数
                let minutes = Math.floor(leave2 / (60));


                return `${hours}:${minutes}`;
            }
        },
        filters: {
            toFixed(num) {
                return isNaN(num.toFixed(2)) ? 0.00 : num.toFixed(2);
            }
        }
    }
</script>

<style scoped lang="less">
    .collec {
        position: relative;
        height: 100%;
        box-sizing: border-box;
        /*padding-bottom: 88px;*/
        .table{
            /*height: 100%;*/
            width: 100%;
            .is-table{
                height: 100% !important;
            }
        }
        .dateTable{
            /*height: 100%;*/
        }
        .collection {
            .title {
                margin-top: 0 !important;
            }
            .content {
                width: 100%;
                position: relative;
                padding: 0 20px;
                box-sizing: border-box;
                background-color: white;
                .big {
                    height: 300px;
                    background: url('../../../../images/dataTotal.png') no-repeat center center;
                    background-size: cover;
                    position: relative;
                    .item {
                        line-height: 1.6;
                        position: absolute;
                        text-align: left;
                        .num {
                            color: #F32F00;
                            font-size: 46px;
                            margin-top: 14px;
                        }
                        .name {
                            color: #666;
                            font-size: 32px;
                            margin-top: -12px;
                        }
                    }
                    .total {
                        top: 10px;
                        left: 90px;
                    }
                    .number {
                        top: 10px;
                        right: 130px;
                    }
                    .order_number {
                        top: 140px;
                        left: 90px;
                    }
                    .task_order_number {
                        top: 140px;
                        right: 81px;
                    }
                }
                .small {
                    width: 100%;
                    height: 150px;
                    background: url('../../../../images/dataTotalsmall.png') no-repeat center center;
                    background-size: cover;
                    position: relative;
                    .item {
                        position: absolute;
                        text-align: left;
                        top: 5px;
                        left: 90px;
                        
                        .num {
                            color: #F32F00;
                            font-size: 46px;
                            margin-top: 10px;
                        }
                        .name {
                            color: #666;
                            font-size: 32px;
                            line-height: 0;
                            margin-top: 15px;
                        }
                    }
                }
                .info {
                    width: 100%;
                    background: #fff;
                    height: 308px;
                    margin-top: 20px;
                    box-sizing: border-box;
                    .left, .right {
                        width: 50%;
                        height: auto;
                        float: left;
                        color: #333;
                        .title {
                            font-size: 34px;
                            padding-left: 10px;
                        }
                        .items {
                            padding-left: 10px;
                            float: left;
                            font-size: 30px;
                            color: #333;
                            line-height: 58px;
                            span {
                                color: #F32F00;
                                margin-left: 38px;
                            }
                        }
                    }
                    .left {
                        &::after {
                            content: "";
                            height: 180px;
                            width: 2px;
                            background: #D8D8D8;
                            display: inline-block;
                            z-index: 30;
                            position: absolute;
                            left: 354px;
                        }
                    }
                }
            }
        }
    }

</style>