<template>
    <my-lists v-model="lists.data" :columns="columns" @change="search" :loading="loading">
        <Card>
            <p slot="title"><span>搜索</span></p>
            <Form ref="searchForm" :model="searchForm" inline :label-width="60">
                <FormItem label="商户简称">
                    <remote remote-url="merchants/select" search-key="title" v-model="searchForm.merchant_id"></remote>
                </FormItem>
                <FormItem label="出车单号">
                    <Input v-model="searchForm.order_no"></Input>
                </FormItem>
                <FormItem label="任务名称">
                    <remote remote-url="task/select" v-model="searchForm.task_id"></remote>
                </FormItem>
                <FormItem label="仓库名称">
                    <remote remote-url="warehouse/select" v-model="searchForm.warehouse_id"></remote>
                </FormItem>
                <FormItem label="线路名称">
                    <Input v-model="searchForm.name"></Input>
                </FormItem>
                <FormItem label="司机姓名">
                    <remote remote-url="driver/select" search-key="title" v-model="searchForm.driver_id"></remote>
                </FormItem>
                <FormItem label="异常">
                    <true-or-false v-model="searchForm.exception_count"></true-or-false>
                </FormItem>
                <FormItem label="代签到">
                    <true-or-false v-model="searchForm.is_agent"></true-or-false>
                </FormItem>
                <FormItem label="一键完成">
                    <true-or-false v-model="searchForm.is_one_step_finish"></true-or-false>
                </FormItem>
                <FormItem label="改派司机">
                    <true-or-false v-model="searchForm.is_reassigned"></true-or-false>
                </FormItem>
                <FormItem label="到仓时间">
                    <c-date-picker type="datetimerange"
                                   v-model="searchForm.arrival_warehouse_time"
                                   :customize="true"
                                   style="width: 280px">
                    
                    </c-date-picker>
                </FormItem>
                <Divider></Divider>
                <FormItem label="出车单状态" :label-width="80">
                    <div class="checkbox-button-all"
                         :class="{'checkbox-button-all-checked':!searchForm.status.length }" @click="() =>
                         {this.searchForm.status = []}">全部
                    </div>
                    <checkbox-button-group v-model="searchForm.status">
                        <checkbox-button value="0">未签到</checkbox-button>
                        <checkbox-button value="1">已签到</checkbox-button>
                        <checkbox-button value="2">配送中</checkbox-button>
                        <checkbox-button value="3">配送完成</checkbox-button>
                        <checkbox-button value="4">设置不配送</checkbox-button>
                        <checkbox-button value="5">无责任解约</checkbox-button>
                        <checkbox-button value="6">运营取消</checkbox-button>
                    </checkbox-button-group>
                </FormItem>
                <FormItem :label-width="2">
                    <Button @click="search(1)" type="primary">搜索</Button>
                    <Button @click="download()" type="primary">导出</Button>
                </FormItem>
            </Form>
        </Card>
        
        <components v-bind:is="component.current" @on-change="hideComponent" :data="component.data"></components>
    </my-lists>
</template>


