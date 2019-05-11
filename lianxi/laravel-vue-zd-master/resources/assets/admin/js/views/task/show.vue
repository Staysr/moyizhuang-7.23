<template>
    <component-modal title="查看任务详情" :width="950" :loading="loading">
        <box title="任务信息">
            <detail title="任务编号">{{task.id}}</detail>
            <detail title="任务状态">
                <task-status :status="task.status"></task-status>
            </detail>
            <detail title="任务创建时间">{{task.create_time}}</detail>
            <detail title="任务类型">{{task.type === 1 ? '主任务' : '临时任务'}}</detail>
            <detail title="仓库名称">{{task.warehouse.title}}</detail>
            <detail title="线路名称">{{task.name}}</detail>
            <detail title="是否固定点">{{task.is_fixed_point === 1 ? '固定点' : '非固定点'}}</detail>
            <detail title="是否返仓">{{task.is_back === 1 ? '是' : '否'}}</detail>
            <detail title="非固定点配送点">{{task.unfixed_json|formatNumber}}个 </detail>
            <detail title="配送总里程">{{task.distance_json|formatNumber}} 公里</detail>
            <detail title="配送区域描述">{{task.delivery_point_remark}}</detail>
            <detail title="保险">{{task.merchant_safe_id === 0 ? "未购买": (task.merchant_safe.is_per===1)?
                "运费的"+task.merchant_safe.is_per+"%":task.merchant_safe.safe_fee}}
            </detail>
            <detail title="车型" :span="12">{{task.car_type_name | formatArray}}</detail>

        </box>
            <box title="固定配送点信息" v-if="task.delivery">
                <Table :columns="tableCol" :data="task.delivery" size="small" ref="table"
                       :loading="loading"></Table>
            </box>
        <box title="任务时间">

            <detail title="司机上岗日期">{{task.type === 1 ? task.arrival_date : task.temp_start_date}}</detail>
            <detail title="配送时间">
                {{task.type === 2 ?task.temp_start_date:task.send_time|formatWeek}}
            </detail>
            <detail title="到仓时间">{{task.arrival_warehouse_time}}</detail>
            <detail title="预计完成时间">{{task.estimate_time}}</detail>
            <detail title="报价截止时间" :span="8">{{task.offer_end_time}}</detail>
            <detail title="选司机截止时间" :span="8">{{task.choose_driver_end_time}}</detail>
        </box>

        <box title="任务描述">

            <detail title="货物类型">{{task.goods_remark}}</detail>
            <detail title="货物总体积">{{task.goods_volume|formatNumber}}立方米</detail>
            <detail title="货物件数">{{task.goods_num|formatNumber}}件</detail>
            <detail title="货物总重量">{{task.goods_weight|formatNumber}}吨</detail>
            <detail title="是否回单">{{task.back_bill === 1 ? '是' : '否'}}</detail>
            <detail title="预计每趟价格">{{task.unit_price|formatNumber}}元</detail>
            <detail title="报价说明">{{task.price_remark}}</detail>
        </box>

        <box title="搬运说明">
            <detail title="货物类型">{{task.carry_type|formatCarry }}</detail>
            <detail title="自带小工">{{task.extra.carry.is_worker === 1 ? '是' : '否'}}</detail>
            <detail title="帮忙装货">{{task.extra.carry.is_loading === 1 ? '是' : '否'}}</detail>
            <detail title="帮忙卸货">{{task.extra.carry.is_unloading === 1 ? '是' : '否'}}</detail>
            <detail title="搬运说明">{{task.carry_type === 0 ? '无需搬运' : task.extra.carry.textarea}}</detail>
        </box>

        <box title="上岗要求">
            <detail title="需要拆后座">{{task.extra.other.is_remove_seat === 1 ? '是' : '否'}}</detail>
            <detail title="需要小推车">{{task.extra.other.is_trolley === 1 ? '是' : '否'}}</detail>
            <detail title="需要带尾板">{{task.extra.other.is_tail_plate === 1 ? '是' : '否'}}</detail>
            <detail title="需要配备双灭火器">{{task.extra.other.is_extinguisher === 1 ? '是' : '否'}}</detail>
            <detail title="需要配备明锁/暗锁">{{task.extra.other.is_lock === 1 ? '是' : '否'}}</detail>
            <detail title="其他上岗要求">{{task.extra.other.other_require}}</detail>
        </box>
        <box title="其他说明">
            <detail title="任务补充说明" :span="25">{{task.extra.supply|valueOfSingle}}</detail>
            <detail title="配送经验要求" :span="25">{{task.extra.dispatching|valueOfSingle}}</detail>
            <detail title="司机福利/补贴/奖励" :span="25">{{task.extra.welfare|valueOfSingle}}</detail>
        </box>
    </component-modal>
</template>

<script>
    import ComponentModal from "../../components/modal/component-modal";
    import component from "../../mixins/component";
    import Detail from "../../components/detail/index";
    import Box from "../../components/box/index";
    import TaskStatus from "../components/task/status";

    export default {
        name: "show",
        components: {TaskStatus, Box, Detail, ComponentModal},
        mixins: [component],
        data() {
            return {
                tableCol: [{
                    title: '序号',
                    render: (h, {index}) => {
                        return <span>{++index}</span>
                    }},
                    {
                        title: '地址',
                        key:"name"
                    },
                    {
                        title: '联系人',
                        key:"contacts"
                    }, {
                        title: '联系方式',
                        key:"contact_way"
                    }],
                task: {
                    send_time: [],
                    warehouse: {
                        id: 0,
                        title: ''
                    },
                    distance_json:'',
                    goods_volume:'',
                    goods_weight:'',
                    goods_num:'',
                    unit_price:'',
                    merchant_safe: {
                        is_per: 0,
                        safe_fee: 0,
                    },
                    extra: {
                        carry: {
                            is_worker: 0,
                            is_loading: 0,
                            is_unloading: 0,
                            textarea: '',
                        },
                        other: {
                            is_remove_seat: 0,
                            is_trolley: 0,
                            is_tail_plate: 0,
                            is_extinguisher: 0,
                            is_lock: 0,
                            other_require: "",
                        }
                    }
                }
            }
        },
        mounted() {
            this.search()
        },
        methods: {
            search(page = 1) {
                this.loading = true
                this.$http.get(`task/${this.data.id}`).then((res) => {
                    this.task = JSON.parse(JSON.stringify(res.data.data));
                    this.loading = false
                })
            }
        },
        filters: {
            formatArray(arr) {
                return (arr || []).join(',')
            },
            formatWeek(arr) {
                let result = '';
                let weekday = ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六", "星期日"];
                if (arr !== undefined && arr instanceof Array) {
                    arr.forEach(function (item, key) {
                        result += weekday[key] + " ";
                    });
                    return result
                } else {
                    return arr;
                }
            },
            valueOfSingle(arr) {
                let result = '';

                if (arr !== undefined && arr instanceof Array) {
                    arr.forEach(function (item, key) {
                        result += item['value'] + " ";
                    });
                    return result;
                } else {
                    return "";
                }
            },
            formatCarry(value) {
                switch (value) {
                    case 0:
                        return '无需搬运';
                    case 1:
                        return '轻度搬运';
                    case 2:
                        return '中度搬运';
                    case 3:
                        return '重度搬运';
                }
            },
            formatNumber(obj){
                if(!obj){
                    return '';
                }else{
                    return obj.min+'-'+obj.max
                }
            }
        }
    }
</script>

<style scoped>

</style>