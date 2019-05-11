<template>
    <my-lists v-model="lists.data" :columns="columns" @change="search" :loading="loading">
        <Card>
            <p slot="title"><span>搜索</span></p>
            <Form ref="searchForm" :model="searchForm" inline :label-width="60">
                <FormItem label="商户简称">
                    <remote remote-url="merchants/select" search-key="title" :remote="true"
                            v-model="searchForm.merchant_id"></remote>
                </FormItem>
                <FormItem label="账单日期">
                    <CalendarPicker type="daterange" v-model="searchForm.bill_time"
                                    placeholder="Select date"></CalendarPicker>
                </FormItem>
                <FormItem label="还款状态">
                    <Select v-model="searchForm.status">
                        <Option :value="0">待还款</Option>
                        <Option :value="1">部分还款</Option>
                        <Option :value="2">已经还款</Option>
                        <Option :value="3">无需还款</Option>
                    </Select>
                </FormItem>
                <FormItem label="逾期状态">
                    <Select v-model="searchForm.overdue">
                        <Option :value="0">已完成</Option>
                        <Option :value="1">账期内</Option>
                        <Option :value="2">账期未还款</Option>
                    </Select>
                </FormItem>
                <FormItem :label-width="1">
                    <Button @click="search(1)" type="primary">搜索</Button>
                    <Button @click="download()" type="primary">导出</Button>
                </FormItem>
                    <alert>账单总金额 <b>{{total[0]}}</b> 元，已还款 <b>{{total[1]}}</b> 元，待还款 <b>{{total[2]}}</b> 元</alert>
            </Form>
            <components v-bind:is="component.current" @on-change="hideComponent" :data="component.data"></components>
        </Card>
    </my-lists>
</template>

<script>
    import MyLists from "../../../components/layout/my-lists";
    import lists from "../../../mixins/lists";
    import CDatePicker from "../../../components/date-picker/index";
    import Remote from "../../../components/select/remote";
    import BillRepayStatus from "../../components/bill-repay/status";
    import BillRepayOverdue from "../../components/bill-repay/overdue";
    import Bview from "./bview";
    import RepayLog from "./repaylog";
    import Repay from "./repay";
    import moment from 'moment'
    import CalendarPicker from '../../../components/month-picker/index'
    import Box from "../../../components/box/index";


    export default {
        name: "index",
        components: {
            Remote,
            CDatePicker,
            MyLists,
            BillRepayStatus,
            BillRepayOverdue,
            Bview,
            RepayLog,
            Repay,
            CalendarPicker,
            Box
        },
        mixins: [lists],
        data() {

            return {
                extra:{
                    total:[]
                },
                columns: [
                    {
                        title: '账单编号',
                        key: 'bill_no'
                    },
                    {
                        title: '商户简称',
                        render: (h, {row}) => {
                            return <span>{row.merchant ? row.merchant.short_name : ''}</span>
                        }
                    },
                    {
                        title: '账单时间',
                        key: 'bill_time'
                    },
                    {
                        title: '账单金额',
                        key: 'money'
                    },
                    {
                        title: '还款金额',
                        key: 'repayment_money'
                    },
                    {
                        title: '最后还款时间',
                        key: 'last_repayment_time'
                    }
                    , {
                        title: '还款状态',
                        render: (h, {row}) => {
                            return <BillRepayStatus status={row.status}></BillRepayStatus>
                        }
                    }, {
                        title: '逾期状态',
                        render: (h, {row}) => {
                            return <BillRepayOverdue overdue={row.overdue}></BillRepayOverdue>
                        }
                    },
                    {
                        title: '还款明细',
                        render: (h, {row}) => {
                            return (<button-group>
                                <i-button size="small" on-click={() => this.showComponent('RepayLog', row)}>还款明细
                                </i-button>
                            </button-group>)
                        }
                    },
                    {
                        title: '账户明细',
                        render: (h, {row}) => {
                            return (<button-group>
                                <i-button size="small" on-click={() => this.showComponent('Bview', row)}>账户明细</i-button>
                            </button-group>)
                        }
                    },
                    {
                        title: '操作',
                        render: (h, {row}) => {
                            return (<button-group>
                                <i-button size="small" on-click={() => this.showComponent('Repay', row)}>还款</i-button>
                            </button-group>)
                        }
                    },
                ]
            }
        },
        computed: {
            total() {
                return this.extra.total;
            }
        },
        methods: {
            search(page = 1) {
                this.loading = true
                this.$http.get(`bill/month`, {params: this.request(page)}).then((res) => {
                    this.assignmentData(res.data.data)
                }).finally(() => {
                    this.loading = false
                });

                this.$http.get(`bill/statistics`, {params: this.request(page)}).then((res) => {
                    this.$set(this.extra,'total',res.data.data);
                }).finally(() => {
                    this.loading = false
                });
            },
            download() {
                this.$http.download(`bill/export`, this.request(), '已出账单.xls');
            }
        }
    }
</script>

<style scoped>

</style>