<script>
    import MyLists             from '../../components/layout/my-lists'
    import lists               from '../../mixins/lists'
    import CDatePicker         from '../../components/date-picker/index'
    import TrueOrFalse         from '../../components/select/true-or-false'
    import CheckboxButtonGroup from '../../components/checkbox/group-box'
    import CheckboxButton      from '../../components/checkbox/index'
    import mView               from './view'
    import Remote              from '../../components/select/remote'
    import Cancel              from './cancel'
    import Undo                from './undo'
    import Finish              from './finish'
    import Agent               from './agent'
    import Change              from './change'
    import TaskOrderStatus     from '../components/task-order/status'
    import { oneOf }           from 'iview/src/utils/assist'
    import moment              from 'moment'

    export default {
        name: 'index',
        components: {
            TaskOrderStatus, Remote, CheckboxButton, CheckboxButtonGroup,
            TrueOrFalse, CDatePicker, MyLists, mView, Cancel, Undo, Agent, Finish, Change
        },
        mixins: [lists],
        data () {
            return {
                searchForm: {
                    status: []
                },
                columns: [
                    {
                        title: '商户简称',
                        render: (h, {row}) => {
                            return <span>{row.merchant.short_name}</span>
                        }
                    }, {
                        title: '出车单号',
                        render: (h, {row}) => {
                            return <a on-click={() => {
                                this.showComponent('mView', row)
                            }}>{row.order_no}</a>
                        }
                    }, {
                        title: '到仓时间',
                        key: 'arrival_warehouse_time',
                        width: 150
                    }, {
                        title: '任务编号',
                        render: (h, {row}) => {
                            return <span>{row.task_id}</span>
                        }
                    }, {
                        title: '线路名称',
                        key: 'name'
                    }, {
                        title: '仓名称',
                        render: (h, {row}) => {
                            return <span>{row.warehouse.title}</span>
                        }
                    }, {
                        title: '状态',
                        render: (h, {row}) => {
                            return <TaskOrderStatus status={row.status}></TaskOrderStatus>
                        }
                    }, {
                        title: '司机姓名',
                        render: (h, {row}) => {
                            return <span>{row.driver ? row.driver.name : ''}</span>
                        }
                    }, {
                        title: '所属队长',
                        render: (h, {row}) => {
                            return <span>{row.driver && row.driver.supervisor ? row.driver.supervisor.name : ''}</span>
                        }
                    }, {
                        title: '司机手机号',
                        render: (h, {row}) => {
                            return <span>{row.driver ? row.driver.phone : ''}</span>
                        }
                    }, {
                        title: '车型',
                        render: (h, {row}) => {
                            return <span>{row.car_type ? row.car_type.name : ''}</span>
                        }
                    }, {
                        title: '操作',
                        render: (h, {row}) => {
                            return (<dropdown trigger="click" on-on-click={(name) => this.listTrigger(name, row)}
                                              v-show={!oneOf(row.status, [4, 5, 6])}>
                                <i-button size="small">操作</i-button>
                                <dropdown-menu slot="list">
                                    <dropdown-item name="设置不配送" v-show={!oneOf(row.status, [3, 4, 5, 6])}>设置不配送
                                    </dropdown-item>
                                    <dropdown-item name="运营取消"
                                                   v-show={!oneOf(row.status, [4, 5, 6])}>运营取消
                                    </dropdown-item>
                                    <dropdown-item name="代签到" v-show={!oneOf(row.status, [1, 2, 3, 4, 5, 6])}>代签到
                                    </dropdown-item>
                                    <dropdown-item name="一键完成" v-show={!oneOf(row.status, [3, 4, 5, 6])}>一键完成
                                    </dropdown-item>
                                    <dropdown-item name="到仓时间或价格变更" v-show={this.isChange(row)}>
                                        到仓时间或价格变更
                                    </dropdown-item>
                                </dropdown-menu>
                            </dropdown>)
                        }
                    }
                ]
            }
        },
        methods: {
            search (page = 1) {
                this.loading = true
                this.$http.get(`order`, {params: this.request(page)}).then((res) => {
                    this.assignmentData(res.data.data)
                }).catch(() => {
                    this.assignmentData([])
                }).finally(() => {
                    this.loading = false
                })
            },
            isChange (row) {
                return moment(row.arrival_warehouse_time).isBetween(moment().subtract('day', 2), moment().add('day',
                    1), 'day') && (!oneOf(row.status, [4, 5, 6]))
            },
            listTrigger (name, row) {
                switch (name) {
                    case '设置不配送':
                        this.showComponent('Undo', row)
                        break
                    case '运营取消':
                        this.showComponent('Cancel', row)
                        break
                    case '代签到':
                        this.showComponent('Agent', row)
                        break
                    case '一键完成':
                        this.showComponent('Finish', row)
                        break
                    case '到仓时间或价格变更':
                        this.showComponent('Change', row)
                        break
                }
            },
            download () {
                this.$http.download(`order/export`, this.request(), '出车单列表.xls')
            }
        },
        watch: {
            'searchForm.arrival_warehouse_time' (val) {
                if (!val[0] || !val[1])
                    delete this.searchForm.arrival_warehouse_time
            }
        }
    }
</script>

<style scoped>
    .checkbox-button-all {
        vertical-align: middle;
        display: inline-block;
        height: 32px;
        line-height: 30px;
        margin: 0;
        padding: 0 15px;
        font-size: 12px;
        color: #515a6e;
        transition: all .2s ease-in-out;
        cursor: pointer;
        border: 1px solid #dcdee2;
        background: #fff;
        position: relative;
        border-radius: 4px;
    }
    
    .checkbox-button-all-checked {
        border-color: #2d8cf0;
        color: #2d8cf0;
    }
</style>