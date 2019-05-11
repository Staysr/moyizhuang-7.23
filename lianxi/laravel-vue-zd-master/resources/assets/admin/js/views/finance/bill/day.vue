<template>
    <my-lists v-model="lists.data" :columns="columns" @change="search" :loading="loading">
        <Card>
            <p slot="title"><span>搜索</span></p>
            <Form ref="searchForm" :model="searchForm" inline  :label-width="60">
                <FormItem label="商户简称">
                    <remote remote-url="merchants/select" search-key="title" :remote="true"
                            v-model="searchForm.merchant_id"></remote>
                </FormItem>
                <FormItem label="账单日期">
                    <c-date-picker v-model="searchForm.create_time" :options="options" type="daterange"></c-date-picker>
                </FormItem>
                <FormItem :label-width="1">
                    <Button @click="search(1)" type="primary">搜索</Button>
                    <Button @click="download()" type="primary">导出</Button>
                </FormItem>
            </Form>
            <alert>配送完成 <b>{{total[0]}}</b> 次，待还款 <b>{{total[1]}}</b> 元</alert>

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
    import moment from 'moment'

    export default {
        name: "index",
        components: {Remote, CDatePicker, MyLists,BillRepayStatus,BillRepayOverdue,Bview},
        mixins: [lists],
        data() {
            return {
                extra:{
                    total:[]
                },
                options: {
                    disabledDate: (value) => {
                        if(  moment(value).isBefore(moment().startOf('month'))  ||  moment(value).isAfter(moment()) ){
                            return true;
                        }
                    }
                },
                columns: [
                    {
                        title: '任务编号',
                        render: (h, {row}) => {
                            return <span>{row.order ? row.order.task_id : ''}</span>
                        }
                    },
                    {
                        title: '出车单号',
                        render: (h, {row}) => {
                            return <span>{row.order ? row.order.order_no : ''}</span>
                        }
                    },
                    {
                        title: '到仓时间',
                        render: (h, {row}) => {
                            return <span>{row.order ? row.order.arrival_warehouse_time : ''}</span>
                        }
                    },
                    {
                        title: '商户简称',
                        render: (h, {row}) => {
                            return <span>{row.merchant ? row.merchant.short_name : ''}</span>
                        }
                    },
                    {
                        title: '运费',
                        render: (h, {row}) => {
                            return <span>{row.order ? (parseFloat(row.order.unit_price)+parseFloat(row.order.merchant_safe_fee)).toFixed(2): '0.00'}</span>
                        }
                    },
                    {
                        title: '商户保险费',
                        render: (h, {row}) => {
                            return <span>{row.order ? row.order.merchant_safe_fee : '0.00'}</span>
                        }
                    },
                    {
                        title: '金额',
                        render: (h, {row}) => {
                            return <span>{row.order ? row.order.unit_price:'0.00'}</span>
                        }
                    },
                    {
                        title: '计费类型',
                        render: (h, {row}) => {
                            return <span>计费</span>
                        }
                    },
                    {
                        title: '司机姓名',
                        render: (h, {row}) => {
                            return <span>{row.driver ? row.driver.name: ''}</span>
                        }
                    },
                    {
                        title: '任务名称',
                        render: (h, {row}) => {
                            return <span>{row.order ? row.order.task.name: ''}</span>
                        }
                    },
                    {
                        title: '仓名称',
                        render: (h, {row}) => {
                            return <span>{row.order? row.order.task.warehouse.title: ''}</span>
                        }
                    },
                    {
                        title: '配送完成时间',
                        render: (h, {row}) => {
                            return <span>{row.order ? row.order.finish_time : ''}</span>
                        }
                    }
                ]
            }
        },
        computed: {
            total() {
                return this.extra.total;
            }
        },
        methods: {
            search(page = 1){
                this.loading = true
                this.$http.get(`bill/day`, {params: this.request(page)}).then((res) => {
                    this.assignmentData(res.data.data)
                }).finally(() => {
                    this.loading = false
                });

                this.$http.get(`bill/analysis`, {params: this.request(page)}).then((res) => {
                    this.$set(this.extra,'total',res.data.data);
                }).finally(() => {
                    this.loading = false
                });
            },
            download() {
                this.$http.download(`bill/download`, this.request(), '未出账单.xls');
            }
        }
    }
</script>

<style scoped>

</style>