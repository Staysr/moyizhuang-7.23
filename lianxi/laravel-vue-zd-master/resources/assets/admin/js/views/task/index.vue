<template>
    <my-lists v-model="lists.data" :columns="columns" @change="search" :loading="loading">
        <Card>
            <p slot="title"><span>搜索</span></p>
            <Form ref="searchForm" :model="searchForm" inline :label-width="60">
                <FormItem label="商户简称">
                    <remote remote-url="merchants/select" search-key="title" v-model="searchForm.merchant_id"></remote>
                </FormItem>
                <FormItem label="仓库名称">
                    <remote remote-url="warehouse/select" v-model="searchForm.warehouse_id"
                            :params="{merchant_id: this.searchForm.merchant_id}" :remote="false"></remote>
                </FormItem>
                <FormItem label="任务编号">
                    <Input v-model="searchForm.task_id"></Input>
                </FormItem>
                <FormItem label="线路名称">
                    <Input v-model="searchForm.name"></Input>
                </FormItem>
                <FormItem label="司机姓名">
                    <remote remote-url="driver/select" search-key="title" v-model="searchForm.driver_id"></remote>
                </FormItem>
                <FormItem label="任务类型">
                    <task-type v-model="searchForm.type"></task-type>
                </FormItem>
                <FormItem label="司机状态">
                    <driver-select-status v-model="searchForm.driver_status"></driver-select-status>
                </FormItem>
                <FormItem label="发布日期">
                    <c-date-picker type="datetimerange" v-model="searchForm.create_time"
                                   style="width: 260px"></c-date-picker>
                </FormItem>
                <FormItem :label-width="1">
                    <Button @click="search(1)" type="primary">搜索</Button>
                    <Button @click="go('task.create')" type="primary">招司机</Button>
                </FormItem>
            </Form>
        </Card>
        <components v-bind:is="component.current" @on-change="hideComponent" :data="component.data"></components>
    </my-lists>
</template>

