<template>
    <my-lists v-model="lists.data" :columns="columns" @change="search" :loading="loading">
        <Card>
            <p slot="title"><span>搜索</span></p>
            <Form ref="searchForm" :model="searchForm" inline :label-width="60">
                <FormItem label="商户简称">
                    <remote remote-url="merchants/select" search-key="title" :remote="false" :ready="true"
                            v-model="searchForm.merchant_id"></remote>
                </FormItem>
                <FormItem :label-width="1">
                    <Button @click="search(1)" type="primary">搜索</Button>
                    <Button @click="download()" type="primary">导出</Button>
                </FormItem>
            </Form>
            <components v-bind:is="component.current" @on-change="hideComponent" :data="component.data"></components>
        </Card>
    </my-lists>
</template>

<script>
    import MyLists from "../../../components/layout/my-lists";
    import lists from "../../../mixins/lists";
    import Remote from "../../../components/select/remote";
    import Bview from "./bview";


    export default {
        name: "index",
        components: {Remote, MyLists,Bview},
        mixins: [lists],
        data() {
            return {
                columns: [{
                    title: '商户名称',
                    render: (h, {row}) => {
                        return <span>{row.merchant ? row.merchant.short_name : ''}</span>
                    }
                }, {
                    title: '商户号码',
                    render: (h, {row}) => {
                        return <span>{row.merchant_user ? row.merchant_user.phone : ''}</span>
                    }
                }, {
                    title: '欠款金额',
                    key: 'borrow'
                }, {
                    title: '逾期未付款金额',
                    key: 'overdue'
                }, {
                    title: '账户余额',
                    key: 'account'
                }, {
                    title: '结算方式',
                    render: (h, {row}) => {
                        return <span>月结</span>
                    }
                }, {
                    title: '承诺回款天数',
                    render: (h, {row}) => {
                        return <span>{row.merchant ? row.merchant.repayment_day : ''}</span>
                    }
                }, {
                    title: '最近还款时间',
                    key: 'latest_repayment_time'
                },
                    {
                        title: '账户明细',
                        render: (h, {row}) => {
                            return (<button-group>
                                <i-button size="small" on-click={() => this.showComponent('Bview', row)}>账户明细</i-button>
                            </button-group>)
                        }
                    }
                ]
            }
        },
        methods: {
            search(page = 1) {
                this.loading = true
                this.$http.get(`account/merchant`, {params: this.request(page)}).then((res) => {
                    this.assignmentData(res.data.data)
                }).finally(() => {
                    this.loading = false
                });
            },
            download() {
                this.$http.download(`account/download`, this.request(), '商户账户账单.xls');
            }
        }
    }
</script>

<style scoped>

</style>