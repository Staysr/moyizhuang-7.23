<template>
    <component-modal title="查看任务报价" :width="950" :loading="loading">
        <box title="查看任务报价">
            <detail title="任务状态">
                <task-status :status="task.status"></task-status>
            </detail>
            <detail title="任务编号">{{task.id}}</detail>
            <detail title="仓库名称"></detail>
            <detail title="线路名称">{{task.name}}</detail>
            <detail title="车型">{{task.car_type_name | formatArray}}</detail>
            <detail title="上岗时间">{{task.work_time}}</detail>
            <detail title="到仓时间">{{task.arrival_warehouse_time}}</detail>
            <detail title="司机报价截止时间">{{task.offer_end_time}}</detail>
            <detail title="选司机截止时间">{{task.choose_driver_end_time}}</detail>
            <detail title="任务创建时间">{{task.create_time}}</detail>
        </box>
        <box title="司机列表">
            <alert>总计 {{offer.length}} 人报价，{{offerChangeCount}} 人可选(所有的司机都会经过方舟仔细筛选，请您放心选择)</alert>
            <my-table :columns="columns" :data="offer" ></my-table>
        </box>
        <components v-bind:is="component.current" @on-change="hideComponent" :data="component.data"></components>

    </component-modal>
</template>

<script>
    import ComponentModal from "../../components/modal/component-modal";
    import lists from "../../mixins/lists";
    import component from "../../mixins/component";
    import Detail from "../../components/detail/index";
    import Box from "../../components/box/index";
    import MyTable from "../../components/table/my-table";
    import TaskStatus from "../components/task/status";
    import {oneOf} from 'iview/src/utils/assist'
    import Rescind from './rescind'

    export default {
        name: "mview",
        components: {TaskStatus, MyTable, Box, Detail, ComponentModal,Rescind},
        mixins: [component,lists],
        data() {
            return {
                task: {},
                columns: [{
                    title: '司机姓名',
                    render: (h, {row}) => {
                        return <span>{row.driver ? row.driver.name : ''}</span>
                    }
                }, {
                    title: '手机号码',
                    width: 120,
                    render: (h, {row}) => {
                        return <span>{row.driver ? row.driver.phone : ''}</span>
                    }
                }, {
                    title: '车牌号码',
                    render: (h, {row}) => {
                        return <span>{row.driver ? row.driver.car_number : ''}</span>
                    }
                }, {
                    title: '报价时间',
                    key: 'create_time',
                    tooltip: true
                }, {
                    title: '竞标语',
                    key: 'remark',
                    tooltip: true
                }, {
                    title: '状态',
                    render: (h, {row}) => {
                        return <span>
                            <tag v-show={row.driver_id === this.task.driver_id} color="green">被选中</tag>
                            <tag v-show={oneOf(row.status, [1, 2]) && row.driver_id !== this.task.driver_id}
                                 color="lime">没选中</tag>
                            <tag v-show={row.status === 0} color="yellow">取消报价</tag>
                        </span>
                    }
                }, {
                    title: '报价',
                    key: 'unit_price'
                }, {
                    title: '操作',
                    render: (h, {row}) => {
                        if (oneOf(this.task.status, [3, 4, 5, 6]) || oneOf(this.task.driver_status, [3, 4]) ||
                            row.status !== 0) {
                            return <div>
                                <i-button size="small"  on-click={() => this.choose(row)} v-show={row.driver_id !== this.task.driver_id} type="info">
                                    选司机
                                </i-button>
                                <i-button size="small"  on-click={() => this.showComponent('Rescind', row)}  v-show={row.driver_id === this.task.driver_id} type="error">
                                    无责任解约
                                </i-button>
                            </div>
                        }
                    }
                }]
            }
        },
        computed: {
            offer() {
                return this.task.offer || []
            },
            offerChangeCount() {
                return this.offer.filter((val) => val.status !== 0).length;
            }
        },
        mounted() {
            this.search()
        },
        methods: {
            search(page = 1) {
                this.loading = true
                this.$http.get(`task/offer/${this.data.id}`).then((res) => {
                    this.task = res.data.data;
                    this.loading = false
                })
            },
            choose(row) {
                this.$http.put(`task/choose/${this.data.id}`,{
                        driver_id:row.driver_id
                  }
                ).then((res) => {
                    this.search();
                })
            }
        },
        filters: {
            formatArray(arr) {
                return (arr || []).join(',')
            }
        }
    }
</script>

<style scoped>

</style>