<script>
    import MyLists from "../../components/layout/my-lists";
    import lists from "../../mixins/lists";
    import TaskStatus from "../components/task/status"
    import TaskDriverStatus from "../components/task/driver-status"
    import TagsTrueOrFalse from "../../components/tags/true-or-false"
    import Remote from "../../components/select/remote";
    import TaskType from "../components/task/select-status";
    import DriverSelectStatus from "../components/task/driver-select-status";
    import CDatePicker from "../../components/date-picker/index";
    import mView from "./view"
    import assigned from './assigned'
    import change from './change'
    import safe from './safe'
    import show from './show'

    export default {
        name: "index",
        components: {
            CDatePicker,
            DriverSelectStatus, TaskType, Remote, MyLists, TaskStatus, TagsTrueOrFalse, TaskDriverStatus,
            mView, assigned,safe,change,show
        },
        mixins: [lists],
        data() {
            return {
                searchForm: {},
                columns: [{
                    title: '任务类型',
                    render: (h, {row}) => {
                        return <div>
                            <tag color="gold">{row.type === 1 ? '主' : '临'}</tag>
                        </div>
                    }
                },{
                    title: '任务编号',
                    key: 'id',
                    render: (h, {row}) => {
                        return <div>
                            <a on-click={() => this.showComponent('mView', row)}>{row.id}</a>
                        </div>
                    }
                },{
                    title: '商户简称',
                    render: (h, {row}) => {
                        return <span>{row.merchant ? row.merchant.short_name : ''}</span>
                    }
                }, {
                    title: '仓名称',
                    render: (h, {row}) => {
                        return <span>{row.warehouse.title}</span>
                    }
                }, {
                    title: '线路名称',
                    key: 'name'
                }, {
                    title: '（报价/查看）',
                    render: (h, {row}) => {
                        return <span>{row.browse_count} / {row.browse_count}</span>
                    }
                }, {
                    title: '任务状态',
                    width: 130,
                    render: (h, {row}) => {
                        return <TaskStatus status={row.status}></TaskStatus>
                    }
                }, {
                    title: '司机信息',
                    render: (h, {row}) => {
                        if (row.rescind) {
                            return <tooltip theme="light" placement="top" transfer
                                            content={`手机号码: ${row.rescind.phone} \n 车辆类型：${row.rescind.car_type.name} \n 车牌号码 ${row.rescind.car_number}`}
                                            max-width={250}>{row.rescind ? row.rescind.name : ''}</tooltip>

                        } else if (row.driver) {
                            return <tooltip theme="light" placement="top" transfer
                                            content={`手机号码: ${row.driver.phone} \n 车辆类型：${row.driver.car_type.name} \n 车牌号码 ${row.driver.car_number}`}
                                            max-width={250}>{row.driver ? row.driver.name : ''}</tooltip>
                        }
                    }
                }, {
                    title: '司机状态',
                    width: 120,
                    render: (h, {row}) => {
                        return <TaskDriverStatus status={row.driver_status}></TaskDriverStatus>
                    }
                }, {
                    title: '上岗日期',
                    render: (h, {row}) => {
                        return <span>{row.type === 1 ? row.arrival_date : row.temp_start_date}</span>
                    }
                }, {
                    title: '是否指派司机',
                    render: (h, {row}) => {
                        return <TagsTrueOrFalse status={row.assign_status}></TagsTrueOrFalse>
                    }
                },{
                    title: '是否显示',
                    render: (h, {row}) => {
                        return  <i-button size="small" on-click={() => this.toggle(row)} type={`${row.is_show === 1 ? 'success' : 'primary'}`} size="small">{row.is_show === 1 ? '是' : '否'}</i-button>
                    }
                },{
                    title: '详情',
                    render: (h, {row}) => {
                        return <div>
                            <a on-click={() => this.showComponent('show', row)}>详情</a>
                        </div>
                    }
                }, {
                    title: '操作',
                    render: (h, {row}) => {
                        return (<dropdown trigger="click" on-on-click={(name) => this.listTrigger(name, row)}>
                            <i-button size="small">操作</i-button>
                            <dropdown-menu slot="list">
                                <dropdown-item name="复制">
                                    复制
                                </dropdown-item>
                                <dropdown-item name="购买保价">
                                    购买保价
                                </dropdown-item>
                                <dropdown-item name="删除">
                                    删除
                                </dropdown-item>
                                <dropdown-item name="作废">
                                    作废
                                </dropdown-item>
                                <dropdown-item name="全都不选">
                                    全都不选
                                </dropdown-item>
                                <dropdown-item name="指派任务">
                                    指派任务
                                </dropdown-item>
                                <dropdown-item name="改派任务">
                                    改派任务
                                </dropdown-item>
                            </dropdown-menu>
                        </dropdown>
                        )
                    }

                }]
            }
        },
        methods: {
            search(page = 1) {
                this.loading = true
                this.$http.get(`task`, {params: this.request(page)}).then((res) => {
                    this.assignmentData(res.data.data)
                }).finally((res) => {
                    this.loading = false
                })
            },
            go (name, params) {
                this.$router.push({name: name, params: params})
            },
            listTrigger(name, row) {
                switch (name) {
                    case '复制':
                        this.go('task.create', {id: row.id})
                        break;
                    case '指派任务':
                        this.showComponent('assigned', row);
                        break;
                    case '改派任务':
                        this.showComponent('change', row);
                        break;
                    case '作废':
                        this.abandon(row);
                        break;
                    case '删除':
                        this.delete(row);
                        break;
                    case '全都不选':
                        this.none(row);
                        break;
                    case '购买保价':
                        this.showComponent('safe', row);
                        break;
                }
            },
            toggle(row){
                let current=this.lists.data.page.current;
                this.$http.put(`task/toggle/${row.id}`,{params:{'status':row.status}}).then((res) => {
                }).finally((res) => {
                   this.search(current)
                })
            },
            abandon(row){
                let current=this.lists.data.page.current;
                this.$http.put(`task/abandon/${row.id}`).then((res) => {
                    this.$Message.success('任务作废成功')
                }).catch((res) => {
                    this.formatErrors(res)
                }).finally((res) => {
                    this.search(current)
                });
            },
            delete(row){
                let current=this.lists.data.page.current;
                this.$http.put(`task/delete/${row.id}`).then((res) => {
                    this.$Message.success('任务删除成功')
                }).catch((res) => {
                    this.error(res)
                }).finally((res) => {
                    this.search(current)
                });
            },
            none(row) {
                let current = this.lists.data.page.current;
                this.$http.put(`task/none/${row.id}`).then((res) => {
                    this.$Message.success('全都不选成功')
                }).catch((res) => {
                    this.formatErrors(res)
                }).finally((res) => {
                    this.search(current)
                });
            }
        }

    }
</script>

<style scoped>

</style>