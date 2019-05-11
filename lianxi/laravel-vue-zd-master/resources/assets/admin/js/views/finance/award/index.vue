<template>
    <my-lists v-model="lists.data" :columns="columns" @change="search" :loading="loading">
        <Card>
            <p slot="title"><span>搜索</span></p>
            <Form ref="searchForm" :model="searchForm" inline :label-width="60">
                <FormItem label="司机姓名">
                    <remote remote-url="driver/select" search-key="title" :remote="true"
                            v-model="searchForm.driver_id"></remote>
                </FormItem>
                <FormItem label="商户简称">
                    <remote remote-url="merchants/select" search-key="title" :remote="true"
                            v-model="searchForm.merchant_id"></remote>
                </FormItem>

                <FormItem label="创建日期">
                    <c-date-picker v-model="searchForm.create_time" :options="options" type="daterange"></c-date-picker>
                </FormItem>

                <FormItem label="类型">
                    <Select v-model="searchForm.type">
                        <Option :value="1">奖励</Option>
                        <Option :value="2">罚款</Option>
                        <Option :value="3">其他</Option>
                    </Select>
                </FormItem>

                <FormItem :label-width="1">
                    <Button @click="search(1)" type="primary">搜索</Button>
                    <Button @click="download()" type="primary">导出</Button>
                    <Button @click="showComponent('Create')" type="primary">添加</Button>
                </FormItem>
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
    import CalendarPicker from '../../../components/month-picker/index'
    import Box from "../../../components/box/index";
    import AwardStatus from "../../components/award/status";
    import Create from "./create.vue"
    import Update from "./update.vue"

    export default {
        name: "index",
        components: {
            AwardStatus,
            Remote,
            CDatePicker,
            MyLists,
            CalendarPicker,
            Box,
            Create,
            Update

        },
        mixins: [lists],
        data() {
            return {
                options: {},
                columns: [
                    {
                        title: '奖惩编号',
                        key: 'reward_no'
                    },
                    {
                        title: '司机姓名',
                        render: (h, {row}) => {
                            return <span>{row.driver ? row.driver.name : ''}</span>
                        }
                    },
                    {
                        title: '司机手机号',
                        render: (h, {row}) => {
                            return <span>{row.driver ? row.driver.phone : ''}</span>
                        }
                    },
                    {
                        title: '商户简称',
                        render: (h, {row}) => {
                            return <span>{row.merchant ? row.merchant.short_name : ''}</span>
                        }
                    },
                    {
                        title: '出车单号',
                        render: (h, {row}) => {
                            return <span>{row.order ? row.order.order_no : ''}</span>
                        }
                    },
                    {
                        title: '类型',
                        render: (h, {row}) => {
                            return <AwardStatus status={row.type}></AwardStatus>
                        }
                    },
                    {
                        title: '金额',
                        key: 'fee'
                    },
                    {
                        title: '原因',
                        key: 'reason'
                    },
                    {
                        title: '创建人',
                        render: (h, {row}) => {
                            return <span>{row.user ? row.user.name : ''}</span>
                        }
                    },
                    {
                        title: '创建日期',
                        key: 'create_time'
                    },
                    {
                        title: '操作',
                        render: (h, {row}) => {
                            return (<button-group>
                                <i-button size="small" on-click={() => this.showComponent('Update', row)}>编辑</i-button>
                                <poptip
                                    confirm
                                    transfer
                                    title="确定要删除吗？"
                                    on-on-ok={() => this.destroyItem(row, `award/${row.id}`)}>
                                    <i-button size="small">删除</i-button>
                                </poptip>
                            </button-group>)
                        }
                    },
                ]
            }
        },
        methods: {
            search(page = 1) {
                this.loading = true
                this.$http.get(`award/`, {params: this.request(page)}).then((res) => {
                    this.assignmentData(res.data.data)
                }).finally(() => {
                    this.loading = false
                });
            },
            download() {
                this.$http.download(`award/export`, this.request(), '司机奖惩.xls');
            }
        }
    }
</script>

<style scoped>

</style>