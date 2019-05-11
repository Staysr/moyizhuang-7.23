<template>
    <component-modal title="查看出车单" :width="1000" :loading="loading">
        <div class="order-step">
            <Steps :current="orders.status" v-if="orders.status === 0 || orders.status === 1 || orders.status === 2
            || orders.status === 3">
                <Step title="未签到" content=""></Step>
                <Step title="已签到" content=""></Step>
                <Step title="配送中" content=""></Step>
                <Step title="配送完成" content=""></Step>
            </Steps>
        </div>

        <box title="任务信息">
            <detail title="任务编号">{{orders.task_id}}</detail>
            <detail title="任务类型">
                <span v-if="orders.task && orders.task.type === 1">主任务</span>
                <span v-else>临时任务</span>
            </detail>
            <detail title="线路名称">{{orders.name }}</detail>
            <detail title="配送信息">{{orders.point_count}} 个 (非固定配送点)</detail>
            <detail title="区域描述" :span="16">{{orders.delivery_point_remark}}</detail>
        </box>

        <box title="仓库信息">
            <detail title="仓库名称">{{orders.warehouse ? orders.warehouse.title : ''}}</detail>
            <detail title="联系人">{{orders.warehouse ? orders.warehouse.contacts : ''}}</detail>
            <detail title="联系电话">{{orders.warehouse ? orders.warehouse.contacts_phone : ''}}</detail>
            <detail title="到仓时间">{{orders.arrival_warehouse_time}}</detail>
            <detail title="仓库地址" >{{orders.warehouse ? orders.warehouse.address : ''}}</detail>
            <detail title="仓库备注">{{orders.warehouse ? orders.warehouse.remark : ''}}</detail>

        </box>

        <box title="司机信息">
            <detail title="司机姓名">{{orders.driver ? orders.driver.name : ''}}</detail>
            <detail title="司机类型">
                <span v-if="orders.driver && orders.driver.driver_type === 0">自营司机</span>
                <span v-if="orders.driver && orders.driver.driver_type === 1">合作司机</span>
                <span v-if="orders.driver && orders.driver.driver_type === 2">社会司机</span>
            </detail>
            <detail title="联系电话">{{orders.driver ? orders.driver.phone : ''}}</detail>
            <detail title="车牌号码">{{orders.driver ? orders.driver.car_number : ''}}</detail>
            <detail title="司机头像"><img :src="orders.driver ? orders.driver.head_img_url : ''" height="30" width="30"/></detail>
        </box>

        <box title="途径点">
            <i-button  size="small" @click="showComponent('Point',orders)" type="primary">添加</i-button>
            <i-button size="small"  type="primary"  @click="notify(orders)" >通知</i-button>
            <Table :columns="columns" :data="orders.delivery" style="margin-top: 10px"></Table>
        </box>
        <components v-bind:is="component.current" @on-change="hideComponent" :data="component.data" @on-ok="() => {this.getView()}"></components>
    </component-modal>
</template>

<script>



    import ComponentModal from "../../components/modal/component-modal";
    import component from "../../mixins/component";
    import Box from "../../components/box/index";
    import Detail from "../../components/detail/index";
    import Remote from "../../components/select/remote";
    import Point from "./point";
    import lists from "../../mixins/lists";


    export default {
        name: "o-view",
        components: {Detail, Box, ComponentModal,Remote,Point},
        mixins: [component,lists],
        mounted() {
            this.$nextTick(() => {
                this.getView()
            })
        },
        data() {
            return {
                orders: {
                    delivery: []
                },
                columns: [{
                    title: '序号',
                    render: (h, {index}) => {
                        return <span>{index + 1}</span>
                    }
                }, {
                    title: '联系人',
                    key: 'contacts'
                }, {
                    title: '联系方式',
                    key: 'contact_way'
                }, {
                    title: '交付地址',
                    key: 'name'
                }, {
                    title: '实际地址',
                    key: 'put_address'
                }, {
                    title: '妥投状态',
                    render: (h, {row}) => {
                        return <span>{row.status === 0 ? '未操作' : row.status === 1 ? '已妥投' : '未妥投'}</span>
                    }
                }, {
                    title: '原因',
                    key: 'reason'
                }, {
                    title: '签收照片',
                    key: 'img_one'
                }, {
                    title: '妥投时间',
                    key: 'finish_time'
                },{
                        title: '操作',
                        render: (h, {row}) => {
                            return (<button-group>
                                <poptip confirm transfer title="确定要删除吗？" on-on-ok={() => this.destroyItem(row, `order/point/${row.id}`)}>
                                    <i-button size="small" >删除</i-button>
                                </poptip>
                            </button-group>)
                        }
                    }
                ]
            }
        },
        methods: {
            notify (item) {
                this.$http.post(`order/notify/${item.id}`).then((res) => {
                }).finally(() => {
                    this.$Message.success('已推送通知')
                });
            },
            getView(){
                this.loading = true
                this.$http.get(`order/${this.data.id}`).then((res) => {
                    this.orders = res.data.data
                }).finally(() => {
                    this.loading = false
                })
            },destroyItem (row, url) {
                this.loading = true
                this.$http.delete(url).then((res) => {
                    this.getView()
                }).catch((res) => {
                    this.formatErrors(res)
                }).finally(() => {
                    this.loading = false
                })
            },
        }
    }
</script>

<style scoped>
    .order-step {
        margin-bottom: 10px;
    }
</style>